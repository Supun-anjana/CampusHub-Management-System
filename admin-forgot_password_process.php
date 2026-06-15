<?php

include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "mail/PHPMailer.php";
require "mail/SMTP.php";
require "mail/Exception.php";

$email = $_POST["email"];

if (empty($email)) {
    echo ("Please enter your Email Address to continue.");
} else {

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='$email'");
    $num = $rs->num_rows;

    if ($num > 0) {

        $row = $rs->fetch_assoc();
        $vcode = uniqid();

        Database::iud("UPDATE `admin` SET `vcode`='$vcode' WHERE `email`='" . $row["email"] . "'");

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'supunanjana2005@gmail.com';
            $mail->Password = 'btunezfrhzaucmdd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('supunanjana2005@gmail.com', 'Synthwave');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset your Synthwave Admin Account password.';

            // Outer black background removed template
            $mail->Body = '<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<table role="presentation" style="width: 100%; border-collapse: collapse; margin: 0; padding: 0;">
    <tbody>
        <tr>
            <td align="center" style="padding: 20px 10px;">
                <table role="presentation" style="max-width: 550px; width: 100%; border-collapse: collapse; background-color: #1f2833; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); overflow: hidden; border: 1px solid #2f3b4c;">
                    
                    <tr>
                        <td style="background: linear-gradient(90deg, #4f46e5, #06b6d4); height: 6px;"></td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 35px 20px 20px 20px;">
                            <h1 style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 28px; color: #66fcf1; letter-spacing: 1px; margin: 0;">
                                SynthwaveLK
                            </h1>
                            <p style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 12px; color: #c5a5c5; text-transform: uppercase; letter-spacing: 2px; margin: 5px 0 0 0;">
                                Administration Control
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <hr style="border: 0; border-top: 1px solid #2f3b4c; margin: 0;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 40px 20px 40px;">
                            <h2 style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 18px; font-weight: 600; color: #ffffff; margin: 0 0 15px 0;">
                                Password Reset Request
                            </h2>
                            <p style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 14px; line-height: 24px; color: #c5a5c5; margin: 0 0 25px 0;">
                                Hi ' . $row["fname"] . ' ' . $row["lname"] . ', we received a request to reset your password. Use the verification code below to set up a new password for your administration account.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 0 40px 25px 40px;">
                            <table role="presentation" style="border-collapse: collapse; background: rgba(102, 252, 241, 0.05); border: 1px dashed #66fcf1; border-radius: 12px; width: 100%;">
                                <tr>
                                    <td align="center" style="padding: 20px;">
                                        <p style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; color: #c5a5c5; margin: 0 0 10px 0;">
                                            Your Verification Code
                                        </p>
                                        <span style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 32px; font-weight: 800; color: #66fcf1; letter-spacing: 6px; display: inline-block;">
                                            ' . $vcode . '
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 30px 40px;">
                            <p style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 13px; line-height: 20px; color: #c5a5c5; margin: 0; padding-top: 15px; border-top: 1px solid #2f3b4c;">
                                <span style="color: #ff4d4d; font-weight: bold;">⚠️ Note -</span> If you didn’t request a password reset, you can safely ignore this email. Your security has not been compromised.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #151a22; padding: 20px 40px;">
                            <p style="font-family: \'Poppins\', \'Segoe UI\', sans-serif; font-size: 12px; color: #c5a5c5; margin: 0;">
                                &copy; 2026 <a href="#" style="color: white; text-decoration: none;">synthwavelk.com</a> | All Rights Reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </tbody>
</table>';

            $mail->send();
            echo ("done");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo ("User not found with the given Email");
    }
}
