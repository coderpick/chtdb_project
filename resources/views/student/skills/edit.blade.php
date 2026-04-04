@extends('layouts.student')

@section('title', 'Skills')
@section('page-title', 'দক্ষতা')

@section('content')
<div class="dash-content-card border-0">
    <h5><i class="bi bi-stars text-warning"></i> দক্ষতা সমূহ (Skills)</h5>
    <p class="card-subtitle">আপনার টেকনিক্যাল ও অন্যান্য দক্ষতা যুক্ত করুন</p>
    
    <div class="row mt-4">
        <div class="col-lg-8">
            <form action="{{ route('student.skills.store') }}" method="POST" class="d-flex gap-2 mb-4">
                @csrf
                <input type="text" name="skill" class="dash-form-control @error('skill') is-invalid @enderror" placeholder="দক্ষতার নাম লিখুন (যেমন: React.js)" list="suggestedSkills" style="max-width:350px;" required>
                <datalist id="suggestedSkills">
                    @foreach($suggestedSkills as $sugg)
                        <option value="{{ $sugg }}">
                    @endforeach
                </datalist>
                <button type="submit" class="btn-dash-save px-4"><i class="bi bi-plus-lg me-1"></i> যোগ করুন</button>
            </form>
            @error('skill')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

            <div class="mb-3">
                <label class="dash-form-label mb-3">আপনার দক্ষতাসমূহ:</label>
                <div id="skillsList">
                    @if(empty($currentSkills))
                        <span style="color:#aaa;font-size:0.88rem;">এখনও কোনো দক্ষতা যোগ করা হয়নি।</span>
                    @else
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($currentSkills as $skill)
                                <span style="background:var(--primary);color:white;padding:5px 12px;border-radius:20px;font-size:0.85rem;display:inline-flex;align-items:center;gap:6px;">
                                    {{ $skill }}
                                    <form action="{{ route('student.skills.destroy', $skill) }}" method="POST" class="d-inline border-0 m-0 p-0 bg-transparent" onsubmit="return confirm('Remove this skill?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-close btn-close-white ms-1" style="font-size: 0.55rem; padding: 0.2rem; cursor:pointer;" aria-label="Remove"></button>
                                    </form>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 border-start ps-lg-4">
            <h6 style="font-weight:700;margin-bottom:12px;color:var(--primary-dark);">সাজেস্টেড দক্ষতা:</h6>
            @if(empty($suggestedSkills))
                <p class="small text-muted">You have all skills from the catalog!</p>
            @else
                <div class="d-flex flex-wrap gap-2" id="suggestedSkills">
                    @foreach(array_slice($suggestedSkills, 0, 15) as $skill)
                        <span class="skill-tag" style="background:#f0f4f8;color:#555;padding:5px 12px;border-radius:20px;font-size:0.85rem;cursor:pointer;transition:all 0.2s;" onclick="event.preventDefault(); document.querySelector('input[name=skill]').value = '{{ $skill }}';" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f0f4f8'">
                            <i class="bi bi-plus-circle text-primary me-1"></i>{{ $skill }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
