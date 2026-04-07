@extends('admin.layouts.admin')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Recent Inquiries</h5>
            <span class="badge bg-primary rounded-pill">{{ $messages->total() }} Total</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Sender</th>
                        <th>Contact Info</th>
                        <th>District & Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr class="{{ $message->status === 'new' ? 'fw-bold border-start border-4 border-primary' : '' }}">
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div>
                                    <div class="mb-0">{{ $message->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <div class="text-muted"><i class="bi bi-telephone me-1"></i> {{ $message->phone }}</div>
                                @if($message->email)
                                    <div class="text-muted"><i class="bi bi-envelope me-1"></i> {{ $message->email }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <span class="badge bg-light text-dark border">{{ $message->district->bn_name ?? 'Unknown' }}</span>
                                <div class="text-muted mt-1">{{ $message->course ?? 'General Inquiry' }}</div>
                            </div>
                        </td>
                        <td>
                            @if($message->status === 'new')
                                <span class="badge bg-danger rounded-pill">New</span>
                            @elseif($message->status === 'read')
                                <span class="badge bg-info rounded-pill">Read</span>
                            @else
                                <span class="badge bg-success rounded-pill">{{ ucfirst($message->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="small text-muted">
                                {{ $message->created_at->diffForHumans() }}
                                <div style="font-size: 0.75rem;">{{ $message->created_at->format('M d, Y') }}</div>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('{{ $message->id }}')" title="Delete Message">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No messages found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($messages->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $messages->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
@endsection
