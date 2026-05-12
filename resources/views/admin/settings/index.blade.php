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
                                    data-bs-target="#general" type="button">
                                    <i class="bi bi-info-circle me-2"></i>General & Topbar
                                </button>
                                <button class="nav-link text-start mb-2" id="hero-tab" data-bs-toggle="tab"
                                    data-bs-target="#hero" type="button">
                                    <i class="bi bi-stars me-2"></i>Hero & Marquee
                                </button>
                                <button class="nav-link text-start mb-2" id="about-tab" data-bs-toggle="tab"
                                    data-bs-target="#about" type="button">
                                    <i class="bi bi-card-text me-2"></i>About Section
                                </button>
                                <button class="nav-link text-start mb-2" id="section-titles-tab" data-bs-toggle="tab"
                                    data-bs-target="#section-titles" type="button">
                                    <i class="bi bi-fonts me-2"></i>Section Titles & Footer
                                </button>
                                <button class="nav-link text-start mb-2" id="orgs-tab" data-bs-toggle="tab"
                                    data-bs-target="#orgs" type="button">
                                    <i class="bi bi-building me-2"></i>Organizations Details
                                </button>
                                <button class="nav-link text-start mb-2" id="stats-tab" data-bs-toggle="tab"
                                    data-bs-target="#stats" type="button">
                                    <i class="bi bi-bar-chart me-2"></i>Statistics Items
                                </button>
                                <button class="nav-link text-start mb-2" id="timeline-tab" data-bs-toggle="tab"
                                    data-bs-target="#timeline" type="button">
                                    <i class="bi bi-clock-history me-2"></i>Timeline Milestones
                                </button>
                                <button class="nav-link text-start mb-2" id="social-tab" data-bs-toggle="tab"
                                    data-bs-target="#social" type="button">
                                    <i class="bi bi-share me-2"></i>Social Links
                                </button>
                                <button class="nav-link text-start mb-2" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact" type="button">
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

                                    <!-- About Section -->
                                    <div class="tab-pane fade" id="about" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">About Section Content</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">About Badge</label>
                                                <input type="text" name="about_badge" class="form-control"
                                                    value="{{ $settings['about_badge'] ?? 'চলমান প্রশিক্ষণ কার্যক্রম' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">About Section Title</label>
                                                <input type="text" name="about_title" class="form-control"
                                                    value="{{ $settings['about_title'] ?? 'প্রকল্প সম্পর্কে' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">About Subtitle</label>
                                                <textarea name="about_subtitle" class="form-control" rows="2">{{ $settings['about_subtitle'] ?? 'তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিমটি পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ডের একটি গুরুত্বপূর্ণ উদ্যোগ।' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">About Detailed Description</label>
                                                <textarea name="about_description" class="form-control" rows="4">{{ $settings['about_description'] ?? 'এই প্রকল্পের মাধ্যমে রাঙামাটি, খাগড়াছড়ি ও বান্দরবান পার্বত্য জেলার বেকার যুবক-যুবতীদের আধুনিক তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ে হাতে-কলমে প্রশিক্ষণ প্রদান করা হয়েছে। প্রশিক্ষণ পার্টনার হিসেবে বাংলাদেশের অন্যতম শীর্ষস্থানীয় আইটি প্রশিক্ষণ প্রতিষ্ঠান PeopleNTech Institute of IT এই কার্যক্রম সফলভাবে পরিচালনা করেছে।' }}</textarea>
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
                                                    <i class="bi bi-globe2 mb-2 d-block text-warning"
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
                                                    <i class="bi bi-shop mb-2 d-block text-danger"
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
                                        <h5 class="mb-4 border-bottom pb-2">Organizations Detail Info</h5>
                                        <div class="row g-4">
                                            <!-- CHTDB Details -->
                                            <div class="col-md-12 p-3 bg-light-subtle rounded border border-white">
                                                <h6 class="text-success mb-3 fw-bold">CHTDB Details</h6>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="chtdb_name" class="form-control"
                                                            value="{{ $settings['chtdb_name'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Badge Text</label>
                                                        <input type="text" name="chtdb_badge" class="form-control"
                                                            value="{{ $settings['chtdb_badge'] ?? 'প্রকল্প বাস্তবায়নকারী' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="chtdb_description" class="form-control" rows="3">{{ $settings['chtdb_description'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড (CHTDB) বাংলাদেশ সরকারের পার্বত্য চট্টগ্রাম বিষয়ক মন্ত্রণালয়ের অধীনে একটি স্বায়ত্তশাসিত সংস্থা। রাঙামাটি, খাগড়াছড়ি ও বান্দরবান — এই তিন পার্বত্য জেলার সার্বিক আর্থ-সামাজিক উন্নয়নে গুরুত্বপূর্ণ ভূমিকা পালন করছে এই প্রতিষ্ঠান।' }}</textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">List Items (Simple List)</label>
                                                        <textarea name="chtdb_list" class="form-control summernote-list" rows="4">{{ $settings['chtdb_list'] ?? '<ul><li>পার্বত্য এলাকায় টেকসই সামাজিক সেবা প্রদান প্রকল্প</li><li>আইসিটি ভিত্তিক দক্ষ জনবল সৃষ্টির মাধ্যমে আত্মকর্মসংস্থান সৃষ্টিকরণ</li><li>কৃষি, অবকাঠামো ও শিক্ষা খাতে উন্নয়ন প্রকল্প পরিচালনা</li><li>পার্বত্য চট্টগ্রামে তুলা চাষ বৃদ্ধি ও দারিদ্র্য বিমোচন</li><li>সোলার প্যানেল স্থাপনের মাধ্যমে বিদ্যুৎ সরবরাহ প্রকল্প</li></ul>' }}</textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">Website Button Label</label>
                                                        <input type="text" name="chtdb_website_label"
                                                            class="form-control"
                                                            value="{{ $settings['chtdb_website_label'] ?? 'chtdb.gov.bd ভিজিট করুন' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PeopleNTech Details -->
                                            <div class="col-md-12 p-3 bg-light-subtle rounded border border-white">
                                                <h6 class="text-primary mb-3 fw-bold">PeopleNTech Details</h6>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="peoplentech_name"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_name'] ?? 'PeopleNTech Institute of IT' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Badge Text</label>
                                                        <input type="text" name="peoplentech_badge"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_badge'] ?? 'ট্রেনিং প্রদানকারী প্রতিষ্ঠান' }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="peoplentech_description" class="form-control" rows="3">{{ $settings['peoplentech_description'] ?? 'PeopleNTech গত ১৪+ বছর ধরে বাংলাদেশে আইটি প্রশিক্ষণ ও জব প্লেসমেন্ট সেবা প্রদান করে আসছে। বিশ্বমানের আইটি বিশেষজ্ঞ তৈরির লক্ষ্যে কাজ করছে এই প্রতিষ্ঠানটি। BASIS ও ISO 9001:2015 সার্টিফিকেটধারী এই প্রতিষ্ঠান দেশ-বিদেশে সুনাম অর্জন করেছে।' }}</textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">List Items (Simple List)</label>
                                                        <textarea name="peoplentech_list" class="form-control summernote-list" rows="4">{{ $settings['peoplentech_list'] ?? '<ul><li>ইন্ডাস্ট্রি-ফোকাসড লাইভ কোর্স পরিচালনা</li><li>চাকরি ও ইন্টার্নশিপ প্লেসমেন্ট সার্ভিস</li><li>ফ্রিল্যান্স ক্যারিয়ার গাইডেন্স ও সাপোর্ট</li><li>লাইফটাইম স্টুডেন্ট সাপোর্ট সিস্টেম</li><li>WUST (USA) এর সাথে গ্লোবাল একাডেমিক সহযোগিতা</li></ul>' }}</textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">Website Button Label</label>
                                                        <input type="text" name="peoplentech_website_label"
                                                            class="form-control"
                                                            value="{{ $settings['peoplentech_website_label'] ?? 'peoplentech.com.bd ভিজিট করুন' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Timeline Milestones -->
                                    <div class="tab-pane fade" id="timeline" role="tabpanel">
                                        <h5 class="mb-4 border-bottom pb-2">Timeline Milestones Settings</h5>

                                        <!-- Milestone 1 -->
                                        <div class="bg-light p-3 rounded mb-4 border">
                                            <h6 class="fw-bold text-primary mb-3">Milestone 1</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Date/Year</label>
                                                    <input type="text" name="timeline_1_date" class="form-control"
                                                        value="{{ $settings['timeline_1_date'] ?? '২০২৪ - শুরু' }}">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="timeline_1_title" class="form-control"
                                                        value="{{ $settings['timeline_1_title'] ?? 'প্রকল্প অনুমোদন ও পরিকল্পনা' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="timeline_1_content" class="form-control" rows="2">{{ $settings['timeline_1_content'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড কর্তৃক প্রকল্প অনুমোদন এবং PeopleNTech কে ট্রেনিং প্রদানকারী প্রতিষ্ঠান হিসেবে নির্বাচন করা হয়।' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Milestone 2 -->
                                        <div class="bg-light p-3 rounded mb-4 border">
                                            <h6 class="fw-bold text-primary mb-3">Milestone 2</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Date/Year</label>
                                                    <input type="text" name="timeline_2_date" class="form-control"
                                                        value="{{ $settings['timeline_2_date'] ?? '২০২৫ - প্রথম ব্যাচ' }}">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="timeline_2_title" class="form-control"
                                                        value="{{ $settings['timeline_2_title'] ?? 'প্রথম ব্যাচ প্রশিক্ষণ শুরু' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="timeline_2_content" class="form-control" rows="2">{{ $settings['timeline_2_content'] ?? 'রাঙামাটি, খাগড়াছড়ি ও বান্দরবানে একযোগে প্রশিক্ষণ কার্যক্রম আরম্ভ। প্রথম ব্যাচে ১০০+ শিক্ষার্থী অংশগ্রহণ।' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Milestone 3 -->
                                        <div class="bg-light p-3 rounded mb-4 border">
                                            <h6 class="fw-bold text-primary mb-3">Milestone 3</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Date/Year</label>
                                                    <input type="text" name="timeline_3_date" class="form-control"
                                                        value="{{ $settings['timeline_3_date'] ?? '২০২৫ - মধ্যভাগ' }}">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="timeline_3_title" class="form-control"
                                                        value="{{ $settings['timeline_3_title'] ?? 'দ্বিতীয় ব্যাচ ও সম্প্রসারণ' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="timeline_3_content" class="form-control" rows="2">{{ $settings['timeline_3_content'] ?? 'দ্বিতীয় ব্যাচে আরও ১১৫+ শিক্ষার্থী যোগদান। নতুন কোর্স সংযোজন এবং কারিকুলাম আপডেট করা হয়।' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Milestone 4 -->
                                        <div class="bg-light p-3 rounded mb-4 border">
                                            <h6 class="fw-bold text-primary mb-3">Milestone 4</h6>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Date/Year</label>
                                                    <input type="text" name="timeline_4_date" class="form-control"
                                                        value="{{ $settings['timeline_4_date'] ?? '২০২৬ - প্রথম ভাগ' }}">
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="timeline_4_title" class="form-control"
                                                        value="{{ $settings['timeline_4_title'] ?? 'সফল সমাপ্তি ও কর্মসংস্থান' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="timeline_4_content" class="form-control" rows="2">{{ $settings['timeline_4_content'] ?? '২০০+ শিক্ষার্থী সফলভাবে প্রশিক্ষণ সম্পন্ন। ৮৫% শিক্ষার্থী কর্মসংস্থানে যুক্ত হয়েছে।' }}</textarea>
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
                    ['para', ['ul', 'ol']],
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
