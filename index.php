<?php
/*$password="Geeks123.,";
$hashed_pass=password_hash($password,PASSWORD_DEFAULT);
setcookie("hash_password",$hashed_pass,time()-1,);*/
//setcookie("user","john",time()-1);
/*
$exco=$_COOKIE['hash_password'];
if(password_verify("Geeks123.,",$exco)){
    echo "<script>alert('$exco')</script>";
}
*/

?>
<!DOCTYPE html>
<html>

<head>
<title>TECH WORLD</title>
<link rel="icon" href="icons/company_logo2.png">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="index.css">
<script src="index.js"></script>

</head>
<?php
    include "connect.php";
    include "email_sending.php";
    include "login_verification.php";
    $login_check=login_or_not();

?>

<body oncontextmenu="return true" >

<!---
<div id="entry">
	<div id="container">
		<img src="icons/company_logo.png">
		<p></p>

	</div>
</div>
---->

<?php
    //create table users(fullname varchar(50),username varchar(20) unique,email varchar(50) primary key,password varchar(30) not null);
    if(isset($_COOKIE["techworldsignincheck"])){
        if($_COOKIE["techworldsignincheck"]==1){
            $alerting_message="You have successfully signin.";
            $text1="Signin success";
            $image="success";
            $color="green";
        }
    }

    if(isset($_COOKIE["techworldlogoutcheck"])){
        if($_COOKIE["techworldlogoutcheck"]==1){
            $alerting_message="You have successfully Logout.";
            $text1="Logout";
            $image="logout";
            $color="green";
        }
    }

    if(isset($_COOKIE["error_in_email"])){
        if($_COOKIE["error_in_email"]==0){
            $alerting_message="Something went wrong. Email can't send. Please check your network connection";
            $text1="Network error";
            $image="network";
            $color="red";
        }
    }

    if(isset($_COOKIE["timeouttechworld"])){
        if($_COOKIE["timeouttechworld"]==-1){
            $alerting_message="5 minutes completed for sign up.so try again";
            $text1="Time Out";
            $image="timeout";
            $color="yellow";
        }
    }
    if(isset($_COOKIE["logintechworld"])){
        if($_COOKIE["logintechworld"]==3){
            $alerting_message="Sign up successfully completed. You can login now ";
            $text1="success";
            $image="success";
            $color="green";
        }
    }
    if(isset($_POST["signup"])){
        $fullname=$_POST["fullname"];
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $sql1="select * from users where email='$email'";
        $sql2="select * from users where username='$username'";
        $isemail=mysqli_query($conn,$sql1);
        $isusern=mysqli_query($conn,$sql2);
        $alerting_message="";
        $text1="";
        $image="";
        $color="";
        if(mysqli_num_rows($isemail)>0){
            //echo "<script>alert('user is already exist')</script>";
            $alerting_message.="email is already existed";
            $text1="warning";
            $image="warning";
            $color="yellow";
        }
        else if(mysqli_num_rows($isusern)>0){
            $alerting_message.="username is already existed";
            $text1="warning";
            $image="warning";
            $color="yellow";
        }
        else{
            $pass_word=password_hash($password,PASSWORD_DEFAULT);
            setcookie("fullnametechworld",$fullname,time()+300);
            setcookie("usernametechworld",$username,time()+300);
            setcookie("emailtechworld",$email,time()+300);
            setcookie("passwordtechworld",$pass_word,time()+300);
            setcookie("logintechworld",1,time()+300);
            header("Location:verification.php");


        }
    }

    if(isset($_POST["signin"])){
            $username_email=$_POST['username'];
            if($_POST["check_user"]=="on"){
                $sql3="select * from users where username='$username_email'";
                $user_email="username";
            }
            else{
               $sql3="select * from users where email='$username_email'";
               $user_email="email";
            }

            $login_result=mysqli_query($conn,$sql3);
            if(mysqli_num_rows($login_result)==1){
                while($row=mysqli_fetch_assoc($login_result)){
                    if(password_verify($_POST["password"],$row["password"])){
                        setcookie("techworldloginemailupdate",$_POST["username"],time()+86400);
                        setcookie("techworldloginpasswordupdate",$_POST["password"],time()+86400);
                        setcookie("useroremail",$user_email,time()+86400);
                        setcookie("techworldsignincheck",1,time()+10);
                        header("Location:index.php");
                    }
                    else{
                        $alerting_message="password is incorrect";
                        $text1="Error";
                        $image="error";
                        $color="red";
                    }
                    break;

                }
            }
            else{
                $alerting_message="account is not found.please check your username / email / password";
                $text1="Error";
                $image="error";
                $color="red";
            }

    }

    if(isset($_POST["logout"])){
        setcookie("techworldloginemailupdate",-1,time()-1);
        setcookie("techworldloginpasswordupdate",-1,time()-1);
        setcookie("useroremail",-1,time()-1);
        setcookie("techworldlogoutcheck",1,time()+10);
        header("Location:index.php");

    }

