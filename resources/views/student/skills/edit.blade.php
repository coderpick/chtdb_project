@extends('layouts.student')

@section('title', 'Skills')
@section('page-title', 'দক্ষতা')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <style>
        :root {
            --primary-rgb: 13, 110, 253;
        }
        .tagify {
            width: 100% !important;
            border-radius: 12px !important;
            border: 1px solid #e2e8f0;
            padding: 8px !important;
            background: #fff;
            transition: all 0.2s ease;
            --tag-bg: var(--primary);
            --tag-hover: var(--primary-dark);
            --tag-text-color: #fff;
            --tag-remove-btn-color: #fff;
        }
        .tagify:hover { border-color: #cbd5e1; }
        .tagify--focus { border-color: var(--primary) !important; box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.08) !important; }
        
        .tagify__tag { margin: 4px !important; }
        .tagify__tag > div {
            border-radius: 20px !important;
            padding: 4px 12px !important;
            background: var(--tag-bg) !important;
            color: var(--tag-text-color) !important;
        }
        .tagify__tag__removeBtn { margin-left: 8px !important; opacity: 0.7; }
        .tagify__tag__removeBtn:hover { opacity: 1; background: transparent !important; }
        
        .tagify__dropdown { border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .tagify__dropdown__item--active { background: var(--primary) !important; color: white !important; }
        
        .skill-tag {
            background:#f1f5f9;
            color:#475569;
            padding:6px 14px;
            border-radius:20px;
            font-size:0.85rem;
            cursor:pointer;
            transition:all 0.2s ease;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
        }
        .skill-tag:hover {
            background:#e2e8f0;
            color:var(--primary);
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }
    </style>
@endpush

@section('content')
<div class="dash-content-card border-0">
    <div>
        <h5><i class="bi bi-stars text-warning"></i> দক্ষতা সমূহ (Skills)</h5>
        <p class="card-subtitle">আপনার টেকনিক্যাল ও অন্যান্য দক্ষতা যুক্ত করুন</p>
    </div>
    
    <div class="row mt-4">
        <div class="col-lg-8">
            <form action="{{ route('student.skills.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="dash-form-label mb-2">আপনার দক্ষতাসমূহ:</label>
                    <input name="skills" id="skillsInput" value="{{ implode(',', $currentSkills) }}" class="dash-form-control" placeholder="দক্ষতার নাম লিখুন এবং এন্টার চাপুন">
                    <p class="text-muted small mt-2"><i class="bi bi-info-circle me-1"></i> একাধিক দক্ষতা যোগ করতে এন্টার (Enter) বা কমা (,) ব্যবহার করুন।</p>
                </div>

                <button type="submit" class="btn-dash-save px-4"><i class="bi bi-check-lg me-1"></i> সকল পরিবর্তন সেভ করুন</button>
            </form>
        </div>

        <div class="col-lg-4 border-start ps-lg-4 mt-4 mt-lg-0">
            <h6 style="font-weight:700;margin-bottom:15px;color:var(--primary-dark);"><i class="bi bi-lightbulb me-1"></i> সাজেস্টেড দক্ষতা:</h6>
            @if(empty($suggestedSkills))
                <p class="small text-muted">আপনি আপনার জন্য প্রযোজ্য সকল দক্ষতা যোগ করেছেন।</p>
            @else
                <div class="d-flex flex-wrap gap-2">
                    @foreach(array_slice($suggestedSkills, 0, 20) as $skill)
                        <span class="skill-tag" onclick="addSkill('{{ $skill }}')">
                            <i class="bi bi-plus-circle me-1"></i>{{ $skill }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    var tagify;
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector('#skillsInput');
        tagify = new Tagify(input, {
            whitelist: @json($suggestedSkills),
            maxTags: 20,
            dropdown: {
                maxItems: 20,
                classname: "tags-look",
                enabled: 0,
                closeOnSelect: true
            }
        });
    });

    function addSkill(skill) {
        if(tagify) {
            tagify.addTags([skill]);
        }
    }
</script>
@endpush
