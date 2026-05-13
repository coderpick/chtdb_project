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
                                @if ($sliders->count() > 0)
                                    @if ($sliders->count() > 1)
                                        <div class="carousel-indicators">
                                            @foreach ($sliders as $key => $slider)
                                                <button type="button" data-bs-target="#heroCarousel"
                                                    data-bs-slide-to="{{ $key }}"
                                                    class="{{ $key == 0 ? 'active' : '' }}"
                                                    aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $key + 1 }}"></button>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="carousel-inner rounded-4 overflow-hidden">
                                        @foreach ($sliders as $key => $slider)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                                data-bs-interval="4000">
                                                <img src="{{ asset($slider->image) }}" class="d-block w-100"
                                                    alt="{{ $slider->title }}" style="height: 380px; object-fit: cover;">
                                                @if ($slider->title || $slider->subtitle)
                                                    <div
                                                        class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-4">
                                                        @if ($slider->title)
                                                            <h6 class="mb-0 text-white fw-bold">{{ $slider->title }}</h6>
                                                        @endif
                                                        @if ($slider->subtitle)
                                                            <p class="x-small mb-0 text-white-50">{{ $slider->subtitle }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    {{-- Fallback Static Carousel --}}
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                            class="active"></button>
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                                    </div>
                                    <div class="carousel-inner rounded-4 overflow-hidden">
                                        <div class="carousel-item active" data-bs-interval="3000">
                                            <img src="{{ asset('img/hero_image.jpg') }}" class="d-block w-100"
                                                alt="ট্রেনিং সেশন" style="height: 380px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="{{ asset('img/rangamati.jpeg') }}" class="d-block w-100"
                                                alt="রাঙামাটি জেলা" style="height: 380px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-item" data-bs-interval="3000">
                                            <img src="{{ asset('img/khagrachari.jpg') }}" class="d-block w-100"
                                                alt="খাগড়াছড়ি জেলা" style="height: 380px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif

                                @if ($sliders->count() > 1 || $sliders->count() == 0)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon shadow-sm" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                                        data-bs-slide="next">
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
    {{-- Hero slider end --}}
    <!-- CHTDB Intro Section -->
    <section class="chtdb-intro-section section-padding" id="chtdb-info"
        style="background: linear-gradient(to bottom, #ffffff, #fcfdfc);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 reveal">
                    <div class="chtdb-img-wrapper">
                        <img src="{{ asset(\App\Models\Setting::get('chtdb_building_image', 'img/chtdb_building.png')) }}"
                            alt="পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড" class="img-fluid rounded-4 shadow-lg">
                        <div class="established-badge">
                            <i class="bi bi-award me-1"></i>
                            <span>{{ \App\Models\Setting::get('chtdb_intro_badge', 'স্থাপিত: ১৯৭৬') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal ps-lg-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-building-check text-success fs-3"></i>
                        </div>
                        <h2 class="section-title mb-0">
                            {{ \App\Models\Setting::get('chtdb_intro_title', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড') }}</h2>
                    </div>
                    <div class="section-divider"></div>
                    <p class="lead mb-4" style="color: var(--primary); font-weight: 700; letter-spacing: -0.02em;">
                        {{ \App\Models\Setting::get('chtdb_intro_highlight', 'পার্বত্য চট্টগ্রামের টেকসই উন্নয়নের অগ্রদূত') }}
                    </p>
                    <p style="font-size:1.05rem;color:#444;line-height:1.9;text-align:justify; margin-bottom: 30px;">
                        {{ \App\Models\Setting::get('chtdb_intro_description', '১৯৭৬ সালের ৭৭ নং অধ্যাদেশ বলে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড গঠিত হয়। পার্বত্য চট্টগ্রাম অঞ্চলে বিভিন্ন উন্নয়নমূলক ও আয়বর্ধকমূলক প্রকল্প/স্কিম গ্রহণ ও বাস্তবায়নে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড গুরুত্বপূর্ণ ভূমিকা পালন করে যাচ্ছে। পার্বত্য চট্টগ্রামে দুর্গম এলাকার যোগাযোগ ব্যবস্থার উন্নয়ন, কৃষি ও সেচ, শিক্ষা, সমাজকল্যাণ, ক্রীড়া ও সংস্কৃতির উন্নয়ন ও বিকাশ, আইসিটি দক্ষতা বৃদ্ধিসহ অন্যান্য প্রয়োজনীয় অবকাঠামো নির্মাণ ও জনগণের আর্থ-সামাজিক অবস্থার উন্নয়নে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ডের ভূমিকা অনস্বীকার্য।') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ \App\Models\Setting::get('chtdb_website', 'https://chtdb.gov.bd/') }}"
                            target="_blank" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                            <i
                                class="bi bi-globe me-2"></i>{{ \App\Models\Setting::get('chtdb_intro_website_label', 'ওয়েবসাইট দেখুন') }}
                        </a>
                        <div class="d-flex align-items-center text-muted small">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>{{ \App\Models\Setting::get('chtdb_intro_org_type', 'সরকারি স্বায়ত্তশাসিত সংস্থা') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project About Section -->
    <section class="about-section section-padding" id="about" style="background: var(--bg-light);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 reveal mb-5 text-center">
                    <h2 class="section-title">{{ \App\Models\Setting::get('scheme_title', 'স্কিম সম্পর্কে') }}</h2>
                    <div class="section-divider mx-auto"></div>
                    <p class="section-subtitle mx-auto"
                        style="max-width: 950px; font-size: 1.1rem; line-height: 1.8; color: #333;">
                        {{ \App\Models\Setting::get('scheme_subtitle', 'তিন পার্বত্য জেলার শিক্ষিত জনগোষ্ঠীর মধ্যে তথ্য ও যোগাযোগ প্রযুক্তির ব্যাপক প্রসার ঘটানো, তথ্য প্রযুক্তিতে দক্ষ ও প্রতিযোগিতামূলক মানবসম্পদ তৈরি করা এবং তথ্য প্রযুক্তির কার্যকর ব্যবহারের মাধ্যমে এ অঞ্চলের শিক্ষিত যুবক-যুবতীদের বিকল্প আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করে তাদের জীবনমান উন্নয়ন করা এ কার্যক্রমের মূল লক্ষ্য। একইসাথে তথ্যপ্রযুক্তিভিত্তিক কর্মসংস্থানের মাধ্যমে নারীর ক্ষমতায়নে ইতিবাচক অবদান রাখা, বিশ্ববাজারে ফ্রিল্যান্সিং খাতের অপার সম্ভাবনাকে কাজে লাগিয়ে দক্ষ ফ্রিল্যান্সার তৈরি করা এবং বৈদেশিক মুদ্রা অর্জনে সহায়তা করাও এর অন্যতম উদ্দেশ্য।') }}
                    </p>
                </div>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Project Description Extra -->
                <div class="col-lg-12 reveal mb-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm border-start border-4 border-success">
                        <p style="font-size:1rem;color:#555;line-height:1.8;margin-bottom:0;">
                            {{ \App\Models\Setting::get('scheme_description_box', 'প্রচলিত কর্মসংস্থানের পাশাপাশি অনলাইনভিত্তিক আত্মকর্মসংস্থানে শিক্ষিত যুবসমাজকে উৎসাহিত করার লক্ষ্যে তিন পার্বত্য জেলার দুই ব্যাচে মোট ২০০ জন শিক্ষিত যুবক-যুবতীকে সম্পূর্ণ বিনামূল্যে প্রশিক্ষণ প্রদান করা হয়েছে, যাতে তারা স্বাবলম্বী হতে পারে। প্রশিক্ষণ চলাকালীন অধিকাংশ প্রশিক্ষণার্থীর জন্য দেশীয় ও আন্তর্জাতিক প্রতিষ্ঠানের সাথে সংযোগ স্থাপনের মাধ্যমে আয়ের বাস্তব সুযোগ সৃষ্টি করা হয়েছে এবং পরবর্তীতে নতুন স্কিমের আওতায় উচ্চতর পর্যায়ের প্রশিক্ষণ প্রদানের মাধ্যমে ইতোমধ্যে প্রশিক্ষণপ্রাপ্ত যুবক-যুবতীদের দক্ষ, পেশাদার ও আত্মনির্ভরশীল ফ্রিল্যান্সার হিসেবে গড়ে তোলা হবে।') }}
                        </p>
                    </div>
                </div>

                <!-- Objectives -->
                <div class="col-lg-6 reveal">
                    <div class="h-100 p-4 rounded-4 shadow-sm"
                        style="background: linear-gradient(135deg, #ffffff 0%, #f0f7f2 100%); border: 1px solid #e0e0e0;">
                        <h4 class="mb-4 d-flex align-items-center" style="color: var(--primary-dark); font-weight: 700;">
                            <span
                                class="me-3 bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;"><i class="bi bi-bullseye"></i></span>
                            {{ \App\Models\Setting::get('objectives_title', 'স্কিমের লক্ষ্য ও উদ্দেশ্য:') }}
                        </h4>
                        <div class="objectives-list">
                            {!! \App\Models\Setting::get(
                                'objectives_list',
                                '<ul><li>তিন পার্বত্য জেলার শিক্ষিত জনগোষ্ঠীর মধ্যে তথ্য প্রযুক্তির প্রসার ঘটানো;</li><li>তথ্য প্রযুক্তিতে দক্ষ জনশক্তি তৈরি করা;</li><li>তথ্য প্রযুক্তিকে কাজে লাগিয়ে এতদঞ্চলের শিক্ষিত যুবক-যুবতীদের বিকল্প আত্ম-কর্মসংস্থানের সুযোগ সৃষ্টির মাধ্যমে জীবনমান উন্নয়ন; নারীর ক্ষমতায়নে অবদান রাখা;</li><li>বিশ্ববাজারে ফ্রিল্যান্সিংয়ের অপার সম্ভাবনাকে কাজে লাগানোর নিমিত্ত ফ্রিল্যান্সিংয়ে দক্ষ মানব সম্পদ সৃষ্টির মাধ্যমে মূল্যবান রেমিটেন্স আয়ের অবদান রাখা;</li><li>বিদ্যমান কর্মসংস্থানের পাশাপাশি অনলাইন ভিত্তিক আত্ম-কর্মসংস্থানে উৎসাহ প্রদান;</li><li>তিন পার্বত্য জেলার দুই ব্যাচের মোট ২০০ জন শিক্ষিত যুবক-যুবতীদের প্রশিক্ষণ প্রদান করে স্বাবলম্বী হতে সহায়তা করা;</li><li>প্রশিক্ষণ চলাকালীন অধিকাংশ প্রশিক্ষণার্থীকে দেশীয়/বিদেশী প্রতিষ্ঠানের সাথে সংযোগ স্থাপনপূর্বক আয়ের উৎস সৃষ্টিকরণ এবং</li><li>শিক্ষিত যুবক-যুবতীদের ফ্রিল্যান্সার হিসেবে গড়ে তোলা।</li></ul>',
                            ) !!}
                        </div>
                    </div>
                </div>

                <!-- Scope of Work -->
                <div class="col-lg-6 reveal">
                    <div class="h-100 p-4 rounded-4 shadow-sm"
                        style="background: linear-gradient(135deg, #ffffff 0%, #fff9e6 100%); border: 1px solid #e0e0e0;">
                        <h4 class="mb-4 d-flex align-items-center" style="color: var(--primary-dark); font-weight: 700;">
                            <span
                                class="me-3 bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;"><i class="bi bi-clipboard-data"></i></span>
                            {{ \App\Models\Setting::get('scope_title', 'স্কিমের কার্যপরিধি:') }}
                        </h4>
                        <div class="mb-4 p-3 bg-white rounded-3 border">
                            <p class="mb-0 fw-bold text-dark">
                                {{ \App\Models\Setting::get('scope_description', 'রাঙ্গামাটি পার্বত্য জেলায় দুই ব্যাচে ৮০ জন এবং বান্দরবান পার্বত্য জেলায় দুই ব্যাচে ৬০ জন এবং খাগড়াছড়ি পার্বত্য জেলায় দুই ব্যাচে ৬০ জন করে মোট ২০০ জন শিক্ষিত যুবক-যুবতীকে তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ে ২০০ কার্যদিবসে প্রশিক্ষণ প্রদান;') }}
                            </p>
                        </div>
                        <h6 class="fw-bold mb-3">
                            {{ \App\Models\Setting::get('scope_module_title', 'প্রশিক্ষণ মডিউল ও সময়কাল:') }}</h6>
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="p-2 border rounded bg-white text-center project-module-card">
                                    <div class="small text-muted">বেসিক রিফ্রেসার্স</div>
                                    <div class="fw-bold text-success">৩০ কার্যদিবস</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border rounded bg-white text-center project-module-card">
                                    <div class="small text-muted">গ্রাফিক্স কোর্স</div>
                                    <div class="fw-bold text-success">৪৫ কার্যদিবস</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border rounded bg-white text-center project-module-card">
                                    <div class="small text-muted">ডিজিটাল মার্কেটিং</div>
                                    <div class="fw-bold text-success">৪৫ কার্যদিবস</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border rounded bg-white text-center project-module-card">
                                    <div class="small text-muted">অডিও-ভিডিও</div>
                                    <div class="fw-bold text-success">৩০ কার্যদিবস</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-2 border rounded bg-white text-center project-module-card">
                                    <div class="small text-muted">ওয়েবসাইট ডিজাইন এবং অ্যানিমেশন</div>
                                    <div class="fw-bold text-success">৫০ কার্যদিবস</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-white rounded-3 border border-warning border-opacity-25">
                            <i class="bi bi-calendar-event me-2 text-warning"></i>
                            <span
                                class="fw-bold">{{ \App\Models\Setting::get('scope_workshop_text', 'কোর্সের বিভিন্ন মডিউল এর বিষয়ে ৩ টি কর্মশালা আয়োজন;') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Officials Section -->
    <section class="section-padding" id="officials" style="background:white;">
        <div class="container">
            <div class="text-center centered reveal">
                <h2 class="section-title">
                    {{ \App\Models\Setting::get('officials_title', 'এই প্রকল্প বাস্তবায়নে যাদের ভূমিকা অনস্বীকার্য') }}
                </h2>
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

    <!-- Training Organization Section -->
    <section class="section-padding" id="organizations"
        style="background: linear-gradient(to bottom, #fcfdfc, #ffffff);">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center centered reveal mb-5">
                <h2 class="section-title">
                    {{ \App\Models\Setting::get('org_section_title', 'ট্রেনিং এ নিযুক্ত প্রতিষ্ঠান') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('org_section_subtitle', 'এই প্রকল্পের অধীনে যারা ট্রেনিং প্রদান করেন') }}
                </p>
            </div>
            <div class="row g-4 reveal">
                <div class="col-12">
                    <div class="org-showcase-card">
                        <div class="row g-0">
                            <!-- Left Side: Basic Info -->
                            <div class="col-lg-5 p-4 p-md-5 d-flex flex-column justify-content-center border-end-lg">

                                <div class="org-brand mb-4">
                                    <div class="org-logo-wrapper mb-4">
                                        <img src="{{ asset(\App\Models\Setting::get('peoplentech_logo', 'img/PNT_logo.webp')) }}"
                                            alt="PeopleNTech" class="img-fluid">
                                    </div>
                                    <h3 class="org-name-large">
                                        {{ \App\Models\Setting::get('peoplentech_name', 'PeopleNTech Institute of IT') }}
                                    </h3>
                                </div>
                                <p class="org-desc-large mb-4">
                                    {{ \App\Models\Setting::get('peoplentech_description', 'PeopleNTech গত ১৪+ বছর ধরে বাংলাদেশে আইটি প্রশিক্ষণ ও জব প্লেসমেন্ট সেবা প্রদান করে আসছে। বিশ্বমানের আইটি বিশেষজ্ঞ তৈরির লক্ষ্যে কাজ করছে এই প্রতিষ্ঠানটি। BASIS ও ISO 9001:2015 সার্টিফিকেটধারী এই প্রতিষ্ঠান দেশ-বিদেশে সুনাম অর্জন করেছে।') }}
                                </p>



                                <div class="mt-5 p-4 rounded-4 bg-white shadow-sm border">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center" style="color: var(--primary-dark);">
                                        <span class="me-3 bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px;"><i class="bi bi-list-check"></i></span>
                                        প্রশিক্ষণ সেবা ও সুবিধা:
                                    </h6>
                                    <div class="org-list-new">
                                        {!! \App\Models\Setting::get(
                                            'peoplentech_list',
                                            '<ul><li>ইন্ডাস্ট্রি-ফোকাসড লাইভ কোর্স পরিচালনা</li><li>চাকরি ও ইন্টার্নশিপ প্লেসমেন্ট সার্ভিস</li><li>ফ্রিল্যান্স ক্যারিয়ার গাইডেন্স ও সাপোর্ট</li><li>লাইফটাইম স্টুডেন্ট সাপোর্ট সিস্টেম</li><li>WUST (USA) এর সাথে গ্লোবাল একাডেমিক সহযোগিতা</li></ul>',
                                        ) !!}
                                    </div>
                                </div>
                            </div>
                            <!-- Right Side: Features & Achievements -->
                            <div class="col-lg-7 p-4 p-md-5">
                                <h5 class="feature-heading mb-4"><i
                                        class="bi bi-award-fill me-2"></i>{{ \App\Models\Setting::get('org_why_title', 'কেন PeopleNTech সেরা?') }}
                                </h5>
                                <div class="row g-3">
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php
                                            $default_titles = [
                                                1 => 'ISO 9001:2015',
                                                2 => 'BASIS সদস্য',
                                                3 => 'WUST (USA)',
                                                4 => '১৪+ বছর',
                                            ];
                                            $default_subtitles = [
                                                1 => 'সার্টিফাইড প্রতিষ্ঠান',
                                                2 => 'জাতীয় সফটওয়্যার সমিতি',
                                                3 => 'গ্লোবাল একাডেমিক পার্টনার',
                                                4 => 'আইটি প্রশিক্ষণে অভিজ্ঞতা',
                                            ];
                                            $default_icons = [
                                                1 => 'bi-patch-check-fill',
                                                2 => 'bi-shield-check',
                                                3 => 'bi-globe2',
                                                4 => 'bi-people-fill',
                                            ];

                                            $f_title = \App\Models\Setting::get(
                                                'org_feature_' . $i . '_title',
                                                $default_titles[$i],
                                            );
                                            $f_subtitle = \App\Models\Setting::get(
                                                'org_feature_' . $i . '_subtitle',
                                                $default_subtitles[$i],
                                            );
                                            $f_icon = \App\Models\Setting::get(
                                                'org_feature_' . $i . '_icon',
                                                $default_icons[$i],
                                            );
                                        @endphp
                                        <div class="col-sm-6">
                                            <div class="feature-box-new">
                                                <div class="icon-circle bg-primary-soft">
                                                    <i class="bi {{ $f_icon }} text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6>{{ $f_title }}</h6>
                                                    <p>{{ $f_subtitle }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <hr class="my-5 opacity-10">
                                <h5 class="feature-heading mb-4"><i
                                        class="bi bi-graph-up-arrow me-2"></i>{{ \App\Models\Setting::get('org_achieve_title', 'একনজরে অর্জন') }}
                                </h5>
                                <div class="row g-3 text-center">
                                    @for ($i = 1; $i <= 4; $i++)
                                        @php
                                            $default_vals = [1 => '১৪+', 2 => '৯+', 3 => '৫০+', 4 => '১০০+'];
                                            $default_labels = [
                                                1 => 'বছর',
                                                2 => 'দেশ',
                                                3 => 'পার্টনার',
                                                4 => 'প্রশিক্ষক',
                                            ];

                                            $s_val = \App\Models\Setting::get(
                                                'org_stat_' . $i . '_val',
                                                $default_vals[$i],
                                            );
                                            $s_label = \App\Models\Setting::get(
                                                'org_stat_' . $i . '_label',
                                                $default_labels[$i],
                                            );
                                        @endphp
                                        <div class="col-6 col-md-3">
                                            <div class="stat-pill">
                                                <span class="stat-val">{{ $s_val }}</span>
                                                <span class="stat-label">{{ $s_label }}</span>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="mt-5 pt-3">
                                    <a href="{{ \App\Models\Setting::get('peoplentech_website', 'https://peoplentech.com.bd') }}"
                                        target="_blank" class="btn btn-premium btn-lg">
                                        <i class="bi bi-globe me-2"></i>
                                        {{ \App\Models\Setting::get('peoplentech_website_label', 'peoplentech.com.bd ভিজিট করুন') }}
                                    </a>
                                </div>
                            </div>
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
                <h2 class="section-title">
                    {{ \App\Models\Setting::get('stories_title', 'প্রশিক্ষিত ছাত্র/ছাত্রীদের মতামত') }}
                </h2>
                <div class="section-divider"></div>
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
                                    @if (strlen($story->story_text) > 200)
                                        <a href="javascript:void(0)" class="read-more-btn"
                                            data-name="{{ $name }}" data-district="{{ $districtLabel }}"
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
                <h2 class="section-title">{{ \App\Models\Setting::get('courses_title', 'প্রশিক্ষণের কোর্স মডিউলসমূহ') }}
                </h2>
                <div class="section-divider"></div>
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
    <!-- Gallery -->
    <section class="section-padding" id="gallery">
        <div class="container">
            <div class="text-center centered reveal">
                <h2 class="section-title">{{ \App\Models\Setting::get('gallery_title', 'ফটো গ্যালারি') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('gallery_subtitle', 'প্রশিক্ষণ কার্যক্রমের বিভিন্ন মুহূর্ত') }}</p>
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
                <h2 class="section-title">{{ \App\Models\Setting::get('centers_title', 'প্রশিক্ষণ ল্যাব সমূহ') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('centers_subtitle', 'তিন পার্বত্য জেলায় আমাদের কম্পিউটার ল্যাব সমূহ') }}
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
                <h2 class="section-title">{{ \App\Models\Setting::get('contact_title', 'যোগাযোগ করুন') }}</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">
                    {{ \App\Models\Setting::get('contact_subtitle', 'আমাদের সাথে যোগাযোগ করতে নিচের ফর্মটি পূরণ করুন') }}
                </p>
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
                                <h6>{{ \App\Models\Setting::get('contact_address_title', 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড') }}
                                </h6>
                                <p>{{ \App\Models\Setting::get('contact_address', 'রাঙামাটি পার্বত্য জেলা, চট্টগ্রাম বিভাগ, বাংলাদেশ') }}
                                </p>
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
                                <p><a href="{{ \App\Models\Setting::get('chtdb_website', 'https://chtdb.gov.bd') }}"
                                        target="_blank" style="color:#f5d060;">chtdb.gov.bd</a>
                                </p>
                            </div>
                        </div>
                        <hr style="border-color:rgba(255,255,255,0.2);">
                        <h6 class="mb-3" style="font-weight:600;">ট্রেনিং প্রদানকারী প্রতিষ্ঠান:</h6>
                        <div class="contact-info-item">
                            <div class="icon"><i class="bi bi-pc-display"></i></div>
                            <div>
                                <h6>{{ \App\Models\Setting::get('training_partner_name', 'PeopleNTech Institute of IT') }}
                                </h6>
                                <p><a href="{{ \App\Models\Setting::get('peoplentech_website', 'https://peoplentech.com.bd') }}"
                                        target="_blank" style="color:#f5d060;">peoplentech.com.bd</a></p>
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
                        <img src="" alt="" id="modalPhoto" class="rounded-circle me-3"
                            style="width: 65px; height: 65px; object-fit: cover; border: 3px solid var(--primary-light, #266b3c);">
                        <div>
                            <h5 class="modal-title mb-0 fw-bold" id="modalName"
                                style="color: var(--primary); font-size: 1.25rem;"></h5>
                            <small class="text-muted" id="modalMeta" style="font-size: 0.9rem;"></small>
                        </div>
                    </div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5 position-relative">
                    <div class="quote-icon mb-3"
                        style="font-size: 3rem; color: var(--primary); opacity: 0.1; position: absolute; top: 20px; left: 30px;">
                        <i class="bi bi-quote"></i>
                    </div>
                    <div class="story-content-wrapper position-relative" style="z-index: 1;">
                        <p id="modalStoryText"
                            style="font-size: 1.1rem; line-height: 1.8; color: #444; white-space: pre-line; text-align: justify;">
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">বন্ধ
                        করুন</button>
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

        /* Organization Showcase Custom Styles */
        .org-showcase-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.07);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        @media (min-width: 992px) {
            .border-end-lg {
                border-right: 1px solid rgba(0, 0, 0, 0.05);
            }
        }

        .bg-light-soft {
            background-color: #fcfdfd;
        }

        .org-badge-new {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(26, 107, 60, 0.08);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            border-radius: 50px;
            border: 1px solid rgba(26, 107, 60, 0.15);
        }

        .org-logo-wrapper {
            width: 140px;
            height: auto;
            transition: all 0.3s ease;
        }

        .org-logo-wrapper:hover {
            transform: translateY(-3px);
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
        }

        .org-logo-wrapper img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .wust-link h6 {
            transition: color 0.3s ease;
        }

        .wust-link:hover h6 {
            color: var(--primary);
        }

        .wust-link i {
            font-size: 0.7rem;
            vertical-align: middle;
            opacity: 0.6;
        }

        .org-name-large {
            font-weight: 800;
            color: var(--primary-dark);
            font-size: 1.8rem;
            line-height: 1.3;
        }

        .org-desc-large {
            color: #555;
            font-size: 1rem;
            line-height: 1.9;
        }

        .btn-premium {
            background: var(--gradient-2);
            color: white;
            padding: 14px 30px;
            border-radius: 16px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(26, 107, 60, 0.2);
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(26, 107, 60, 0.3);
            color: white;
        }

        .feature-heading {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--primary-dark);
        }

        .feature-box-new {
            background: white;
            padding: 18px;
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            gap: 15px;
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-box-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border-color: var(--primary-soft);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .bg-success-soft {
            background: rgba(25, 135, 84, 0.1);
        }

        .bg-primary-soft {
            background: rgba(13, 110, 253, 0.1);
        }

        .bg-info-soft {
            background: rgba(13, 202, 240, 0.1);
        }

        .bg-warning-soft {
            background: rgba(255, 193, 7, 0.1);
        }

        .feature-box-new h6 {
            font-weight: 700;
            margin-bottom: 2px;
            font-size: 0.95rem;
        }

        .feature-box-new p {
            font-size: 0.78rem;
            color: #888;
            margin: 0;
        }

        .stat-pill {
            padding: 20px 10px;
            border-radius: 20px;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.04);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-pill .stat-val {
            display: block;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-pill .stat-label {
            font-size: 0.8rem;
            color: #888;
            font-weight: 600;
        }

        .org-list-new ul,
        .objectives-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .org-list-new li,
        .objectives-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            font-size: 1.05rem;
            color: #444;
            line-height: 1.6;
        }

        .org-list-new li::before,
        .objectives-list li::before {
            content: "\f270";
            /* bi-check2-circle */
            font-family: "bootstrap-icons";
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: bold;
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
