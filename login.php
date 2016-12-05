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
                //if bool variable for checking if it's a post request
                $post_request = $_SERVER['REQUEST_METHOD'] === 'POST';

                //bool for showing the incorrect message prompt
                $incorrect_username_or_password = false;

                //get the username and password post variables
                $username = $_POST['username'];
                $password = $_POST['password'];

                //if post request and post variables arn't empty
                if($post_request &&
                   $username !=='' &&
                   $password !==''){
                    //connect to the db
                    include 'connect.php';
                    //get the salt of the username entered
                    $salt_query = $db->prepare("SELECT `salt` FROM `users` WHERE username=:username");
                    $salt_query->bindParam(':username', $username);
                    $salt_query->execute();
                    $salt = $salt_query->fetchColumn();
                    if($salt){//if salt exist means user exists

                        //concat password with salt and hash it
                        $hash_password = hash('sha256', $password.$salt);
                        //check if the hashpassword is right
                        $user_id_query = $db->prepare("SELECT `id` FROM `users` WHERE username=:username AND password=:hash_password");
                        $user_id_query->bindParam(':username', $username);
                        $user_id_query->bindParam(':hash_password', $hash_password);
                        $user_id_query->execute();
                        $user_id = $user_id_query->fetchColumn();
                        if($user_id){//if user_id is there then password is right
                            //generate new salt
                            $new_salt = bin2hex(openssl_random_pseudo_bytes(20));
                            //generate new hash password
                            $new_hash_password = hash('sha256', $password.$new_salt);
                            //update hash password
                            $update_salt_hash_password_query = $db->prepare("UPDATE `users` SET `password`='$new_hash_password', `salt`='$new_salt' WHERE `id`='$user_id'");
                            $update_salt_hash_password_query->execute();

                            //create session id
                            $new_session_id = hash('sha256', bin2hex(openssl_random_pseudo_bytes(20)));

                            //insert session id
                            $insert_session_query = $db->prepare("INSERT INTO `sessions`(`id`, `user_id`) VALUES (:new_session_id, :user_id)");
                            $insert_session_query->bindParam(':new_session_id', $new_session_id);
                            $insert_session_query->bindParam(':user_id', $user_id);
                            $insert_session_query->execute();

                            //start session
                            session_start();

                            //set session variables
                            $_SESSION['session_id'] = $new_session_id;
                            $_SESSION['session_username'] = $username;

                            //redirect to another page
                            if($_GET['goTo']==='submit'){
                                header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
                            }
                            else{
                                header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
                            }
                        }
                        else{
                            //incorrect password message must be prompted
                            $incorrect_username_or_password = true;
                        }
                    }
                    else{
                        //incorrect password message must be prompted
                        $incorrect_username_or_password = true;
                    }
                }
            ?>
            <div class="inner-content">
                <h1 class="content-title">
                    <?php 
                     if($_GET['goTo']==='submit'){
                    ?>
                    Login to Submit
                    <?php
                     }
                     else {
                    ?>
                    Login
                    <?php
                     }
                    ?>
                </h1>
                <div class="small-sweeper"></div>
                <div class="blue-box login-box">
                    <form action="login.php?goTo=<?php echo $_GET['goTo'] ?>" method="POST">
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
        <?php include 'footer.php' ?>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->