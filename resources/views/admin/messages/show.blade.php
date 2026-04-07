@extends('admin.layouts.admin')

@section('title', 'Message Details')
@section('page-title', 'Message Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-chat-left-dots text-primary me-2"></i> Message Body</h5>
                <span class="badge bg-{{ $message->status === 'new' ? 'danger' : 'info' }} rounded-pill px-3">{{ ucfirst($message->status) }}</span>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-1">Posted on {{ $message->created_at->format('M d, Y at h:i A') }}</p>
                <div class="p-3 bg-light rounded" style="white-space: pre-wrap; font-size: 1.1rem; border-left: 4px solid var(--primary);">
                    {{ $message->message }}
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex gap-2">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-whatsapp"></i> Reply on WhatsApp
                    </a>
                    @if($message->email)
                        <a href="mailto:{{ $message->email }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-envelope"></i> Send Email
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-person-badge text-primary me-2"></i> Sender Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Full Name</label>
                    <div class="fw-bold">{{ $message->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Phone</label>
                    <div class="fw-bold text-primary">{{ $message->phone }}</div>
                </div>
                @if($message->email)
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Email Address</label>
                    <div class="fw-bold">{{ $message->email }}</div>
                </div>
                @endif
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">District</label>
                    <div class="fw-bold">
                        <span class="badge bg-light text-dark border">{{ $message->district->bn_name ?? 'Unknown' }}</span>
                    </div>
                </div>
                <div class="mb-0">
                    <label class="text-muted small fw-bold text-uppercase">Interested In</label>
                    <div class="fw-bold text-info">{{ $message->course ?? 'General Inquiry' }}</div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm bg-light" style="border-radius: 15px;">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Quick Actions</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm text-start">
                        <i class="bi bi-arrow-left me-2"></i> Back to Messages
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm text-start w-100">
                            <i class="bi bi-trash me-2"></i> Delete This Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
