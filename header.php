<?php 
 session_start();
 $session_id = $_SESSION['session_id'];
 $session_username = $_SESSION['session_username'];
 if(($_SERVER['REQUEST_URI']==='/login.php' || $_SERVER['REQUEST_URI']==='/registration.php') &&
    $session_id && $session_id){
      header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
      return;
 }
 if($_SERVER['REQUEST_URI']==='/submission.php' && !isset($_SESSION['session_id']) && !isset($_SESSION['session_username'])){
     header("Location: https://{$_SERVER['HTTP_HOST']}/login.php?goTo=submit");
     return;
 }
?>
<div class="header"> <!-- starting header div box tag -->
    <h1>Spotted Wifi</h1> <!-- h1 tag for the header text -->
</div> <!-- ending header div box tag -->
<div class="menu"> <!-- starting menu div box tag, a tags are the standar links of the nav bar  -->
    <a href="index.php" class="<?php if($_SERVER['REQUEST_URI']==='/index.php'){ echo 'active-link'; }?>">Home</a>
    <a href="search.php" class="<?php if($_SERVER['REQUEST_URI']==='/search.php'){ echo 'active-link'; }?>">Search</a>
    <?php
        if(!isset($_SESSION['session_id']) && !isset($_SESSION['session_username'])){ 
    ?>
    <a href="login.php?goTo=submit" class="<?php if($_SERVER['REQUEST_URI']==='/submission.php' || $_SERVER['REQUEST_URI']==='/login.php?goTo=submit'){ echo 'active-link'; }?>">Submit</a>
    <a href="login.php" class="<?php if($_SERVER['REQUEST_URI']==='/login.php'){ echo 'active-link'; }?>">Login</a>
    <a href="registration.php" class="<?php if($_SERVER['REQUEST_URI']==='/registration.php'){ echo 'active-link'; }?> sign-up-link">Signup</a>
    <?php
        }
        else{
    ?>
    <a href="submission.php" class="<?php if($_SERVER['REQUEST_URI']==='/submission.php' || $_SERVER['REQUEST_URI']==='/login.php?goTo=submit'){ echo 'active-link'; }?>">Submit</a>
    <a href="logout.php" class="<?php if($_SERVER['REQUEST_URI']==='/logout.php'){ echo 'active-link'; }?>">Logout (<?php echo $session_username; ?>)</a>
    <?php
        }
    ?>
</div>