@extends('layouts.student')

@section('title', 'Training Information')
@section('page-title', 'প্রশিক্ষণ তথ্য')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .training-status-badge {
                padding: 5px 12px;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
            }

            .status-ongoing {
                background: #fff4e5;
                color: #b95000;
            }

            .status-completed {
                background: #e6fcf5;
                color: #087f5b;
            }

            .status-certified {
                background: #e7f5ff;
                color: #1971c2;
            }

            .info-item {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 8px;
            }

            .info-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f0f4f9;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary);
            }
        </style>
    @endpush

    <div class="row g-4">
        <!-- Training Summary Card (Shown if data exists) -->
        @if ($training)
            <div class="col-12">
                <div class="dash-content-card border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1"><i class="bi bi-mortarboard-fill text-primary me-2"></i>প্রশিক্ষণ সারসংক্ষেপ
                            </h5>
                            <p class="text-muted small">আপনার বর্তমান নিবন্ধিত প্রশিক্ষণ তথ্য</p>
                        </div>
                        <span class="training-status-badge status-{{ $training->status }}">
                            @if ($training->status == 'ongoing')
                                চলমান
                            @elseif($training->status == 'completed')
                                সম্পন্ন
                            @else
                                সার্টিফাইড
                            @endif
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-book"></i></div>
                                <div>
                                    <div class="text-muted small">কোর্স</div>
                                    <div class="fw-bold">{{ $training->course->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-people"></i></div>
                                <div>
                                    <div class="text-muted small">ব্যাচ</div>
                                    <div class="fw-bold">{{ $training->batch->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                                <div>
                                    <div class="text-muted small">প্রশিক্ষণ কেন্দ্র</div>
                                    <div class="fw-bold">{{ $training->trainingCenter->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Form Card -->
        <div class="col-12">
            <div class="dash-content-card border-0">
                <h5><i class="bi bi-pencil-square text-success me-2"></i>প্রশিক্ষণ তথ্য আপডেট করুন</h5>
                <p class="card-subtitle">আপনার প্রশিক্ষণের সর্বশেষ তথ্য প্রদান করুন</p>

                <form action="{{ route('student.training.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="dash-form-label">প্রশিক্ষণ কোর্স *</label>
                            <select name="course_id" class="dash-form-control @error('course_id') is-invalid @enderror"
                                required id="courseSelect">
                                <option value="">কোর্স নির্বাচন করুন</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id', $training->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="dash-form-label" for="centerSelect">প্রশিক্ষণ কেন্দ্র *</label>
                            <select name="center_id" class="dash-form-control @error('center_id') is-invalid @enderror"
                                id="centerSelect" required>
                                <option value="">কেন্দ্র নির্বাচন করুন</option>
                                @foreach ($centers as $center)
                                    <option value="{{ $center->id }}"
                                        {{ old('center_id', $training->district_id ?? '') == $center->district_id ? 'selected' : '' }}>
                                        {{ $center->name }} ({{ $center->district->name ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('center_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="dash-form-label">ব্যাচ</label>
                            <select name="batch_id" class="dash-form-control @error('batch_id') is-invalid @enderror"
                                id="batchSelect">
                                <option value="">ব্যাচ নির্বাচন করুন</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ old('batch_id', $training->batch_id ?? '') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- district --}}
                        <div class="col-md-6">
                            <label class="dash-form-label">জেলা *</label>
                            <select name="district_id" class="dash-form-control @error('district_id') is-invalid @enderror"
                                id="districtSelect" required>
                                <option value="">জেলা নির্বাচন করুন</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ old('district_id', $training->district_id ?? '') == $district->id ? 'selected' : '' }}>
                                        {{ $district->bn_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('district_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- upazila --}}
                        <div class="col-md-6">
                            <label class="dash-form-label">উপজেলা *</label>
                            <select name="upazila_id" class="dash-form-control @error('upazila_id') is-invalid @enderror"
                                id="upazilaSelect" required>
                                @forelse ($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}"
                                        {{ old('upazila_id', $training->upazila_id ?? '') == $upazila->id ? 'selected' : '' }}>
                                        {{ $upazila->bn_name }}
                                    </option>
                                @empty
                                    <option value="">উপজেলা নির্বাচন করুন</option>
                                @endforelse
                            </select>
                            @error('upazila_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="dash-form-label">প্রশিক্ষণের অবস্থা *</label>
                            <select name="status" class="dash-form-control @error('status') is-invalid @enderror" required>
                                <option value="ongoing"
                                    {{ old('status', $training->status ?? '') == 'ongoing' ? 'selected' : '' }}>চলমান
                                </option>
                                <option value="completed"
                                    {{ old('status', $training->status ?? '') == 'completed' ? 'selected' : '' }}>সম্পন্ন
                                </option>
                                <option value="certified"
                                    {{ old('status', $training->status ?? '') == 'certified' ? 'selected' : '' }}>
                                    সার্টিফাইড</option>
                            </select>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="dash-form-label">গ্রেড / ফলাফল</label>
                            <input type="text" name="grade"
                                class="dash-form-control @error('grade') is-invalid @enderror"
                                value="{{ old('grade', $training->grade ?? '') }}" placeholder="যেমন: A+, ৮০%">
                            @error('grade')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="dash-form-label">শুরুর তারিখ</label>
                            <input type="text" name="start_date" id="start-date-picker"
                                class="dash-form-control @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date', isset($training->start_date) ? $training->start_date?->format('Y-m-d') : '') }}"
                                placeholder="YYYY-MM-DD">
                            @error('start_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="dash-form-label">সমাপ্তির তারিখ</label>
                            <input type="text" name="end_date" id="end-date-picker"
                                class="dash-form-control @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date', isset($training->end_date) ? $training->end_date?->format('Y-m-d') : '') }}"
                                placeholder="YYYY-MM-DD">
                            @error('end_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn-dash-save"><i class="bi bi-check-lg me-2"></i>প্রশিক্ষণ তথ্য
                            সেভ
                            করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Flatpickr
                flatpickr("#start-date-picker", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d M Y",
                });
                flatpickr("#end-date-picker", {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d M Y",
                });
            });
            $(document).ready(function() {
                // Batch load by training center id by ajax request
                $('#centerSelect').on('change', function() {
                    const centerId = $(this).val();
                    if (centerId) {
                        $.ajax({
                            url: `/training-center/${centerId}/batches`,
                            type: 'GET',
                            success: function(response) {
                                $('#batchSelect').html(
                                    '<option value="">ব্যাচ নির্বাচন করুন</option>');
                                $.each(response, function(index, batch) {
                                    $('#batchSelect').append('<option value="' + batch.id +
                                        '">' + batch.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#batchSelect').html('<option value="">ব্যাচ নির্বাচন করুন</option>');
                    }
                });
                /* get upzilla */
                $('#districtSelect').on('change', function() {
                    const districtId = $(this).val();
                    console.log(districtId);

                    if (districtId) {
                        $.ajax({
                            url: `/district/${districtId}/upazilas`,
                            type: 'GET',
                            success: function(response) {
                                $('#upazilaSelect').html(
                                    '<option value="">উপজেলা নির্বাচন করুন</option>');
                                $.each(response, function(index, upazila) {
                                    $('#upazilaSelect').append('<option value="' + upazila
                                        .id +
                                        '">' + upazila.bn_name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#upazilaSelect').html('<option value="">উপজেলা নির্বাচন করুন</option>');
                    }
                });
            });
        </script>
    @endpush
@endsection