?>

<div id="header">

	<div id="menu" >
		<div id="menuimg">
			<img src="icons/menu.svg" onclick="close_sidenav(1)" style="width:35px;margin-top:4px" alt="menu" title="menu">
			<div id="sidenav">
				<div id="sideimg"><img src="icons/close.png" alt="close" onclick="close_sidenav(0)" style="width:23px;margin-right:10px;color:red;margin-top:5px" /></div>
				<div id="navmenu">
					<a hre="#p1" onclick="color_change('pl1','#3a0473','p1')" ><div><li>Home</li></div></a>
					<a hre="#p2" onclick="color_change('pl2','#06558a','p2')" ><div><li>About Us</li></div></a>
					<a hre="#p3" onclick="color_change('pl3','#2f0680','p3')" ><div><li>Services</li></div></a>
					<!---<a href="#p4" onclick="color_change('pl4','#0f7f5d','p4')" ><div><li>Careers</li></div></a>--->
					<a hre="#p5" onclick="color_change('pl5','#2999bf','p5')" ><div><li>Contact us</li></div></a>
				</div>

			</div>
		</div>
		<!--<li style="list-style-type:none;font-size:140%;font-weight:bold;color:white"><i>TECH WORLD</i></li>-->
		<img src="icons/logo1.png" alt="TECH WORLD" style="width:180px;border:none;margin-top:5px">
	</div>

	<div id="rhead">
		<div id="links">
				<a hre="#p1" onclick="color_change('pl1','#3a0473','p1')" ><li>Home</li></a>
				<a hre="#p2" onclick="color_change('pl2','#06558a','p2')" ><li>About Us</li></a>
				<a hre="#p3" onclick="color_change('pl3','#2f0680','p3')" ><li>Services</li></a>
				<!---<a href="#p4" onclick="color_change('pl4','#0f7f5d','p4')" ><li>Careers</li></a>--->
				<a hre="#p5" onclick="color_change('pl5','#2999bf','p5')"  ><li>Contact us</li></a>
		</div>
		<div id="user">
			<img src="icons/user.png" onclick="accountopen()" alt="sign in"  style="width:33px;cursor:pointer;" />
			<div id="account">
                <?php
                    if(login_or_not()=="no"){
                ?>
    			         <a onclick="open_popup('login',1)">Login</a>
                         <a onclick="open_popup('create_account',1)">Create account</a>
                <?php } ?>
                <?php if(login_or_not()=="yes"){ ?>
    			 <a href="edit_profile.html" onclick="accountopen()">Edit profile</a>
				<a onclick="logout()"  id="logout_link">Logout</a>
            <?php } ?>
			</div>
		</div>
	</div>
</div>

			<!-------header ending------->

			<!-------login pop up----->

