<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

    public function sendMail($to, $subjet, $body) {
        require_once(APPPATH . 'third_party/phpmailer/src/PHPMailer.php');
        require_once(APPPATH . 'third_party/phpmailer/src/SMTP.php');
        require_once(APPPATH . 'third_party/phpmailer/src/Exception.php');
        $mail = new PHPMailer\PHPMailer\PHPMailer();                               // Enable verbose debug output
        $mail->isSMTP();
        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail 
        $mail->Username = 'binalfinlite@gmail.com';                 // SMTP username
        // SMTP username
        $mail->Password = 'binal123!@#';                    // SMTP password
        // Enable TLS encryption, `ssl` also accepted
//        $mail->SMTPOptions = array(
//            'ssl' => array(
//                'verify_peer' => false,
//                'verify_peer_name' => false,
//                'allow_self_signed' => true,
//               
//            )
//        );
        $mail->Port = 587;
        $mail->SetFrom('binalfinlite@gmail.com', 'Mehta Garments');
        $mail->addAddress($to);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subjet;
        $mail->Timeout = 1;
        $mail->Body = $body;
        //$mail->Send();
        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
//        return 1;
    }

}
