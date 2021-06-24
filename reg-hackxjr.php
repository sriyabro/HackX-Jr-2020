<?php
$admin = 'mnipunai7@gmail.com';

$postData = $uploadedFile = '';

if(isset($_POST['submit'])){

    $postData = $_POST;
    $team = $_POST['teamName'];
    $school = $_POST['schoolName'];
    $district = $_POST['district'];
    $mentor = $_POST['mentor'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $aware = $_POST['aware'];
    $mem1 = $_POST['member1'];
    $mem2 = $_POST['member2'];
    $mem3 = $_POST['member3'];
    $mem4 = $_POST['member4'];
    $mem5 = $_POST['member5'];
    
    if(!empty($team) && !empty($school) && !empty($district) && !empty($email) && !empty($mobile) && !empty($mem1)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ ?>
              <script language="javascript" type="text/javascript">
                 alert('Enter a valid email address');
                  window.location.href = 'index.html#register';
              </script>
          <?php
        }else{
            $uploadStatus = 1;
            
            // Upload attachment file
            if(!empty($_FILES["proposal"]["name"])){
                
                // File path config
                $targetDir = "uploads/";
                $fileName = $team.' - '.$school.' - '.basename($_FILES["proposal"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                
                // Allow file format
                $allowTypes = array('pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to the server
                    if(move_uploaded_file($_FILES["proposal"]["tmp_name"], $targetFilePath)){
                        $uploadedFile = $targetFilePath;
                    }else{
                        $uploadStatus = 0;
                        ?>
                        <script language="javascript" type="text/javascript">
                              alert('Sorry. There was an error uploading the file. Please try again');
                              window.location.href = 'index.html#register';
                        </script>
                        <?php
                    }
                }else{
                    $uploadStatus = 0;
                    ?>
                    <script language="javascript" type="text/javascript">
                          alert('Sorry, only PDF files are allowed to upload.');
                          window.location.href = 'index.html#register';
                    </script>
                    <?php
                }
            }
            
            if($uploadStatus == 1){
                
                // Recipient
                $toEmail = $admin;

                // Sender
                $fromName = 'HackX Jr Team';
                
                // Subject
                $subject = 'New HackX Jr Registration - Team '.$team.' from '.$school.' - '.$district ;
                
                // Message 
                $htmlContent = '<h2>New HackX Jr Registration</h2>
                    <p><b>Team Name: </b>'.$team.'<br>
                    <b>School: </b>'.$school.'<br>
                    <b>District: </b>'.$district.'<br>
                    <b>Mentor: </b>'.$mentor.'<br>
                    <b>Email: </b></b>'.$email.'<br>
                    <b>Mobile: </b>'.$mobile.'<br>
                    <b>Awareness Attendance: </b>'.$aware.'</p>
                    <p><b>Team Details -</b><br>
                    <b>    Member 1: </b>'.$mem1.'<br>
                    <b>    Member 2: </b>'.$mem2.'<br>
                    <b>    Member 3: </b>'.$mem3.'<br>
                    <b>    Member 4: </b>'.$mem4.'<br>
                    <b>    Member 5: </b>'.$mem5.'</p>';
                
                // Header for sender info
                $headers = "From: $fromName"." <".$admin.">";

                if(!empty($uploadedFile) && file_exists($uploadedFile)){
                    
                    // Boundary 
                    $semi_rand = md5(time()); 
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                    
                    // Headers for attachment 
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                    
                    // Multipart boundary 
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
                    
                    // Preparing attachment
                    if(is_file($uploadedFile)){
                        $message .= "--{$mime_boundary}\n";
                        $fp =    @fopen($uploadedFile,"rb");
                        $data =  @fread($fp,filesize($uploadedFile));
                        @fclose($fp);
                        $data = chunk_split(base64_encode($data));
                        $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" . 
                        "Content-Description: ".basename($uploadedFile)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    }
                    
                    $message .= "--{$mime_boundary}--";
                    $returnpath = "-f" . $email;
                    
                    // Send email
                    $mail = mail($toEmail, $subject, $message, $headers, $returnpath);
                    
                
                }else{
                     // Set content-type header for sending HTML email
                    $headers .= "\r\n". "MIME-Version: 1.0";
                    $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
                    
                    // Send email
                    $mail = mail($toEmail, $subject, $htmlContent, $headers); 
                }
                
                //Mail to user
                $mail_to_user = $email;
                $user_subject = 'HackX Jr. 2k20 - Registration Confirmation';

                $user_body_message = '<h4>HackX Jr. 2020</h4>
                                    <p>Hello Team '.$team.',</p>
                                    <p>Thank you for registering with HackX Jr. 2020.</p>
                                    <p>Your proposal will be evaluated, and shortlisted teams will be notified through email and social media.</p>
                                    <p>Best of luck on your journey! </p>
                                    <p><a href="https://www.facebook.com/HackXJunior">Find us on Facebook</p>
                                    <p>Regards,<br>
                                       Team HackX Jr</p>';
                                       
                $user_headers = "MIME-Version: 1.0" . "\r\n"; 
                $user_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                $user_headers .= 'From: '.$fromName.'<'.$admin.'>' . "\r\n"."CC: ".$admin."\r\n";
                $user_headers .= "Reply-To: ".$admin."\r\n";
                    
                // If mail sent
                if($mail){
                    $user_mail = mail($mail_to_user, $user_subject, $user_body_message, $user_headers);
                    if($user_mail){
                    ?>
                    <script language="javascript" type="text/javascript">
                          alert('Registration Successful. Thank you!.');
                          window.location.href = 'index.html';
                    </script>
                    <?php
                    }
                    $postData = '';
                }else{
                  ?>
                    <script language="javascript" type="text/javascript">
                          alert('Registration Failed. Please try again.');
                          window.location.href = 'index.html#register';
                    </script>
                    <?php
                }
            }
        }
    }else{
    ?>
      <script language="javascript" type="text/javascript">
           alert('Please fill all required fields.');
           window.location.href = 'index.html#register';
      </script>
    <?php
    }
} ?>