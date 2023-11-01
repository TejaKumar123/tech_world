<?php
include "connect.php";
function login_or_not(){
    global $conn;
    if(isset($_COOKIE["techworldloginemailupdate"]) && isset($_COOKIE["techworldloginpasswordupdate"]) && isset($_COOKIE["useroremail"]) ){
        $usernameoremail=$_COOKIE['techworldloginemailupdate'];
        $useroremail=$_COOKIE['useroremail'];
        $scheck="select * from users where $useroremail='$usernameoremail'";
        $result=mysqli_query($conn,$scheck);
        if(mysqli_num_rows($result)==1){
            while($row=mysqli_fetch_assoc($result)){
                if(password_verify($_COOKIE["techworldloginpasswordupdate"],$row["password"])){
                    return "yes";
                }
                else{
                    return "no";
                }
            }
        }
        else{
            return "no";
        }
    }
    else{
        return "no";
    }

}

?>
