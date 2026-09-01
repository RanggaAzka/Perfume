# USER GUIDE
# WEBSITE E-COMMERCE & BRAND PERFU.ME
### SMK Informatika Pesat — Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL)

---

| **Informasi Dokumen** | **Keterangan** |
|---|---|
| **Judul Dokumen** | User Guide Website E-Commerce & Brand Perfu.me |
| **Disusun oleh** | Tim Pengembang Web Perfu.me (Faisal & Tim RPL) |
| **Program / Kelas** | Rekayasa Perangkat Lunak (RPL) — SMK Informatika Pesat |
| **Tanggal** | 1 September 2026 |
| **Versi Dokumen** | 1.0 (Final Release) |
| **Alamat Website** | `http://localhost:8000` / `https://perfu.me` |

---

## 1. Pendahuluan

### 1.1 Tentang Dokumen
Dokumen **User Guide** ini disusun sebagai buku panduan resmi operasional dan penggunaan website *perfu.me*. Panduan ini mencakup petunjuk langkah demi langkah, mulai dari cara mengakses website, menjelajahi katalog produk parfum, memesan refill aroma, menggunakan fitur keranjang belanja interaktif hingga proses checkout pesanan dan pengelolaan data melalui panel Admin (Console).

### 1.2 Tentang Website
**Perfu.me** (*Smell Good, Feel Confident.*) adalah platform web e-commerce dan katalog fragrance modern yang menghadirkan lini parfum signature berkualitas tinggi dengan karakter aroma mewah (*affordable luxury*). Website ini dilengkapi dengan fitur katalog parfum dengan piramida aroma (*olfactive pyramid*) dan visual persentase *main accords*, layanan stasiun isi ulang (*refill station*), sistem keranjang belanja (*cart slide-over drawer*), formulir pemesanan terintegrasi notifikasi WhatsApp otomatis (**Fonnte API Gateway**), serta panel administrasi lengkap untuk manajemen inventaris produk.

### 1.3 Sasaran Pengguna Dokumen
1. **Pelanggan & Pengunjung Umum**: Panduan menjelajahi aroma, memilih ukuran botol refill, memasukkan item ke keranjang, dan melakukan transaksi pemesanan.
2. **Administrator & Pengelola Toko**: Panduan mengelola katalog parfum, menambah aroma refill, memantau pesanan masuk, membalas pesan WhatsApp pelanggan langsung dari web, dan mengonfigurasi gateway WhatsApp.
3. **Guru Pembimbing & Tim Penguji**: Dokumen referensi kelengkapan pengujian fungsionalitas dan arsitektur sistem perangkat lunak.

---

## 2. Kebutuhan Sistem

Sebelum mengakses dan menggunakan website *perfu.me*, pastikan perangkat Anda memenuhi spesifikasi berikut:

* **Perangkat**: Laptop, Komputer Desktop, Tablet, atau Smartphone (Android / iOS).
* **Browser yang Disarankan**: Google Chrome, Mozilla Firefox, Microsoft Edge, atau Apple Safari versi terbaru.
* **Koneksi Internet**: Koneksi internet yang stabil untuk memuat aset visual dan komunikasi API WhatsApp.
* **Kompatibilitas**: Website bersifat *fully responsive* (otomatis menyesuaikan resolusi layar mobile, tablet, maupun desktop) dan berbasis web murni (*web-based*) tanpa memerlukan instalasi aplikasi pihak ketiga.

---

## 3. Struktur Halaman Website

Berikut adalah peta struktur menu utama pada website *perfu.me* beserta fungsinya:

### A. Halaman Publik (Frontend)

