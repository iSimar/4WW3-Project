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
        <?php include 'header.php' ?>
        <div class="content">
            <?php
                $post_request = $_SERVER['REQUEST_METHOD'] === 'POST';
                $hotspotCreated = false;
                $name = $_POST['name'];
                $longitude = $_POST['longitude'];
                $latitude = $_POST['latitude'];
                $url = $_POST['url'];
                $rating = $_POST['rating'];
                $longitudeIsNumeric = preg_match('/^\-?\d+(\.\d+)?$/', $longitude);
                $latitudeIsNumeric = preg_match('/^\-?\d+(\.\d+)?$/', $latitude);
                $validUrl = preg_match('/^(http:\/\/|https:\/\/)?(www.)?([a-zA-Z0-9]+).[a-zA-Z0-9]*.[a-z]{3}.?([a-z]+)?$/', $url);
                if(
                    $post_request &&
                    $name != '' &&
                    $latitude != '' &&
                    $longitude != '' &&
                    $longitudeIsNumeric &&
                    $latitudeIsNumeric &&
                    ($url==='' || $validUrl)
                ){
                    $ratingNum = substr($rating, 0, 5);
                    include 'connect.php';
                    $insert_hotspot_query = $db->query("INSERT INTO `hotspots`(`name`, `longitude`, `latitude`, `website`, `rating`, `imageURL`) VALUES ('$name', '$longitude','$latitude', '$url', '$ratingNum','')");
                    $hotspotCreated = true;
                }
            ?>
            <div class="inner-content">
                <h1 class="content-title">
                    Found a wifi hotspot?
                </h1>
                <h2 class="content-title">
                    Submit it.
                </h2>
                <div class="small-sweeper"></div>
                <div class="blue-box submit-box">
                    <form action="submission.php" method="POST">
                    <h2>Name</h2>
                    <input type="text" class="textbox text-box-full-width" placeholder="eg. Starbucks, thode library, pizza pizza" name="name" id="name" value="<?php echo $name; ?>"/>
                    <?php
                        if($post_request && $name ===''){
                    ?>
                    <div class="error-message-box" style="display:block;">
                        <div class="error-message-box-title">
                            Required field
                        </div>
                        <div class="error-message-box-description">
                            Name is a required field
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <br/>
                    <h2>Location</h2>
                    <input type="text" class="textbox location-textbox" placeholder="Longitude" name="longitude"id="longitudeTextbox" value="<?php echo $longitude; ?>"/>
                    <input type="text" class="textbox location-textbox" placeholder="Latitude" name="latitude" id="latitudeTextbox" value="<?php echo $latitude; ?>"/>
                    <?php
                        if($post_request && ($longitude === '' || $latitude === '')){
                    ?>
                    <div class="error-message-box" style="display:block;">
                        <div class="error-message-box-title">
                            Required fields
                        </div>
                        <div class="error-message-box-description">
                            Longitude and Latitude are required
                        </div>
                    </div>
                    <?php
                        }
                        elseif($post_request && !($longitudeIsNumeric && $latitudeIsNumeric)){
                    ?>
                    <div class="error-message-box" style="display:block;">
                        <div class="error-message-box-title">
                            Invalid coordinates format
                        </div>
                        <div class="error-message-box-description">
                            Longitude and Latitude are required to be numeric values
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <br/>
                    <a class="small-link underlined" id="useCurrentLocation" onclick="onClickUseCurrentLocation()" style="text-align: left;">
                        <h3>Use Current Location</h3>
                    </a>
                    <h2>Website (Optional)</h2>
                    <input type="text" class="textbox text-box-full-width" placeholder="http://example.com" name="url" id="url" value="<?php echo $url; ?>"/>
                    <?php
                        if($post_request && $url!=='' && !$validUrl){
                    ?>
                    <div class="error-message-box" style="display:block;">
                        <div class="error-message-box-title">
                            Invalid url format
                        </div>
                        <div class="error-message-box-description">
                            '<?php echo $url; ?>' is not a valid url. (eg. https://google.com)
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <br/>
                    <h2>Rating</h2>
                    <select class="dropdown submit-dropdown" name="rating">
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
                    <input type="submit" class="button" value="Submit"/>
                    <br/>
                    <br/>
                    </form>
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