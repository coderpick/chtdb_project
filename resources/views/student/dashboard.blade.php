@extends('layouts.student')

@section('title', 'Dashboard')
@section('page-title', 'ড্যাশবোর্ড - ওভারভিউ')


@section('content')

@php
    $total = 7;
    $filled = 0;
    if($user->profile && $user->profile->phone) $filled++;
    if($user->training && $user->training->course_id) $filled++;
    if(isset($user->career) && $user->career->designation) $filled++;
    if($user->projects->count() > 0) $filled++;
    if($user->skills->count() > 0) $filled++;
    if($user->socialLinks && $user->socialLinks->linkedin) $filled++;
    if($user->portfolioSetting && $user->portfolioSetting->slug) $filled++;
    $percent = ($filled / $total) * 100;
@endphp

<div class="dash-welcome-banner mb-4">
    <h4>🎉 স্বাগতম, <span>{{ $user->name }}</span>!</h4>
    <p>আপনার প্রোফাইল সম্পূর্ণ করুন এবং পোর্টফোলিও তৈরি করুন। সম্পূর্ণ প্রোফাইল আপনার ক্যারিয়ারে সাহায্য করবে।</p>
    <div class="dash-progress-bar">
        <div class="dash-progress-fill" style="width:{{ round($percent) }}%;"></div>
    </div>
    <div class="dash-progress-label">প্রোফাইল সম্পূর্ণতা: <strong>{{ round($percent) }}%</strong></div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="dash-stat-card">
            <div class="dash-stat-icon" style="background:rgba(26,107,60,0.1);color:var(--primary);">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div>
                <h4>{{ $user->training && $user->training->course_id ? '1' : '0' }}</h4>
                <p>কোর্স সম্পন্ন</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-stat-card">
            <div class="dash-stat-icon" style="background:rgba(0,123,255,0.1);color:#0d6efd;">
                <i class="bi bi-collection"></i>
            </div>
            <div>
                <h4>{{ $user->projects->count() }}</h4>
                <p>প্রজেক্ট</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-stat-card">
            <div class="dash-stat-icon" style="background:rgba(232,185,49,0.1);color:var(--secondary);">
                <i class="bi bi-star-fill"></i>
            </div>
            <div>
                <h4>{{ $user->skills->count() }}</h4>
                <p>দক্ষতা</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-stat-card">
            <div class="dash-stat-icon" style="background:rgba(192,57,43,0.1);color:#c0392b;">
                <i class="bi bi-trophy-fill"></i>
            </div>
            <div>
                <h4>{{ $user->training && $user->training->certificate_no ? '1' : '0' }}</h4>
                <p>সার্টিফিকেট</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="dash-content-card h-100">
            <h5><i class="bi bi-lightning-fill text-warning"></i> দ্রুত অ্যাকশন</h5>
            <p class="card-subtitle">আপনার প্রোফাইল সম্পূর্ণ করতে নিচের ধাপগুলো অনুসরণ করুন</p>
            <div class="d-flex flex-column gap-3 mt-3">
                <a href="{{ route('student.profile.edit') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3 p-3" style="background:#f8faf9;border-radius:12px;cursor:pointer;">
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(26,107,60,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-fill text-success"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:600;font-size:0.88rem;">প্রোফাইল তথ্য দিন</div>
                            <div style="font-size:0.78rem;color:#888;">নাম, ছবি, ঠিকানা ইত্যাদি</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </a>
                
                <a href="{{ route('student.training.edit') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3 p-3" style="background:#f8faf9;border-radius:12px;cursor:pointer;">
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(0,123,255,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-mortarboard-fill text-primary"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:600;font-size:0.88rem;">প্রশিক্ষণ তথ্য যোগ করুন</div>
                            <div style="font-size:0.78rem;color:#888;">কোর্স, ব্যাচ, সার্টিফিকেট</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </a>
                
                <a href="{{ route('student.career.edit') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3 p-3" style="background:#f8faf9;border-radius:12px;cursor:pointer;">
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(232,185,49,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-briefcase-fill" style="color:var(--secondary);"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:600;font-size:0.88rem;">ক্যারিয়ার তথ্য দিন</div>
                            <div style="font-size:0.78rem;color:#888;">জব/ফ্রিল্যান্সিং/উদ্যোক্তা</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </a>
                
                <a href="{{ route('student.projects.index') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center gap-3 p-3" style="background:#f8faf9;border-radius:12px;cursor:pointer;">
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(192,57,43,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-collection-fill" style="color:#c0392b;"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-weight:600;font-size:0.88rem;">পোর্টফোলিও তৈরি করুন</div>
                            <div style="font-size:0.78rem;color:#888;">প্রজেক্ট ও কাজের নমুনা</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="dash-content-card h-100">
            <h5><i class="bi bi-info-circle-fill text-primary"></i> সংক্ষিপ্ত তথ্য</h5>
            <p class="card-subtitle">আপনার প্রোফাইলের সংক্ষিপ্ত বিবরণ</p>
            <table class="table table-borderless mt-3" style="font-size:0.88rem;">
                <tr>
                    <td class="text-muted" style="width:40%;">নাম:</td>
                    <td style="font-weight:600;">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="text-muted">ইমেইল:</td>
                    <td style="font-weight:600;">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="text-muted">জেলা:</td>
                    <td style="font-weight:600;">{{ $user->profile->district ?? 'দেওয়া হয়নি' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">কোর্স:</td>
                    <td style="font-weight:600;">{{ $user->training->course->name ?? 'দেওয়া হয়নি' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">পেশা/বর্তমান অবস্থা:</td>
                    <td style="font-weight:600;">{{ isset($user->career) ? $user->career->status : 'দেওয়া হয়নি' }}</td>
                </tr>
                <tr>
                    <td class="text-muted">আয়:</td>
                    <td style="font-weight:600;">{{ isset($user->career) && $user->career->income ? $user->career->income : 'দেওয়া হয়নি' }}</td>
                </tr>
            </table>

            @if($user->portfolioSetting && $user->portfolioSetting->slug)
            <div class="mt-4 p-3" style="background:#f8faf9;border-radius:12px;">
                <h6 class="mb-2" style="font-weight:600;font-size:0.88rem;"><i class="bi bi-link-45deg"></i> পাবলিক পোর্টফোলিও</h6>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control bg-white" value="{{ url('/') }}/portfolio/{{ $user->portfolioSetting->slug }}" readonly id="portfolioUrl">
                    <button class="btn btn-outline-primary" onclick="copyPortfolioUrl()"><i class="bi bi-clipboard"></i> কপি</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyPortfolioUrl() {
    const input = document.getElementById('portfolioUrl');
    input.select();
    navigator.clipboard.writeText(input.value).then(() => {
        alert('Copied to clipboard!');
    });
}
</script>
@endpush
