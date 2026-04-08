@extends('admin.layouts.admin')

@section('title', 'Training Centers')
@section('page-title', 'Manage Training Centers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="mb-0">Training Centers Overview</h6>
        <a href="{{ route('admin.centers.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-2"></i>Add New Center
        </a>
    </div>

    <div class="row g-4">
        @forelse($centers as $center)
            @php
                $districtName = strtolower($center->district->name ?? 'rangamati');
                $fallbackImg = 'img/' . $districtName . ($districtName == 'rangamati' ? '.jpeg' : '.jpg');
                $bannerUrl = $center->banner ? asset($center->banner) : asset($fallbackImg);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="center-card">
                    <div class="center-card-header"
                        style="background: linear-gradient(135deg, rgba(0,0,0,0.5), rgba(0,0,0,0.6)), url('{{ $bannerUrl }}') center/cover no-repeat;">
                        <span class="badge {{ $center->is_active ? 'bg-success' : 'bg-secondary' }} status-badge">
                            {{ $center->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <i class="bi bi-geo-alt-fill"></i>
                        <h5>{{ $center->name }}</h5>
                    </div>
                    <div class="center-card-body">
                        <div class="info-item mb-2">
                            <i class="bi bi-building text-success me-2"></i>
                            <span>{{ $center->address }}</span>
                        </div>
                        <div class="info-item mb-2">
                            <i class="bi bi-telephone text-success me-2"></i>
                            <span>{{ $center->phone }}</span>
                        </div>
                        <div class="info-item mb-3">
                            <i class="bi bi-people text-primary me-2"></i>
                            <span>{{ $center->total_trainee }}+ Students</span>
                        </div>

                        <div class="d-flex gap-2 mt-auto pt-3 border-top">
                            <a href="{{ route('admin.centers.edit', $center) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            {{-- <form action="{{ route('admin.centers.destroy', $center) }}" method="POST"
                                class="flex-grow-1" onsubmit="return confirm('Are you sure you want to delete this center?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i class="bi bi-geo-alt text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="text-muted">No centers found.</h4>
                        <p class="text-muted mb-4">Start by adding your first training center.</p>
                        <a href="{{ route('admin.centers.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-2"></i>Add New Center
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@push('styles')
    <style>
        .center-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.4s;
            border: 1px solid rgba(0, 0, 0, 0.04);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .center-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .center-card-header {
            padding: 40px 24px;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .center-card-header .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        .center-card-header i {
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .center-card-header h5 {
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            font-size: 1.1rem;
        }

        .center-card-body {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .center-card-body .info-item {
            display: flex;
            align-items: flex-start;
            font-size: 0.88rem;
            color: #555;
        }

        .center-card-body .info-item i {
            margin-top: 3px;
            width: 20px;
            flex-shrink: 0;
        }
    </style>
@endpush
