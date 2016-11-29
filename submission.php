<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Submit</title>
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
            <a href="submission.php" class="active-link">Submit</a>
            <a href="login.php">Login</a>
            <a href="registration.php" class="sign-up-link">Signup</a>
        </div>
        <div class="content">
            <div class="inner-content">
                <h1 class="content-title">
                    Found a wifi hotspot?
                </h1>
                <h2 class="content-title">
                    Submit it.
                </h2>
                <div class="small-sweeper"></div>
                <div class="blue-box submit-box">
                    <h2>Location</h2>
                    <input type="text" class="textbox location-textbox" placeholder="Longitude" id="longitudeTextbox"/>
                    <input type="text" class="textbox location-textbox" placeholder="Latitude" id="latitudeTextbox"/>
                    <br/>
                    <a class="small-link underlined" id="useCurrentLocation" onclick="onClickUseCurrentLocation()" style="text-align: left;">
                        <h3>Use Current Location</h3>
                    </a>
                    <h2>Website (Optional)</h2>
                    <input type="text" class="textbox text-box-full-width" placeholder="http://example.com" id="url"/>
                    <div class="error-message-box" id="urlSubmissionErrorBox">
                        <div class="error-message-box-title" id="urlSubmissionErrorBoxTitle">
                            Error Title
                        </div>
                        <div class="error-message-box-description" id="urlSubmissionErrorBoxDesc">
                            This is the explaination of the error.
                        </div>
                    </div>
                    <br/>
                    <h2>Rating</h2>
                    <select class="dropdown submit-dropdown">
                      <option selected>Any</option>
                      <option>5 Stars</option>
                      <option>4 Stars</option>
                      <option>3 Stars</option>
                      <option>2 Stars</option>
                      <option>1 Stars</option>
                    </select>
                    <br/>
                    <br/>
                    <h2>Select Image</h2>
                    <input type="file" class="select-image" name="image" accept="image/*">
                    <br/>
                    <div class="small-sweeper"></div>
                    <a class="button" id="submitButton">Submit</a>
                    <br/>
                    <br/>
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
        <script src="./js/submission.js" type="text/javascript"></script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->