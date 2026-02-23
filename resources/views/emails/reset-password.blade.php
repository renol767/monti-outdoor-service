<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password - Monti Outdoor Service</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #e97543; margin: 0; font-size: 24px; }
        .content { color: #333333; line-height: 1.6; }
        .button-container { text-align: center; margin: 30px 0; }
        .button { background-color: #e97543; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; }
        .footer { text-align: center; color: #888888; font-size: 12px; margin-top: 20px; border-top: 1px solid #eeeeee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Monti Outdoor Service</h1>
        </div>
        <div class="content">
            <p>Hello, {{ $user->name ?? 'Adventurer' }}!</p>
            <p>You are receiving this email because we received a password reset request for your <strong>Monti Outdoor Service</strong> account.</p>
            <p>Please click the button below to reset your password:</p>
            
            <div class="button-container">
                <a href="{{ $url }}" class="button" style="color: #ffffff;">Reset Password</a>
            </div>
            
            <p>This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Best regards,<br>The Monti Outdoor Service Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Monti Outdoor Service. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
