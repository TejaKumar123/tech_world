<?php

include "email_sending.php";
include "connect.php";

if($_COOKIE["logintechworld"]==1){
    sendemail();
    setcookie("logintechworld",2,time()+290);
}

if(!isset($_COOKIE["logintechworld"])){
    setcookie("timeouttechworld",-1,time()+10);
    header("Location:index.php");
}

$message="";
$box_color="";

if(isset($_POST["everification"])){
    if(password_verify($_POST["otp"],$_COOKIE["passwordforlogin"])){
        //inserting data
        $fullname=$_COOKIE["fullnametechworld"];
        $username=$_COOKIE["usernametechworld"];
        $email=$_COOKIE["emailtechworld"];
        $hash_pass=$_COOKIE["passwordtechworld"];

        $sql="insert into users values('$fullname','$username','$email','$hash_pass')";
        $result=mysqli_query($conn, $sql);
        /*if($result){
            echo "<script>alert('user $username created successfully')</script>";
        }
        else{
            echo "<script>alert('signup failed')</script>";
        }*/

        //deleting all cookies
        setcookie("fullnametechworld",1,time()-1);
        setcookie("usernametechworld",1,time()-1);
        setcookie("emailtechworld",1,time()-1);
        setcookie("passwordtechworld",1,time()-1);
        setcookie("passwordforlogin",1,time()-1);
        setcookie("logintechworld",3,time()+10); //3 for after sign up
        header("Location:index.php");
    }
    else{
        $GLOBALS["message"]="otp is incorrect. Try again";
        $box_color="red";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>email verification</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <style>
    body,html{background-color:white;position:relative;width:100%;margin:0px;background-color:#3a0473;}
    #container{width:280px;min-height:250px;border:1px solid black;margin:center;margin-top:20px;border-radius:10px;box-shadow:0px 4px 10px <?= $box_color ?>;background-color:white;position:absolute;left:50%;transform:translateX(-50%);padding:5px 5px;}
    #otp_con{width:100%;height:110px;border:none;margin:auto;font-family:serif;margin-top:-17px;padding:10px 0px 0px 0px;position:relative;}
    input[type="number"]{background-color:white;border:none;outline:none;background:transparent;font-size:130%;width:150px;height:40px;outline:2px solid black;border-radius:5px;letter-spacing:2.5px;padding-left:10px;font-style:italic;}
    input[type="submit"]{background-color:green;padding:none;border-radius:10px;outline:none;border:1px solid green;text-align:center;width:120px;height:40px;font-size:110%;cursor:pointer;margin-top:8px;transition:0.3s;}
    p{text-align:center;font-style:sans-serif;font-size:150%;}
    /*label{font-size:130%;margin-right:10px;margin-left:30px}*/
    #note{text-align:center;color:red;list-style-type:none;position:absolute;bottom:10px;left:50%;transform:translateX(-50%);text-wrap:nowrap;}
    </style>

</head>

<body>
    <div id="container">
        <p>Enter the otp send to <span style="font-size:80%;"><span style="color:blue;"><?= $_COOKIE['emailtechworld'] ?></span></p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post" id="otp_con">
            <!----<label for="otp_tech">OTP: </label>---->
            <center><input type="number" id="otp_tech" name="otp" value="" maxlength="6" required></center>
            <li style="color:red;margin-top:10px;list-style-type:none;"><center><?= $message ?></center></li>
            <center><input type="submit" value="verify" name="everification"></center>
        </form>
        <li id="note">Note: Enter the otp within 5 minutes</li>
    </div>
</body>
    <script>


    </script>
</html>
