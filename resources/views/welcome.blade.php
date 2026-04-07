<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>আইসিটি দক্ষতা উন্নয়ন স্কিম | তিন পার্বত্য জেলা</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Top Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <span><i class="bi bi-geo-alt me-1"></i> পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড, রাঙামাটি</span>
                    <span class="ms-3"><i class="bi bi-envelope me-1"></i> info@chtdb.gov.bd</span>
                    <span class="ms-3"><i class="bi bi-telephone me-1"></i> +৮৮০-৩৫১-৬২০৮১</span>
                </div>
                <div class="col-md-5 text-end">
                    <a href="https://chtdb.gov.bd" target="_blank" class="me-3"><i class="bi bi-globe me-1"></i>
                        chtdb.gov.bd</a>
                    <a href="https://peoplentech.com.bd" target="_blank"><i class="bi bi-globe me-1"></i>
                        peoplentech.com.bd</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div
                    style="width:48px;height:48px;border-radius:12px;background:var(--gradient-1);display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-mortarboard-fill text-white" style="font-size:1.5rem;"></i>
                </div>
                <div class="brand-text d-none d-sm-block">আইসিটি দক্ষতা উন্নয়ন<br>তিন পার্বত্য জেলা স্কিম</div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">হোম</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">প্রকল্প</a></li>
                    <li class="nav-item"><a class="nav-link" href="#organizations">সংস্থাসমূহ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stories">সাফল্য</a></li>
                    <li class="nav-item"><a class="nav-link" href="#courses">কোর্সসমূহ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">গ্যালারি</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">যোগাযোগ</a></li>
                </ul>
                <div class="nav-auth-btns d-flex gap-2 ms-lg-3 mt-2 mt-lg-0">
                    <a href="#stories" class="btn btn-primary-custom">
                        <i class="bi bi-trophy me-1"></i> সাফল্যের গল্প
                    </a>
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.1);border:none;padding:8px;">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('student.dashboard') }}"
                                        style="border-radius:8px;padding:10px 16px;">
                                        <i class="bi bi-speedometer2 me-2"></i>ড্যাশবোর্ড
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form
                                        action="{{ Auth::user()->role == 'admin' ? route('admin.logout') : route('student.logout') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"
                                            style="border-radius:8px;padding:10px 16px;">
                                            <i class="bi bi-box-arrow-left me-2"></i>লগআউট
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="javascript:void(0)" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-in-right me-1"></i> লগইন
                        </a>
                        <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                            <i class="bi bi-person-plus me-1"></i> রেজিস্ট্রেশন
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Marquee -->
    <div class="marquee-bar">
        <div class="marquee-content">
            📢 তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান
            সুযোগ সৃষ্টিকরণ স্কিম — পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগে ২১৫+ শিক্ষার্থী
            প্রশিক্ষিত — রাঙামাটি | খাগড়াছড়ি | বান্দরবান 🏔️
        </div>
    </div>

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
                        <i class="bi bi-stars me-1"></i> পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড
                    </div>
                    <h1 class="hero-title">
                        তিন পার্বত্য জেলার<br>
                        <span class="highlight">আইসিটি দক্ষতা উন্নয়ন</span><br>
                        ও আত্মকর্মসংস্থান স্কিম
                    </h1>
                    <p class="hero-subtitle">
                        রাঙামাটি, খাগড়াছড়ি ও বান্দরবান জেলার বেকার যুবক-যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক
                        দক্ষতা উন্নয়নের মাধ্যমে আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করা হচ্ছে। ট্রেনিং পার্টনার
                        <strong>PeopleNTech</strong> এর সহযোগিতায়।
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#stories" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-trophy me-2"></i>সাফল্যের গল্প দেখুন
                        </a>
                        <a href="#about" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-info-circle me-2"></i>বিস্তারিত জানুন
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['students'] }}">0</span>+</h3>
                            <p>প্রশিক্ষিত শিক্ষার্থী</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['districts'] }}">0</span></h3>
                            <p>পার্বত্য জেলা</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['courses'] }}">0</span>+</h3>
                            <p>আইসিটি কোর্স</p>
                        </div>
                        <div class="hero-stat">
                            <h3><span class="counter" data-target="{{ $stats['employment_rate'] }}">0</span>%</h3>
                            <p>কর্মসংস্থান হার</p>
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
                            <i class="bi bi-play-circle me-2"></i> চলমান প্রশিক্ষণ কার্যক্রম
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <div class="section-divider"></div>
                    <h2 class="section-title">প্রকল্প সম্পর্কে</h2>
                    <p class="section-subtitle" style="max-width:100%;">
                        তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও
                        আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিমটি পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ডের একটি গুরুত্বপূর্ণ
                        উদ্যোগ।
                    </p>
                    <p style="font-size:0.92rem;color:#555;line-height:1.8;margin-bottom:25px;">
                        এই প্রকল্পের মাধ্যমে রাঙামাটি, খাগড়াছড়ি ও বান্দরবান পার্বত্য জেলার বেকার যুবক-যুবতীদের আধুনিক
                        তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ে হাতে-কলমে প্রশিক্ষণ প্রদান করা হয়েছে। প্রশিক্ষণ পার্টনার হিসেবে
                        বাংলাদেশের অন্যতম শীর্ষস্থানীয় আইটি প্রশিক্ষণ প্রতিষ্ঠান <strong>PeopleNTech Institute of
                            IT</strong> এই কার্যক্রম সফলভাবে পরিচালনা করেছে।
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
                            <span style="font-size:1.8rem;font-weight:800;color:var(--secondary);">৫০+</span>
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
                                data-target="{{ $stats['students'] }}">0</span>+</div>
                        <div class="stat-label">মোট প্রশিক্ষিত শিক্ষার্থী</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-briefcase-fill"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ round($stats['students'] * 0.92) }}">0</span>+</div>
                        <div class="stat-label">কর্মসংস্থান সৃষ্টি</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-globe2"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ round($stats['students'] * 0.2) }}">0</span>+</div>
                        <div class="stat-label">সফল ফ্রিল্যান্সার</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 reveal">
                    <div class="stat-box">
                        <div class="stat-icon"><i class="bi bi-shop"></i></div>
                        <div class="stat-number"><span class="counter"
                                data-target="{{ round($stats['students'] * 0.15) }}">0</span>+</div>
                        <div class="stat-label">উদ্যোক্তা তৈরি</div>
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
                                <img src="{{ asset('img/gallery/gallery-' . $i . '.jpg') }}"
                                    alt="প্রশিক্ষণ কার্যক্রম"
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
                    <div class="col-md-4 reveal">
                        <div class="center-card">
                            <div class="center-card-header"
                                style="background:linear-gradient(135deg,rgba(0,0,0,0.5),rgba(0,0,0,0.6)),url('{{ asset('img/' . ($center->district == 'khagrachari' ? 'khagrachari' : ($center->district == 'rangamati' ? 'rangamati' : 'bandarban')) . ($center->district == 'rangamati' ? '.jpeg' : '.jpg')) }}') center/cover no-repeat;">
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
                                    <input type="tel" name="phone" class="form-control"
                                        placeholder="০১XXXXXXXXX" required>
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
                                <p><a href="https://chtdb.gov.bd" target="_blank"
                                        style="color:#f5d060;">chtdb.gov.bd</a></p>
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
                        <li><a href="#contact">যোগাযোগ</a></li>
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
    <div class="modal fade auth-modal" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
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
                                        <label class="form-check-label" for="rememberMe"
                                            style="font-size:0.85rem;">মনে
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
                                        onclick="togglePassword('regPassword', this)"><i
                                            class="bi bi-eye"></i></button>
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
                                            style="color:var(--primary);text-decoration:none;">শর্তাবলী</a> ও <a
                                            href="#"
                                            style="color:var(--primary);text-decoration:none;">গোপনীয়তা
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const updateCount = () => {
                    const count = +counter.innerText;
                    const inc = target / speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        }

        // Reveal on scroll
        const reveal = () => {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);
        window.onload = () => {
            reveal();
            animateCounters();
        }

        // Contact form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>প্রক্রিয়াকরণ হচ্ছে...';
                
                const formData = new FormData(this);
                
                fetch('{{ route('contact.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        contactForm.reset();
                    } else {
                        alert(data.message || 'কিছু সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('দুঃখিত, সংযোগ বিচ্ছিন্ন হয়েছে। আবার চেষ্টা করুন।');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
            });
        }

        // Success stories filter
        const filterBtns = document.querySelectorAll('.filter-btns .btn');
        const storyItems = document.querySelectorAll('.story-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.getAttribute('data-filter');

                storyItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-district') === filter) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            });
        });

        // Load more success stories
        function loadMore() {
            const moreStories = document.querySelectorAll('.more-story');
            moreStories.forEach(story => story.classList.remove('d-none'));
            document.getElementById('loadMoreBtn').style.display = 'none';
        }

        // Load more testimonials
        function loadMoreTestimonials() {
            document.getElementById('moreTestimonials').style.display = 'flex';
            document.getElementById('loadMoreTestimonialsBtn').style.display = 'none';
        }

        // Toggle password visibility
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        // Auth modal switching
        function switchToRegister() {
            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            new bootstrap.Modal(document.getElementById('registerModal')).show();
        }

        function switchToLogin() {
            bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
            new bootstrap.Modal(document.getElementById('loginModal')).show();
        }

        // Gallery Lightbox
        let currentLightboxIndex = 0;
        const galleryImages = Array.from(document.querySelectorAll('.gallery-item img'));

        function openLightbox(index) {
            currentLightboxIndex = index;
            const img = galleryImages[index];
            document.getElementById('lightboxImg').src = img.getAttribute('data-fullsize') || img.src;
            document.getElementById('lightboxCaption').innerText = img.alt;
            document.getElementById('lightboxCounter').innerText = `${index + 1} / ${galleryImages.length}`;
            document.getElementById('galleryLightbox').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('galleryLightbox').style.display = 'none';
        }

        function navigateLightbox(step) {
            currentLightboxIndex = (currentLightboxIndex + step + galleryImages.length) % galleryImages.length;
            openLightbox(currentLightboxIndex);
        }

        // Navbar interaction
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('navbar-scrolled');
            } else {
                nav.classList.remove('navbar-scrolled');
            }
        });
    </script>
</body>

</html>