| No | Nama Halaman / Menu | Fungsi & Isi Halaman |
|:--:|---|---|
| **1** | **Beranda (Home)** | Menampilkan hero banner minimalis mewah dengan slogan *"Smell Good, Feel Confident"*, pengenalan aroma unggulan (*Featured Products*), pratinjau stasiun refill, dan langganan buletin (*newsletter*). |
| **2** | **Tentang Kami (About)** | Menjelaskan filosofi brand *perfu.me*, standar peracikan bahan baku olfactive berkualitas, serta komitmen menghadirkan wewangian mewah dengan harga terjangkau. |
| **3** | **Kisah Aroma (Story)** | Mengulas perjalanan kreasi aroma (*artisan craftsmanship*), harmonisasi racikan piramida wewangian, dan komitmen keberlanjutan (*sustainability*). |
| **4** | **Katalog Produk (Products)** | Menampilkan seluruh koleksi parfum signature lengkap dengan filter pencarian aroma, kartu produk dengan foto botol, harga resmi, stepper kuantitas (`-` `1` `+`), dan tombol tambah ke keranjang. |
| **5** | **Detail Produk (Show Product)** | Menampilkan visual detail botol parfum, karakter wewangian, diagram persentase *Main Accords*, piramida aroma lengkap (*Top, Heart, Base Notes*), opsi kuantitas, tombol tambah keranjang, dan tombol order kilat via WhatsApp. |
| **6** | **Stasiun Refill (Refill Collection)** | Menampilkan daftar lengkap aroma yang tersedia untuk isi ulang (*refill*), panduan harga berdasarkan ukuran botol (30ml, 50ml, 100ml), serta formulir pemesanan isi ulang langsung ke keranjang. |
| **7** | **Keranjang Belanja (Cart Drawer)** | Slide-over drawer interaktif dari sisi kanan layar yang menampilkan daftar item belanjaan, kalkulasi subtotal otomatis, kontrol penambahan/pengurangan kuantitas, tombol hapus item, dan form checkout data pelanggan. |
| **8** | **Hubungi Kami (Contact)** | Menampilkan informasi alamat butik fisik, jam operasional, email customer care, tautan instant chat WhatsApp, serta formulir pengiriman pesan/konsultasi aroma. |

### B. Halaman Pengelola (Admin Console)

| No | Nama Halaman / Fitur | Fungsi & Isi Halaman |
|:--:|---|---|
| **9** | **Login Admin (`/login`)** | Pintu masuk autentikasi aman bagi administrator dengan logo resmi *perfu.me* dan proteksi sesi. |
| **10** | **Admin Dashboard** | Menampilkan statistik produk aktif, total aroma refill, pesan/pesanan belum dibaca, feed produk terbaru, dan daftar pesan pelanggan masuk. |
| **11** | **Manajemen Produk** | Menambah produk baru, mengedit deskripsi, mengatur harga, mengunggah foto botol parfum, menyusun *fragrance notes*, dan mengatur persentase *main accords*. |
| **12** | **Koleksi Refill** | Menambah varian aroma refill baru, mengaktifkan/menonaktifkan ketersediaan refill di toko, serta memantau total permintaan per aroma. |
| **13** | **Fragrance Notes** | Database kamus aroma olfactive (*vanilla, amber, bergamot, cedarwood, dll.*) yang digunakan sebagai komponen racikan produk signature. |
| **14** | **Pesan & Pesanan Masuk** | Filter pesan/order (Kontak, Refill, Pertanyaan Produk, Checkout Keranjang), rincian tabel barang pesanan, tombol balas WhatsApp resmi, dan arsip riwayat balasan. |
| **15** | **Pengaturan & Fonnte Gateway** | Mengatur identitas brand, jam operasional, alamat butik, tautan media sosial (Instagram, TikTok), token API WhatsApp Gateway Fonnte, status koneksi perangkat, dan tombol uji coba ping pesan. |

---

## 4. Panduan Penggunaan — Pengunjung & Pelanggan (Langkah demi Langkah)

### 4.1 Mengakses Website
1. Buka aplikasi peramban web (*Google Chrome / Safari / Edge*) di laptop atau smartphone Anda.
2. Masukkan alamat URL website: `http://localhost:8000` (atau domain live `https://perfu.me`).
3. Tekan **Enter**. Halaman Beranda (*Home*) akan terbuka secara otomatis dengan tampilan poster minimalis mewah dan visual botol parfum signature.

---

### 4.2 Menjelajahi & Memilih Produk Signature
1. Klik menu **"Products"** pada navigasi atas website.
2. Anda akan diarahkan ke halaman katalog produk lengkap.
3. Anda dapat mencari parfum berdasarkan nama atau menyaring kategori aroma melalui kolom pencarian.
4. Gunakan kontrol kuantitas stepper **(`-` `1` `+`)** pada kartu produk untuk menentukan jumlah botol yang diinginkan.
5. Klik tombol **"Tambah ke Keranjang"** untuk memasukkan produk ke keranjang belanja secara instan, atau klik nama produk untuk melihat profil wewangian secara detail.

