
<?php

/**
 * Class Filerecord
 * get a record based on File
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailsent extends CApplicationComponent
{

public function sent($email,$id)
    {
	   require 'vendor/autoload.php';
       
	   try {
    $mail = new PHPMailer();     
    $mail->isSMTP(); 
    //$mail->SMTPDebug = 2;   	// Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'rsprampaul14321@gmail.com';                 // SMTP username
    $mail->Password = '8098311375';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('rsprampaul14321@gmail.com', 'Fyndup');
    $mail->addAddress($email, 'user');     // Add a recipient
	$img=Yii::getPathOfAlias('webroot').'/images/mail.png';
    $mail->AddEmbeddedImage($img, 'logo_2u');
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'User Registration';
    $fac=Faculties::model()->findByPk(1);
    $facbs64=base64_encode($fac->id);
    $userid=base64_encode($id);
	
    $link = Yii::app()->getBaseUrl(TRUE) . '/usersRegistration/userregistration?f='.$facbs64."&user=".$userid;
	$mail->Body = '<div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
    <table style="width: 100%;">
      <tr>
        <td></td>
        <td bgcolor="#FFFFFF ">
          <div style="padding: 15px; max-width: 750px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid lightseagreen;">
            <table style="width: 100%;background: #00b6e2 ;">
              <tr>
                <td></td>
                <td>
                  <div>
                    <table width="100%">
                      <tr>
                         <td rowspan="2" style="text-align:center;padding:10px;">
							<img style="float:left;width:100px;height:73px;background:white; "  src="cid:logo_2u" /> 
							
							<span style="color:white;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;">
							"When you want, where you want."<span></span></span></td>
                      </tr>
                    </table>
                  </div>
                </td>
                <td></td>
              </tr>
            </table>
            <table style="padding: 10px;font-size:14px; width:100%;">
              <tr>
                <td style="padding:10px;font-size:14px; width:100%;">
                    <p>Hi ,</p>
                    <h1 style="margin: 0 0; font-size: 26pt; color: #02bcd3;">Welcome to Fyndup!</h1>
					<p style="font-family:Arial,"Helvetica Neue",Helvetica,sans-serif;font-family-short:arial;font-size:14px;font-weight:normal;line-height:21px;color:#646566;margin-top:0;margin-left:0;margin-right:0;padding:0;margin:0;">Please verify your email address so we know that its really you!</p>
                    <p style="margin:0;padding:0;">&nbsp;</p>
	                <p style="font-family:Arial,"Helvetica Neue",Helvetica,sans-serif;font-family-short:arial;font-size:14px;font-weight:normal;line-height:21px;color:#646566;margin-top:0;margin-left:0;margin-right:0;padding:0;margin:0;">
                    <a style="padding: 10px 15px;background: #4479BA;color: #FFF;text-decoration: none;" data-hw-href="" href="'.$link.'" data-hw-target="hc72i0/KSczLBgA" target="_blank">VERIFY MY EMAIL ADDRESS</a>
                    <p style="margin:0;padding:0;">&nbsp;</p>
					<p style="font-family:Arial,"Helvetica Neue",Helvetica,sans-serif;font-family-short:arial;font-size:14px;font-weight:normal;line-height:21px;color:#646566;margin-top:0;margin-left:0;margin-right:0;padding:0;margin:0;">If the button above doesnt work, copy and paste this link into your browser:</p>
                    <p style="margin:0;padding:0;">&nbsp;</p>
					<p style="font-family:Arial,"Helvetica Neue",Helvetica,sans-serif;font-family-short:arial;font-size:14px;font-weight:normal;line-height:21px;color:#646566;margin-top:0;margin-left:0;margin-right:0;padding:0;margin:0;"><a href='.$link.' target="_blank">'.$link.'</a></p>
				    <p style="margin:0;padding:0;">&nbsp;</p>
				    <p>Regards,</p>
					<p>Fyndup Team.</p>
				 </td>
              </tr>
			  <tr>
			  <td>
				 <div align="center" style="font-size:12px; margin-top:20px; padding:5px; width:100%; background:#eee;">
                    © '.date('Y').' <a href="#" target="_blank" style="color:#333; text-decoration: none;">SPLAT</a>
                  </div>
                </td>
			  </tr>
            </table>
          </div>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
    }
}