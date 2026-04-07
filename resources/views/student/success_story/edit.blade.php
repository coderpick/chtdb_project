@extends('layouts.student')

@section('title', 'Success Story')
@section('page-title', 'সফলতার গল্প / টেস্টিমোনিয়াল')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="dash-content-card border-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5><i class="bi bi-trophy-fill text-warning me-2"></i>আপনার সফলতার গল্প</h5>
                    <p class="card-subtitle mb-0">প্রশিক্ষণের পর আপনার জীবন কীভাবে পরিবর্তিত হয়েছে তা শেয়ার করুন</p>
                </div>
                @if($successStory)
                    <div class="status-indicator">
                        @if($successStory->status == 'approved')
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i> অনুমোদিত (Approved)
                            </span>
                        @elseif($successStory->status == 'rejected')
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                <i class="bi bi-x-circle-fill me-1"></i> প্রত্যাখ্যাত (Rejected)
                            </span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                <i class="bi bi-clock-history me-1"></i> অপেক্ষমাণ (Pending)
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            <form action="{{ route('student.success-story.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="dash-form-label">আপনার গল্প লিখুন *</label>
                    <textarea name="story_text" 
                              class="dash-form-control @error('story_text') is-invalid @enderror" 
                              rows="12" 
                              placeholder="আপনার আইসিটি প্রশিক্ষণ শুরু করার আগের অবস্থা, প্রশিক্ষণের অভিজ্ঞতা এবং বর্তমান পেশাগত অবস্থান সম্পর্কে বিস্তারিত লিখুন..."
                              required>{{ old('story_text', $successStory->story_text ?? '') }}</textarea>
                    <div class="form-text mt-2">
                        <i class="bi bi-info-circle me-1"></i> কমপক্ষে ৫০টি শব্দ লিখুন। এটি আপনার পোর্টফোলিওতে প্রদর্শিত হবে।
                    </div>
                    @error('story_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="alert alert-info border-0 bg-light-subtle rounded-3 mb-4">
                    <div class="d-flex gap-3">
                        <i class="bi bi-lightbulb text-info fs-4"></i>
                        <div class="small">
                            <strong>মনে রাখবেন:</strong> আপনি যখনই আপনার গল্পটি আপডেট করবেন, এটি পুনরায় অ্যাডমিনের কাছে অনুমোদনের জন্য চলে যাবে। অনুমোদিত হওয়ার পর এটি আপনার পাবলিক পোর্টফোলিওতে দৃশ্যমান হবে।
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-dash-save">
                    <i class="bi bi-send-fill me-2"></i> সফলতার গল্প সেভ করুন
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dash-content-card border-0 bg-primary-subtle bg-opacity-10 h-100">
            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-stars me-2"></i>কীভাবে একটি ভালো গল্প লিখবেন?</h6>
            <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small text-secondary">
                <li class="d-flex gap-2">
                    <i class="bi bi-1-circle-fill text-primary"></i>
                    <span><strong>ভূমিকা:</strong> প্রশিক্ষণ শুরু করার আগে আপনার অবস্থা কেমন ছিল তা দিয়ে শুরু করুন।</span>
                </li>
                <li class="d-flex gap-2">
                    <i class="bi bi-2-circle-fill text-primary"></i>
                    <span><strong>অভিজ্ঞতা:</strong> প্রশিক্ষণের সময় কোনটি আপনার সবচেয়ে ভালো লেগেছে বা কী শিখেছেন তা লিখুন।</span>
                </li>
                <li class="d-flex gap-2">
                    <i class="bi bi-3-circle-fill text-primary"></i>
                    <span><strong>সাফল্য:</strong> প্রশিক্ষণের পর আপনি কোথায় কাজ করছেন বা কীভাবে আয় করছেন তা উল্লেখ করুন।</span>
                </li>
                <li class="d-flex gap-2">
                    <i class="bi bi-4-circle-fill text-primary"></i>
                    <span><strong>কৃতজ্ঞতা:</strong> বোর্ড বা মেন্টরদের প্রতি কোনো বার্তা থাকলে যোগ করতে পারেন।</span>
                </li>
            </ul>
            
            <hr class="my-4 opacity-10">
            
            <div class="text-center p-3 rounded-4 bg-white shadow-sm">
                <div class="avatar-lg mx-auto mb-2" style="width:60px;height:60px;border-radius:50%;background:#f8f9fa;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-quote fs-2 text-primary"></i>
                </div>
                <p class="fst-italic small text-muted mb-0">"আপনার গল্প অন্য হাজারও শিক্ষার্থীর জন্য অনুপ্রেরণা হতে পারে।"</p>
            </div>
        </div>
    </div>
</div>
@endsection
