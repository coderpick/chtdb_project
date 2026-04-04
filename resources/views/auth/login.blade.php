@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5 mb-5" style="max-width: 500px;">
    <div class="card p-4">
        <div class="text-center mb-4">
            <h3 style="color: var(--primary);">লগইন করুন</h3>
            <p class="text-muted">আপনার অ্যাকাউন্টে প্রবেশ করুন</p>
        </div>

        <form action="{{ route('student.login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">ইমেইল</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">পাসওয়ার্ড</label>
                <div class="position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    <button type="button" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">মনে রাখুন</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>লগইন
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}">← হOm পেজে ফিরুন</a>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endsection
