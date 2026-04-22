@extends('layouts.frontend.master')

@section('title', 'Student Directory | আইসিটি দক্ষতা উন্নয়ন স্কিম')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .page-header-section {
            background: var(--gradient-1);
            padding: 50px 0;
            color: white;
            text-align: center;
        }

        .student-directory-section {
            padding: 50px 0;
            background-color: #f8fafc;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .table-responsive {
            padding: 20px;
        }

        .table thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            padding: 15px 20px;
            border: none;
        }

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            background: var(--gradient-1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-weight: 700;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-top: 15px;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item active {
            color: white;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.5);
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_filter {
            float: left;
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 8px 15px;
            width: 350px !important;
            margin-left: 0 !important;
        }

        .dataTables_wrapper .dataTables_length {
            float: right;
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 5px 35px 5px 12px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23475569' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
            cursor: pointer;
            outline: none;
        }

        .page-item.active .page-link {
            background: var(--gradient-1);
            border-color: transparent;
        }

        .page-link {
            color: #475569;
            border-radius: 8px;
            margin: 0 3px;
        }
    </style>
@endpush

@section('content')
    <section class="page-header-section">
        <div class="container">
            <h1 class="display-5 fw-bold animate__animated animate__fadeInDown mb-0">Student Directory</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center animate__animated animate__fadeInUp">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Student Directory</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="student-directory-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card animate__animated animate__fadeIn">
                        <div class="table-responsive">
                            <table id="studentTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Details</th>
                                        <th>District</th>
                                        <th>Batch</th>
                                        <th>Freelancer Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3">
                                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $student->getName() }}</div>
                                                        <div class="text-muted small">{{ $student->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark px-3 py-2"
                                                    style="border-radius: 8px;">
                                                    <i class="bi bi-geo-alt me-1 text-primary"></i>
                                                    {{ $student->district->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-primary">
                                                    {{ $student->batch->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($student->getFreelancerUrl())
                                                    <a href="{{ $student->getFreelancerUrl() }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                                        <i class="bi bi-link-45deg"></i> View Profile
                                                    </a>
                                                @else
                                                    <span class="text-muted small">Not Available</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "pageLength": 15,
                "ordering": true,
                "info": true,
                "responsive": true,
                "dom": '<"row mb-3" <"col-md-6"f> <"col-md-6 text-end"l> >rtip',
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 3, 4]
                }],
                "language": {
                    "search": "",
                    "searchPlaceholder": "Search students...",
                    "lengthMenu": "Show _MENU_",
                    "paginate": {
                        "next": '<i class="bi bi-chevron-right"></i>',
                        "previous": '<i class="bi bi-chevron-left"></i>'
                    }
                }
            });
        });
    </script>
@endpush
