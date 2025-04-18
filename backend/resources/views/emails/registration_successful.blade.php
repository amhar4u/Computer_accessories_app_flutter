<!DOCTYPE html>
<html>
<head>
    <title>Welcome to LaptopZone</title>
</head>
<body>
    <div style="text-align: center;">
        <img src="{{ asset('assets/logo.png') }}" alt="LaptopZone Logo" style="width: 150px; height: auto; margin-bottom: 20px;">
    </div>
    <h1>Welcome, {{ $user->name }}!</h1>
    <p>Thank you for registering at LaptopZone. We're excited to have you on board!</p>
    <p>Feel free to explore our platform and find the best laptops and accessories for your needs.</p>
    <p>Best regards,<br>The LaptopZone Team</p>
</body>
</html>