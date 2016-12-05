<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Signup</title>
        <!-- fetch and link css stylesheet file to the html page -->
        <link rel="stylesheet" type="text/css" href="./style.css">
        <!-- fetch and link google font to html page -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

        <!-- import jquery 3.1.1 core -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    </head> <!-- ending head tag -->
    <body> <!-- starting body tag -->
        <?php include 'header.php' ?>
        <div class="content">
            <?php
                $processed = $_SERVER['REQUEST_METHOD'] === 'POST';
                $accountCreated = false;
                
                $username = $_POST['username'];
                $fullName = $_POST['fullName'];
                $birthDate = $_POST['birthDate'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                // print_r($_POST);
                if(
                    $processed &&
                    $username !=='' &&
                    $fullName !=='' &&
                    $birthDate !== '' &&
                    $email !== '' &&
                    $phone !== '' &&
                    $password !== '' &&
                    $confirmPassword !== '' &&
                    preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $birthDate) &&
                    preg_match('/^[a-zA-Z\s]+$/', $fullName) &&
                    preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email) &&
                    preg_match('/^[0-9]+$/', $phone) &&
                    strlen($phone)==10 &&
                    $password == $confirmPassword
                   ) {
                    include 'connect.php';
                    $count_username_query = $db->prepare("SELECT count(*) FROM `users` WHERE username=:username");
                    $count_username_query->bindParam(':username', $username);
                    $count_username_query->execute();
                    if($count_username_query->fetchColumn()==0){
                        $username_exists = false;
                        $salt = bin2hex(openssl_random_pseudo_bytes(20));
                        $hash_password = hash('sha256', $password.$salt);
                        $insert_user_query = $db->prepare("INSERT INTO `users`(`username`, `password`, `salt`, `birth_date`, `email`, `phone_number`, `full_name`) VALUES (:username, :hash_password, :salt, :birthDate, :email, :phone, :fullName)");
                        $insert_user_query->bindParam(':username', $username);
                        $insert_user_query->bindParam(':hash_password', $hash_password);
                        $insert_user_query->bindParam(':salt', $salt);
                        $insert_user_query->bindParam(':birthDate', $birthDate);
                        $insert_user_query->bindParam(':email', $email);
                        $insert_user_query->bindParam(':phone', $phone);
                        $insert_user_query->bindParam(':fullName', $fullName);
                        $insert_user_query->execute();
                        $accountCreated = true;
                    }
                    else{
                        $username_exists = true;
                    }
                    $insert_user_query = null;
                    $count_username_query = null;
                    $db = null;
              }
              if($processed && $accountCreated){
            ?>
                <div class="inner-content">
                    <h1 class="content-title">
                        Congratulations 
                    </h1>
                    <div class="small-sweeper"></div>
                    <div class="blue-box login-box">
                        <br/>
                        <h2>You are a member now! Thank you for signing up. You can login now.</h2>
                        <br/>
                        <a class="button" href="login.php">Login Now</a>
                    </div>
                </div>
            <?php
                }
                else {
            ?>
            <div class="inner-content">
                <h1 class="content-title">
                    Ready to join?
                </h1>
                <div class="small-sweeper"></div>
                <div class="blue-box login-box">
                    <form action="registration.php" method="POST">
                    <br/>
                    <input type="text" name="username" class="textbox text-box-full-width" placeholder="Username" id="username" value="<?php echo $username ?>"/>
                    <?php 
                        if($processed && $username && $username_exists == 1){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Username already exists!
                            </div>
                            <div class="error-message-box-description">
                                <?php echo $username ?> is already in use, please try using a different username.
                            </div>
                        </div>
                    <?php
                        }
                        else if($processed && !$username){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Username is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" name="fullName" placeholder="Full Name" id="fullName" value="<?php echo $fullName ?>"/>
                    <?php 
                        if($processed && $fullName && !preg_match('/^[a-zA-Z\s]+$/', $fullName)){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Must be alphabetic
                            </div>
                            <div class="error-message-box-description">
                                '<?php echo $fullName ?>' contains other characters than letters.
                            </div>
                        </div> 
                    <?php
                        }
                        else if($processed && !$fullName){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Full name is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" placeholder="Birth Date (MM/DD/YYYY)" id="birthDate" name="birthDate" value="<?php echo $birthDate ?>"/>
                    <?php 
                        if($processed && $birthDate && !preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $birthDate)){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Must be in date format
                            </div>
                            <div class="error-message-box-description">
                                '<?php echo $birthDate ?>' is NOT in MM/DD/YYYY date format.
                            </div>
                        </div> 
                    <?php
                        }
                        else if($processed && !$birthDate){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Birth date is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="email" class="textbox text-box-full-width" placeholder="Email" id="email" name="email" value="<?php echo $email ?>"/>
                    <?php 
                        if($processed && $email && !preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Must be in date format
                            </div>
                            <div class="error-message-box-description">
                                '<?php echo $email ?>' is NOT in MM/DD/YYYY date format.
                            </div>
                        </div> 
                    <?php
                        }
                        else if($processed && !$email){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Email is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" placeholder="Phone Number (ex: 4161234567)" id="phone" name="phone" value="<?php echo $phone ?>"/>
                    <?php 
                        if($processed && $phone && !preg_match('/^[0-9]+$/', $phone)){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Must be numeric
                            </div>
                            <div class="error-message-box-description">
                                '<?php echo $phone ?>' contains other characters than numbers.
                            </div>
                        </div> 
                    <?php
                        }
                        else if($processed && $phone && strlen($phone)!=10){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Invalid phone number
                            </div>
                            <div class="error-message-box-description">
                                Phone number must be 10 digits long
                            </div>
                        </div>
                    <?php
                        }
                        else if($processed && !$phone){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Phone number is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="password" class="textbox text-box-full-width" placeholder="Password" id="password" name="password"/>
                    <?php 
                        if($processed && $password != $confirmPassword){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Passwords did not match
                            </div>
                            <div class="error-message-box-description">
                                Password and confirm password field must match.
                            </div>
                        </div> 
                    <?php
                        }
                        else if($processed && !$password){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Password is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="password" class="textbox text-box-full-width" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword"/>
                    <?php
                        if($processed && !$confirmPassword){
                    ?>
                        <div class="error-message-box" style="display:block;">
                            <div class="error-message-box-title">
                                Required field
                            </div>
                            <div class="error-message-box-description">
                                Confirm password is a required field
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="small-sweeper"></div>
                    <input type="checkbox" name="terms">
                    <span class="terms-line">
                        I accept the 
                    </span><a href="#" class="small-link">Terms and Conditions</a>
                    <div class="small-sweeper"></div>
                    <input type="submit" class="button" value="Register"/>
                    <!--<a class="button" id="registerButton">Register</a>-->
                    <div class="small-sweeper"></div>
                </form>
                </div>
                <div class="large-sweeper"></div>
                <div class="large-sweeper"></div>
            </div>
            <?php
                }
            ?>
        </div>
        <?php include 'footer.php' ?>
        <script src="./js/requests.js" type="text/javascript"></script>
        <!-- <script src="./js/formValidation.js" type="text/javascript"></script> -->
    </body><!-- ending body tag -->
</html><!-- ending html tag -->