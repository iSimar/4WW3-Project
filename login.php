<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Login</title>
        <!-- fetch and link css stylesheet file to the html page -->
        <link rel="stylesheet" type="text/css" href="./style.css">
        <!-- fetch and link google font to html page -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    </head> <!-- ending head tag -->
    <body> <!-- starting body tag -->
        <?php include 'header.php' ?>
        <div class="content">
            <?php
                $post_request = $_SERVER['REQUEST_METHOD'] === 'POST';

                $incorrect_username_or_password = false;

                $username = $_POST['username'];
                $password = $_POST['password'];

                if($post_request &&
                   $username !=='' &&
                   $password !==''){
                    include 'connect.php';
                    $salt_query = $db->query("SELECT `salt` FROM `users` WHERE username='$username'");
                    $salt = $salt_query->fetchColumn();
                    if($salt){
                        $hash_password = hash('sha256', $password.$salt);
                        $user_id_query = $db->query("SELECT `id` FROM `users` WHERE username='$username' AND password='$hash_password'");
                        $user_id = $user_id_query->fetchColumn();
                        if($user_id){
                            $new_session_id = hash('sha256', bin2hex(openssl_random_pseudo_bytes(20)));
                            $insert_session_query = $db->query("INSERT INTO `sessions`(`id`, `user_id`) VALUES ('$new_session_id','$user_id')");
                            session_start();
                            $_SESSION['session_id'] = $new_session_id;
                            $_SESSION['session_username'] = $username;
                            header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
                        }
                        else{
                            $incorrect_username_or_password = true;
                        }
                    }
                    else{
                        $incorrect_username_or_password = true;
                    }
                }
            ?>
            <div class="inner-content">
                <h1 class="content-title">
                    User Login
                </h1>
                <div class="small-sweeper"></div>
                <div class="blue-box login-box">
                    <form action="login.php" method="POST">
                    <br/>
                    <input type="text" class="textbox text-box-full-width" placeholder="Username" name="username" value="<?php echo $username ?>"/>
                    <?php
                        if($post_request && $username ===''){
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
                    <input type="password" class="textbox text-box-full-width" placeholder="Password" name="password"/>
                    <?php
                        if($post_request && $password ===''){
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
                    <?php
                        if($incorrect_username_or_password){
                    ?>
                        <div class="error-red">
                            Incorrect username or password.
                        </div>
                        <div class="small-sweeper"></div>
                    <?php
                        }
                    ?>
                    <input type="submit" class="button" value="Login"/>
                    </form>
                    <br/>
                    <br/>
                    <a href="registration.php" class="small-link">Create an account</a>
                </div>
                <div class="large-sweeper"></div>
                <div class="large-sweeper"></div>
            </div>
        </div>
        <div class="footer"><!-- starting footer -->
            <h5 class="footer-text"> <!-- starting footer-text h5 tag -->
                All rights reserved, 2016. Simarpreet Singh. Made in Hamilton, ON.
            </h5><!-- ending footer-text h5 tag -->
        </div><!-- ending footer -->
    </body><!-- ending body tag -->
</html><!-- ending html tag -->