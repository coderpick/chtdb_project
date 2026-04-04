@extends('admin.layouts.admin')

@section('title', 'Student Profile')
@section('page-title', 'Student Profile')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <h6>Personal Information</h6>
                <table class="table table-sm table-borderless">
                    <tr><th width="150">Name</th><td>{{ $user->name }}</td></tr>
                    <tr><th>Email</th><td>{{ $user->email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $user->profile->phone ?? '—' }}</td></tr>
                    <tr><th>District</th><td>{{ $user->profile->district ?? '—' }}</td></tr>
                    <tr><th>Upazila</th><td>{{ $user->profile->upazila ?? '—' }}</td></tr>
                    <tr><th>Date of Birth</th><td>{{ $user->profile->dob ? \Carbon\Carbon::parse($user->profile->dob)->format('Y-m-d') : '—' }}</td></tr>
                    <tr><th>Gender</th><td>{{ $user->profile->gender ?? '—' }}</td></tr>
                    <tr><th>Bio</th><td>{{ $user->profile->bio ?? '—' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h6>Training Information</h6>
                @if($user->training)
                <table class="table table-sm table-borderless">
                    <tr><th width="150">Course</th><td>{{ $user->training->course->name ?? '—' }}</td></tr>
                    <tr><th>Batch</th><td>{{ $user->training->batch->name ?? '—' }}</td></tr>
                    <tr><th>Center</th><td>{{ $user->training->center->name ?? '—' }}</td></tr>
                    <tr><th>Status</th><td>{{ $user->training->status }}</td></tr>
                    <tr><th>Duration</th><td>{{ $user->training->start_date }} to {{ $user->training->end_date }}</td></tr>
                    <tr><th>Grade</th><td>{{ $user->training->grade }}</td></tr>
                    <tr><th>Certificate No</th><td>{{ $user->training->certificate_no }}</td></tr>
                </table>
                @else
                <p class="text-muted">No training assigned.</p>
                @endif
            </div>
        </div>

        @if($user->career)
        <div class="card mb-4">
            <div class="card-body">
                <h6>Career Information</h6>
                <table class="table table-sm table-borderless">
                    <tr><th width="150">Status</th><td>{{ $user->career->status }}</td></tr>
                    <tr><th>Income</th><td>{{ $user->career->income }}</td></tr>
                    <tr><th>Company</th><td>{{ $user->career->company }}</td></tr>
                    <tr><th>Designation</th><td>{{ $user->career->designation }}</td></tr>
                </table>
            </div>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h6>Skills</h6>
                <p>{{ $user->skills->pluck('name')->join(', ') ?: '—' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <h6>Portfolio Settings</h6>
                @if($user->portfolioSetting)
                <table class="table table-sm table-borderless">
                    <tr><th>Slug</th><td>{{ $user->portfolioSetting->slug }}</td></tr>
                    <tr><th>Theme</th><td>{{ $user->portfolioSetting->theme }}</td></tr>
                    <tr><th>Visible</th><td>{{ $user->portfolioSetting->is_visible ? 'Yes' : 'No' }}</td></tr>
                </table>
                @else
                <p class="text-muted">No portfolio settings.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
