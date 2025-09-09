@extends('layouts.admin')

@section('title', 'Detail Hunian Kamar - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.occupancy.index') }}">Monitoring Hunian</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $room->nama_kamar }}</li>
                        </ol>
                    </nav>
                    <h2 class="h3 mb-0">Detail Hunian - {{ $room->nama_kamar }}</h2>
                </div>
                <div>
                    <a href="{{ route('admin.occupancy.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Room Information -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Kamar</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-muted">Nama Kamar</label>
                                <div class="h5 mb-0">{{ $room->nama_kamar }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Tipe Kamar</label>
                                <div>{{ $room->typeKamar->nama ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Harga per Bulan</label>
                                <div class="h6 text-success mb-0">Rp {{ number_format($room->typeKamar->harga ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Status Saat Ini</label>
                                <div>
                                    @if($room->status_kamar === 'Tersedia')
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-door-open me-1"></i>Tersedia
                                        </span>
                                    @elseif($room->status_kamar === 'Booked')
                                        <span class="badge bg-warning fs-6">
                                            <i class="fas fa-clock me-1"></i>Booked
                                        </span>
                                    @elseif($room->status_kamar === 'Dihuni')
                                        <span class="badge bg-info fs-6">
                                            <i class="fas fa-home me-1"></i>Dihuni
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($room->typeKamar)
                            <div class="mb-0">
                                <label class="form-label text-muted">Spesifikasi</label>
                                <div class="small">
                                    @if($room->typeKamar->ukuran_kamar)
                                        <div><i class="fas fa-expand-arrows-alt text-muted me-2"></i>{{ $room->typeKamar->ukuran_kamar }}</div>
                                    @endif
                                    @if($room->typeKamar->type_kasur)
                                        <div><i class="fas fa-bed text-muted me-2"></i>{{ $room->typeKamar->type_kasur }}</div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Current Occupant -->
                <div class="col-lg-8 mb-4">
                    @if($currentBooking)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Penghuni Saat Ini</h5>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-warning" onclick="showExtendModal({{ $currentBooking->id }})">
                                    <i class="fas fa-calendar-plus me-1"></i>Perpanjang
                                </button>
                                <button class="btn btn-outline-danger" onclick="showTerminateModal({{ $currentBooking->id }})">
                                    <i class="fas fa-stop-circle me-1"></i>Hentikan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-center me-3" style="width: 50px; height: 50px;">
                                            {{ strtoupper(substr($currentBooking->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $currentBooking->user->name }}</h5>
                                            <div class="text-muted">{{ $currentBooking->user->email }}</div>
                                            @if($currentBooking->user->userProfile)
                                            <div class="small text-muted">
                                                <i class="fas fa-phone me-1"></i>{{ $currentBooking->user->userProfile->phone ?? 'Tidak ada nomor' }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-light rounded">
                                                <div class="text-muted small">Booking Code</div>
                                                <div class="fw-bold">{{ $currentBooking->booking_code }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-light rounded">
                                                <div class="text-muted small">Durasi Sewa</div>
                                                <div class="fw-bold">{{ $currentBooking->rental_duration_months }} Bulan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Tanggal Mulai Sewa</label>
                                    <div class="fw-semibold">
                                        {{ $currentBooking->rental_start_date ? $currentBooking->rental_start_date->format('d F Y') : '-' }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Tanggal Berakhir Sewa</label>
                                    <div class="fw-semibold">
                                        {{ $currentBooking->rental_end_date ? $currentBooking->rental_end_date->format('d F Y') : '-' }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Sisa Waktu</label>
                                    <div>
                                        @if($currentBooking->rental_end_date)
                                            @php
                                                $daysLeft = $currentBooking->rental_end_date->diffInDays(now(), false);
                                            @endphp
                                            @if($daysLeft <= 0)
                                                <span class="badge bg-danger">{{ abs($daysLeft) }} hari lagi</span>
                                            @elseif($daysLeft <= 7)
                                                <span class="badge bg-warning">{{ $daysLeft }} hari lagi</span>
                                            @else
                                                <span class="badge bg-success">{{ $daysLeft }} hari lagi</span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">Total Pembayaran</label>
                                    <div class="fw-bold text-success">
                                        Rp {{ number_format($currentBooking->total_amount, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            @if($currentBooking->notes)
                            <hr>
                            <div>
                                <label class="form-label text-muted">Catatan</label>
                                <div class="p-2 bg-light rounded">{{ $currentBooking->notes }}</div>
                            </div>
                            @endif

                            @if($currentBooking->extension_requested)
                            <hr>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Permintaan Perpanjangan</strong> - Penghuni telah mengajukan permintaan perpanjangan {{ $currentBooking->rental_duration_months }} bulan.
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-user-slash fa-3x mb-3 d-block"></i>
                                <h5>Kamar Belum Dihuni</h5>
                                <p>Kamar ini saat ini tidak memiliki penghuni aktif.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Booking History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Riwayat Booking</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Booking Code</th>
                                    <th>Penghuni</th>
                                    <th>Periode Sewa</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Tanggal Booking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingHistory as $booking)
                                <tr class="{{ $booking->id === $currentBooking?->id ? 'table-info' : '' }}">
                                    <td>
                                        <div class="fw-bold">{{ $booking->booking_code }}</div>
                                        @if($booking->id === $currentBooking?->id)
                                            <small class="badge bg-primary">Aktif</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-secondary text-white rounded-circle d-flex align-items-center justify-center me-2" style="width: 32px; height: 32px; font-size: 12px;">
                                                {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div>{{ $booking->user->name }}</div>
                                                <small class="text-muted">{{ $booking->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($booking->rental_start_date && $booking->rental_end_date)
                                            <div class="small">
                                                <div><strong>Mulai:</strong> {{ $booking->rental_start_date->format('d/m/Y') }}</div>
                                                <div><strong>Berakhir:</strong> {{ $booking->rental_end_date->format('d/m/Y') }}</div>
                                                <div><strong>Durasi:</strong> {{ $booking->rental_duration_months }} bulan</div>
                                            </div>
                                        @else
                                            <span class="text-muted">Belum dimulai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($booking->status === 'confirmed')
                                            <span class="badge bg-info">Confirmed</span>
                                        @elseif($booking->status === 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="badge bg-secondary">Cancelled</span>
                                        @elseif($booking->status === 'expired')
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($booking->status === 'terminated')
                                            <span class="badge bg-dark">Terminated</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">
                                            Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>{{ $booking->created_at->format('d/m/Y H:i') }}</div>
                                        <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-history fa-2x mb-3 d-block"></i>
                                            Belum ada riwayat booking
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extend Rental Modal -->
<div class="modal fade" id="extendModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perpanjang Masa Sewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="extendForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="extend_months" class="form-label">Perpanjang Berapa Bulan?</label>
                        <select class="form-select" id="extend_months" name="months" required>
                            <option value="">Pilih durasi...</option>
                            <option value="1">1 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="12">12 Bulan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="extend_reason" class="form-label">Alasan (Opsional)</label>
                        <textarea class="form-control" id="extend_reason" name="reason" rows="3" 
                                  placeholder="Alasan perpanjangan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-calendar-plus me-1"></i>Perpanjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Terminate Rental Modal -->
<div class="modal fade" id="terminateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hentikan Masa Sewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="terminateForm">
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Peringatan!</strong> Tindakan ini akan menghentikan masa sewa dan membuat kamar tersedia kembali.
                    </div>
                    <div class="mb-3">
                        <label for="terminate_reason" class="form-label">Alasan Penghentian <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="terminate_reason" name="reason" rows="4" 
                                  placeholder="Masukkan alasan penghentian sewa..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-stop-circle me-1"></i>Hentikan Sewa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentBookingId = null;

function showExtendModal(bookingId) {
    currentBookingId = bookingId;
    document.getElementById('extendForm').reset();
    new bootstrap.Modal(document.getElementById('extendModal')).show();
}

function showTerminateModal(bookingId) {
    currentBookingId = bookingId;
    document.getElementById('terminateForm').reset();
    new bootstrap.Modal(document.getElementById('terminateModal')).show();
}

document.getElementById('extendForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
    
    fetch(`/admin/occupancy/extend/${currentBookingId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('extendModal')).hide();
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses permintaan');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});

document.getElementById('terminateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!confirm('Apakah Anda yakin ingin menghentikan sewa ini?')) {
        return;
    }
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
    
    fetch(`/admin/occupancy/terminate/${currentBookingId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('terminateModal')).hide();
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses permintaan');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});
</script>
@endsection