<div id="account_popup"  onclick="cancelpop(event)">
	<div id="login" onclick="stoppro(event)">
		<li id="cancel" onclick="open_popup('login',0)">&times;</li>
		<li id="heading" >Login</li>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
			<label for="name">Username/Email:</label><br>
			<input type="text" name="username" id="name" placeholder="Type your username/email" required></input>
            <label for="check_user" style="user-select:none;" >If username:</label><input type="checkbox" id="check_user" value="on" name="check_user"><br/>
			<label for="password">Password:</label><br>
			<input type="password" name="password" id="password" placeholder="Type your password" required></input>
			<a href="#" style="margin-left:7px;color:blue;text-decoration:none;">Forgot Password?</a>
			<input type="submit" name="signin" value="Login"></input>
		</form>
	</div>
	<div id="create_account" onclick="stoppro(event)" >
		<li id="cancel" onclick="open_popup('create_account',0)">&times;</li>
		<li id="heading">Sign Up</li>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST"  onsubmit="return validate_signup()"  autocomplete="off">
			<label for="name1">Full Name:</label><br>
			<input type="text" name="fullname" id="name1" placeholder="Type your fullname" value="" maxlength="50"></input>
			<label for="username">Username:<span style="color:red;">*</span></label><br>
			<input type="text" name="username" id="username" placeholder="Type your username" maxlength="20" value="" required></input>
			<label for="email1">Email:<span style="color:red;">*</span></label>
			<input type="email" id="email1" name="email" placeholder="Type your email address" maxlength="50" required></input>
			<label for="password1">Password:<span style="color:red;">*</span></label><br>
			<input type="password" name="password" id="password1" minlength="8" maxlength="30" required></input>
			<label for="rpassword">Repeat Password:<span style="color:red;">*</span></label><br>
			<input type="password" name="rename_password" id="rpassword" required></input>
			<input type="checkbox" name="agree" id="check" value="agree" required ></input>
			<label for="check" style="user-select:none;">I agree to the <b>Terms of user</b></label>
			<input type="submit" name="signup" value="Sign Up" id="signup_button" style="margin-top:18px;" ></input>
		</form>
	</div>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']?>"  method="post" style="display:none;">
    <input type="submit" value="logout" name="logout" id="logout_form">
</form>


			<!-------login pop up ending------>
<!---
<div id="bottom_nav1">
<div id="bottom_navigation">
	<a hre="#p1" id="pl1" onclick="color_change('pl1','#3a0473','p1')" title="Home" ></a>
	<a hre="#p2" id="pl2" onclick="color_change('pl2','#06558a','p2')" title="About Us" ></a>
	<a hre="#p3" id="pl3" onclick="color_change('pl3','#2f0680','p3')" title="Services" ></a>
	<a href="#p4" id="pl4" onclick="color_change('pl4','#0f7f5d','p4')" title="Careers" ></a>
	<a hre="#p5" id="pl5" onclick="color_change('pl5','#2999bf','p5')" title="Contact Us"></a>
