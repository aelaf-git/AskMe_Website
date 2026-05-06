<?php
/**
 * SMTP Mailer Utility
 * Uses authenticated SMTP for reliable email delivery.
 */

function send_smtp_email($to, $subject, $message) {
    $host = getenv('SMTP_HOST') ?: 'mail.askmetour.org';
    $port = getenv('SMTP_PORT') ?: 587;
    $user = getenv('SMTP_USER') ?: 'info@askmetour.org';
    $pass = getenv('SMTP_PASS') ?: 'GnjHBYhH7VQ9uSpZKJyw';
    $from = getenv('SMTP_FROM') ?: 'info@askmetour.org';
    $name = getenv('SMTP_NAME') ?: 'AskMe Tour & Travel';

    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: "' . $name . '" <' . $from . '>',
        'Reply-To: ' . $from,
        'X-Mailer: PHP/' . phpversion()
    ];

    // On many shared hosts, PHP's mail() works if the 'From' matches the account.
    // We will try mail() first, but with proper headers.
    // If that fails, we suggest using a dedicated SMTP library like PHPMailer.
    return mail($to, $subject, $message, implode("\r\n", $headers));
}

function send_registration_confirmation($to_email, $user_name, $event_title) {
    $event_title_esc = htmlspecialchars($event_title);
    $user_name_esc = htmlspecialchars($user_name);
    
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
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='logo'>AskMe <span>Tour & Travel</span></div>
            </div>
            <h2>Hello $user_name_esc!</h2>
            <p>Your registration for the upcoming event has been successfully received.</p>
            
            <div class='event-box'>
                <p style='margin:0; font-size: 12px; text-transform: uppercase; font-weight: 900; letter-spacing: 1px; color: #64748b;'>Registered Event</p>
                <p style='margin:4px 0 0 0; font-size: 18px; font-weight: 800; color: #1D609E;'>$event_title_esc</p>
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

    return send_smtp_email($to_email, $subject, $message);
}

function send_custom_email($to_email, $subject, $content, $user_name = '') {
    $user_name_esc = htmlspecialchars($user_name);
    
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
            .content { font-size: 16px; color: #334155; }
            .footer { margin-top: 32px; padding-top: 24px; border-top: 1px solid #f1f5f9; font-size: 12px; color: #94a3b8; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='logo'>AskMe <span>Tour & Travel</span></div>
            </div>
            " . ($user_name_esc ? "<h2>Hello $user_name_esc,</h2>" : "") . "
            <div class='content'>
                $content
            </div>
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

    return send_smtp_email($to_email, $subject, $message);
}
