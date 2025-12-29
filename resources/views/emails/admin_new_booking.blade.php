<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking</title>
</head>
<body>
    <h2>New booking received</h2>
    <p>A new booking was made on Golden Wave:</p>

    <ul>
        <li><strong>Booking ID:</strong> {{ $booking->id }}</li>
        <li><strong>Room:</strong> {{ $booking->room->name ?? 'N/A' }}</li>
        <li><strong>Guest:</strong> {{ $booking->guest_name }} ({{ $booking->guest_email }})</li>
        <li><strong>Phone:</strong> {{ $booking->guest_phone ?? '-' }}</li>
        <li><strong>Check-in:</strong> {{ $booking->check_in_date }}</li>
        <li><strong>Check-out:</strong> {{ $booking->check_out_date }}</li>
        <li><strong>Guests:</strong> {{ $booking->number_of_guests }}</li>
        <li><strong>Total Price:</strong> {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</li>
        <li><strong>Status:</strong> {{ $booking->status }}</li>
    </ul>

    <p>Visit admin panel to review and confirm the booking.</p>
</body>
</html>
