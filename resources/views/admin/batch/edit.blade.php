@extends('admin.layouts.admin')

@section('title', 'Edit Batch')
@section('page-title', 'Edit Batch')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.batch.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="training_center_id" class="form-label">Training Center</label>
                            <select name="training_center_id" id="training_center_id" class="form-select" required>
                                <option value="">Select Training Center</option>
                                @foreach ($centers as $center)
                                    <option value="{{ $center->id }}"
                                        {{ old('training_center_id', $batch->training_center_id) == $center->id ? 'selected' : '' }}>
                                        {{ $center->name }}</option>
                                @endforeach
                            </select>
                            @error('training_center_id')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Batch Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $batch->name) }}" required>
                            @error('name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control"
                                value="{{ old('capacity', $batch->capacity) }}">
                            @error('capacity')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="enrolled_count" class="form-label">Enrollment</label>
                            <input type="number" name="enrolled_count" id="enrolled_count" class="form-control"
                                value="{{ old('enrolled_count', $batch->enrolled_count) }}">
                            @error('enrolled_count')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shift" class="form-label">Shift</label>
                            <select name="shift" id="shift" class="form-select" required>
                                <option value="Morning" {{ old('shift', $batch->shift) == 'Morning' ? 'selected' : '' }}>
                                    Morning</option>
                                <option value="Afternoon"
                                    {{ old('shift', $batch->shift) == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                            </select>
                            @error('shift')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker"
                                value="{{ old('start_date', $batch->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker"
                                value="{{ old('end_date', optional($batch->end_date)->format('Y-m-d')) }}">
                            @error('end_date')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="upcoming"
                                    {{ old('status', $batch->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="ongoing" {{ old('status', $batch->status) == 'ongoing' ? 'selected' : '' }}>
                                    Ongoing</option>
                                <option value="completed"
                                    {{ old('status', $batch->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Batch</button>
                <a href="{{ route('admin.batch.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr('#start_date', {
            dateFormat: "Y-m-d",
        });

        flatpickr('#end_date', {
            dateFormat: "Y-m-d",
        });
    </script>
@endpush
