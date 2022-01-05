<?php 
    require_once './includes/phpmailer/class.phpmailer.php';

    function sendMail($to_email, $to_name, $subject, $content){
        $mail = new PHPMailer(true); 
        $mail->IsSMTP();

        $sent = true;
        try {
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
        
            $mail->SMTPSecure = 'ssl';
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 465;

            require_once $_SERVER['DOCUMENT_ROOT'] . '/.config/email.php';
            $mail->Username   = $email_username;
            $mail->Password   = $email_password;
   
            $mail->AddAddress($to_email, $to_name);
            $mail->SetFrom($email_username,'Hillside Hotel');
        
            $mail->Subject = $subject;
            $mail->AltBody = 'To view this post you need a compatible HTML viewer!';
        
            $message = $content;
            $mail->MsgHTML($message);
            $mail->Send();
    
          } catch (phpmailerException $e) {
            //   echo $e->errorMessage(); //error from PHPMailer
            $sent = false;
          } catch (Exception $e){
            //   echo $e->getMessage(); //error from PHPMailer
            $sent = false;
          }

        return $sent;
    }
?>