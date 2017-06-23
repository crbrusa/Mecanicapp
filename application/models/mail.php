<?php
class mail extends CI_Model {
	public function __construct()
       	{
            //$this->load->database();
          
        }
    Public function enviarmail()
    {

    	require("PHPMailer-master//PHPMailerAutoload.php");
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "mecanicotest@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "mecanicodesarrollo";
//Set who the message is to be sent from
$mail->setFrom('mecanicotest@gmail.com', 'Ejecutivo');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'Anuncio');
//Set who the message is to be sent to
$mail->addAddress('crbrusa@gmail.com', 'Matias Estay');
//Set the subject line
$mail->Subject = 'Mensaje de Mecanicapp';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->Body = 'Hello, this is my message.';
//Replace the plain text body with one created manually
$mail->AltBody = 'Test';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}


    }


    Public function sendgrid()
    {
    	require('smtpapi-php/smtpapi-php.php');
    	$header = new Smtpapi\Header();
$header->addTo('crbrusa@gmail.com');
//$header->addTo('test2@example.com');
print $header->jsonString();

    } 

}