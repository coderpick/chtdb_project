@extends('layouts.frontend.master')

@section('title', 'Student Directory | আইসিটি দক্ষতা উন্নয়ন স্কিম')

@push('styles')
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
            margin-bottom: 30px;
        }

        .search-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 20px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.1);
        }

        .search-btn {
            background: var(--gradient-1);
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .reset-btn {
            background: #f1f5f9;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            color: #475569;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .table-responsive {
            padding: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 18px 24px;
            border-bottom: 2px solid #f1f5f9;
        }

        .table tbody td {
            padding: 18px 24px;
            vertical-align: middle;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }

        .avatar-circle {
            width: 45px;
            height: 45px;
            background: var(--gradient-1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.1rem;
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

        .breadcrumb-item.active {
            color: white;
        }

        .pagination {
            margin: 0;
        }

        .page-item .page-link {
            border-radius: 10px;
            margin: 0 5px;
            border: none;
            color: #475569;
            font-weight: 600;
            padding: 10px 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .page-item.active .page-link {
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 4rem;
            color: #e2e8f0;
            margin-bottom: 20px;
            display: block;
        }
    </style>
@endpush

@section('content')
    <section class="page-header-section">
        <div class="container">
            <h1 class="display-5 fw-bold animate__animated animate__fadeInDown mb-0">
                প্রশিক্ষণপ্রাপ্ত ছাত্র-ছাত্রীর তালিকা
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center animate__animated animate__fadeInUp">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">হোম</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">ছাত্র-ছাত্রীর তালিকা</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="student-directory-section">
        <div class="container">
            <!-- Search Filters -->
            <div class="search-card animate__animated animate__fadeIn">
                <form id="searchForm" action="{{ route('student.directory') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-muted small">Name</label>
                            <input type="text" id="nameInput" name="name" class="form-control"
                                placeholder="Search by name..." value="{{ request('name') }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small">District</label>
                            <select id="districtSelect" name="district" class="form-select">
                                <option value="">All Districts</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ request('district') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold text-muted small">Per Page</label>
                            <select id="perPageSelect" name="per_page" class="form-select">
                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" id="resetBtn"
                                class="reset-btn d-flex justify-content-center align-items-center gap-2 w-100 border-0">
                                <i class="bi bi-arrow-clockwise"></i>Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card animate__animated animate__fadeIn" id="studentTableContainer">
                        @include('student_directory._table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            const $form = $('#searchForm');
            const $container = $('#studentTableContainer');
            let timeout = null;

            function fetchData(url = null) {
                const fetchUrl = url || $form.attr('action');
                const data = $form.serialize();

                // Add loading state
                $container.css('opacity', '0.5');

                $.ajax({
                    url: fetchUrl,
                    data: data,
                    type: 'GET',
                    success: function(response) {
                        $container.html(response);
                        $container.css('opacity', '1');

                        // Update URL without reloading
                        const newUrl = fetchUrl + '?' + data;
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                    },
                    error: function() {
                        $container.css('opacity', '1');
                    }
                });
            }

            // Reset button click
            $('#resetBtn').on('click', function() {
                $('#nameInput').val('');
                $('#districtSelect').val('');
                $('#perPageSelect').val('15');
                fetchData();
            });

            // Input event for name (with debounce)
            $('#nameInput').on('keyup', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    fetchData();
                }, 500);
            });

            // Change event for selects
            $('#districtSelect, #perPageSelect').on('change', function() {
                fetchData();
            });

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                fetchData(url);
                // Scroll to top of table
                $('html, body').animate({
                    scrollTop: $form.offset().top - 100
                }, 200);
            });
        });
    </script>
@endpush
