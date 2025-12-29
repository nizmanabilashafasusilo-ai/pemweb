@extends('admin.layouts.master')

@section('page-title','Activity Log')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>When</th>
                                <th>Action</th>
                                <th>User</th>
                                <th>Details</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $l)
                                @php
                                    $raw = $l->details;
                                    $decoded = null;
                                    if (is_string($raw)) {
                                        $try = json_decode($raw, true);
                                        $decoded = json_last_error() === JSON_ERROR_NONE ? $try : $raw;
                                    } else {
                                        $decoded = $raw;
                                    }

                                    $readable = '';
                                    switch ($l->action) {
                                        case 'booking_created':
                                            if (is_array($decoded)) {
                                                $id = $decoded['booking_id'] ?? ($decoded['id'] ?? '—');
                                                $room = $decoded['room_id'] ?? ($decoded['room'] ?? '—');
                                                $email = $decoded['guest_email'] ?? ($decoded['email'] ?? '—');
                                                $price = isset($decoded['total_price']) ? number_format($decoded['total_price'],0,',','.') : null;
                                                $readable = "Booking #{$id} for room {$room} by {$email}" . ($price ? " — Rp {$price}" : '');
                                            } else {
                                                $readable = (string) $decoded;
                                            }
                                            break;
                                        case 'booking_confirmed_via_sandbox':
                                            if (is_array($decoded)) {
                                                $id = $decoded['booking_id'] ?? '—';
                                                $amount = isset($decoded['amount']) ? number_format($decoded['amount'],0,',','.') : null;
                                                $readable = "Confirmed booking #{$id}" . ($amount ? " — Rp {$amount}" : '');
                                            } else {
                                                $readable = (string) $decoded;
                                            }
                                            break;
                                        case 'approve_cancellation':
                                        case 'cancellation_approved':
                                            $readable = is_string($decoded) ? $decoded : (is_array($decoded) ? implode(' ', array_values($decoded)) : (string) $decoded);
                                            break;
                                        case 'update_user':
                                            if (is_array($decoded)) {
                                                $name = $decoded['name'] ?? ($decoded['email'] ?? '—');
                                                $readable = "Updated user {$name}";
                                            } else {
                                                $readable = (string) $decoded;
                                            }
                                            break;
                                        case 'update_article':
                                            $readable = is_string($decoded) && $decoded !== '' ? (string) $decoded : 'Article updated';
                                            break;
                                        default:
                                            if (is_array($decoded)) {
                                                $parts = [];
                                                foreach ($decoded as $k => $v) {
                                                    if (is_scalar($v)) $parts[] = "{$k}: {$v}";
                                                }
                                                $readable = $parts ? implode(' | ', $parts) : json_encode($decoded, JSON_UNESCAPED_UNICODE);
                                            } else {
                                                $readable = (string) $decoded;
                                            }
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $l->id }}</td>
                                    <td>{{ $l->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $l->action }}</td>
                                    <td>{{ optional($l->user)->name ?? 'System' }}</td>
                                    <td class="text-break" style="max-width:360px;"><code class="small">{{ \Illuminate\Support\Str::limit($readable, 180) }}</code></td>
                                    <td>{{ $l->ip }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">{{ $logs->links() }}</div>
    </div>
@endsection
