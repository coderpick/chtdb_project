  <!-- Footer -->
  <footer class="footer">
      <div class="container">
          <div class="row g-4">
              <div class="col-lg-4">
                  <div class="d-flex align-items-center gap-2 mb-3">
                      <div
                          style="width:48px;height:48px;border-radius:12px;background:var(--gradient-1);display:flex;align-items:center;justify-content:center;">
                          <i class="bi bi-mortarboard-fill text-white" style="font-size:1.5rem;"></i>
                      </div>
                      <div>
                          <h5 class="mb-0" style="font-size:1rem;">আইসিটি দক্ষতা উন্নয়ন স্কিম</h5>
                      </div>
                  </div>
                  <p style="font-size:0.88rem;line-height:1.8;opacity:0.8;">
                      তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও
                      আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিম। পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ
                      উদ্যোগ।
                  </p>
                  <div class="social-links mt-3">
                      <a href="#"><i class="bi bi-facebook"></i></a>
                      <a href="#"><i class="bi bi-youtube"></i></a>
                      <a href="#"><i class="bi bi-linkedin"></i></a>
                      <a href="#"><i class="bi bi-twitter-x"></i></a>
                  </div>
              </div>
              <div class="col-lg-2 col-md-4">
                  <h5>দ্রুত লিংক</h5>
                  <ul class="footer-links">
                      <li><a href="#home">হোম</a></li>
                      <li><a href="#about">প্রকল্প</a></li>
                      <li><a href="#stories">সাফল্যের গল্প</a></li>
                      <li><a href="#courses">কোর্সসমূহ</a></li>
                      <li><a href="{{ route('student.directory') }}">Students Directory</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 col-md-4">
                  <h5>গুরুত্বপূর্ণ লিংক</h5>
                  <ul class="footer-links">
                      <li><a href="https://chtdb.gov.bd" target="_blank"><i
                                  class="bi bi-box-arrow-up-right me-1"></i>পা.চ. উন্নয়ন বোর্ড</a></li>
                      <li><a href="https://peoplentech.com.bd" target="_blank"><i
                                  class="bi bi-box-arrow-up-right me-1"></i>PeopleNTech</a></li>
                      <li><a href="https://mochta.gov.bd" target="_blank"><i
                                  class="bi bi-box-arrow-up-right me-1"></i>পা.চ. বিষয়ক মন্ত্রণালয়</a></li>
                      <li><a href="https://ict.gov.bd" target="_blank"><i
                                  class="bi bi-box-arrow-up-right me-1"></i>আইসিটি বিভাগ</a></li>
                      <li><a href="https://bangladesh.gov.bd" target="_blank"><i
                                  class="bi bi-box-arrow-up-right me-1"></i>বাংলাদেশ সরকার</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 col-md-4">
                  <h5>নিউজলেটার</h5>
                  <p style="font-size:0.85rem;opacity:0.8;">সর্বশেষ আপডেট পেতে সাবস্ক্রাইব করুন</p>
                  <div class="input-group mt-3">
                      <input type="email" class="form-control" placeholder="আপনার ইমেইল"
                          style="border-radius:12px 0 0 12px;border:none;">
                      <button class="btn"
                          style="background:var(--primary);color:white;border-radius:0 12px 12px 0;padding:0 20px;">
                          <i class="bi bi-send"></i>
                      </button>
                  </div>
              </div>
          </div>
          <div class="footer-bottom text-center">
              <p class="mb-0" style="font-size:0.85rem;">
                  © {{ date('Y') }} তিন পার্বত্য জেলার আইসিটি দক্ষতা উন্নয়ন স্কিম | পার্বত্য চট্টগ্রাম উন্নয়ন
                  বোর্ড |
                  ট্রেনিং পার্টনার: <a href="https://peoplentech.com.bd" target="_blank"
                      style="color:var(--secondary);text-decoration:none;">PeopleNTech Institute of IT</a>
              </p>
          </div>
      </div>
  </footer>
  <!-- Back to Top -->
  <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
      <i class="bi bi-arrow-up"></i>
  </button>

  <!-- Success Modal -->
  <div class="modal fade success-modal" id="successModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="success-checkmark">
                  <i class="bi bi-check-lg"></i>
              </div>
              <h4 style="font-weight:700;color:var(--primary-dark);">ধন্যবাদ!</h4>
              <p style="color:#666;margin-bottom:20px;">আপনার বার্তা সফলভাবে পাঠানো হয়েছে। আমরা শীঘ্রই আপনার সাথে
                  যোগাযোগ করব।</p>
              <button type="button" class="btn btn-primary-custom" data-bs-dismiss="modal">ঠিক আছে</button>
          </div>
      </div>
  </div>

  <!-- ===== LOGIN MODAL ===== -->
  <div class="modal fade auth-modal" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="row g-0">
                  <div class="col-md-5">
                      <div class="auth-modal-left">
                          <h3>🏔️ স্বাগতম!</h3>
                          <p>তিন পার্বত্য জেলার আইসিটি দক্ষতা উন্নয়ন স্কিমের পোর্টালে আপনাকে স্বাগতম।</p>
                          <ul class="auth-features">
                              <li><i class="bi bi-check-circle-fill"></i> আপনার পোর্টফোলিও তৈরি করুন</li>
                              <li><i class="bi bi-check-circle-fill"></i> প্রশিক্ষণের তথ্য আপডেট করুন</li>
                              <li><i class="bi bi-check-circle-fill"></i> সাফল্যের গল্প শেয়ার করুন</li>
                              <li><i class="bi bi-check-circle-fill"></i> নেটওয়ার্ক গড়ে তুলুন</li>
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
                                  <input type="email" name="email" class="form-control"
                                      placeholder="আপনার ইমেইল" required>
                              </div>
                              <div class="auth-input-group">
                                  <i class="bi bi-lock input-icon"></i>
                                  <input type="password" name="password" class="form-control" id="loginPassword"
                                      placeholder="পাসওয়ার্ড" required>
                                  <button type="button" class="toggle-pass"
                                      onclick="togglePassword('loginPassword', this)"><i
                                          class="bi bi-eye"></i></button>
                              </div>
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="remember"
                                          id="rememberMe">
                                      <label class="form-check-label" for="rememberMe" style="font-size:0.85rem;">মনে
                                          রাখুন</label>
                                  </div>
                                  <a href="#"
                                      style="font-size:0.85rem;color:var(--primary);text-decoration:none;">পাসওয়ার্ড
                                      ভুলে গেছেন?</a>
                              </div>
                              <button type="submit" class="btn btn-auth">
                                  <i class="bi bi-box-arrow-in-right me-2"></i>লগইন করুন
                              </button>
                          </form>
                          <div class="auth-divider"><span>অথবা</span></div>
                          <div class="auth-switch">
                              অ্যাকাউন্ট নেই? <a href="javascript:void(0)" onclick="switchToRegister()">রেজিস্ট্রেশন
                                  করুন</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- ===== REGISTER MODAL ===== -->
  <div class="modal fade auth-modal" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false"
      tabindex="-1">
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
                                  <input type="text" name="name" class="form-control"
                                      placeholder="আপনার পুরো নাম" required>
                                  @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="auth-input-group">
                                  <i class="bi bi-envelope input-icon"></i>
                                  <input type="email" name="email" class="form-control"
                                      placeholder="আপনার ইমেইল" required>
                                  @error('email')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="auth-input-group">
                                  <i class="bi bi-geo-alt input-icon"></i>
                                  <select name="district" class="form-control" required>
                                      <option value="" selected disabled>জেলা নির্বাচন করুন</option>
                                      <option value="rangamati">রাঙ্গামাটি</option>
                                      <option value="khagrachhari">খাগড়াছড়ি</option>
                                      <option value="bandarban">বান্দরবান</option>
                                  </select>
                                  @error('district')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>


                              <div class="auth-input-group">
                                  <i class="bi bi-lock input-icon"></i>
                                  <input type="password" name="password" class="form-control" id="regPassword"
                                      placeholder="পাসওয়ার্ড (ন্যূনতম ৬ অক্ষর)" required minlength="6">
                                  <button type="button" class="toggle-pass"
                                      onclick="togglePassword('regPassword', this)"><i class="bi bi-eye"></i></button>
                                  @error('password')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                              <div class="auth-input-group">
                                  <i class="bi bi-lock-fill input-icon"></i>
                                  <input type="password" name="password_confirmation" class="form-control"
                                      id="regPasswordConfirm" placeholder="পাসওয়ার্ড নিশ্চিত করুন" required>
                                  <button type="button" class="toggle-pass"
                                      onclick="togglePassword('regPasswordConfirm', this)"><i
                                          class="bi bi-eye"></i></button>
                              </div>
                              <div class="form-check mb-3">
                                  <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                  <label class="form-check-label" for="agreeTerms" style="font-size:0.85rem;">
                                      <a href="#"
                                          style="color:var(--primary);text-decoration:none;">শর্তাবলী</a>
                                      ও <a href="#" style="color:var(--primary);text-decoration:none;">গোপনীয়তা
                                          নীতি</a> মেনে নিচ্ছি
                                  </label>
                              </div>
                              <button type="submit" class="btn btn-auth">
                                  <i class="bi bi-person-plus me-2"></i>রেজিস্ট্রেশন করুন
                              </button>
                          </form>
                          <div class="auth-divider"><span>অথবা</span></div>
                          <div class="auth-switch">
                              ইতিমধ্যে অ্যাকাউন্ট আছে? <a href="javascript:void(0)" onclick="switchToLogin()">লগইন
                                  করুন</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
