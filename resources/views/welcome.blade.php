@extends('layouts.frontend.master')
@section('content')
    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <!-- Particles (simplified for performance) -->
        <div class="particle" style="width:12px;height:12px;top:15%;left:8%;animation-delay:0s;"></div>
        <div class="particle" style="width:15px;height:15px;top:60%;left:5%;animation-delay:2s;"></div>
        <div class="particle" style="width:14px;height:14px;top:80%;right:10%;animation-delay:1.5s;"></div>

        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-badge">
                        <i class="bi bi-stars me-1"></i>
                        {{ \App\Models\Setting::get('hero_badge', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড') }}
                    </div>
                    <h1 class="hero-title">
                        {{ \App\Models\Setting::get('hero_title', 'তিন পার্বত্য জেলার') }}<br>
                        <span
                            class="highlight">{{ \App\Models\Setting::get('hero_highlight', 'আইসিটি দক্ষতা উন্নয়ন') }}</span><br>
                        {{ \App\Models\Setting::get('hero_title_end', 'ও আত্মকর্মসংস্থান স্কিম') }}
                    </h1>
                    {{-- <p class="hero-subtitle">
                        {{ \App\Models\Setting::get('hero_subtitle', 'রাঙামাটি, খাগড়াছড়ি ও বান্দরবান জেলার বেকার যুবক-যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়নের মাধ্যমে আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করা হচ্ছে। ট্রেনিং এ নিযুক্ত প্রতিষ্ঠান PeopleNTech এর সহযোগিতায়।') }}
                    </p> --}}
                    <div class="d-flex flex-wrap gap-3 mt-3">
                        <a href="#stories" class="btn btn-primary-custom btn-lg mb-0">
                            <i class="bi bi-trophy me-2"></i>ছাত্র/ছাত্রীদের মতামত
                        </a>
                        <a href="#about" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-info-circle me-2"></i>প্রকল্প সম্পর্কে জানুন
                        </a>
                    </div>
                    {{-- hero statistics title and values --}}
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['students'] }}">0</span></h3>
                            <p>{{ \App\Models\Setting::get('stat_1_label', 'প্রশিক্ষিত শিক্ষার্থী') }}</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['districts'] }}">0</span></h3>
                            <p>{{ \App\Models\Setting::get('stat_2_label', 'পার্বত্য জেলা') }}</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['courses'] }}">0</span></h3>
                            <p>{{ \App\Models\Setting::get('stat_3_label', 'আইসিটি কোর্স') }}</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['employment_rate'] }}">0</span>%</h3>
                            <p>{{ \App\Models\Setting::get('stat_4_label', 'কর্মসংস্থান হার') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-area">
                        <div class="hero-img-card p-2 shadow-lg position-relative">
                            <style>
                                #heroCarousel .carousel-indicators {
                                    justify-content: flex-end;
                                    margin-right: 5%;
                                    margin-bottom: 1rem;
                                }
                                #heroCarousel .carousel-indicators [data-bs-target] {
                                    width: 10px;
                                    height: 10px;
                                    border-radius: 50%;
                                    margin: 0 4px;
                                }
                                #heroCarousel .carousel-caption {
                                    bottom: 2.5rem;
                                    text-align: left;
                                    left: 5%;
                                    right: auto;
                                    padding: 0.5rem 1.2rem;
                                }
                            </style>
                            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                @if($sliders->count() > 0)
                                    @if($sliders->count() > 1)
                                        <div class="carousel-indicators">
                                            @foreach($sliders as $key => $slider)
                                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                                                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="carousel-inner rounded-4 overflow-hidden">
                                        @foreach($sliders as $key => $slider)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="4000">
                                                <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}" style="height: 380px; object-fit: cover;">
                                                @if($slider->title || $slider->subtitle)
                                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-4">
                                                        @if($slider->title) <h6 class="mb-0 text-white fw-bold">{{ $slider->title }}</h6> @endif
                                                        @if($slider->subtitle) <p class="x-small mb-0 text-white-50">{{ $slider->subtitle }}</p> @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    {{-- Fallback Static Carousel --}}
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                                    </div>
                                    <div class="carousel-inner rounded-4 overflow-hidden">
                                        <div class="carousel-item active" data-bs-interval="3000">
                                            <img src="{{ asset('img/hero_image.jpg') }}" class="d-block w-100" alt="ট্রেনিং সেশন" style="height: 380px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="{{ asset('img/rangamati.jpeg') }}" class="d-block w-100" alt="রাঙামাটি জেলা" style="height: 380px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="{{ asset('img/khagrachari.jpg') }}" class="d-block w-100" alt="খাগড়াছড়ি জেলা" style="height: 380px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif
                                
                                @if($sliders->count() > 1 || $sliders->count() == 0)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon shadow-sm" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon shadow-sm" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 reveal">
                    <div class="about-img-wrapper">
                        <img src="{{ asset('img/about.jpg') }}" alt="প্রশিক্ষণ">
                        <div class="about-overlay-badge">
                            <i class="bi bi-play-circle me-2"></i>
                            {{ \App\Models\Setting::get('about_badge', 'চলমান প্রশিক্ষণ কার্যক্রম') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <h2 class="section-title">{{ \App\Models\Setting::get('about_title', 'প্রকল্প সম্পর্কে') }}</h2>
                    <div class="section-divider"></div>
                    <p class="section-subtitle" style="max-width:100%;">
                        {{ \App\Models\Setting::get('about_subtitle', 'তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিমটি পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ডের একটি গুরুত্বপূর্ণ উদ্যোগ।') }}
                    </p>
                    <p style="font-size:0.92rem;color:#555;line-height:1.8;margin-bottom:25px;">
                        {{ \App\Models\Setting::get('about_description', 'এই প্রকল্পের মাধ্যমে রাঙামাটি, খাগড়াছড়ি ও বান্দরবান পার্বত্য জেলার বেকার যুবক-যুবতীদের আধুনিক তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ে হাতে-কলমে প্রশিক্ষণ প্রদান করা হয়েছে। প্রশিক্ষণ পার্টনার হিসেবে বাংলাদেশের অন্যতম শীর্ষস্থানীয় আইটি প্রশিক্ষণ প্রতিষ্ঠান PeopleNTech Institute of IT এই কার্যক্রম সফলভাবে পরিচালনা করেছে।') }}
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature-item">
                                <div class="feature-icon"><i class="bi bi-laptop"></i></div>
                                <div>
                                    <h6>আইসিটি প্রশিক্ষণ</h6>
                                    <p>আধুনিক প্রযুক্তি বিষয়ে হাতে-কলমে প্রশিক্ষণ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-item">
                                <div class="feature-icon"><i class="bi bi-briefcase"></i></div>
                                <div>
                                    <h6>কর্মসংস্থান সৃষ্টি</h6>
                                    <p>চাকরি ও ফ্রিল্যান্সিং এর সুযোগ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-item">
                                <div class="feature-icon"><i class="bi bi-people"></i></div>
                                <div>
                                    <h6>যুব উন্নয়ন</h6>
                                    <p>বেকার যুবক-যুবতীদের দক্ষতা বৃদ্ধি</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-item">
                                <div class="feature-icon"><i class="bi bi-globe2"></i></div>
                                <div>
                                    <h6>ডিজিটাল বাংলাদেশ</h6>
                                    <p>পার্বত্য অঞ্চলে ডিজিটাল সেবা সম্প্রসারণ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Organizations Section -->
    <section class="section-padding" id="organizations">
        <div class="container">
            <div class="text-center centered reveal">
                <h2 class="section-title">
                    {{ \App\Models\Setting::get('org_section_title', 'বাস্তবায়নকারী সংস্থা ও নিযুক্ত প্রতিষ্ঠান') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('org_section_subtitle', 'এই প্রকল্পের সাথে সংশ্লিষ্ট প্রধান সংস্থা ও তাদের ভূমিকা') }}
                </p>
            </div>
            <div class="row g-4">
                <!-- CHTDB -->
                <div class="col-lg-6 reveal">
                    <div class="org-card">
                        <div class="org-logo" style="background:rgba(13,74,40,0.08);">
                            <i class="bi bi-building text-success"></i>
                        </div>
                        <span class="badge bg-success mb-3">{{ \App\Models\Setting::get('chtdb_badge', 'প্রকল্প বাস্তবায়নকারী') }}</span>
                        <h4>{{ \App\Models\Setting::get('chtdb_name', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড') }}</h4>
                        <p>{{ \App\Models\Setting::get('chtdb_description', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড (CHTDB) বাংলাদেশ সরকারের পার্বত্য চট্টগ্রাম বিষয়ক মন্ত্রণালয়ের অধীনে একটি স্বায়ত্তশাসিত সংস্থা। রাঙামাটি, খাগড়াছড়ি ও বান্দরবান — এই তিন পার্বত্য জেলার সার্বিক আর্থ-সামাজিক উন্নয়নে গুরুত্বপূর্ণ ভূমিকা পালন করছে এই প্রতিষ্ঠান।') }}
                        </p>
                        <div class="org-list">
                            {!! \App\Models\Setting::get('chtdb_list', '<ul><li>পার্বত্য এলাকায় টেকসই সামাজিক সেবা প্রদান প্রকল্প</li><li>আইসিটি ভিত্তিক দক্ষ জনবল সৃষ্টির মাধ্যমে আত্মকর্মসংস্থান সৃষ্টিকরণ</li><li>কৃষি, অবকাঠামো ও শিক্ষা খাতে উন্নয়ন প্রকল্প পরিচালনা</li><li>পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগে আইসিটি বিষয়ক প্রশিক্ষণ প্রদান</li><li>সোলার প্যানেল স্থাপনের মাধ্যমে বিদ্যুৎ সরবরাহ প্রকল্প</li></ul>') !!}
                        </div>
                        <a href="{{ \App\Models\Setting::get('chtdb_website', 'https://chtdb.gov.bd') }}" target="_blank" class="btn btn-primary-custom mt-3">
                            <i class="bi bi-globe me-1"></i> {{ \App\Models\Setting::get('chtdb_website_label', 'chtdb.gov.bd ভিজিট করুন') }}
                        </a>
                    </div>
                </div>

                <!-- PeopleNTech -->
                <div class="col-lg-6 reveal">
                    <div class="org-card">
                        <div class="org-logo" style="background:rgba(0,123,255,0.08);">
                            <i class="bi bi-pc-display-horizontal text-primary"></i>
                        </div>
                        <span class="badge bg-primary mb-3">{{ \App\Models\Setting::get('peoplentech_badge', 'ট্রেনিং প্রদানকারী প্রতিষ্ঠান') }}</span>
                        <h4>{{ \App\Models\Setting::get('peoplentech_name', 'PeopleNTech Institute of IT') }}</h4>
                        <p>{{ \App\Models\Setting::get('peoplentech_description', 'PeopleNTech গত ১৪+ বছর ধরে বাংলাদেশে আইটি প্রশিক্ষণ ও জব প্লেসমেন্ট সেবা প্রদান করে আসছে। বিশ্বমানের আইটি বিশেষজ্ঞ তৈরির লক্ষ্যে কাজ করছে এই প্রতিষ্ঠানটি। BASIS ও ISO 9001:2015 সার্টিফিকেটধারী এই প্রতিষ্ঠান দেশ-বিদেশে সুনাম অর্জন করেছে।') }}</p>
                        <div class="org-list">
                            {!! \App\Models\Setting::get('peoplentech_list', '<ul><li>ইন্ডাস্ট্রি-ফোকাসড লাইভ কোর্স পরিচালনা</li><li>চাকরি ও ইন্টার্নশিপ প্লেসমেন্ট সার্ভিস</li><li>ফ্রিল্যান্স ক্যারিয়ার গাইডেন্স ও সাপোর্ট</li><li>লাইফটাইম স্টুডেন্ট সাপোর্ট সিস্টেম</li><li>WUST (USA) এর সাথে গ্লোবাল একাডেমিক সহযোগিতা</li></ul>') !!}
                        </div>
                        <a href="{{ \App\Models\Setting::get('peoplentech_website', 'https://peoplentech.com.bd') }}" target="_blank" class="btn btn-primary-custom mt-3"
                            style="background:linear-gradient(135deg,#0d6efd,#0b5ed7);">
                            <i class="bi bi-globe me-1"></i> {{ \App\Models\Setting::get('peoplentech_website_label', 'peoplentech.com.bd ভিজিট করুন') }}
                        </a>
                    </div>
                </div>
            </div>
            <!-- PeopleNTech Detailed Section -->
            {{-- <div class="row mt-5 align-items-center reveal">
                <div class="col-lg-7">
                    <div
                        style="background:linear-gradient(135deg,#e8f5e9,#fff);border-radius:20px;padding:35px;border:1px solid rgba(26,107,60,0.1);">
                        <h4 style="font-weight:700;color:var(--primary-dark);margin-bottom:15px;">
                            <i class="bi bi-award me-2 text-success"></i>PeopleNTech কেন এই প্রকল্পের ট্রেনিং প্রদানকারী? 
                        </h4>
                        <p style="font-size:0.92rem;color:#555;line-height:1.8;">
                            PeopleNTech Institute of IT বাংলাদেশের অন্যতম শীর্ষস্থানীয় আইটি প্রশিক্ষণ প্রতিষ্ঠান। গত ১৪
                            বছরেরও বেশি সময় ধরে তারা সফলভাবে হাজার হাজার শিক্ষার্থীকে দক্ষ আইটি পেশাজীবী হিসেবে গড়ে
                            তুলেছে। তাদের ইন্ডাস্ট্রি-ফোকাসড কারিকুলাম, অভিজ্ঞ মেন্টর ও জব প্লেসমেন্ট সাপোর্ট এই
                            প্রকল্পের সফলতায় গুরুত্বপূর্ণ ভূমিকা রেখেছে।
                        </p>
                        <div class="row g-3 mt-2">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2 p-3"
                                    style="background:white;border-radius:12px;">
                                    <i class="bi bi-patch-check-fill text-success fs-4"></i>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;">ISO 9001:2015</div>
                                        <div style="font-size:0.78rem;color:#888;">সার্টিফাইড প্রতিষ্ঠান</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2 p-3"
                                    style="background:white;border-radius:12px;">
                                    <i class="bi bi-shield-check text-primary fs-4"></i>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;">BASIS সদস্য</div>
                                        <div style="font-size:0.78rem;color:#888;">জাতীয় সফটওয়্যার সমিতি</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2 p-3"
                                    style="background:white;border-radius:12px;">
                                    <i class="bi bi-globe2 text-info fs-4"></i>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;">WUST (USA)</div>
                                        <div style="font-size:0.78rem;color:#888;">গ্লোবাল একাডেমিক পার্টনার</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2 p-3"
                                    style="background:white;border-radius:12px;">
                                    <i class="bi bi-people-fill text-warning fs-4"></i>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;">১৪+ বছরের অভিজ্ঞতা</div>
                                        <div style="font-size:0.78rem;color:#888;">আইটি প্রশিক্ষণে</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div style="background:var(--gradient-2);border-radius:20px;padding:35px;color:white;">
                        <h5 style="font-weight:700;margin-bottom:20px;"><i class="bi bi-graph-up-arrow me-2"></i>
                            PeopleNTech এর অর্জন</h5>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3"
                            style="background:rgba(255,255,255,0.1);border-radius:12px;">
                            <span style="font-size:1.8rem;font-weight:800;color:var(--secondary);">১৪+</span>
                            <span style="font-size:0.9rem;">বছর ধরে সফল কার্যক্রম</span>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3"
                            style="background:rgba(255,255,255,0.1);border-radius:12px;">
                            <span style="font-size:1.8rem;font-weight:800;color:var(--secondary);">৯+</span>
                            <span style="font-size:0.9rem;">দেশে কার্যক্রম বিস্তৃত</span>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3"
                            style="background:rgba(255,255,255,0.1);border-radius:12px;">
                            <span style="font-size:1.8rem;font-weight:800;color:var(--secondary);">৫০+</span>
                            <span style="font-size:0.9rem;">একাডেমিক ইনস্টিটিউশন পার্টনার</span>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3"
                            style="background:rgba(255,255,255,0.1);border-radius:12px;">
                            <span style="font-size:1.8rem;font-weight:800;color:var(--secondary);">১০০+</span>
                            <span style="font-size:0.9rem;">দক্ষ ও অভিজ্ঞ প্রশিক্ষক</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- Officials Section -->
    <section class="section-padding" id="officials" style="background:white;">
        <div class="container">
            <div class="text-center centered reveal">
                <h2 class="section-title">
                    {{ \App\Models\Setting::get('officials_title', 'এই প্রকল্প বাস্তবায়নে যাদের ভূমিকা অনস্বীকার্য') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('officials_subtitle', 'পরিকল্পনা, বাস্তবায়ন ও নির্দেশনার মাধ্যমে যারা এই প্রকল্পকে সফল করতে নিরলস কাজ করেছেন') }}
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($officials as $official)
                    <div class="col-sm-6 col-lg-3 reveal">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                @if ($official->image)
                                    <img src="{{ asset($official->image) }}" alt="{{ $official->name }}">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person text-muted" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                <div class="team-social">
                                    @if ($official->facebook_url)
                                        <a href="{{ $official->facebook_url }}" target="_blank"><i
                                                class="bi bi-facebook"></i></a>
                                    @endif
                                    @if ($official->linkedin_url)
                                        <a href="{{ $official->linkedin_url }}" target="_blank"><i
                                                class="bi bi-linkedin"></i></a>
                                    @endif
                                    @if ($official->email)
                                        <a href="mailto:{{ $official->email }}"><i class="bi bi-envelope"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="team-info">
                                <h5>{{ $official->name }}</h5>
                                <p>{{ $official->designation }}</p>
                                @if ($official->organization)
                                    <small>{{ $official->organization }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section section-padding">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_1_value'] }}">0</span></div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_1_label', 'মোট প্রশিক্ষিত শিক্ষার্থী') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-briefcase-fill"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_2_value'] }}">0</span></div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_2_label', 'কর্মসংস্থান সৃষ্টি') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-globe2"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_3_value'] }}">0</span></div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_3_label', 'সফল ফ্রিল্যান্সার') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-shop"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_4_value'] }}">0</span></div>
                        <div class="stat-label">{{ \App\Models\Setting::get('stat_extra_4_label', 'উদ্যোক্তা তৈরি') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="stories-section section-padding" id="stories">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('stories_title', 'প্রশিক্ষিত ছাত্র/ছাত্রীদের মতামত') }}</h2>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('stories_subtitle', 'প্রশিক্ষণার্থীদের বাস্তব অভিজ্ঞতার আলোকে এই অংশটি তৈরি করা হয়েছে।') }}
                </p>
            </div>

            <!-- Filter -->
            <div class="text-center filter-btns mb-4 reveal">
                <button class="btn active" data-filter="all">সকল জেলা</button>
                <button class="btn" data-filter="rangamati">🟢 রাঙামাটি</button>
                <button class="btn" data-filter="khagrachhari">🔵 খাগড়াছড়ি</button>
                <button class="btn" data-filter="bandarban">🟡 বান্দরবান</button>
            </div>

            <div class="row g-4" id="storiesGrid">
                @foreach ($successStories as $index => $story)
                    @php
                        $user = $story->user;
                        $profile = $user?->studentProfile;
                        $name = $user?->name ?? 'শিক্ষার্থী';
                        $district = $story->district; // Use SuccessStory's direct district relation
$photo = $profile?->photo ?? null;

// Map district name to slug (lowercase) for JS filter
$districtSlug = $district ? strtolower($district->name) : '';
$districtLabel = $district ? $district->bn_name : 'সকল জেলা';

$training = $user?->training;
$course = $training?->course;
$courseName = $course?->name ?? 'আইসিটি কোর্স';
$courseIcon = $course?->icon ?? 'bi-laptop';

$career = $story->career;
$income = $career?->income ?? 0;
$careerStatus = $career?->status ?? 'job';

$statusLabels = [
    'job' => 'চাকরিজীবী',
    'freelance' => 'ফ্রিল্যান্সার',
    'entrepreneur' => 'উদ্যোক্তা',
    'job_freelance' => 'চাকরি ও ফ্রিল্যান্সিং',
    'unemployed' => 'বেকার',
    'student' => 'শিক্ষার্থী',
];
$tagText = $statusLabels[$careerStatus] ?? 'সাফল্য';
                    @endphp
                    <div class="col-md-6 col-lg-4 story-item {{ $index >= 6 ? 'd-none more-story' : '' }}"
                        @if ($districtSlug) data-district="{{ $districtSlug }}" @endif>
                        <div class="story-card reveal">
                            <div class="story-header">
                                <img src="{{ $photo ? asset($photo) : 'https://ui-avatars.com/api/?name=' . urlencode($name) }}"
                                    alt="{{ $name }}" class="story-avatar">
                                <div class="story-header-info">
                                    <h5>{{ $name }}</h5>
                                    <span class="district-badge">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $districtLabel }}
                                    </span>
                                </div>
                            </div>
                            <div class="story-body">
                                <span class="story-course"><i class="bi {{ $courseIcon }} me-1"></i>
                                    {{ $courseName }}</span>
                                <p class="story-text">
                                    {{ Str::limit($story->story_text, 200) }}
                                    @if(strlen($story->story_text) > 200)
                                        <a href="javascript:void(0)" class="read-more-btn" 
                                           data-name="{{ $name }}" 
                                           data-district="{{ $districtLabel }}"
                                           data-course="{{ $courseName }}"
                                           data-photo="{{ $photo ? asset($photo) : 'https://ui-avatars.com/api/?name=' . urlencode($name) }}"
                                           data-story="{{ $story->story_text }}">আরও পড়ুন</a>
                                    @endif
                                </p>
                            </div>
                            <div class="story-footer">
                                @if ($income > 0)
                                    <span class="story-income"><i class="bi bi-currency-exchange"></i> মাসিক আয়:
                                        {{ str_replace(range(0, 9), ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $income) }}৳</span>
                                @else
                                    <span class="story-income"></span>
                                @endif
                                <div class="story-tags"><span>{{ $tagText }}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($successStories->count() > 6)
                <div class="text-center mt-5 reveal">
                    <button class="btn btn-primary-custom btn-lg" id="loadMoreBtn" onclick="loadMore()">
                        <i class="bi bi-arrow-down-circle me-2"></i>আরও সাফল্যের গল্প দেখুন
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Courses Section -->
    <section class="section-padding" id="courses" style="background:var(--bg-light);">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('courses_title', 'প্রশিক্ষণের কোর্স মডিউলসমূহ') }}</h2>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('courses_subtitle', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড এর তত্ত্বাবধানে পরিচালিত আইসিটি কোর্স মডিউলসমূহ') }}
                </p>
            </div>
            <div class="row g-4">
                @foreach ($courses as $course)
                    <div class="col-6 col-md-4 col-lg-3 reveal">
                        <div class="course-card">
                            <div class="course-icon"
                                style="background:{{ $course->color }}20;color:{{ $course->color }};">
                                <i class="bi {{ $course->icon }}"></i>
                            </div>
                            <h5>{{ $course->name }}</h5>
                            <p>{{ Str::limit($course->description, 60) }}</p>
                            <span class="badge bg-success">{{ $course->duration_weeks }} সপ্তাহের কোর্স</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Timeline -->
    <section class="timeline-section section-padding" style="background:var(--bg-light);">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('timeline_title', 'প্রকল্পের পথচলা') }}</h2>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('timeline_subtitle', 'প্রকল্প শুরু থেকে আজ পর্যন্ত গুরুত্বপূর্ণ মাইলফলকসমূহ') }}
                </p>
            </div>
            <div class="timeline reveal">
                @for($i = 1; $i <= 4; $i++)
                    @php
                        $date = \App\Models\Setting::get("timeline_{$i}_date");
                        $title = \App\Models\Setting::get("timeline_{$i}_title");
                        $content = \App\Models\Setting::get("timeline_{$i}_content");
                    @endphp
                    @if($date || $title || $content)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <span class="timeline-date">{{ $date }}</span>
                                <h5>{{ $title }}</h5>
                                <p>{{ $content }}</p>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="section-padding" id="gallery">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('gallery_title', 'ফটো গ্যালারি') }}</h2>
                <p class="section-subtitle">{{ \App\Models\Setting::get('gallery_subtitle', 'প্রশিক্ষণ কার্যক্রমের বিভিন্ন মুহূর্ত') }}</p>
            </div>
            <div class="row g-3">
                @forelse($gallery as $index => $item)
                    <div class="col-6 col-md-4 col-lg-3 reveal">
                        <div class="gallery-item" onclick="openLightbox({{ $index }})">
                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}"
                                data-fullsize="{{ asset($item->image_path) }}">
                            <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                        </div>
                    </div>
                @empty
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="col-6 col-md-4 col-lg-3 reveal">
                            <div class="gallery-item" onclick="openLightbox({{ $i - 1 }})">
                                <img src="{{ asset('img/gallery/gallery-' . $i . '.jpg') }}" alt="প্রশিক্ষণ কার্যক্রম"
                                    data-fullsize="{{ asset('img/gallery/gallery-' . $i . '.jpg') }}">
                                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- Gallery Lightbox -->
    <div class="gallery-lightbox" id="galleryLightbox">
        <div class="lightbox-backdrop" onclick="closeLightbox()"></div>
        <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
        <button class="lightbox-nav lightbox-prev" onclick="navigateLightbox(-1)"><i
                class="bi bi-chevron-left"></i></button>
        <button class="lightbox-nav lightbox-next" onclick="navigateLightbox(1)"><i
                class="bi bi-chevron-right"></i></button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightboxImg">
            <div class="lightbox-caption" id="lightboxCaption"></div>
            <div class="lightbox-counter" id="lightboxCounter"></div>
        </div>
    </div>

    <!-- Training Centers -->
    <section class="section-padding" style="background:var(--bg-light);">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('centers_title', 'প্রশিক্ষণ ল্যাব সমূহ') }}</h2>
                <p class="section-subtitle">{{ \App\Models\Setting::get('centers_subtitle', 'তিন পার্বত্য জেলায় আমাদের কম্পিউটার ল্যাব সমূহ') }}
                </p>
            </div>
            <div class="row g-4">
                @foreach ($centers as $center)
                    @php
                        $districtName = strtolower($center->district->name ?? 'rangamati');
                        $fallbackImg = 'img/' . $districtName . ($districtName == 'rangamati' ? '.jpeg' : '.jpg');
                        $bannerUrl = $center->banner ? asset($center->banner) : asset($fallbackImg);
                    @endphp
                    <div class="col-md-4 reveal">
                        <div class="center-card">
                            <div class="center-card-header"
                                style="background:linear-gradient(135deg,rgba(0,0,0,0.5),rgba(0,0,0,0.6)),url('{{ $bannerUrl }}') center/cover no-repeat;">
                                <i class="bi bi-geo-alt-fill d-block"></i>
                                <h5>{{ $center->name }}</h5>
                            </div>
                            <div class="center-card-body">
                                <p><i class="bi bi-building me-2 text-success"></i>{{ $center->address }}</p>
                                {{-- <p><i class="bi bi-telephone me-2 text-success"></i>{{ $center->phone }}</p> --}}
                                <p><i class="bi bi-people me-2 text-primary"></i>{{ $center->total_trainee }}
                                    শিক্ষার্থী প্রশিক্ষিত</p>
                                <p><i class="bi bi-laptop me-2 text-success"></i>আধুনিক কম্পিউটার ল্যাব সুবিধা</p>
                                <p><i class="bi bi-wifi me-2 text-success"></i>হাই-স্পিড ইন্টারনেট সংযোগ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section section-padding" id="contact">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">{{ \App\Models\Setting::get('contact_title', 'যোগাযোগ করুন') }}</h2>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('contact_subtitle', 'আমাদের সাথে যোগাযোগ করতে নিচের ফর্মটি পূরণ করুন') }}</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-7 reveal">
                    <div class="contact-form-wrapper">
                        <form id="contactForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">আপনার নাম *</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="পুরো নাম লিখুন" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">মোবাইল নম্বর *</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="০১XXXXXXXXX"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">ইমেইল</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="example@email.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">জেলা *</label>
                                    <select name="district_id" class="form-select" required>
                                        <option value="">জেলা নির্বাচন করুন</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->bn_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">আগ্রহের কোর্স</label>
                                    <select name="course" class="form-select">
                                        <option value="">কোর্ট নির্বাচন করুন</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->slug }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">আপনার বার্তা</label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="আপনার বার্তা লিখুন..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom btn-lg w-100">
                                        <i class="bi bi-send me-2"></i>বার্তা পাঠান
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{--   contact information  --}}
                <div class="col-lg-5 reveal">
                    <div class="contact-info-card">
                        <h5 class="mb-4" style="font-weight:700;"><i class="bi bi-headset me-2"></i> যোগাযোগের তথ্য
                        </h5>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-building"></i></div>
                            <div>
                                <h6>{{ \App\Models\Setting::get('contact_address_title', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড') }}</h6>
                                <p>{{ \App\Models\Setting::get('contact_address', 'রাঙামাটি পার্বত্য জেলা, চট্টগ্রাম বিভাগ, বাংলাদেশ') }}</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <h6>ফোন নম্বর</h6>
                                <p>{{ \App\Models\Setting::get('contact_phone', '০২৩৩৩৩৭৩২৩১') }}</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-envelope"></i></div>
                            <div>
                                <h6>ইমেইল</h6>
                                <p>{{ \App\Models\Setting::get('contact_email', 'mi@chtdb.gov.bd') }}</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-globe"></i></div>
                            <div>
                                <h6>ওয়েবসাইট</h6>
                                <p><a href="{{ \App\Models\Setting::get('chtdb_website', 'https://chtdb.gov.bd') }}" target="_blank" style="color:#f5d060;">chtdb.gov.bd</a>
                                </p>
                            </div>
                        </div>
                        <hr style="border-color:rgba(255,255,255,0.2);">
                        <h6 class="mb-3" style="font-weight:600;">ট্রেনিং প্রদানকারী প্রতিষ্ঠান:</h6>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-pc-display"></i></div>
                            <div>
                                <h6>{{ \App\Models\Setting::get('training_partner_name', 'PeopleNTech Institute of IT') }}</h6>
                                <p><a href="{{ \App\Models\Setting::get('peoplentech_website', 'https://peoplentech.com.bd') }}" target="_blank"
                                        style="color:#f5d060;">peoplentech.com.bd</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Story Modal -->
    <div class="modal fade" id="storyModal" tabindex="-1" aria-labelledby="storyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header border-0 bg-light p-4">
                    <div class="d-flex align-items-center">
                        <img src="" alt="" id="modalPhoto" class="rounded-circle me-3" style="width: 65px; height: 65px; object-fit: cover; border: 3px solid var(--primary-light, #266b3c);">
                        <div>
                            <h5 class="modal-title mb-0 fw-bold" id="modalName" style="color: var(--primary); font-size: 1.25rem;"></h5>
                            <small class="text-muted" id="modalMeta" style="font-size: 0.9rem;"></small>
                        </div>
                    </div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5 position-relative">
                    <div class="quote-icon mb-3" style="font-size: 3rem; color: var(--primary); opacity: 0.1; position: absolute; top: 20px; left: 30px;">
                        <i class="bi bi-quote"></i>
                    </div>
                    <div class="story-content-wrapper position-relative" style="z-index: 1;">
                        <p id="modalStoryText" style="font-size: 1.1rem; line-height: 1.8; color: #444; white-space: pre-line; text-align: justify;"></p>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">বন্ধ করুন</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .hero-img-card {
            overflow: hidden;
        }

        .hero-img-card .carousel {
            border-radius: 16px;
            overflow: hidden;
        }

        .hero-img-card .carousel-indicators {
            bottom: 15px;
        }

        .hero-img-card .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--secondary);
            border: 2px solid white;
            opacity: 0.7;
            margin: 0 5px;
        }

        .hero-img-card .carousel-indicators .active {
            opacity: 1;
            background-color: white;
            transform: scale(1.2);
        }

        .hero-img-card .carousel-control-prev,
        .hero-img-card .carousel-control-next {
            width: 45px;
            height: 45px;
            background: rgba(26, 107, 60, 0.4);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .hero-img-card:hover .carousel-control-prev,
        .hero-img-card:hover .carousel-control-next {
            opacity: 1;
        }

        .hero-img-card .carousel-control-prev:hover,
        .hero-img-card .carousel-control-next:hover {
            background: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .hero-img-card .carousel-item img {
            transition: transform 5s ease;
        }

        .hero-img-card .carousel-item.active img {
            transform: scale(1.05);
        }

        .team-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .team-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 320px;
            border-bottom: 5px solid var(--primary);
        }

        .team-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform 0.5s ease;
        }

        .team-card:hover .team-img-wrapper img {
            transform: scale(1.1);
        }

        .team-social {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            background: rgba(26, 107, 60, 0.9);
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 15px 0;
            transition: all 0.4s;
        }

        .team-card:hover .team-social {
            bottom: 0;
        }

        .team-social a {
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .team-social a:hover {
            color: var(--secondary);
            transform: translateY(-3px);
        }

        .team-info {
            padding: 25px 15px;
        }

        .team-info h5 {
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
            font-size: 1.15rem;
        }

        .team-info p {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.88rem;
            margin-bottom: 2px;
        }

        .team-info small {
            color: #888;
            font-size: 0.78rem;
            display: block;
        }

        /* Read More Button Styles */
        .read-more-btn {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.88rem;
            margin-left: 5px;
            display: inline-block;
            transition: all 0.3s ease;
            border-bottom: 1px dashed var(--primary);
            padding-bottom: 1px;
        }

        .read-more-btn:hover {
            color: var(--secondary);
            border-bottom-color: var(--secondary);
            transform: translateX(3px);
        }

        .story-text {
            line-height: 1.7;
            color: #555;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const storyModal = document.getElementById('storyModal');
            if (storyModal) {
                const readMoreButtons = document.querySelectorAll('.read-more-btn');
                readMoreButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const name = this.getAttribute('data-name');
                        const district = this.getAttribute('data-district');
                        const course = this.getAttribute('data-course');
                        const photo = this.getAttribute('data-photo');
                        const story = this.getAttribute('data-story');

                        document.getElementById('modalName').innerText = name;
                        document.getElementById('modalMeta').innerText = `${district} | ${course}`;
                        document.getElementById('modalPhoto').src = photo;
                        document.getElementById('modalStoryText').innerText = story;

                        const modal = new bootstrap.Modal(storyModal);
                        modal.show();
                    });
                });
            }
        });
    </script>
@endpush