---

### 4.3 Membaca Profil Aroma & Olfactive Pyramid pada Halaman Detail
1. Pada halaman katalog produk, klik salah satu foto atau nama parfum untuk membuka halaman **Detail Produk**.
2. Halaman ini menyajikan informasi menyeluruh:
   * **Deskripsi & Karakter**: Karakter wewangian, konsentrasi (*Eau de Parfum*), dan ketahanan (*longevity*).
   * **Main Accords**: Bar grafik interaktif persentase komposisi olfactive dominan (*misal: Sweet 40%, Vanilla 30%, Amber 20%*).
   * **Fragrance Architecture**: Piramida aroma yang membagi formula parfum menjadi **Top Notes** (aroma awal), **Heart Notes** (aroma inti), dan **Base Notes** (aroma dasar tahan lama).
3. Tentukan jumlah produk pada kotak **Qty** (`-` `1` `+`), lalu klik **"Tambah ke Keranjang"** atau klik tombol **"Pesan Cepat via WhatsApp"** jika ingin memesan langsung tanpa melalui keranjang belanja.

---

### 4.4 Memesan Isi Ulang Aroma pada Stasiun Refill (Refill Collection)
1. Klik menu **"Refills"** pada navigasi atas website.
2. Halaman ini menjelaskan konsep ramah lingkungan dari *perfu.me Refill Station*.
3. Pada kartu formulir pemesanan refill:
   * Ketik atau pilih aroma yang diinginkan pada dropdown.
   * Pilih **Ukuran Botol** yang diinginkan (*30 ml, 50 ml, atau 100 ml*).
   * Tentukan jumlah botol pada kontrol kuantitas **(`-` `1` `+`)**.
4. Klik tombol **"Tambah ke Keranjang"**. Varian refill Anda akan tersimpan di keranjang belanja bersama produk signature lainnya.

---

### 4.5 Menggunakan Keranjang Belanja & Melakukan Checkout Pesanan
1. Klik icon **Shopping Bag (Keranjang)** di bagian navigasi atas untuk membuka **Cart Slide-Over Drawer**.
2. Di dalam drawer keranjang belanja:
   * Periksa daftar produk dan refill yang telah dipilih beserta rincian harga satuannya.
   * Anda dapat menambah/mengurangi kuantitas menggunakan tombol **`+`** atau **`-`**, atau menghapus item dengan mengklik tombol icon tempat sampah.
   * Subtotal dan Total tagihan belanja akan terkalkulasi secara otomatis secara *real-time*.
3. Gulir ke bawah pada bagian formulir **Detail Pemesan**:
   * Masukkan **Nama Lengkap Anda**.
   * Masukkan **Nomor WhatsApp Aktif** (*format: 08xxxxxxxxxx*).
   * Masukkan **Alamat Pengiriman / Catatan Khusus**.
4. Klik tombol emas **"Lanjut ke Checkout Pesanan &rarr;"**.
5. Sistem akan menyimpan pesanan Anda, mengosongkan keranjang, mengirimkan notifikasi instan ke WhatsApp admin, serta membuka aplikasi WhatsApp Anda dengan draf format pesanan rapi untuk konfirmasi akhir pembayaran.

---

### 4.6 Mengirimkan Pesan / Konsultasi pada Halaman Kontak
1. Klik menu **"Contact"** pada navigasi atas website.
2. Anda akan menemukan lokasi alamat butik fisik, jam operasional, email, serta tautan cepat WhatsApp concierge.
3. Untuk mengirim pesan melalui website, lengkapi formulir:
   * **Nama Anda**
   * **Alamat Email**
   * **Nomor WhatsApp** (opsional)
   * **Isi Pesan / Pertanyaan Konsultasi**
4. Klik tombol **"Kirim Pesan"**. Pesan Anda akan langsung masuk ke database panel admin toko.

---

## 5. Panduan Penggunaan — Administrator (Admin Console)

