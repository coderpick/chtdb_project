<!-- ===== LOGIN MODAL ===== -->
<div class="modal fade auth-modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="row g-0">
                <div class="col-md-5">
                    <div class="auth-modal-left">
                        <h3>🏔️ স্বাগতম!</h3>
                        <p>তিন পার্বত্য জেলার আইসিটি দক্ষতা উন্নয়ন স্কিমের পোর্টালে আপনাকে স্বাগতম।</p>
                        <ul class="auth-features">
                            <li><i class="bi bi-check-circle-fill"></i> আপনার পোর্টফোলিও তৈরি করুন</li>
                            <li><i class="bi bi-check-circle-fill"></i> প্রশিক্ষণের তথ্য আপডেট করুন</li>
                            <li><i class="bi bi-check-circle-fill"></i> সাফল্যের গল্প শেয়ার করুন</li>
                            <li><i class="bi bi-check-circle-fill"></i> নেটওয়ার Scrabble的古窑 G treat</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="auth-modal-right">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                        <h4><i class="bi bi-box-arrow-in-right me-2"></i>লগইন করুন</h4>
                        <p class="auth-subtitle">আপনার অ্যাকাউন্টে প্রবেশ করুন</p>
                        <form action="{{ route('student.login') }}" method="POST">
                            @csrf
                            <div class="auth-input-group">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="আপনার ইমেইল" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="auth-input-group">
                                <i class="bi bi-lock input-icon"></i>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="পাসওয়ার্ড" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="button" class="toggle-pass" onclick="togglePassword('loginPassword', this)"><i class="bi bi-eye"></i></button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rememberMe" style="font-size:0.85rem;">মনে রাখুন</label>
                                </div>
                                {{-- <a href="#" style="font-size:0.85rem;color:var(--primary);text-decoration:none;">পাসওয়ার্ড ভুলে গেছেন?</a> --}}
                            </div>
                            <button type="submit" class="btn btn-auth">
                                <i class="bi bi-box-arrow-in-right me-2"></i>লগইন করুন
                            </button>
                        </form>
                        <div class="auth-divider"><span>অথবা</span></div>
                        <div class="auth-switch">
                            অ্যাকাউন্ট নেই? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">রেজিস্ট্রেশন করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== REGISTER MODAL ===== -->
<div class="modal fade auth-modal" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="row g-0">
                <div class="col-md-5">
                    <div class="auth-modal-left">
                        <h3>🎓 যোগ দিন!</h3>
                        <p>নিজের প্রোফাইল তৈরি করুন, পোর্টফোলিও তৈরি করুন এবং আপনার সাফল্যের গল্প শেয়ার করুন।</p>
                        <ul class="auth-features">
                            <li><i class="bi bi-check-circle-fill"></i> সম্পূর্ণ বিনামূল্যে রেজিস্ট্রেশন</li>
                            <li><i class="bi bi-check-circle-fill"></i> ব্যক্তিগত ড্যাশবোর্ড</li>
                            <li><i class="bi bi-check-circle-fill"></i> পোর্টফোলিও বিল্ডার</li>
                            <li><i class="bi bi-check-circle-fill"></i> জব/ফ্রিল্যান্সিং প্রোফাইল</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="auth-modal-right">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                        <h4><i class="bi bi-person-plus me-2"></i>রেজিস্ট্রেশন</h4>
                        <p class="auth-subtitle">নতুন অ্যাকাউন্ট তৈরি করুন</p>
                        <form action="{{ route('student.register') }}" method="POST">
                            @csrf
                            <div class="auth-input-group">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="আপনার পুরো নাম" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="auth-input-group">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="আপনার ইমেইল" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="auth-input-group">
                                <i class="bi bi-lock input-icon"></i>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="পাসওয়ার্ড (ন্যূনতম ৬ অক্ষর)" required minlength="6" oninput="checkPasswordStrength(this.value)">
                                <button type="button" class="toggle-pass" onclick="togglePassword('regPassword', this)"><i class="bi bi-eye"></i></button>
                            </div>
                            <div class="password-strength" id="passStrengthBar"></div>
                            <small class="d-block mb-3" id="passStrengthText" style="font-size:0.78rem;color:#888;"></small>
                            @error('password')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror

                            <div class="auth-input-group">
                                <i class="bi bi-lock-fill input-icon"></i>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="পাসওয়ার্ড নিশ্চিত করুন" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                <label class="form-check-label" for="agreeTerms" style="font-size:0.85rem;">
                                    <a href="#" style="color:var(--primary);text-decoration:none;">শর্তাবলী</a> ও <a href="#" style="color:var(--primary);text-decoration:none;">গোপনীয়তা নীতি</a> মেনে নিচ্ছি
                                </label>
                            </div>

                            <button type="submit" class="btn btn-auth">
                                <i class="bi bi-person-plus me-2"></i>রেজিস্ট্রেশন
                            </button>
                        </form>
                        <div class="auth-divider"><span>অথবা</span></div>
                        <div class="auth-switch">
                            ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">লগইন করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
