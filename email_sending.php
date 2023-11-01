<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require  'vendor/autoload.php';

$ran=0;

function sendemail(){
    $GLOBALS["ran"]=rand(100000,999999);
    $pass=password_hash($GLOBALS["ran"],PASSWORD_DEFAULT);
    setcookie("passwordforlogin",$pass,time()+300);
    try{
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth=true;
        $mail->Username="nkumarteja123@gmail.com";
        $mail->Password="yrgf hzhl eopm tccv";
        $mail->SMTPSecure="tls";
        $mail->Port=587;

        $mail->setFrom("nkumarteja123@gmail.com","Tech World");
        $mail->addAddress($_COOKIE['emailtechworld']);

        $mail->isHTML(true);
        $mail->Subject="Tech World Email verification";
        $mail->addEmbeddedImage("logo1.png","logo1.png","logo1.png");
        $mail->Body="
        <!DOCTYPE html>
        <html>
        <body>
        	<div style='width:100%;height:auto;background-color:#f0f2f3;border:none;padding-top:20px;padding-bottom:20px;'>
        		<div style='width:90%;min-height:300px;padding:10px;background-color:white;margin:auto;'>
        			<div style='width:100%;height:55px;background-color:black;padding-top:10px;padding-bottom:10px;'><center><img src='cid:logo1.png' width='200px'></center></div>
			        <p style='font-size:140%;font-weight:700;color:#4a4444;'>Verify your email address</p>
        			<p style='color:#4a4444;'>Thanks for starting the new TECH WORLD account creation process. We want to make sure it's really you. Please enter the following verification code when prompted. If you don’t want to create an account, you can ignore this message.</p>
			        <p style='font-size:100%;text-align:center;color:#4a4444;'>Verification code<br><span style='color:black;font-size:170%;margin-bottom:-10px;'><b>".$GLOBALS['ran']."</b></span><br><center><span style='color:#4a4444;text-align:center;'>(This code is valid for 5 minutes)</span></center></p>
			        <hr>
			        <p style='color:#4a4444;opacity:90%;'>Tech World will never email you and ask you to disclose or verify your password, credit card, or banking account number.</p><br>
        		</div>
        	</div>
        </body>
        </html>
        ";

        $mail->send();

    }
    catch(Exception $excep){
        setcookie("error_in_email",0,time()+300);
        header("Location:index.php");
        exit();
    }
}

?>