### 5.1 Masuk ke Panel Admin (Sign In)
1. Akses URL `/login` pada browser (contoh: `http://localhost:8000/login`).
2. Masukkan alamat email admin (*contoh: `admin@example.com`*) dan kata sandi Anda.
3. Centang opsi *"Ingat saya di perangkat ini"* jika menggunakan komputer pribadi.
4. Klik tombol **"Masuk ke Panel Admin &rarr;"**. Anda akan diarahkan ke halaman **Dashboard Overview**.

---

### 5.2 Memantau Aktivitas Toko pada Dashboard Overview
1. Dashboard menyajikan 4 kartu ringkasan utama:
   * **Signature Products**: Total produk parfum terdaftar di sistem.
   * **Active in Store**: Jumlah parfum yang sedang tayang aktif di website publik.
   * **Refill Aromas**: Total varian aroma refill yang tersedia.
   * **Unread Messages**: Jumlah pesanan atau pesan baru dari pelanggan yang belum dibaca.
2. Jika terdapat pesan/pesanan baru, banner notifikasi berwarna emas akan tampil di bagian atas dengan tombol **"Buka Pesan &rarr;"**.
3. Kolom **Recent Products** dan **Recent Customer Messages** memudahkan admin memantau riwayat entri terbaru secara sekilas.

---

### 5.3 Mengelola Produk Signature (Tambah, Edit, Hapus, & Atur Accords)
1. Pada sidebar navigasi admin, klik menu **"Signature Products"**.
2. **Menambah Produk Baru**:
   * Klik tombol **"+ Tambah Produk"** di pojok kanan atas.
   * Isi Nama Produk, Deskripsi Singkat, Deskripsi Lengkap, Fragrance Family, Kategori, Ketahanan, dan Harga Satuan (Rp).
   * Pada bagian **Fragrance Notes Architecture**, centang wewangian yang digunakan dan pilih posisinya (*Top Note, Heart Note, atau Base Note*).
   * Pada bagian **Main Accords**, klik *"+ Tambah Bar Accord"* untuk memilih jenis aroma (*Woody, Floral, Vanilla, Fresh, dll.*) serta tentukan persentasenya (maksimal 4 accord). Accord tertinggi akan otomatis ditampilkan paling atas di web publik.
   * Unggah foto botol parfum berformat PNG/JPG/WEBP.
   * Centang opsi *“Publikasikan produk”* agar langsung tampil di web publik.
   * Klik **"Buat Produk Baru &rarr;"**.
3. **Mengedit / Menghapus Produk**:
   * Klik tautan **"Edit"** pada baris produk yang ingin diubah datanya.
   * Klik tautan **"Hapus"** untuk menghapus produk dari database (dengan konfirmasi dialog keamanan).

---

### 5.4 Mengelola Koleksi Aroma Refill
1. Pada sidebar navigasi admin, klik menu **"Refill Collection"**.
2. Halaman ini memuat daftar semua aroma yang dapat di-refill oleh pelanggan.
3. Untuk menambahkan aroma baru, klik tombol **"+ Tambah Refill"**, ketik nama aroma parfum, pastikan opsi aktif tercentang, lalu klik **"Tambah Refill &rarr;"**.
4. Anda dapat menonaktifkan aroma tertentu sementara waktu tanpa harus menghapusnya dari database.

---

### 5.5 Memproses Pesan & Pesanan Checkout dari Pelanggan
1. Pada sidebar navigasi admin, klik menu **"Messages & Orders"**.
2. Gunakan filter dropdown untuk menyaring jenis pesan (*Direct Contact, Refill Requests, Product Inquiries, atau Cart Checkouts*) atau status pesan (*Unread / Read*).
3. Klik tombol **"Detail &rarr;"** pada pesan yang ingin diperiksa.
4. Pada halaman detail pesan:
   * Anda dapat melihat identitas pemesan, waktu masuk, serta tabel rincian item pesanan (nama produk, ukuran botol, jumlah kuantitas, dan total nilai belanja).
   * **Membalas Pesan via WhatsApp**: Ketik teks balasan pada kotak *"Kirim Balasan WhatsApp Resmi"* lalu klik tombol **"Kirim Balasan Sekarang &rarr;"**. Pesan balasan akan terkirim langsung ke nomor WhatsApp pelanggan secara resmi melalui Fonnte Gateway.
   * Klik tombol **"Chat di WhatsApp"** untuk membuka percakapan personal langsung di aplikasi WhatsApp Web/Desktop.

