<?php
	include("function/header.php");

	// require_once "function/recaptchalib.php";
	if($_POST["btn"] == "submit"){
		switch(checkInfo($_POST)){
			case 1:
				$err = "Look... I know you probably like that one, but somebody beat ya to it, add a number or something";
				session_destroy();
				break;
			case 2:
				$err = "Mate... ONLY ONE ACCOUNT PER EMAIL!!!!";
				session_destroy();
				break;
			case 3:
				$err = "dude, you remember yer password... right?";
				session_destroy();
				break;
			case 4:
				$err = "YA FACKING NEED A PASSWORD TO GET IN!!!!";
				session_destroy();
				break;
			case 5:
				$err = "No... NO!!!!";
				session_destroy();
				break;
			case 6:
				$err = "PUT SOMETHING IN HERE! ANYTHING!!!";
				session_destroy();
				break;
			case 7:
				$err = "YOU DO KNOW WHY THIS IS PUT IN, RIGHT!? nah me neither, BUT FILL IT IN!!!";
				session_destroy();
				break;
			case 8:
				$err = "... fill in... YER FACKING EMAIL!!!";
				session_destroy();
				break;
			default:
				header("Location: reg_success.php");
				break;
		}
		echo "<div class='errdiv'>$err</div>";	
	}

	function checkInfo($info){
		if($info["username"] != ""){
			if (preg_match('/[;"=]/', $info["username"])){
				return 5;
            }
			else if(isUnique("username",$info["username"])){
				$_SESSION["username"] = $info["username"];
			}
			else
				return 1;
		}
		else
			return 6;
		
		if($info["email"] != ""){
			if (preg_match('/[;"=]/', $info["email"])){
				return 5;
			}
			else if(isUnique("email",$info["email"])){
					$_SESSION["email"] = $info["email"];
			}
			else
				return 2;
		}
		else
			return 8;

		if($info["pass"] != ""){
			if (preg_match('/[;"=]/', $info["pass"])){
				return 5;
			}
			else{
				$out = checkPassword($info["pass"], $info["conf"]);
				return $out;
			}
		}
		else
			return 4;

		if($info["conf"] != ""){
			if (preg_match('/[;"=]/', $info["conf"])){
                return 5;
			}
		}
		else
			return 7;
	}

	function checkPassword($pass, $conf){
		$hashpass = hash("whirlpool",$pass);
		$hashconf = hash("whirlpool",$conf);
		if($hashpass === $hashconf){
			$_SESSION["pass"] = $hashpass;
			return 0;
		}
		else
			return 3;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Tamagru</title>
		<meta http-equiv="Cache-control" content="no-cache">
		<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet"> 
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="centerdiv">
			<form action="" method="post" style="top:50%">
			<div class="field">
				<label class="label">Sign Your SOUL</label>
				<input class='input' type="text" name="username" placeholder="Enter Username"><br>
				<input class='input' title="INSTRUCTIONS WERE RIGHT THERE!!!!!" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$" type="password"  name="pass" placeholder="Password requires one lower case letter, one upper case letter, one digit, 8+ characters, and no spaces."><br>
				<input class='input' title="DUDE!!!!" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$" type="password"  name="conf" placeholder="Confirm Password"><br>
				<input class='input' type="email" name="email" placeholder="Enter Email Address"><br>
				<div class="field">
<label class="label">Gender</label>
<div class="control">
<div class="select">
<select name="gender">
    <option>Male</option> 
    <option>Female</option>
	<option>Non-binary</option>
	<option>Gender-fluid</option>
	<option>Agender</option>
	<option>Prefer not to say</option>
	<option>Apache Attack Helicopter</option>
	<option>Other</option>
</select>
</div>
</div>
</div>
<!-- <div class="g-recaptcha" data-sitekey="6LfjL4IUAAAAAKmjTsPYNwAU6D4ky8MUiLJK89f1"></div> -->
				<input class='button is-dark' type="submit" name="btn" value="submit"><br>
			</form>
			<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
			<div class="content has-text-centered">
			<h5>Already without a soul?</h5> <a href=login.php>Sign in here.</a><br>
		</div>
		<?php
			// $secret = "6LfjL4IUAAAAAKmjTsPYNwAU6D4ky8MUiLJK89f1";
			// $response = null;
			// $reCaptcha = new ReCaptcha($secret);

			// if ($_POST["g-recaptcha-response"]){
			// 	$response = $reCaptcha->verifyResponse(
			// 		$_SERVER["REMOTE_ADDR"],
			// 		$_POST["g-recaptcha-response"]
			// 	);
			// }
		?>
	</body>
	<div id="notification"></div>
			<div class="hero-foot">
				<footer class="footer">
					<div class="container">
						</div>
					</div>
				</footer>
				</div>
				</div>
</html>