<?php
  define("_AXES_ALLOWED", true);
  require_once("includes/init.php");

  //check if on maintenance mode
  if(!$core->maintenance_mode){
    redirect_to("index.php");
  }
?>
<!DOCTYPE html>
<html>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p>
        <!-- Brand -->
        <a href="index.php">
            <img src="img/logo/logo.png">
        </a>
    </p>
  </div>
  <div class="middle">
    <h1>Performing Maintenance</h1>
    <hr>
    <p>Our site is getting a little tune up and some love</p>
  </div>
  <div class="bottomleft">
    <p>We apologize for the inconvenience, but we're performing some maintenance.</p>
  </div>
</div>

</body>
</html>
