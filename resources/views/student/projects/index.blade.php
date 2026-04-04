@extends('layouts.student')

@section('title', 'Projects')
@section('page-title', 'পোর্টফোলিও / প্রজেক্ট')

@section('content')
<div class="dash-content-card border-0">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
        <div>
            <h5><i class="bi bi-collection-fill" style="color:#c0392b;"></i> পোর্টফোলিও / প্রজেক্ট</h5>
            <p class="card-subtitle mb-0">আপনার সম্পন্ন করা প্রজেক্ট/কাজের নমুনা যুক্ত করুন</p>
        </div>
        <a href="{{ route('student.projects.create') }}" class="btn btn-outline-success" style="border-radius:12px;font-weight:600;"><i class="bi bi-plus-lg me-1"></i> নতুন প্রজেক্ট</a>
    </div>

    @if($projects->isEmpty())
        <div class="row g-3" id="projectsList">
            <div class="col-12 text-center py-5" id="noProjectMsg">
                <i class="bi bi-folder2-open" style="font-size:3rem;color:#ddd;"></i>
                <p style="color:#aaa;margin-top:10px;">এখনও কোনো প্রজেক্ট যুক্ত করা হয়নি।<br>উপরের "নতুন প্রজেক্ট" বাটনে ক্লিক করুন।</p>
            </div>
        </div>
    @else
        <div class="table-responsive mt-2">
            <table class="table table-hover align-middle mb-0" style="border-radius: 12px; overflow: hidden; border: 1px solid #eee;">
                <thead style="background: #f8faf9;">
                    <tr>
                        <th class="ps-3 border-0 py-3" style="font-weight:600;color:#555;">Title</th>
                        <th class="border-0 py-3" style="font-weight:600;color:#555;">Technologies</th>
                        <th class="border-0 py-3" style="font-weight:600;color:#555;">Featured</th>
                        <th class="text-end pe-3 border-0 py-3" style="font-weight:600;color:#555;">Actions</th>
                    </tr>
                </thead>
                <tbody style="border-top: none;">
                    @foreach($projects as $project)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td class="ps-3 py-3" style="font-weight:500;">{{ $project->name ?? $project->title }}</td>
                        <td class="py-3">
                            <div class="d-flex flex-wrap gap-1">
                                @foreach(explode(',', $project->technologies) as $tech)
                                    @if(trim($tech))
                                        <span style="background:#e8f4fd; color:#0d6efd; padding:3px 8px; border-radius:12px; font-size:0.75rem;">{{ trim($tech) }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td class="py-3">
                            @if($project->is_featured)
                                <i class="bi bi-star-fill text-warning" title="Featured"></i>
                            @else
                                <i class="bi bi-star text-muted"></i>
                            @endif
                        </td>
                        <td class="text-end pe-3 py-3">
                            <a href="{{ route('student.projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px; padding:0.25rem 0.5rem;"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('student.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" style="border-radius:8px; padding:0.25rem 0.5rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
