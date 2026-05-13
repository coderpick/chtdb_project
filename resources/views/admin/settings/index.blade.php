@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Manage Site Content')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="card border-0 shadow-sm">
                    <div class="row g-0">
                        <!-- Vertical/Horizontal Nav -->
                        <div class="col-xl-3 border-end bg-light-subtle">
                            <div class="p-3 border-bottom bg-light">
                                <h6 class="mb-0 fw-bold"><i class="bi bi-gear-fill me-2 text-primary"></i>Settings Categories
                                </h6>
                            </div>
                            <div class="nav nav-pills flex-column flex-xl-column p-3" id="settingsTabs" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active text-start mb-2" id="general-tab" data-bs-toggle="tab"
                                    data-bs-target="#general" type="button" role="tab" aria-controls="general"
                                    aria-selected="true">
                                    <i class="bi bi-info-circle me-2"></i>General & Topbar
                                </button>
                                <button class="nav-link text-start mb-2" id="hero-tab" data-bs-toggle="tab"
                                    data-bs-target="#hero" type="button" role="tab" aria-controls="hero"
                                    aria-selected="false">
                                    <i class="bi bi-stars me-2"></i>Hero & Marquee
                                </button>
                                <button class="nav-link text-start mb-2" id="chtdb-tab" data-bs-toggle="tab"
                                    data-bs-target="#chtdb" type="button" role="tab" aria-controls="chtdb"
                                    aria-selected="false">
                                    <i class="bi bi-building me-2"></i>CHTDB Intro Section
                                </button>
                                <button class="nav-link text-start mb-2" id="about-tab" data-bs-toggle="tab"
                                    data-bs-target="#about" type="button" role="tab" aria-controls="about"
                                    aria-selected="false">
                                    <i class="bi bi-card-text me-2"></i>About & Scheme Section
                                </button>
                                <button class="nav-link text-start mb-2" id="section-titles-tab" data-bs-toggle="tab"
                                    data-bs-target="#section-titles" type="button" role="tab"
                                    aria-controls="section-titles" aria-selected="false">
                                    <i class="bi bi-fonts me-2"></i>Section Titles & Subtitles
                                </button>
                                <button class="nav-link text-start mb-2" id="stats-tab" data-bs-toggle="tab"
                                    data-bs-target="#stats" type="button" role="tab" aria-controls="stats"
                                    aria-selected="false">
                                    <i class="bi bi-bar-chart me-2"></i>Statistics Items
                                </button>
                                <button class="nav-link text-start mb-2" id="orgs-tab" data-bs-toggle="tab"
                                    data-bs-target="#orgs" type="button" role="tab" aria-controls="orgs"
                                    aria-selected="false">
                                    <i class="bi bi-building-gear me-2"></i>Training Partner & Orgs
                                </button>
                                <button class="nav-link text-start mb-2" id="social-tab" data-bs-toggle="tab"
                                    data-bs-target="#social" type="button" role="tab" aria-controls="social"
                                    aria-selected="false">
                                    <i class="bi bi-share me-2"></i>Social Links
                                </button>
                                <button class="nav-link text-start mb-2" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">
                                    <i class="bi bi-headset me-2"></i>Contact Info
                                </button>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="col-xl-9">
                            <div class="card-body p-4">
                                <div class="tab-content" id="settingsTabsContent">
                                    <!-- General & Topbar -->
                                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">General & Topbar Settings</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Site Name (Footer/Copyright)</label>
                                                <input type="text" name="site_name" class="form-control"
                                                    value="{{ $settings['site_name'] ?? 'তিন পার্বত্য জেলার আইসিটি দক্ষতা উন্নয়ন স্কিম' }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Site Name (Header - HTML Allowed)</label>
                                                <input type="text" name="site_name_header" class="form-control"
                                                    value="{{ $settings['site_name_header'] ?? 'আইসিটি দক্ষতা উন্নয়ন<br>তিন পার্বত্য জেলায় স্কিম' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Topbar Address (BN)</label>
                                                <input type="text" name="topbar_address" class="form-control"
                                                    value="{{ $settings['topbar_address'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড, রাঙামাটি' }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Topbar Email</label>
                                                <input type="email" name="topbar_email" class="form-control"
                                                    value="{{ $settings['topbar_email'] ?? 'info@chtdb.gov.bd' }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Topbar Phone</label>
                                                <input type="text" name="topbar_phone" class="form-control"
                                                    value="{{ $settings['topbar_phone'] ?? '+৮৮০-৩৫১-৬২০৮১' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">CHTDB Website URL</label>
                                                <input type="url" name="chtdb_website" class="form-control"
                                                    value="{{ $settings['chtdb_website'] ?? 'https://chtdb.gov.bd' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Training assigned institute URL</label>
                                                <input type="url" name="peoplentech_website" class="form-control"
                                                    value="{{ $settings['peoplentech_website'] ?? 'https://peoplentech.com.bd' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hero & Marquee -->
                                    <div class="tab-pane fade" id="hero" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Hero Section & Marquee Announcement</h5>
                                        <div class="row g-3">
                                            <div class="col-12 border-bottom pb-4 mb-2">
                                                <label class="form-label">Marquee Announcement Text</label>
                                                <textarea name="marquee_text" class="form-control" rows="2">{{ $settings['marquee_text'] ?? '📢 তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিম — পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগে ২১৫+ শিক্ষার্থী প্রশিক্ষিত — রাঙামাটি | খাগড়াছড়ি | বান্দরবান 🏔️' }}</textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Hero Badge Text</label>
                                                <input type="text" name="hero_badge" class="form-control"
                                                    value="{{ $settings['hero_badge'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Hero Title (Main)</label>
                                                <input type="text" name="hero_title" class="form-control"
                                                    value="{{ $settings['hero_title'] ?? 'তিন পার্বত্য জেলার' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Hero Title (Highlight)</label>
                                                <input type="text" name="hero_highlight" class="form-control"
                                                    value="{{ $settings['hero_highlight'] ?? 'আইসিটি দক্ষতা উন্নয়ন' }}">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Hero Title (Ending)</label>
                                                <input type="text" name="hero_title_end" class="form-control"
                                                    value="{{ $settings['hero_title_end'] ?? 'ও আত্মকর্মসংস্থান স্কিম' }}">
                                            </div>
                                            <div class="col-12 border-bottom pb-4 mb-2">
                                                <label class="form-label">Hero Subtitle</label>
                                                <textarea name="hero_subtitle" class="form-control" rows="3">{{ $settings['hero_subtitle'] ?? 'রাঙামাটি, খাগড়াছড়ি ও বান্দরবান জেলার বেকার যুবক-যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়নের মাধ্যমে আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করা হচ্ছে। ট্রেনিং পার্টনার PeopleNTech এর সহযোগিতায়।' }}</textarea>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label d-block mb-3 fw-bold"><i
                                                        class="bi bi-bar-chart-fill me-2"></i> Hero Statistics
                                                    Values</label>
                                                <div class="row g-3">
                                                    <div class="col-md-3">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="form-label text-muted small">Stat 1 (Label &
                                                                Value)</label>
                                                            <input type="text" name="stat_1_label"
                                                                class="form-control mb-2"
                                                                value="{{ $settings['stat_1_label'] ?? 'প্রশিক্ষিত শিক্ষার্থী' }}">
                                                            <input type="text" name="hero_stat_1_value"
                                                                class="form-control" placeholder="Default: 200"
                                                                value="{{ $settings['hero_stat_1_value'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="form-label text-muted small">Stat 2 (Label &
                                                                Value)</label>
                                                            <input type="text" name="stat_2_label"
                                                                class="form-control mb-2"
                                                                value="{{ $settings['stat_2_label'] ?? 'পার্বত্য জেলা' }}">
                                                            <input type="text" name="hero_stat_2_value"
                                                                class="form-control" placeholder="Default: 3"
                                                                value="{{ $settings['hero_stat_2_value'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="form-label text-muted small">Stat 3 (Label &
                                                                Value)</label>
                                                            <input type="text" name="stat_3_label"
                                                                class="form-control mb-2"
                                                                value="{{ $settings['stat_3_label'] ?? 'আইসিটি কোর্স' }}">
                                                            <input type="text" name="hero_stat_3_value"
                                                                class="form-control" placeholder="Default: 8"
                                                                value="{{ $settings['hero_stat_3_value'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="p-3 border rounded bg-light">
                                                            <label class="form-label text-muted small">Stat 4 (Label &
                                                                Value)</label>
                                                            <input type="text" name="stat_4_label"
                                                                class="form-control mb-2"
                                                                value="{{ $settings['stat_4_label'] ?? 'কর্মসংস্থান হার' }}">
                                                            <input type="text" name="hero_stat_4_value"
                                                                class="form-control" placeholder="Default: 85"
                                                                value="{{ $settings['hero_stat_4_value'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- CHTDB Intro Section -->
                                    <div class="tab-pane fade" id="chtdb" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">CHTDB Intro Section Content</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Intro Badge</label>
                                                <input type="text" name="chtdb_intro_badge" class="form-control"
                                                    value="{{ $settings['chtdb_intro_badge'] ?? 'স্থাপিত: ১৯৭৬' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Intro Title</label>
                                                <input type="text" name="chtdb_intro_title" class="form-control"
                                                    value="{{ $settings['chtdb_intro_title'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Intro Highlight</label>
                                                <input type="text" name="chtdb_intro_highlight" class="form-control"
                                                    value="{{ $settings['chtdb_intro_highlight'] ?? 'পার্বত্য চট্টগ্রামের টেকসই উন্নয়নের অগ্রদূত' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Intro Description</label>
                                                <textarea name="chtdb_intro_description" class="form-control" rows="5">{{ $settings['chtdb_intro_description'] ?? '১৯৭৬ সালের ৭৭ নং অধ্যাদেশ বলে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড গঠিত হয়। পার্বত্য চট্টগ্রাম অঞ্চলে বিভিন্ন উন্নয়নমূলক ও আয়বর্ধকমূলক প্রকল্প/স্কিম গ্রহণ ও বাস্তবায়নে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড গুরুত্বপূর্ণ ভূমিকা পালন করে যাচ্ছে। পার্বত্য চট্টগ্রাম অঞ্চলে দুর্গম এলাকার যোগাযোগ ব্যবস্থার উন্নয়ন, কৃষি ও সেচ, শিক্ষা, সমাজকল্যাণ, ক্রীড়া ও সংস্কৃতির উন্নয়ন ও বিকাশ, আইসিটি দক্ষতা বৃদ্ধিসহ অন্যান্য প্রয়োজনীয় অবকাঠামো নির্মাণ ও জনগণের আর্থ-সামাজিক অবস্থার উন্নয়নে পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ডের ভূমিকা অনস্বীকার্য।' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Building Image Path (e.g.
                                                    img/chtdb_building.png)</label>
                                                <input type="text" name="chtdb_building_image" class="form-control"
                                                    value="{{ $settings['chtdb_building_image'] ?? 'img/chtdb_building.png' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Website Button Label</label>
                                                <input type="text" name="chtdb_intro_website_label"
                                                    class="form-control"
                                                    value="{{ $settings['chtdb_intro_website_label'] ?? 'ওয়েবসাইট দেখুন' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Organization Type Label</label>
                                                <input type="text" name="chtdb_intro_org_type" class="form-control"
                                                    value="{{ $settings['chtdb_intro_org_type'] ?? 'সরকারি স্বায়ত্তশাসিত সংস্থা' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- About & Scheme Section -->
                                    <div class="tab-pane fade" id="about" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">About & Scheme Content</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Scheme Title</label>
                                                <input type="text" name="scheme_title" class="form-control"
                                                    value="{{ $settings['scheme_title'] ?? 'স্কিম সম্পর্কে' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Scheme Subtitle/Description</label>
                                                <textarea name="scheme_subtitle" class="form-control" rows="4">{{ $settings['scheme_subtitle'] ?? 'তিন পার্বত্য জেলার শিক্ষিত জনগোষ্ঠীর মধ্যে তথ্য ও যোগাযোগ প্রযুক্তির ব্যাপক প্রসার ঘটানো, তথ্য প্রযুক্তিতে দক্ষ ও প্রতিযোগিতামূলক মানবসম্পদ তৈরি করা এবং তথ্য প্রযুক্তির কার্যকর ব্যবহারের মাধ্যমে এ অঞ্চলের শিক্ষিত যুবক-যুবতীদের বিকল্প আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করে তাদের জীবনমান উন্নয়ন করা এ কার্যক্রমের মূল লক্ষ্য। একইসাথে তথ্যপ্রযুক্তিভিত্তিক কর্মসংস্থানের মাধ্যমে নারীর ক্ষমতায়নে ইতিবাচক অবদান রাখা, বিশ্ববাজারে ফ্রিল্যান্সিং খাতের অপার সম্ভাবনাকে কাজে লাগিয়ে দক্ষ ফ্রিল্যান্সার তৈরি করা এবং বৈদেশিক মুদ্রা অর্জনে সহায়তা করাও এর অন্যতম উদ্দেশ্য।' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Scheme Description Box (Highlighted)</label>
                                                <textarea name="scheme_description_box" class="form-control" rows="4">{{ $settings['scheme_description_box'] ?? 'প্রচলিত কর্মসংস্থানের পাশাপাশি অনলাইনভিত্তিক আত্মকর্মসংস্থানে শিক্ষিত যুবকসমাজকে উৎসাহিত করার লক্ষ্যে তিন পার্বত্য জেলার দুই ব্যাচে মোট ২০০ জন শিক্ষিত যুবক-যুবতীকে সম্পূর্ণ বিনামূল্যে প্রশিক্ষণ প্রদান করা হয়েছে, যাতে তারা স্বাবলম্বী হতে পারে। প্রশিক্ষণ চলাকালীন অধিকাংশ প্রশিক্ষণার্থীর জন্য দেশীয় ও আন্তর্জাতিক প্রতিষ্ঠানের সাথে সংযোগ স্থাপনের মাধ্যমে আয়ের বাস্তব সুযোগ সৃষ্টি করা হয়েছে এবং পরবর্তীতে নতুন স্কিমের আওতায় উচ্চতর পর্যায়ের প্রশিক্ষণ প্রদানের মাধ্যমে ইতোমধ্যে প্রশিক্ষণপ্রাপ্ত যুবক-যুবতীদের দক্ষ, পেশাদার ও আত্মনির্ভরশীল ফ্রিল্যান্সার হিসেবে গড়ে তোলা হবে।' }}</textarea>
                                            </div>
                                            <div class="col-md-12 border-top pt-3 mt-3">
                                                <label class="form-label fw-bold">Objectives Section</label>
                                                <input type="text" name="objectives_title" class="form-control mb-2"
                                                    placeholder="Objectives Title"
                                                    value="{{ $settings['objectives_title'] ?? 'স্কিমের লক্ষ্য ও উদ্দেশ্য:' }}">
                                                <textarea name="objectives_list" class="form-control summernote-list" rows="6">{{ $settings['objectives_list'] ?? '<ul><li>তিন পার্বত্য জেলার শিক্ষিত জনগোষ্ঠীর মধ্যে তথ্য প্রযুক্তির প্রসার ঘটানো;</li><li>তথ্য প্রযুক্তিতে দক্ষ জনশক্তি তৈরি করা;</li><li>তথ্য প্রযুক্তিকে কাজে লাগিয়ে এতদঞ্চলের শিক্ষিত যুবক-যুবতীদের বিকল্প আত্ম-কর্মসংস্থানের সুযোগ সৃষ্টির মাধ্যমে জীবনমান উন্নয়ন; নারীর ক্ষমতায়নে অবদান রাখা;</li><li>বিশ্ববাজারে ফ্রিল্যান্সিংয়ের অপার সম্ভাবনাকে কাজে লাগানোর নিমিত্ত ফ্রিল্যান্সিংয়ে দক্ষ মানব সম্পদ সৃষ্টির মাধ্যমে মূল্যবান রেমিটেন্স আয়ের অবদান রাখা;</li><li>বিদ্যমান কর্মসংস্থানের পাশাপাশি অনলাইন ভিত্তিক আত্ম-কর্মসংস্থানে উৎসাহ প্রদান;</li><li>তিন পার্বত্য জেলার দুই ব্যাচের মোট ২০০ জন শিক্ষিত যুবক-যুবতীদের প্রশিক্ষণ প্রদান করে স্বাবলম্বী হতে সহায়তা করা;</li><li>প্রশিক্ষণ চলাকালীন অধিকাংশ প্রশিক্ষণার্থীকে দেশীয়/বিদেশী প্রতিষ্ঠানের সাথে সংযোগ স্থাপনপূর্বক আয়ের উৎস সৃষ্টিকরণ এবং</li><li>শিক্ষিত যুবক-যুবতীদের ফ্রিল্যান্সার হিসেবে গড়ে তোলা।</li></ul>' }}</textarea>
                                            </div>
                                            <div class="col-md-12 border-top pt-3 mt-3">
                                                <label class="form-label fw-bold">Scope of Work Section</label>
                                                <input type="text" name="scope_title" class="form-control mb-2"
                                                    placeholder="Scope Title"
                                                    value="{{ $settings['scope_title'] ?? 'স্কিমের কার্যপরিধি:' }}">
                                                <textarea name="scope_description" class="form-control mb-3" rows="3">{{ $settings['scope_description'] ?? 'রাঙ্গামাটি পার্বত্য জেলায় দুই ব্যাচে ৮০ জন এবং বান্দরবান পার্বত্য জেলায় দুই ব্যাচে ৬০ জন এবং খাগড়াছড়ি পার্বত্য জেলায় দুই ব্যাচে ৬০ জন করে মোট ২০০ জন শিক্ষিত যুবক-যুবতীকে তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ে ২০০ কার্যদিবসে প্রশিক্ষণ প্রদান;' }}</textarea>

                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Module Section Title</label>
                                                        <input type="text" name="scope_module_title"
                                                            class="form-control"
                                                            value="{{ $settings['scope_module_title'] ?? 'প্রশিক্ষণ মডিউল ও সময়কাল:' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Workshop Text</label>
                                                        <input type="text" name="scope_workshop_text"
                                                            class="form-control"
                                                            value="{{ $settings['scope_workshop_text'] ?? 'কোর্সের বিভিন্ন মডিউল এর বিষয়ে ৩ টি কর্মশালা আয়োজন;' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section Titles & Footer -->
                                    <div class="tab-pane fade" id="section-titles" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Section Titles, Subtitles & Footer</h5>
                                        <div class="row g-4">
                                            <!-- Implementation Orgs -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Implementation Organizations</label>
                                                <input type="text" name="org_section_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['org_section_title'] ?? 'বাস্তবায়নকারী সংস্থা ও নিযুক্ত প্রতিষ্ঠান' }}">
                                                <textarea name="org_section_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['org_section_subtitle'] ?? 'এই প্রকল্পের সাথে সংশ্লিষ্ট প্রধান সংস্থা ও তাদের ভূমিকা' }}</textarea>
                                            </div>
                                            <!-- Officials -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Project Officials Section</label>
                                                <input type="text" name="officials_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['officials_title'] ?? 'এই প্রকল্প বাস্তবায়নে যাদের ভূমিকা অনস্বীকার্য' }}">
                                                <textarea name="officials_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['officials_subtitle'] ?? 'পরিকল্পনা, বাস্তবায়ন ও নির্দেশনার মাধ্যমে যারা এই প্রকল্পকে সফল করতে নিরলস কাজ করেছেন' }}</textarea>
                                            </div>
                                            <!-- Success Stories -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Success Stories Section</label>
                                                <input type="text" name="stories_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['stories_title'] ?? 'প্রশিক্ষিত ছাত্র/ছাত্রীদের মতামত' }}">
                                                <textarea name="stories_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['stories_subtitle'] ?? 'প্রশিক্ষণার্থীদের বাস্তব অভিজ্ঞতার আলোকে এই অংশটি তৈরি করা হয়েছে।' }}</textarea>
                                            </div>
                                            <!-- Course Modules -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Course Modules Section</label>
                                                <input type="text" name="courses_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['courses_title'] ?? 'প্রশিক্ষণের কোর্স মডিউলসমূহ' }}">
                                                <textarea name="courses_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['courses_subtitle'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড এর তত্ত্বাবধানে পরিচালিত আইসিটি কোর্স মডিউলসমূহ' }}</textarea>
                                            </div>
                                            <!-- Project Timeline -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Project Timeline Section</label>
                                                <input type="text" name="timeline_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['timeline_title'] ?? 'প্রকল্পের পথচলা' }}">
                                                <textarea name="timeline_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['timeline_subtitle'] ?? 'প্রকল্প শুরু থেকে আজ পর্যন্ত গুরুত্বপূর্ণ মাইলফলকসমূহ' }}</textarea>
                                            </div>
                                            <!-- Photo Gallery -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Photo Gallery Section</label>
                                                <input type="text" name="gallery_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['gallery_title'] ?? 'ফটো গ্যালারি' }}">
                                                <textarea name="gallery_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['gallery_subtitle'] ?? 'প্রশিক্ষণ কার্যক্রমের বিভিন্ন মুহূর্ত' }}</textarea>
                                            </div>
                                            <!-- Training Labs -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Training Labs Section</label>
                                                <input type="text" name="centers_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['centers_title'] ?? 'প্রশিক্ষণ ল্যাব সমূহ' }}">
                                                <textarea name="centers_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['centers_subtitle'] ?? 'তিন পার্বত্য জেলায় আমাদের কম্পিউটার ল্যাব সমূহ' }}</textarea>
                                            </div>
                                            <!-- Contact Section -->
                                            <div class="col-md-6 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Contact Section</label>
                                                <input type="text" name="contact_title" class="form-control mb-2"
                                                    placeholder="Title"
                                                    value="{{ $settings['contact_title'] ?? 'যোগাযোগ করুন' }}">
                                                <textarea name="contact_subtitle" class="form-control" rows="2" placeholder="Subtitle">{{ $settings['contact_subtitle'] ?? 'আমাদের সাথে যোগাযোগ করতে নিচের ফর্মটি পূরণ করুন' }}</textarea>
                                            </div>
                                            <!-- Footer Description -->
                                            <div class="col-12 p-3 border rounded bg-light-subtle">
                                                <label class="form-label fw-bold">Footer Description Text</label>
                                                <textarea name="footer_description" class="form-control" rows="3">{{ $settings['footer_description'] ?? 'তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিম। পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগ।' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Statistics Items -->
                                    <div class="tab-pane fade" id="stats" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Statistics Labels & Calculated Values</h5>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded text-center h-100">
                                                    <i class="bi bi-mortarboard mb-2 d-block text-primary"
                                                        style="font-size: 1.5rem;"></i>
                                                    <label class="form-label">Extra Stat 1</label>
                                                    <input type="text" name="stat_extra_1_label"
                                                        class="form-control mb-2"
                                                        value="{{ $settings['stat_extra_1_label'] ?? 'মোট প্রশিক্ষিত শিক্ষার্থী' }}">
                                                    <input type="text" name="stats_extra_1_value"
                                                        class="form-control bg-light" placeholder="Auto-calculated"
                                                        value="{{ $settings['stats_extra_1_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded text-center h-100">
                                                    <i class="bi bi-briefcase mb-2 d-block text-success"
                                                        style="font-size: 1.5rem;"></i>
                                                    <label class="form-label">Extra Stat 2</label>
                                                    <input type="text" name="stat_extra_2_label"
                                                        class="form-control mb-2"
                                                        value="{{ $settings['stat_extra_2_label'] ?? 'কর্মসংস্থান সৃষ্টি' }}">
                                                    <input type="text" name="stats_extra_2_value"
                                                        class="form-control bg-light" placeholder="Auto-calculated"
                                                        value="{{ $settings['stats_extra_2_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded text-center h-100">
                                                    <i class="bi bi-globe2 mb-2 d-block text-info"
                                                        style="font-size: 1.5rem;"></i>
                                                    <label class="form-label">Extra Stat 3</label>
                                                    <input type="text" name="stat_extra_3_label"
                                                        class="form-control mb-2"
                                                        value="{{ $settings['stat_extra_3_label'] ?? 'সফল ফ্রিল্যান্সার' }}">
                                                    <input type="text" name="stats_extra_3_value"
                                                        class="form-control bg-light" placeholder="Auto-calculated"
                                                        value="{{ $settings['stats_extra_3_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded text-center h-100">
                                                    <i class="bi bi-shop mb-2 d-block text-warning"
                                                        style="font-size: 1.5rem;"></i>
                                                    <label class="form-label">Extra Stat 4</label>
                                                    <input type="text" name="stat_extra_4_label"
                                                        class="form-control mb-2"
                                                        value="{{ $settings['stat_extra_4_label'] ?? 'উদ্যোক্তা তৈরি' }}">
                                                    <input type="text" name="stats_extra_4_value"
                                                        class="form-control bg-light" placeholder="Auto-calculated"
                                                        value="{{ $settings['stats_extra_4_value'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Organizations Details -->
                                    <div class="tab-pane fade" id="orgs" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Training Partner Details (PeopleNTech)</h5>
                                        <div class="row g-4">
                                            <!-- PeopleNTech Brand -->
                                            <div class="col-md-12 p-3 bg-light-subtle rounded border">
                                                <h6 class="text-primary mb-3 fw-bold"><i
                                                        class="bi bi-briefcase me-2"></i>PeopleNTech Branding</h6>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Institute Name</label>
                                                        <input type="text" name="peoplentech_name"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_name'] ?? 'PeopleNTech Institute of IT' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Logo Path (e.g.
                                                            img/PNT_logo.webp)</label>
                                                        <input type="text" name="peoplentech_logo"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_logo'] ?? 'img/PNT_logo.webp' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="peoplentech_description" class="form-control" rows="3">{{ $settings['peoplentech_description'] ?? 'PeopleNTech গত ১৪+ বছর ধরে বাংলাদেশে আইটি প্রশিক্ষণ ও জব প্লেসমেন্ট সেবা প্রদান করে আসছে। বিশ্বমানের আইটি বিশেষজ্ঞ তৈরির লক্ষ্যে কাজ করছে এই প্রতিষ্ঠানটি। BASIS ও ISO 9001:2015 সার্টিফিকেটধারী এই প্রতিষ্ঠান দেশ-বিদেশে সুনাম অর্জন করেছে।' }}</textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Features List (HTML Allowed)</label>
                                                        <textarea name="peoplentech_list" class="form-control summernote-list" rows="4">{{ $settings['peoplentech_list'] ?? '<ul><li>ইন্ডাস্ট্রি-ফোকাসড লাইভ কোর্স পরিচালনা</li><li>চাকরি ও ইন্টার্নশিপ প্লেসমেন্ট সার্ভিস</li><li>ফ্রিল্যান্স ক্যারিয়ার গাইডেন্স ও সাপোর্ট</li><li>লাইফটাইম স্টুডেন্ট সাপোর্ট সিস্টেম</li><li>WUST (USA) এর সাথে গ্লোবাল একাডেমিক সহযোগিতা</li></ul>' }}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Website Button Label</label>
                                                        <input type="text" name="peoplentech_website_label"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_website_label'] ?? 'peoplentech.com.bd ভিজিট করুন' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Website URL</label>
                                                        <input type="url" name="peoplentech_website"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_website'] ?? 'https://peoplentech.com.bd' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Why PeopleNTech Section -->
                                            <div class="col-md-12 p-3 bg-white rounded border">
                                                <h6 class="text-primary mb-3 fw-bold"><i
                                                        class="bi bi-question-circle me-2"></i>Why Choose Us Section
                                                </h6>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">Why Us Title</label>
                                                        <input type="text" name="org_why_title" class="form-control"
                                                            value="{{ $settings['org_why_title'] ?? 'কেন PeopleNTech সেরা?' }}">
                                                    </div>
                                                    @for ($i = 1; $i <= 4; $i++)
                                                        <div class="col-md-6">
                                                            <div class="p-2 border rounded bg-light">
                                                                <label class="form-label fw-bold small">Feature
                                                                    {{ $i }}</label>
                                                                <input type="text"
                                                                    name="org_feature_{{ $i }}_title"
                                                                    class="form-control mb-2" placeholder="Title"
                                                                    value="{{ $settings['org_feature_' . $i . '_title'] ?? '' }}">
                                                                <input type="text"
                                                                    name="org_feature_{{ $i }}_subtitle"
                                                                    class="form-control mb-2" placeholder="Subtitle"
                                                                    value="{{ $settings['org_feature_' . $i . '_subtitle'] ?? '' }}">
                                                                <input type="text"
                                                                    name="org_feature_{{ $i }}_icon"
                                                                    class="form-control"
                                                                    placeholder="Icon (Bootstrap Icon Class)"
                                                                    value="{{ $settings['org_feature_' . $i . '_icon'] ?? 'bi-patch-check-fill' }}">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Achievements / Stats -->
                                            <div class="col-md-12 p-3 bg-light-subtle rounded border">
                                                <h6 class="text-primary mb-3 fw-bold"><i
                                                        class="bi bi-trophy me-2"></i>Achievements & Stats</h6>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label class="form-label">Achievement Title</label>
                                                        <input type="text" name="org_achieve_title"
                                                            class="form-control"
                                                            value="{{ $settings['org_achieve_title'] ?? 'একনজরে অর্জন' }}">
                                                    </div>
                                                    @for ($i = 1; $i <= 4; $i++)
                                                        <div class="col-md-3">
                                                            <div class="p-2 border rounded bg-white">
                                                                <label class="form-label fw-bold small">Stat
                                                                    {{ $i }}</label>
                                                                <input type="text"
                                                                    name="org_stat_{{ $i }}_val"
                                                                    class="form-control mb-2"
                                                                    placeholder="Value (e.g. 14+)"
                                                                    value="{{ $settings['org_stat_' . $i . '_val'] ?? '' }}">
                                                                <input type="text"
                                                                    name="org_stat_{{ $i }}_label"
                                                                    class="form-control" placeholder="Label (e.g. Years)"
                                                                    value="{{ $settings['org_stat_' . $i . '_label'] ?? '' }}">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Social Links -->
                                    <div class="tab-pane fade" id="social" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Social Media Links</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-facebook me-1 text-primary"></i>
                                                    Facebook URL</label>
                                                <input type="url" name="social_facebook" class="form-control"
                                                    value="{{ $settings['social_facebook'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-youtube me-1 text-danger"></i>
                                                    YouTube URL</label>
                                                <input type="url" name="social_youtube" class="form-control"
                                                    value="{{ $settings['social_youtube'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-linkedin me-1 text-primary"></i>
                                                    LinkedIn URL</label>
                                                <input type="url" name="social_linkedin" class="form-control"
                                                    value="{{ $settings['social_linkedin'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-twitter-x me-1 text-dark"></i>
                                                    Twitter/X URL</label>
                                                <input type="url" name="social_twitter" class="form-control"
                                                    value="{{ $settings['social_twitter'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="tab-pane fade" id="contact" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Contact Information & Footer Address</h5>
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Address Title</label>
                                                <input type="text" name="contact_address_title" class="form-control"
                                                    value="{{ $settings['contact_address_title'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Full Address</label>
                                                <textarea name="contact_address" class="form-control" rows="2">{{ $settings['contact_address'] ?? 'রাঙামাটি পার্বত্য জেলা, চট্টগ্রাম বিভাগ, বাংলাদেশ' }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Contact Phone</label>
                                                <input type="text" name="contact_phone" class="form-control"
                                                    value="{{ $settings['contact_phone'] ?? '০২৩৩৩৩৭৩২৩১' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Contact Email</label>
                                                <input type="email" name="contact_email" class="form-control"
                                                    value="{{ $settings['contact_email'] ?? 'mi@chtdb.gov.bd' }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Training Partner Name</label>
                                                <input type="text" name="training_partner_name" class="form-control"
                                                    value="{{ $settings['training_partner_name'] ?? 'PeopleNTech Institute of IT' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light d-flex justify-content-end py-3 px-4 border-top">
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="bi bi-save me-2"></i>Save All Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote-list').summernote({
                placeholder: 'Write your list items here...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['para', ['ul']],
                    ['view', ['codeview']]
                ]
            });
        });
    </script>
@endpush

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .nav-pills .nav-link {
            color: #555;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(13, 110, 253, 0.05);
            color: #0d6efd;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }

        .bg-light-subtle {
            background-color: #f8f9fa !important;
        }

        /* Responsive Tabs for < 1200px */
        @media (max-width: 1199.98px) {
            .border-end {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6 !important;
            }

            #settingsTabs {
                flex-direction: row !important;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding: 1rem !important;
                gap: 10px;
            }

            .nav-pills .nav-link {
                white-space: nowrap;
                margin-bottom: 0 !important;
            }
        }
    </style>
@endpush
