<?php
/**
 * Simple Mailer Function
 * Uses PHP's mail() function for compatibility.
 * Note: For production with authenticated SMTP, it is highly recommended to use PHPMailer.
 */

function send_registration_confirmation($to_email, $user_name, $event_title) {
    $from_email = getenv('SMTP_FROM') ?: 'info@askmetour.org';
    $from_name = getenv('SMTP_NAME') ?: 'AskMe Tour & Travel';
    
    $subject = "Registration Confirmation: " . $event_title;
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: 'Outfit', 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; padding: 40px 0; }
            .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 40px; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
            .header { text-align: center; margin-bottom: 32px; }
            .logo { font-size: 24px; font-weight: 900; color: #1D609E; text-transform: uppercase; letter-spacing: -1px; }
            .logo span { color: #89C23D; }
            h2 { color: #1D609E; font-weight: 800; font-size: 24px; margin-bottom: 16px; }
            p { margin-bottom: 16px; }
            .event-box { background-color: #f1f5f9; padding: 20px; border-radius: 16px; border-left: 4px solid #89C23D; margin: 24px 0; }
            .footer { margin-top: 32px; padding-top: 24px; border-top: 1px solid #f1f5f9; font-size: 12px; color: #94a3b8; text-align: center; }
            .accent { color: #89C23D; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='logo'>AskMe <span>Tour & Travel</span></div>
            </div>
            <h2>Hello $user_name!</h2>
            <p>Your registration for the upcoming event has been successfully received.</p>
            
            <div class='event-box'>
                <p style='margin:0; font-size: 12px; text-transform: uppercase; font-weight: 900; letter-spacing: 1px; color: #64748b;'>Registered Event</p>
                <p style='margin:4px 0 0 0; font-size: 18px; font-weight: 800; color: #1D609E;'>$event_title</p>
            </div>
            
            <p>Our team is currently reviewing your documents and application details. We will contact you via email or phone within 24-48 hours with further instructions.</p>
            
            <p>If you have any immediate questions, please don't hesitate to reach out to us.</p>
            
            <div class='footer'>
                <p>Sent by <strong>AskMe Tour & Travel</strong><br>
                Bole, Addis Ababa, Ethiopia<br>
                <a href='mailto:info@askmetour.org' style='color: #89C23D; text-decoration: none;'>info@askmetour.org</a> | <a href='https://askmetour.org' style='color: #89C23D; text-decoration: none;'>www.askmetour.org</a></p>
                <p>&copy; " . date('Y') . " AskMe Tour & Travel. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $from_name <$from_email>" . "\r\n";
    $headers .= "Reply-To: $from_email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    return @mail($to_email, $subject, $message, $headers);
}
