<?php
	include("header_front.php");
    if ($_POST["btn"] == "Submit"){
        $username = toQuote($_POST["username"]);
        $password = hash("whirlpool",$_POST["pass"]);
        $statement = "SELECT * FROM  users WHERE username = $username";
        $out = $db->returnRecord($statement);
        echo "<div class='errdiv'>VERIFY YER ACCOUNT FIRST, YA TWAT</div>";
        if ($out[0]["password"] == $password && $out[0]["verified"] == "1"){
            $_SESSION["username"] = $_POST["username"];
            header("Location: video.php");
        }
    }
?>
<html>
    <body>
        <div class="centerdiv">
            <form action="" method="post" style="top:50%">
                <h4 class='title is-2'>See your Soul</h4>
                <input class="input" type="text" name="username" placeholder="Enter Username"><br>
                <input class="input" title="Yer Password please" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$" type="password"  name="pass" placeholder="Enter Password"><br>
                <input class='button is-dark' type="submit" name="btn" value="Submit"><br>
            </form>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <br>
			<a class="link" href='forgotpass.php'>...You forgot it... Didn't you</a>
			<br>
           
        </div>
    </body>
    <div id="notification"></div>
			<div class="hero-foot">
				<footer class="footer">
					<div class="container">
						<div class="content has-text-centered">
						</div>
					</div>
				</footer>
</html>
</html>