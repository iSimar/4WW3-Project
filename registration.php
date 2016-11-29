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
        <div class="header"> <!-- starting header div box tag -->
            <h1>Spotted Wifi</h1> <!-- h1 tag for the header text -->
        </div> <!-- ending header div box tag -->
        <div class="menu"> <!-- starting menu div box tag, a tags are the standar links of the nav bar  -->
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="submission.php">Submit</a>
            <a href="login.php">Login</a>
            <a href="registration.php" class="sign-up-link active-link">Signup</a>
        </div>
        <div class="content">
            <div class="inner-content">
                <h1 class="content-title">
                    Ready to join?
                </h1>
                <div class="small-sweeper"></div>
                <div class="blue-box login-box">
                    <br/>
                    <input type="text" class="textbox text-box-full-width" placeholder="Username"/>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" placeholder="Full Name" id="fullName"/>
                    <div class="error-message-box" id="fullNameRegisterErrorBox">
                        <div class="error-message-box-title" id="fullNameRegisterErrorBoxTitle">
                            Error Title
                        </div>
                        <div class="error-message-box-description" id="fullNameRegisterErrorBoxDesc">
                            This is the explaination of the error.
                        </div>
                    </div>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" placeholder="Birth Date (MM/DD/YYYY)" id="birthDate"/>
                    <div class="error-message-box" id="birthDateRegisterErrorBox">
                        <div class="error-message-box-title" id="birthDateRegisterErrorBoxTitle">
                            Error Title
                        </div>
                        <div class="error-message-box-description" id="birthDateRegisterErrorBoxDesc">
                            This is the explaination of the error.
                        </div>
                    </div>
                    <div class="small-sweeper"></div>
                    <input type="email" class="textbox text-box-full-width" placeholder="Email" id="email"/>
                    <div class="error-message-box" id="emailRegisterErrorBox">
                        <div class="error-message-box-title" id="emailRegisterErrorBoxTitle">
                            Error Title
                        </div>
                        <div class="error-message-box-description" id="emailRegisterErrorBoxDesc">
                            This is the explaination of the error.
                        </div>
                    </div>
                    <div class="small-sweeper"></div>
                    <input type="text" class="textbox text-box-full-width" placeholder="Phone Number (ex: 4161234567)" id="phone"/>
                    <div class="error-message-box" id="phoneRegisterErrorBox">
                        <div class="error-message-box-title" id="phoneRegisterErrorBoxTitle">
                            Error Title
                        </div>
                        <div class="error-message-box-description" id="phoneRegisterErrorBoxDesc">
                            This is the explaination of the error.
                        </div>
                    </div>
                    <div class="small-sweeper"></div>
                    <input type="password" class="textbox text-box-full-width" placeholder="Password"/>
                    <div class="small-sweeper"></div>
                    <input type="password" class="textbox text-box-full-width" placeholder="Confirm Password"/>
                    <div class="small-sweeper"></div>
                    <input type="checkbox" name="terms">
                    <span class="terms-line">
                        I accept the 
                    </span><a href="#" class="small-link">Terms and Conditions</a>
                    <div class="small-sweeper"></div>
                    <a class="button" id="registerButton">Register</a>
                    <div class="small-sweeper"></div>
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
        <script src="./js/formValidation.js" type="text/javascript"></script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->