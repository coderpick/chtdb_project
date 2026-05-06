<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th width="80">#</th>
                <th>Student Details</th>
                <th>District</th>
                <th>Batch</th>
                <th class="text-end">Freelancer Profile</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $students->firstItem() + $loop->index }}</td>
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
                            style="border-radius: 8px; border: 1px solid #eef2f7;">
                            <i class="bi bi-geo-alt me-1 text-primary"></i>
                            {{ $student->district->name ?? 'N/A' }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-semibold text-primary">
                            {{ $student->batch->name ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="text-end">
                        @if ($student->getFreelancerUrl())
                            <a href="{{ $student->getFreelancerUrl() }}" target="_blank"
                                class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Profile
                            </a>
                        @else
                            <span class="text-muted small">Not Available</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-person-exclamation"></i>
                            <h5 class="text-muted">No students found matching your criteria.</h5>
                            <p class="text-muted small">Try adjusting your search filters.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card-footer bg-white border-top-0 py-3 px-4">
    {{ $students->links() }}
</div>
