@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5 mb-5" style="max-width: 500px;">
    <div class="card p-4">
        <div class="text-center mb-4">
            <h3 style="color: var(--primary);">রেজিস্ট্রেশন</h3>
            <p class="text-muted">নতুন অ্যাকাউন্ট তৈরি করুন</p>
        </div>

        <form action="{{ route('student.register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">আপনার পুরো নাম</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">ইমেইল</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">পাসওয়ার্ড</label>
                <div class="position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="6" oninput="checkPasswordStrength(this.value)">
                    <button type="button" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="password-strength mt-2" id="passStrengthBar" style="height: 4px; border-radius: 2px; background: #eee; overflow: hidden;">
                    <div id="passStrengthFill" style="height: 100%; width: 0%; transition: width 0.3s, background 0.3s;"></div>
                </div>
                <small class="text-muted" id="passStrengthText"></small>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">পাসওয়ার্ড নিশ্চিত করুন</label>
                <div class="position-relative">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    <button type="button" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword('password_confirmation', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreeTerms" name="terms" required>
                <label class="form-check-label" for="agreeTerms">
                    <a href="#" class="text-decoration-none">শর্তাবলী</a> এবং <a href="#" class="text-decoration-none">গোপনীয়তা নীতি</a> মেনে নিচ্ছি
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-person-plus me-2"></i>রেজিস্ট্রেশন
            </button>
        </form>

        <div class="text-center mt-3">
            <small>ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="{{ route('student.login') }}">লগইন করুন</a></small>
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

function checkPasswordStrength(password) {
    const fill = document.getElementById('passStrengthFill');
    const text = document.getElementById('passStrengthText');
    let strength = 0;
    if (password.length >= 6) strength++;
    if (password.length >= 10) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    const colors = ['#dc3545', '#ffc107', '#17a2b8', '#28a745', '#155724'];
    const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
    const widths = ['20%', '40%', '60%', '80%', '100%'];

    fill.style.width = widths[strength];
    fill.style.background = colors[strength];
    text.textContent = password.length > 0 ? 'Strength: ' + labels[strength] : '';
}
</script>
@endsection