---

### 5.6 Mengatur Identitas Toko & Integrasi WhatsApp Gateway (Fonnte)
1. Pada sidebar navigasi admin, klik menu **"Settings & Fonnte"**.
2. Pada kartu **General Storefront**:
   * Perbarui Nama Brand, Email Resmi CS, Nomor Hotline, Jam Operasional, Alamat Butik, serta URL Instagram dan TikTok.
3. Pada kartu **Integrasi Notifikasi Fonnte**:
   * Masukkan **Fonnte Device API Token** dari akun *fonnte.com* Anda.
   * Masukkan **Nomor WhatsApp Admin Penerima** (*format: 628xxxxxxxxxx*) yang akan menerima alert setiap ada transaksi checkout baru.
   * Klik tombol **"Simpan Semua Pengaturan &rarr;"**.
4. Pada kartu **Fonnte Device Status**:
   * Periksa status koneksi perangkat (*Connected / Disconnected*), sisa kuota pesan WhatsApp, dan masa aktif token.
   * Klik tombol **"Send Test WhatsApp"** untuk menguji coba pengiriman pesan simulasi ke HP admin.

---

## 6. Pertanyaan yang Sering Diajukan (FAQ)

**T: Apakah website perfu.me dapat diakses dengan lancar melalui Smartphone?**  
**J:** Ya, website *perfu.me* dirancang 100% responsif dengan standar desain *mobile-first*, sehingga tampilan katalog, piramida aroma, keranjang belanja, hingga dashboard admin dapat dioperasikan secara ergonomis di HP, tablet, maupun laptop.

**T: Bagaimana cara pelanggan melakukan pemesanan parfum dan refill sekaligus?**  
**J:** Pelanggan cukup memilih produk parfum dari katalog dan aroma refill dari stasiun refill, memasukkan keduanya ke dalam Keranjang Belanja (*Cart Drawer*), lalu mengisi data kontak satu kali saat checkout.

**T: Apakah stok dan status produk di katalog dapat diperbarui kapan saja?**  
**J:** Ya, administrator dapat mengaktifkan atau menonaktifkan visibilitas produk maupun aroma refill kapan saja melalui panel admin tanpa perlu mengubah kode sumber.

**T: Bagaimana sistem notifikasi pesanan bekerja?**  
**J:** Setiap kali pelanggan menyelesaikan checkout di keranjang belanja, sistem backend *perfu.me* secara otomatis memicu layanan **Fonnte API** untuk mengirimkan notifikasi rincian pesanan ke nomor WhatsApp admin toko secara seketika (*real-time*).

**T: Di mana admin dapat melihat riwayat balasan pesan kepada pelanggan?**  
**J:** Pada halaman detail pesan di panel admin (`/admin/messages/{id}`), seluruh riwayat balasan yang pernah dikirimkan via WhatsApp tercatat rapi beserta stempel waktu pengirimannya.

---

## 7. Kontak Bantuan & Tim Pengembang

Jika Anda memiliki pertanyaan teknis, menemukan kendala sistem, atau memerlukan bantuan pengembangan lebih lanjut, silakan hubungi tim kami:

* **Tim Pengembang**: Faisal & Tim RPL (SMK Informatika Pesat)
* **Email Dukungan Teknis**: `concierge@perfu.me` / `faisal.dev@pesat.sch.id`
* **Layanan WhatsApp Concierge**: `+62 813-8341-5432`
* **Alamat Butik & Workshop**: Jl. Palem VII No. 37, RT 01 / RW 08, Kelurahan Sindang Barang, Kecamatan Bogor Barat, Kota Bogor, Jawa Barat 16117
* **Jam Layanan Bantuan**: Senin – Sabtu, 09.00 – 18.00 WIB

---
*© 2026 perfu.me — Smell Good, Feel Confident. Hak Cipta Dilindungi Undang-Undang.*
