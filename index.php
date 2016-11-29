<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi</title>
        <!-- fetch and link css stylesheet file to the html page -->
        <link rel="stylesheet" type="text/css" href="./style.css">
        <!-- fetch and link google font to html page -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    </head> <!-- ending head tag -->
    <body> <!-- starting body tag -->
        <div class="header"> <!-- starting header div box tag -->
            <h1>Spotted Wifi</h1> <!-- h1 tag for the header text -->
        </div> <!-- ending header div box tag -->
        <div class="menu"> <!-- starting menu div box tag, a tags are the standar links of the nav bar  -->
            <a href="index.php" class="active-link">Home</a>
            <a href="search.php">Search</a>
            <a href="submission.php">Submit</a>
            <a href="login.php">Login</a>
            <a href="registration.php" class="sign-up-link">Signup</a>
        </div>
        <div class="content homepage-content">
            <!-- the content of this page is gray box, with description of the website
                 it also includes a button that leads to the search page -->
            <div class="gray-box intro-box">
                <h1>
                    Find <u>FREE</u> Wifi hotspots
                </h1>
                <h4 class="intro-desc">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.
                </h4>
                <a href="search.php" class="button">Search Wifi Hotspots</a>
                <br/>
                <br/>
            </div>
        </div>
        <div class="footer"><!-- starting footer -->
            <h5 class="footer-text"> <!-- starting footer-text h5 tag -->
                All rights reserved, 2016. Simarpreet Singh. Made in Hamilton, ON.
            </h5><!-- ending footer-text h5 tag -->
        </div><!-- ending footer -->
    </body><!-- ending body tag -->
</html><!-- ending html tag -->