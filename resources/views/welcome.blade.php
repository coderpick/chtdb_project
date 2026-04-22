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
                    <p class="hero-subtitle">
                        {{ \App\Models\Setting::get('hero_subtitle', 'রাঙামাটি, খাগড়াছড়ি ও বান্দরবান জেলার বেকার যুবক-যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়নের মাধ্যমে আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করা হচ্ছে। ট্রেনিং পার্টনার PeopleNTech এর সহযোগিতায়।') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#stories" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-trophy me-2"></i>সাফল্যের গল্প দেখুন
                        </a>
                        <a href="#about" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-info-circle me-2"></i>বিস্তারিত জানুন
                        </a>
                    </div>
                    {{-- hero statistics title and values --}}
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['students'] }}">0</span>+</h3>
                            <p>{{ \App\Models\Setting::get('stat_1_label', 'প্রশিক্ষিত শিক্ষার্থী') }}</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['districts'] }}">0</span></h3>
                            <p>{{ \App\Models\Setting::get('stat_2_label', 'পার্বত্য জেলা') }}</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['courses'] }}">0</span>+</h3>
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
                        <div class="hero-img-card">
                            <img src="{{ asset('img/hero_image.jpg') }}" alt="ট্রেনিং সেশন">
                        </div>
                        <div class="floating-badge badge-1">
                            <div class="d-flex align-items-center gap-2">
                                <div
                                    style="width:40px;height:40px;border-radius:10px;background:rgba(26,107,60,0.1);display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                </div>
                                <div>
                                    <div style="font-weight:700;font-size:0.85rem;">প্রশিক্ষণ সম্পন্ন</div>
                                    <div style="font-size:0.75rem;color:#888;">{{ $stats['students'] }} শিক্ষার্থী
                                        উত্তীর্ণ</div>
                                </div>
                            </div>
                        </div>
                        <div class="floating-badge badge-2">
                            <div class="d-flex align-items-center gap-2">
                                <div
                                    style="width:40px;height:40px;border-radius:10px;background:rgba(232,185,49,0.15);display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-trophy-fill" style="color:var(--secondary);"></i>
                                </div>
                                <div>
                                    <div style="font-weight:700;font-size:0.85rem;">সাফল্যের হার</div>
                                    <div style="font-size:0.75rem;color:#888;">{{ $stats['employment_rate'] }}%
                                        কর্মসংস্থান</div>
                                </div>
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
                    <div class="section-divider"></div>
                    <h2 class="section-title">{{ \App\Models\Setting::get('about_title', 'প্রকল্প সম্পর্কে') }}</h2>
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
                <div class="section-divider"></div>
                <h2 class="section-title">সংস্থাসমূহ ও অংশীদার</h2>
                <p class="section-subtitle">এই প্রকল্পের সাথে সংশ্লিষ্ট প্রধান সংস্থাসমূহ ও তাদের অবদান</p>
            </div>
            <div class="row g-4">
                <!-- CHTDB -->
                <div class="col-lg-6 reveal">
                    <div class="org-card">
                        <div class="org-logo" style="background:rgba(13,74,40,0.08);">
                            <i class="bi bi-building text-success"></i>
                        </div>
                        <span class="badge bg-success mb-3">প্রকল্প বাস্তবায়নকারী</span>
                        <h4>পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড</h4>
                        <p>পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড (CHTDB) বাংলাদেশ সরকারের পার্বত্য চট্টগ্রাম বিষয়ক
                            মন্ত্রণালয়ের অধীনে একটি স্বায়ত্তশাসিত সংস্থা। রাঙামাটি, খাগড়াছড়ি ও বান্দরবান — এই তিন
                            পার্বত্য জেলার সার্বিক আর্থ-সামাজিক উন্নয়নে গুরুত্বপূর্ণ ভূমিকা পালন করছে এই প্রতিষ্ঠান।
                        </p>
                        <ul class="org-list">
                            <li><i class="bi bi-check-circle-fill"></i> পার্বত্য এলাকায় টেকসই সামাজিক সেবা প্রদান
                                প্রকল্প</li>
                            <li><i class="bi bi-check-circle-fill"></i> আইসিটি ভিত্তিক দক্ষ জনবল সৃষ্টির মাধ্যমে
                                আত্মকর্মসংস্থান সৃষ্টিকরণ</li>
                            <li><i class="bi bi-check-circle-fill"></i> কৃষি, অবকাঠামো ও শিক্ষা খাতে উন্নয়ন প্রকল্প
                                পরিচালনা</li>
                            <li><i class="bi bi-check-circle-fill"></i> পার্বত্য চট্টগ্রামে তুলা চাষ বৃদ্ধি ও দারিদ্র্য
                                বিমোচন</li>
                            <li><i class="bi bi-check-circle-fill"></i> সোলার প্যানেল স্থাপনের মাধ্যমে বিদ্যুৎ সরবরাহ
                                প্রকল্প</li>
                        </ul>
                        <a href="https://chtdb.gov.bd" target="_blank" class="btn btn-primary-custom mt-3">
                            <i class="bi bi-globe me-1"></i> chtdb.gov.bd ভিজিট করুন
                        </a>
                    </div>
                </div>

                <!-- PeopleNTech -->
                <div class="col-lg-6 reveal">
                    <div class="org-card">
                        <div class="org-logo" style="background:rgba(0,123,255,0.08);">
                            <i class="bi bi-pc-display-horizontal text-primary"></i>
                        </div>
                        <span class="badge bg-primary mb-3">ট্রেনিং পার্টনার</span>
                        <h4>PeopleNTech Institute of IT</h4>
                        <p>PeopleNTech গত ১৪+ বছর ধরে বাংলাদেশে আইটি প্রশিক্ষণ ও জব প্লেসমেন্ট সেবা প্রদান করে আসছে।
                            বিশ্বমানের আইটি বিশেষজ্ঞ তৈরির লক্ষ্যে কাজ করছে এই প্রতিষ্ঠানটি। BASIS ও ISO 9001:2015
                            সার্টিফিকেটধারী এই প্রতিষ্ঠান দেশ-বিদেশে সুনাম অর্জন করেছে।</p>
                        <ul class="org-list">
                            <li><i class="bi bi-check-circle-fill"></i> ইন্ডাস্ট্রি-ফোকাসড লাইভ কোর্স পরিচালনা</li>
                            <li><i class="bi bi-check-circle-fill"></i> চাকরি ও ইন্টার্নশিপ প্লেসমেন্ট সার্ভিস</li>
                            <li><i class="bi bi-check-circle-fill"></i> ফ্রিল্যান্স ক্যারিয়ার গাইডেন্স ও সাপোর্ট</li>
                            <li><i class="bi bi-check-circle-fill"></i> লাইফটাইম স্টুডেন্ট সাপোর্ট সিস্টেম</li>
                            <li><i class="bi bi-check-circle-fill"></i> WUST (USA) এর সাথে গ্লোবাল একাডেমিক সহযোগিতা
                            </li>
                        </ul>
                        <a href="https://peoplentech.com.bd" target="_blank" class="btn btn-primary-custom mt-3"
                            style="background:linear-gradient(135deg,#0d6efd,#0b5ed7);">
                            <i class="bi bi-globe me-1"></i> peoplentech.com.bd ভিজিট করুন
                        </a>
                    </div>
                </div>
            </div>

            <!-- PeopleNTech Detailed Section -->
            <div class="row mt-5 align-items-center reveal">
                <div class="col-lg-7">
                    <div
                        style="background:linear-gradient(135deg,#e8f5e9,#fff);border-radius:20px;padding:35px;border:1px solid rgba(26,107,60,0.1);">
                        <h4 style="font-weight:700;color:var(--primary-dark);margin-bottom:15px;">
                            <i class="bi bi-award me-2 text-success"></i>PeopleNTech কেন এই প্রকল্পের ট্রেনিং পার্টনার?
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
                                data-target="{{ $stats['extra_1_value'] }}">0</span>+</div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_1_label', 'মোট প্রশিক্ষিত শিক্ষার্থী') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-briefcase-fill"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_2_value'] }}">0</span>+</div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_2_label', 'কর্মসংস্থান সৃষ্টি') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-globe2"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_3_value'] }}">0</span>+</div>
                        <div class="stat-label">
                            {{ \App\Models\Setting::get('stat_extra_3_label', 'সফল ফ্রিল্যান্সার') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-shop"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ $stats['extra_4_value'] }}">0</span>+</div>
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
                <h2 class="section-title">সাফল্যের গল্প</h2>
                <p class="section-subtitle">আমাদের প্রশিক্ষিত শিক্ষার্থীদের অনুপ্রেরণামূলক সাফল্যের কাহিনী</p>
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
                                <p class="story-text">{{ Str::limit($story->story_text, 200) }}</p>
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
                <h2 class="section-title">প্রশিক্ষণ কোর্সসমূহ</h2>
                <p class="section-subtitle">PeopleNTech এর তত্ত্বাবধানে পরিচালিত আইসিটি কোর্সসমূহ</p>
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
                <h2 class="section-title">প্রকল্পের পথচলা</h2>
                <p class="section-subtitle">প্রকল্প শুরু থেকে আজ পর্যন্ত গুরুত্বপূর্ণ মাইলফলকসমূহ</p>
            </div>
            <div class="timeline reveal">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">২০২৪ - শুরু</span>
                        <h5>প্রকল্প অনুমোদন ও পরিকল্পনা</h5>
                        <p>পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড কর্তৃক প্রকল্প অনুমোদন এবং PeopleNTech কে ট্রেনিং পার্টনার
                            হিসেবে নির্বাচন করা হয়।</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">২০২৫ - প্রথম ব্যাচ</span>
                        <h5>প্রথম ব্যাচ প্রশিক্ষণ শুরু</h5>
                        <p>রাঙামাটি, খাগড়াছড়ি ও বান্দরবানে একযোগে প্রশিক্ষণ কার্যক্রম আরম্ভ। প্রথম ব্যাচে ১০০+
                            শিক্ষার্থী অংশগ্রহণ।</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">২০২৫ - মধ্যভাগ</span>
                        <h5>দ্বিতীয় ব্যাচ ও সম্প্রসারণ</h5>
                        <p>দ্বিতীয় ব্যাচে আরও ১১৫+ শিক্ষার্থী যোগদান। নতুন কোর্স সংযোজন এবং কারিকুলাম আপডেট করা হয়।
                        </p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="timeline-date">২০২৬ - প্রথম ভাগ</span>
                        <h5>সফল সমাপ্তি ও কর্মসংস্থান</h5>
                        <p>২০০+ শিক্ষার্থী সফলভাবে প্রশিক্ষণ সম্পন্ন। ৮৫% শিক্ষার্থী কর্মসংস্থানে যুক্ত হয়েছে।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="section-padding" id="gallery">
        <div class="container">
            <div class="text-center centered reveal">
                <div class="section-divider"></div>
                <h2 class="section-title">ফটো গ্যালারি</h2>
                <p class="section-subtitle">প্রশিক্ষণ কার্যক্রমের বিভিন্ন মুহূর্ত</p>
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
                <h2 class="section-title">প্রশিক্ষণ কেন্দ্রসমূহ</h2>
                <p class="section-subtitle">তিন পার্বত্য জেলায় আমাদের প্রশিক্ষণ কেন্দ্র</p>
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
                                <p><i class="bi bi-telephone me-2 text-success"></i>{{ $center->phone }}</p>
                                <p><i class="bi bi-people me-2 text-primary"></i>{{ $center->total_trainee }}+
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
                <h2 class="section-title">যোগাযোগ করুন</h2>
                <p class="section-subtitle">আমাদের সাথে যোগাযোগ করতে নিচের ফর্মটি পূরণ করুন</p>
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
                                <h6>পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড</h6>
                                <p>রাঙামাটি পার্বত্য জেলা, চট্টগ্রাম বিভাগ, বাংলাদেশ</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <h6>ফোন নম্বর</h6>
                                <p>০২৩৩৩৩৭৩২৩১</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-envelope"></i></div>
                            <div>
                                <h6>ইমেইল</h6>
                                <p>mi@chtdb.gov.bd</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-globe"></i></div>
                            <div>
                                <h6>ওয়েবসাইট</h6>
                                <p><a href="https://chtdb.gov.bd" target="_blank" style="color:#f5d060;">chtdb.gov.bd</a>
                                </p>
                            </div>
                        </div>
                        <hr style="border-color:rgba(255,255,255,0.2);">
                        <h6 class="mb-3" style="font-weight:600;">ট্রেনিং পার্টনার:</h6>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-pc-display"></i></div>
                            <div>
                                <h6>PeopleNTech Institute of IT</h6>
                                <p><a href="https://peoplentech.com.bd" target="_blank"
                                        style="color:#f5d060;">peoplentech.com.bd</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
   
@endsection
