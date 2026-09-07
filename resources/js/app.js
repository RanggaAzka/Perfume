import './bootstrap-fallback';

// Mobile navigation
document.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('[data-mobile-menu]');
    const toggles = document.querySelectorAll('[data-mobile-toggle]');

    if (menu && toggles.length) {
        toggles.forEach((btn) => {
            btn.addEventListener('click', () => {
                const isOpen = menu.classList.toggle('flex');
                menu.classList.toggle('hidden');
                toggles.forEach((t) => t.setAttribute('aria-expanded', isOpen ? 'true' : 'false'));
                document.body.style.overflow = isOpen ? 'hidden' : '';
            });
        });

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menu.classList.contains('flex')) {
                menu.classList.remove('flex');
                menu.classList.add('hidden');
                toggles.forEach((t) => t.setAttribute('aria-expanded', 'false'));
                document.body.style.overflow = '';
            }
        });
    }

    // Admin sidebar drawer
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('[data-sidebar]');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        revealEls.forEach((el) => observer.observe(el));
    } else {
        revealEls.forEach((el) => el.classList.add('is-visible'));
    }

    // Refill carousel drag to scroll
    const carousel = document.getElementById('refill-carousel');
    if (carousel) {
        let isDown = false;
        let startX;
        let scrollLeft;

        carousel.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });

        carousel.addEventListener('mouseleave', () => {
            isDown = false;
        });

        carousel.addEventListener('mouseup', () => {
            isDown = false;
        });

        carousel.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - carousel.offsetLeft;
            const walk = (x - startX) * 1.5;
            carousel.scrollLeft = scrollLeft - walk;
        });
    }

    // Cart drawer (slide-over from the right)
    const cartDrawer = document.querySelector('[data-cart-drawer]');
    if (cartDrawer) {
        const cartPanel = cartDrawer.querySelector('[data-cart-panel]');
        const HIDE_TRANSITION_MS = 300;

        function openCart() {
            cartDrawer.classList.remove('hidden');
            requestAnimationFrame(() => {
                cartPanel.classList.remove('translate-x-full');
            });
            cartDrawer.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeCart() {
            if (cartDrawer.getAttribute('aria-hidden') === 'true') return;
            cartPanel.classList.add('translate-x-full');
            cartDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            window.setTimeout(() => {
                if (cartDrawer.getAttribute('aria-hidden') === 'true') {
                    cartDrawer.classList.add('hidden');
                }
            }, HIDE_TRANSITION_MS);
        }

        document.querySelectorAll('[data-cart-open]').forEach((btn) => {
            btn.addEventListener('click', openCart);
        });
        document.querySelectorAll('[data-cart-close]').forEach((btn) => {
            btn.addEventListener('click', closeCart);
        });
        document.querySelectorAll('[data-cart-backdrop]').forEach((el) => {
            el.addEventListener('click', closeCart);
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeCart();
        });

        // Auto-open after an add/update operation so the customer sees the result.
        if (cartDrawer.hasAttribute('data-cart-open-on-load')) {
            openCart();
        }
    }

    // Success confirmation modal (popup shown after a successful form submission).
    const successModal = document.querySelector('[data-success-modal]');
    if (successModal) {
        const successPanel = successModal.querySelector('[data-success-panel]');

        function openSuccessModal() {
            successModal.classList.remove('hidden');
            successModal.classList.add('flex');
            successModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeSuccessModal() {
            if (successModal.getAttribute('aria-hidden') === 'true') return;
            successModal.classList.add('hidden');
            successModal.classList.remove('flex');
            successModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        successModal.querySelectorAll('[data-success-close]').forEach((btn) => {
            btn.addEventListener('click', closeSuccessModal);
        });
        successModal.querySelectorAll('[data-success-backdrop]').forEach((el) => {
            el.addEventListener('click', closeSuccessModal);
        });
        const successKeyHandler = (e) => {
            if (e.key === 'Escape') closeSuccessModal();
        };
        document.addEventListener('keydown', successKeyHandler);

        if (successModal.hasAttribute('data-success-open-on-load')) {
            openSuccessModal();
        }
    }

    // Cart AJAX: quantity stepper and remove (no page reload).
    const rupiah = new Intl.NumberFormat('id-ID');

    function cartFetch(action, method, body) {
        const token = document.querySelector('meta[name="csrf-token"]');
        return fetch(action, {
            method,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token ? token.content : '',
            },
            credentials: 'same-origin',
            body: body ? JSON.stringify(body) : undefined,
        }).then((response) => {
            if (!response.ok) throw new Error('Request failed');
            return response.json();
        });
    }

    function setCartCount(count) {
        document.querySelectorAll('[data-cart-count]').forEach((badge) => {
            badge.textContent = count > 99 ? '99+' : String(count);
            badge.classList.toggle('hidden', count <= 0);
        });
    }

    function setDrawerSubtotal(subtotal) {
        document.querySelectorAll('[data-cart-subtotal]').forEach((el) => {
            el.textContent = 'Rp ' + rupiah.format(subtotal);
        });
    }

    function setCartTotals(subtotal, count) {
        setDrawerSubtotal(subtotal);
        setCartCount(count);
        document.querySelectorAll('[data-cart-tambah-link]').forEach((el) => {
            el.classList.toggle('hidden', count <= 0);
        });
    }

    // Quantity stepper: PATCH via fetch, update numbers in place.
    document.querySelectorAll('[data-cart-inc], [data-cart-dec]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const input = document.querySelector(btn.dataset.target);
            if (!input) return;

            const step = btn.hasAttribute('data-cart-inc') ? 1 : -1;
            const next = Math.max(1, Math.min(99, parseInt(input.value || '1', 10) + step));

            btn.disabled = true;
            cartFetch(btn.closest('form').action, 'PATCH', { quantity: next })
                .then((data) => {
                    input.value = data.quantity;
                    const line = btn.closest('[data-line-key]');
                    if (line) {
                        const display = line.querySelector('[data-qty-display]');
                        const sub = line.querySelector('[data-line-subtotal]');
                        if (display) display.textContent = String(data.quantity);
                        if (sub) sub.textContent = 'Rp ' + rupiah.format(data.line_subtotal);
                    }
                    setCartTotals(data.subtotal, data.count);
                })
                .catch(() => {
                    input.value = input.value;
                })
                .finally(() => {
                    btn.disabled = false;
                });
        });
    });

    // Remove item: confirm, DELETE via fetch, drop the row (or empty state).
    document.querySelectorAll('[data-cart-remove]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            if (!window.confirm('Hapus item ini dari keranjang?')) return;
            e.preventDefault();

            const form = btn.closest('[data-cart-remove-form]');
            btn.disabled = true;

            cartFetch(form ? form.action : '', 'DELETE')
                .then((data) => {
                    const line = btn.closest('[data-line-key]');
                    if (line) {
                        if (data.empty && document.getElementById('cart-drawer-body')) {
                            document.getElementById('cart-drawer-body').innerHTML = data.html;
                        } else {
                            line.remove();
                        }
                    }
                    setCartTotals(data.subtotal, data.count);
                })
                .catch(() => { })
                .finally(() => {
                    btn.disabled = false;
                });
        });
    });

    // Admin product form: dynamic Main Accords picker (select + % rows).
    const accordPicker = document.querySelector('[data-accord-picker]');
    if (accordPicker) {
        const rowsEl = accordPicker.querySelector('[data-accord-rows]');
        const template = document.getElementById('accord-row-template');
        const addBtn = accordPicker.querySelector('[data-accord-add]');
        const MAX_ACCORDS = 4;

        function syncAccordRows() {
            const rows = Array.from(rowsEl.querySelectorAll('.accord-row'));
            const used = [];

            rows.forEach((row, i) => {
                const select = row.querySelector('select[name*="[accord]"]');
                const input = row.querySelector('input[name*="[percent]"]');
                if (select) select.name = 'main_accords[' + i + '][accord]';
                if (input) input.name = 'main_accords[' + i + '][percent]';
                Array.from(select.options).forEach((opt) => { opt.disabled = false; });
                if (select.value) used.push(select.value);
            });

            rows.forEach((row) => {
                const select = row.querySelector('select[name*="[accord]"]');
                if (!select || select.value) return;
                Array.from(select.options).forEach((opt) => {
                    if (opt.value && used.includes(opt.value)) opt.disabled = true;
                });
            });

            addBtn.disabled = rows.length >= MAX_ACCORDS;
        }

        addBtn.addEventListener('click', () => {
            if (rowsEl.querySelectorAll('.accord-row').length >= MAX_ACCORDS) return;
            rowsEl.appendChild(template.content.cloneNode(true));
            syncAccordRows();
        });

        rowsEl.addEventListener('click', (e) => {
            const removeBtn = e.target.closest('[data-accord-remove]');
            if (removeBtn) {
                removeBtn.closest('.accord-row').remove();
                syncAccordRows();
            }
        });

        rowsEl.addEventListener('change', (e) => {
            if (e.target.matches('select[name*="[accord]"]')) syncAccordRows();
        });

        syncAccordRows();
    }
});
