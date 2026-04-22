@extends('admin.layouts.admin')

@section('title', 'Students')
@section('page-title', 'Manage Students')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-file-earmark-excel text-primary fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Import Student Records</h4>
                    <p class="text-muted small">Upload your spreadsheet to bulk import students</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.student-records.import.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="file" class="form-label fw-medium text-secondary">Select Excel/CSV File</label>
                            <div class="input-group">
                                <input type="file" name="file" id="file" class="form-control rounded-start-3" 
                                    accept=".xlsx,.xls,.csv" required>
                                <span class="input-group-text bg-light text-muted rounded-end-3">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </span>
                            </div>
                            <div class="form-text mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                File must contain headers matching the database fields. Supported: .xlsx, .xls, .csv
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3 shadow-sm">
                                <i class="bi bi-upload me-2"></i>Upload & Import
                            </button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-link text-decoration-none text-muted small mt-2">
                                <i class="bi bi-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 p-3 bg-light rounded-3 border-0">
                <h6 class="fw-bold text-dark mb-2"><i class="bi bi-lightbulb me-2 text-warning"></i>Pro Tips:</h6>
                <ul class="text-muted small mb-0 ps-3">
                    <li>Download the <a href="#" class="text-primary fw-medium text-decoration-none">sample template</a> for correct formatting.</li>
                    <li>Ensure all mandatory fields (Name, Roll, Class) are filled.</li>
                    <li>Check for duplicate entries before uploading.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
