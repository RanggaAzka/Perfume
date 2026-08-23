@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
    @if ($errors->any())
        <div class="mb-6 border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="text-xs uppercase tracking-widest2 text-ink/50">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
        </div>

        <div>
            <label for="password" class="text-xs uppercase tracking-widest2 text-ink/50">Password</label>
            <input type="password" name="password" id="password" required
                   class="mt-2 w-full border-0 border-b border-black/20 bg-transparent px-0 py-2 text-sm focus:border-gold focus:ring-0">
        </div>

        <label class="flex items-center gap-2 text-sm text-ink/60">
            <input type="checkbox" name="remember" class="rounded border-black/20 text-gold focus:ring-gold">
            Remember me
        </label>

        <button type="submit"
                class="w-full border border-ink px-8 py-3 text-sm uppercase tracking-widest2 transition hover:border-gold hover:text-gold">
            Sign In
        </button>
    </form>
@endsection
