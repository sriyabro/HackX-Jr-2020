<?php
$admin = 'mnipunai7@gmail.com';

$team = $_POST['teamName'];
$district = $_POST['district'];
$mentor = $_POST['mentor'];
$students = $_POST['studentCount'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$fromName = 'HackX Jr Team';

//Admin email
$subject = 'New Awareness Session Registration - '.$team.' - '.$district;
$message =  'School Name: '.$team."\n".
            'District: '.$district."\n".
            'Mentor Name: '.$mentor."\n".
            'No. of students attending: '.$students."\n".
            'Email: '.$email."\n".
            'Mobile: '.$mobile;

$headers = 'From: '.$admin."\r\n";
$headers .= 'Reply-To: '.$email."\r\n";

//User email
$user_subject ='HackX Jr 2020 Awareness Session - Registration Confirmation';
$user_message = 'Hello, '."\n\n".'Thank you for registering with HackX Jr. 2020 Awareness Session.'."\n".'The invitation link for the awareness session will be sent to this email address.'."\n".'Share it with your friends who are interested.'."\n\n".'Regards,'."\n".'Team HackX Jr';

$user_headers = "From: $fromName"." <".$admin.">"."\r\n";
$user_headers .= 'Reply-To: '.$admin."\r\n";

$admin_mail_status = mail($admin, $subject, $message, $headers);
$user_mail_status = mail($email, $user_subject, $user_message, $user_headers);

if ($admin_mail_status && $user_mail_status) { ?>
 <script language="javascript" type="text/javascript">
    alert('Registration succeesful. Thank you!');
 	window.location.href = 'index.html';
 </script>
 <?php
 }
 else { ?>
  <script language="javascript" type="text/javascript">
   alert('Registration failed. Please try again');
   window.location.href = 'index.html#register';
  </script>
<?php } ?>