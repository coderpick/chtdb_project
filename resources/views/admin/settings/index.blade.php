@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Manage Site Content')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header bg-white">
                        <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button">General & Topbar</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button">Hero & Marquee</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button">About Section</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button">Statistics Items</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button">Contact Info</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="settingsTabsContent">
                            <!-- General & Topbar -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Topbar Address (BN)</label>
                                        <input type="text" name="topbar_address" class="form-control" value="{{ $settings['topbar_address'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড, রাঙামাটি' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Topbar Email</label>
                                        <input type="email" name="topbar_email" class="form-control" value="{{ $settings['topbar_email'] ?? 'info@chtdb.gov.bd' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Topbar Phone</label>
                                        <input type="text" name="topbar_phone" class="form-control" value="{{ $settings['topbar_phone'] ?? '+৮৮০-৩৫১-৬২০৮১' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">CHTDB Website URL</label>
                                        <input type="url" name="chtdb_website" class="form-control" value="{{ $settings['chtdb_website'] ?? 'https://chtdb.gov.bd' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Training Partner (PeopleNTech) URL</label>
                                        <input type="url" name="peoplentech_website" class="form-control" value="{{ $settings['peoplentech_website'] ?? 'https://peoplentech.com.bd' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Hero & Marquee -->
                            <div class="tab-pane fade" id="hero" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-12 border-bottom pb-4 mb-2">
                                        <label class="form-label">Marquee Announcement Text</label>
                                        <textarea name="marquee_text" class="form-control" rows="2">{{ $settings['marquee_text'] ?? '📢 তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিম — পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগে ২১৫+ শিক্ষার্থী প্রশিক্ষিত — রাঙামাটি | খাগড়াছড়ি | বান্দরবান 🏔️' }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Hero Badge Text</label>
                                        <input type="text" name="hero_badge" class="form-control" value="{{ $settings['hero_badge'] ?? 'পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Hero Title (Main)</label>
                                        <input type="text" name="hero_title" class="form-control" value="{{ $settings['hero_title'] ?? 'তিন পার্বত্য জেলার' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Hero Title (Highlight)</label>
                                        <input type="text" name="hero_highlight" class="form-control" value="{{ $settings['hero_highlight'] ?? 'আইসিটি দক্ষতা উন্নয়ন' }}">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Hero Title (Ending)</label>
                                        <input type="text" name="hero_title_end" class="form-control" value="{{ $settings['hero_title_end'] ?? 'ও আত্মকর্মসংস্থান স্কিম' }}">
                                    </div>
                                    <div class="col-12 border-bottom pb-4 mb-2">
                                        <label class="form-label">Hero Subtitle</label>
                                        <textarea name="hero_subtitle" class="form-control" rows="3">{{ $settings['hero_subtitle'] ?? 'রাঙামাটি, খাগড়াছড়ি ও বান্দরবান জেলার বেকার যুবক-যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়নের মাধ্যমে আত্মকর্মসংস্থানের সুযোগ সৃষ্টি করা হচ্ছে। ট্রেনিং পার্টনার PeopleNTech এর সহযোগিতায়।' }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label d-block mb-3 fw-bold"><i class="bi bi-bar-chart-fill me-2"></i> Hero Statistics Values</label>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded bg-light">
                                                    <label class="form-label text-muted small">Stat 1 (Label & Value)</label>
                                                    <input type="text" name="stat_1_label" class="form-control mb-2" value="{{ $settings['stat_1_label'] ?? 'প্রশিক্ষিত শিক্ষার্থী' }}">
                                                    <input type="text" name="hero_stat_1_value" class="form-control" placeholder="Default: 200" value="{{ $settings['hero_stat_1_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded bg-light">
                                                    <label class="form-label text-muted small">Stat 2 (Label & Value)</label>
                                                    <input type="text" name="stat_2_label" class="form-control mb-2" value="{{ $settings['stat_2_label'] ?? 'পার্বত্য জেলা' }}">
                                                    <input type="text" name="hero_stat_2_value" class="form-control" placeholder="Default: 3" value="{{ $settings['hero_stat_2_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded bg-light">
                                                    <label class="form-label text-muted small">Stat 3 (Label & Value)</label>
                                                    <input type="text" name="stat_3_label" class="form-control mb-2" value="{{ $settings['stat_3_label'] ?? 'আইসিটি কোর্স' }}">
                                                    <input type="text" name="hero_stat_3_value" class="form-control" placeholder="Default: 8" value="{{ $settings['hero_stat_3_value'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="p-3 border rounded bg-light">
                                                    <label class="form-label text-muted small">Stat 4 (Label & Value)</label>
                                                    <input type="text" name="stat_4_label" class="form-control mb-2" value="{{ $settings['stat_4_label'] ?? 'কর্মসংস্থান হার' }}">
                                                    <input type="text" name="hero_stat_4_value" class="form-control" placeholder="Default: 85" value="{{ $settings['hero_stat_4_value'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- About Section -->
                            <div class="tab-pane fade" id="about" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">About Badge</label>
                                        <input type="text" name="about_badge" class="form-control" value="{{ $settings['about_badge'] ?? 'চলমান প্রশিক্ষণ কার্যক্রম' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">About Section Title</label>
                                        <input type="text" name="about_title" class="form-control" value="{{ $settings['about_title'] ?? 'প্রকল্প সম্পর্কে' }}">
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

                            <!-- Statistics Items -->
                            <div class="tab-pane fade" id="stats" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="p-3 border rounded text-center">
                                            <i class="bi bi-mortarboard mb-2 d-block text-primary" style="font-size: 1.5rem;"></i>
                                            <label class="form-label">Extra Stat 1 (Label & Value)</label>
                                            <input type="text" name="stat_extra_1_label" class="form-control mb-2" value="{{ $settings['stat_extra_1_label'] ?? 'মোট প্রশিক্ষিত শিক্ষার্থী' }}">
                                            <input type="text" name="stats_extra_1_value" class="form-control" placeholder="Auto-calculated" value="{{ $settings['stats_extra_1_value'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 border rounded text-center">
                                            <i class="bi bi-briefcase mb-2 d-block text-success" style="font-size: 1.5rem;"></i>
                                            <label class="form-label">Extra Stat 2 (Label & Value)</label>
                                            <input type="text" name="stat_extra_2_label" class="form-control mb-2" value="{{ $settings['stat_extra_2_label'] ?? 'কর্মসংস্থান সৃষ্টি' }}">
                                            <input type="text" name="stats_extra_2_value" class="form-control" placeholder="Auto-calculated" value="{{ $settings['stats_extra_2_value'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 border rounded text-center">
                                            <i class="bi bi-globe2 mb-2 d-block text-warning" style="font-size: 1.5rem;"></i>
                                            <label class="form-label">Extra Stat 3 (Label & Value)</label>
                                            <input type="text" name="stat_extra_3_label" class="form-control mb-2" value="{{ $settings['stat_extra_3_label'] ?? 'সফল ফ্রিল্যান্সার' }}">
                                            <input type="text" name="stats_extra_3_value" class="form-control" placeholder="Auto-calculated" value="{{ $settings['stats_extra_3_value'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3 border rounded text-center">
                                            <i class="bi bi-shop mb-2 d-block text-danger" style="font-size: 1.5rem;"></i>
                                            <label class="form-label">Extra Stat 4 (Label & Value)</label>
                                            <input type="text" name="stat_extra_4_label" class="form-control mb-2" value="{{ $settings['stat_extra_4_label'] ?? 'উদ্যোক্তা তৈরি' }}">
                                            <input type="text" name="stats_extra_4_value" class="form-control" placeholder="Auto-calculated" value="{{ $settings['stats_extra_4_value'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Full Address</label>
                                        <textarea name="contact_address" class="form-control" rows="2">{{ $settings['contact_address'] ?? 'রাঙামাটি পার্বত্য জেলা, চট্টগ্রাম বিভাগ, বাংলাদেশ' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Phone</label>
                                        <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '০২৩৩৩৩৭৩২৩১' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Email</label>
                                        <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'mi@chtdb.gov.bd' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="bi bi-save me-2"></i>Save All Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .nav-tabs .nav-link {
            color: #666;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border: none;
            border-bottom: 2px solid transparent;
        }
        .nav-tabs .nav-link.active {
            color: var(--primary);
            background: transparent;
            border-bottom: 2px solid var(--primary);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #444;
            margin-bottom: 0.4rem;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
@endpush