</div>
</div>---->
<!---
<div id="pages_box">
	<div id="pages_container">
	---->
    <?php
        if(!empty($alerting_message)){
            //echo "<script>alert('$slerting_message')</script>";
    ?>
        <div id="alerting" style="box-shadow:0px 1px 10px <?= $color?>;">
            <div><img src="icons/notification/<?= $image ?>.png" id="img1" /></div>
            <div id="texts"><b><?= $text1 ?></b><br><li><?= $alerting_message ?></li></div>
            <img src="icons/close.png" id="img2" onclick="close_alert()" />
        </div>
    <?php } ?>
    <?php
    //if(login_or_not()=="no"){
    ?>
		<div id="p1" class="page">
			<!---<div id="quotdiv">  Quotation div----->
				<!---<div id="backgro"></div>
				<div id="front">--->
				<div id="quot">
						<li style="list-style-type:none;font-size:500%;text-shadow:1px 2px 0px black;color:#fff;margin:25px 0px 5px 10px;text-align:center;">Give Your Site <br>A New Look!</li>
						<p style="color:#fff;font-size:140%;text-shadow:0px 1px 5px black;font-weight:600;line-height:30px;margin-left:13px;text-align:center;">TECH WORLD can create anything in the world of technology </p>
						<div id="butt" onclick="openwehave()" >What We Have &gt;&gt;</span></div>
				</div>
				<div id="wehave">
						<li style="margin-top:20px">TECHNICAL SKILLS</li>
						<li>BUSINESS UNDERSTANDING</li>
						<li>PARTNER ON THE LONG RUN</li>
						<li>Delagation and time management</li>
						<li>Efficient Employees</li>
				</div>
				<!---</div>
			</div>--->
		</div>
        <?php //} ?>
		<div id="p2" class="page">
			<!---<div id="backgro1"></div>
			<div id="front1">--->
			<div id="p2div">
					<div id="aboutus1">
						<li style="list-style-type:none;text-shadow:1px 2px 0px black;font-size:330%;color:white;font-weight:bold;text-align:center;word-spacing:6px;margin-top:20px;">WHAT WE DO?</li>
						<li style="list-style-type:none;color:white;font-size:135%;text-align:center;font-weight:600;margin-top:5px;">Our modest list of services to suit all your digital needs</li>
					</div>
					<div id="aboutus2">
						<div class="aboutus3" >
							<div>
								<img src="icons/heart.png" >
							</div>
							<div>
								<li>Clean & Modern:</li>
								<li>A fabulous collection of unique design ideas with custom made interfaces.</li>
							</div>
						</div>
						<div class="aboutus3" >
							<div>
								<img src="icons/design.png" >
							</div>
							<div>
								<li>Unique Design:</li>
								<li>Modern industrial clean design...and the list goes on.</li>
							</div>
						</div>
						<div class="aboutus3" style="height:140px">
							<div>
								<img src="icons/pixel_perfect.png">
							</div>
							<div>
								<li>Pixel Perfect:</li>
								<li>Custome tailored to match your needs and requirements.</li>
							</div>
						</div>
						<div class="aboutus3" style="height:140px" >
							<div>
								<img src="icons/responsive.png">
							</div>
							<div>
								<li>Responsive:</li>
								<li>Responsiveness is the essential mix of flexible grids and layouts. images,and an intellegent use of media quaries.</li>
							</div>
						</div>
						<div class="aboutus3"  >
							<div>
								<img src="icons/staff.png" >
							</div>
							<div>
								<li>Cool Staff:</li>
								<li>Let's be honest everyone looks for a "cool" staff to work with.</li>
							</div>
						</div>
						<div class="aboutus3" >
							<div>
								<img src="icons/support.png" >
							</div>
							<div>
								<li>Great Support:</li>
								<li>Trouble-free support is what we offer.</li>
							</div>
						</div>
					</div>
			</div>
			<!---</div>---->
		</div>

		<div id="p3" class="page">
			<div id="p3div">
				<li id="heading">OUR&nbsp; SERVICES</li>
				<div id="service1">
					<div id="service2">
						<div id="service3">
							<div class="service_div" onclick="open_service('app',0)" >
									<img src="icons/service/app.png" class="img" >
									<li>App Development</li>
							</div>

							<div class="service_div" onclick="open_service('web',1)" >
									<img src="icons/service/web.png" class="img" >
									<li>Web Development</li>
							</div>

							<div class="service_div" onclick="open_service('design',2)" >
									<img src="icons/service/design.png" class="img" >
									<li>UI & UX Design</li>
							</div>
						</div>
						<div id="service4">
							<div class="service_div" onclick="open_service('marketing',3)" >
									<img src="icons/service/marketing.png" class="img" >
									<li>Marketing</li>
							</div>

							<div class="service_div" onclick="open_service('support',4)" >
									<img src="icons/support.png" class="img" style="width:55px;" >
									<li>Support</li>
							</div>
						</div>
					</div>

					<div id="service5">
						<div id="app" class="service_div2">
							<li id="head" style="background-image:url('icons/service/app.png')">App Development</li>
							<p>With Growing demand in this Digital World we are committed to develop the perfect Mobile Application that your Business needs. </p>
							<p>With an Attractive Price in mind we have an answer to your requests, if your business is struggling or you want to reach more people, a Mobile Application is what you need.We are Experts in the fields of</p>
							<ul style="margin-top:-5px;margin-left:30px;">
							<li>E-Commerce</li>
							<li>Restaurants, Nightlife and Clubs</li>
							<li>Jewellery store </li>
							<li>Small Business Owners … And many more</li>
							</ul>

						</div>

						<div id="web" class="service_div2">
							<li id="head" style="background-image:url('icons/service/web.png')">Web Development</li>
							<p>A website establishes your Business, adds value and credibility. There are millions of websites in the cyber world , no matter how good your services are:the main goal is to stand out. </p>
							<p>Here with Cutting edge designs and functionality, we design the exact website you need for your business. While It Comes To Web Development Its Our Best And Most Demanding Service With 100% Guaranteed Satisfaction</p>
						</div>

						<div id="design" class="service_div2">
							<li id="head" style="background-image:url('icons/service/design.png')">Ui Design</li>
							<p>A Fabulous Collection Of Unique Design Ideas With Custom-Made Interfaces Is A True Work Of Design And Style.  Design is one of the most important factors when building a brand.</p>
							<p> The design is what will set you apart from your competition and help you get the desired emotion or feeling from customers. With An Abundance Of Unique Design Styles, We Offer You Customization And Modern Style.</p>
						</div>

						<div id="marketing" class="service_div2">
							<li id="head" style="background-image:url('icons/service/marketing.png')">Marketing</li>
							<p>Around 4 Billion People use Social Media in the current scenario, and the numbers are still growing exponentially. Your customers are online, which highlights the importance of digital marketing. They’re browsing the web looking for your products or services. </p>
							<p>If they can’t find your products because you don’t have an online presence, you risk losing those leads to your competitors. We at CalciteX Provide Businesses Of All Sizes With An Opportunity To Market Their Brand 24/7 At A Low Cost. From Startups To Medium-Sized Enterprises To Multiple-Location Companies</p>
						</div>

						<div id="support" class="service_div2">
							<li id="head" style="background-image:url('icons/service/support.png')">Out Support</li>
							<p>Proactive chat, audio, and video Support . Trouble-free support is what we offer. Every request is responded by the supervisors directly.</p>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!---
		<div id="p4" class="page">
			<div id="backgro3"></div>
			<div id="front3">

				<li id="career_head1">Work @ TechWorld</li>
				<li id="career_head2">At TechWorld we are always looking for passionate and talented people</li>

				<div id="career1">
					<div id="career1_a">
						<div>
							<div>
								<img src="icons/career/build.png" style="width:90px;">
							</div>
							<div>
								<li>Bulid what you want to bulid</li>
								<li>We encourage you to build what you want to build, with technologies you love. We work on a lot of tools and projects. You can join one that you find interesting or start something new of your own.</li>
							</div>
						</div>
						<div>
							<div>
								<img src="icons/career/salary.png" style="width:84px;">
							</div>
							<div>
								<li>Salary Benefits</li>
								<li>We’re a revenue positive, a bootstrapped startup that pays above market rates, and higher salary hikes than most of the other companies.</li>
							</div>
						</div>
						<div>
							<div>
								<img src="icons/career/heart.png" style="width:86px;">
							</div>
							<div>
								<li>Flexible Vacation Policy</li>
								<li>We believe in a flexible vacation policy. The idea: You’re free to take as much time off as you choose, as long as you get your job done – in time. It’s a focus on producing great results, rather than just putting in the hours.</li>
							</div>
						</div>
						<div>
							<div>
								<img src="icons/career/relax.png" style="width:89px;">
							</div>
							<div>
								<li>A Relaxed, Tension Free Environment</li>
								<li>We are a bunch of fun loving people who don’t like to be bossed around. Work from anywhere and whenever you want, as long as you get your job done. We value what you do, rather than when and where you do it</li>
							</div>
						</div>
						<div>
							<div>
								<img src="icons/career/work.png" style="width:115px;">
							</div>
							<div>
								<li>Work On Bleeding Edge Tech</li>
								<li>We are obsessed with Technology. We use bleeding edge tools to get stuff done and contribute to Open Source Projects. You get to learn, work and play around with the latest technologies that we use.</li>
							</div>
						</div>
						<div>
							<div>
								<img src="icons/career/life.png" style="width:86px;">
							</div>
							<div>
								<li>Good work-life balance</li>
								<li>Your personal growth is vital to us, and we’ll give you everything you need to make it happen.</li>
							</div>
						</div>
					</div>
				</div>

				<br>
				<p style="color:black;text-align:center;text-shadow:0px 1.5px 0px white;font-size:50px;font-weight:500;text-decoration:underline;">Open Positions</p>
				<div id="career3" >
					<li onclick="open_career('career3_a')">Software Development</li>
					<div id="career3_a">
						<img src="images/software.jpg" style="width:100%;height:255px;border-radius:10px;" >
						<h1>Software Development</h1>
						<p>We at CalciteX encourage you to build what you want to develop, with technologies you love. We work on a lot of tools and projects. We are a platform where you can level up your Coding game!</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
					<li onclick="open_career('career3_b')">Business Development</li>
					<div id="career3_b">
						<img src="images/business.jpg" style="width:100%;height:255px;border-radius:10px;" >
						<h1>Business Development</h1>
						<p>Hone your skills in pursuing strategic opportunities. Cultivate valuable partnerships and professional relationships with our clients. Provide value to newly identified markets</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
					<li onclick="open_career('career3_c')">Human Resources</li>
					<div id="career3_c">
						<img src="images/resources.png" style="width:100%;height:255px;border-radius:10px;" >
						<h1>Human Resources</h1>
						<p>Source, Hire and Engage with Newly recruited Interns / Experienced Professionals. Find out the training they need, make them used to the working environment and Increase the productivity by assigning the right person the right task.</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
				</div>

				<br><br><br>
				<div id="career2">
					<div>
						<img src="images/software.jpg" style="width:100%;height:50%;border-radius:10px;" >
						<h1>Software Development</h1>
						<p>We at CalciteX encourage you to build what you want to develop, with technologies you love. We work on a lot of tools and projects. We are a platform where you can level up your Coding game!</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
					<div>
						<img src="images/business.jpg" style="width:100%;height:50%;border-radius:10px;" >
						<h1>Business Development</h1>
						<p>Hone your skills in pursuing strategic opportunities. Cultivate valuable partnerships and professional relationships with our clients. Provide value to newly identified markets</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
					<div>
						<img src="images/resources.png" style="width:100%;height:50%;border-radius:10px;" >
						<h1>Human Resources</h1>
						<p>Source, Hire and Engage with Newly recruited Interns / Experienced Professionals. Find out the training they need, make them used to the working environment and Increase the productivity by assigning the right person the right task.</p>
						<a href="#">click here to apply &gt;&gt;</a>
					</div>
				</div>


			</div>
		</div>--->

		<div id="p5" class="page">
			<div id="p5div">
				<!----<div id="backgro4"></div>
				<div id="front4">--->
					<div id="contact1">
						<li id="stayin1" >STAY<br>IN<br>TOUCH</li>
						<li id="stayin2">STAY IN TOUCH</li>
						<div id="contact1_a">
							<form method="get" autocomplete="on">
								<input type="text" id="sname" name="name" placeholder="Name" required>
								<input type="email" placeholder="Email" name="email" required>
								<input type="text" placeholder="Subject" name="subject" required>
								<textarea placeholder="Message" name="message"></textarea>
								<input type="submit" value="SUBMIT" style="background-color:#16255c;border:none;border-radius:0px;cursor:pointer;height:45px;color:white;">
							</form>
							<p style="margin-left:15px;font-weight:500;margin-top:35px;color:white;font-size:110%;line-height:1.4;">Feel free to contact us anytime you<br>want if you have any doubt about<br>our services/packages</p>
						</div>
					</div>
					<div id="contact2">
						<div id="contact2_a">
							<li>support@techworld.com</li>
							<li style="font-size:175%;font-weight:600;">+91 7075739434</li>
						</div>
						<div id="contact2_b">
							<li>N.Teja Kumar</li>
							<li>Koilakuntla(M)</li>
							<li>Nandyal(Dt)</li>
							<li>Andhra Pradesh</li>
							<li>India - 518134</li>
							<li style="margin-top:15px;letter-spacing:7px;">
								<a href="#"><span class="ionicon icon1"><ion-icon name="logo-instagram"></ion-icon></span></a>
								<a href="#"><span class="ionicon icon2"><ion-icon name="logo-linkedin"></ion-icon></span></a></li>
							<li>Copyright &copy; 2022 Techworld</li>

						</div>
					</div>
				<!---</div>--->
			</div>
		</div>

	<!--</div>
</div>--->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
