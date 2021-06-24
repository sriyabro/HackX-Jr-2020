<?php
$admin = 'hackxjr.mit@gmail.com';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$msgsub = $_POST['subject'];
$msg = $_POST['message'];

$fromName = 'HackX Jr Team';
//Admin email
$subject = 'Contact Request from '.$fname.' '.$lname.' - HackX Jr. 2k20';
$body = 'A contact request was made as follows,'."\n".
          		'First Name:'.$fname."\n".
          		'Last Name: '.$lname."\n".
          		'Email: '.$email."\n".
         		'Subject: '.$msgsub."\n".
         		'Message: '.$msg."\n";

$headers = 'From: '.$admin."\r\n";
$headers .= 'Reply-To: '.$email."\r\n";

//User email
$user_subject = 'HackX Jr. 2020 - Automated Reply';
$user_body = 'Hi! '.$fname.','."\n\n".'Thank you for contacting HackX Jr team.'."\n".'We are happy to assist you. We will get back to you as quickly as possible!'."\n\n".'Regards,'."\n".'Team HackX Jr';

$user_headers = "From: $fromName"." <".$admin.">"."\r\n";
$user_headers .= 'Reply-To: '.$admin."\r\n";


$admin_mail_status = mail($admin, $subject, $body, $headers);
$user_mail_status = mail($email, $user_subject, $user_body, $user_headers);


if ($admin_mail_status && $user_mail_status) { ?>
 <script language="javascript" type="text/javascript">
    alert('Your message has been recorded. Thank you for contacting us.');

 	window.location.href = 'index.html';
 </script>
 <?php
 }
 else { ?>
  <script language="javascript" type="text/javascript">
   alert('Failed to send the message. Please try again.');
   window.location.href = 'index.html#contact';
  </script>
<?php } ?>