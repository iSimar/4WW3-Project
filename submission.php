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
                // ini_set('display_startup_errors', 1);
                // ini_set('display_errors', 1);
                // error_reporting(-1);

                require 'vendor/autoload.php';
                use Aws\S3\S3Client;
                $s3_bucket_name = '4ww3-project-images';
                $s3_access_key = 'AKIAJJJSOACIUXC3ERDQ';
                $s3_secret_key = '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';

                $post_request = $_SERVER['REQUEST_METHOD'] === 'POST';
                $hotspotCreated = false;
                $name = $_POST['name'];
                $longitude = $_POST['longitude'];
                $latitude = $_POST['latitude'];
                $url = $_POST['url'];
                $rating = $_POST['rating'];
                $img_filepath = $_FILES['image']['tmp_name'];
                $img = $_FILES['image']['name'];
                // print_r($_FILES);
                // echo $img;
                // echo $img_filepath;
                
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
                    if($img_filepath != '' && $img != ''){
                        $s3 = S3Client::factory(array(
                        'credentials'=> [
                            'key'    => 'AKIAILGN6ARHF7F6UNYQ',
                            'secret' => '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'],
                            'region' => 'us-west-2',
                            'version'=> '2006-03-01'
                        ));
                        // Upload data using amazon s3 bucket
                        $result = $s3->putObject(array(
                            'Bucket' => $s3_bucket_name,
                            'Key'    => $img,
                            'SourceFile'   => $img_filepath,
                            'ContentType' =>'image/jpeg',
                            'ACL'    => 'public-read'
                        ));
                        // Print the URL to the object.
                        $imageURL =  $result['ObjectURL'];
                    }

                    $ratingNum = substr($rating, 0, 1);
                    include 'connect.php';
                    $insert_hotspot_query = $db->query("INSERT INTO `hotspots`(`name`, `longitude`, `latitude`, `website`, `rating`, `imageURL`) VALUES ('$name', '$longitude','$latitude', '$url', '$ratingNum','$imageURL')");
                    $hotspot_id_query = $db->query("SELECT `id` FROM `hotspots` WHERE name='$name' AND longitude='$longitude' AND latitude='$latitude' AND website='$website' AND rating='$rating' AND imageURL='$imageURL'");
                    $hotspot_id = $hotspot_id_query->fetchColumn();
                    $user_id_query = $db->query("SELECT `user_id` FROM `sessions` WHERE id='$session_id'");
                    $user_id = $user_id_query->fetchColumn();
                    $insert_hotspot_query = $db->query("INSERT INTO `reviews`(`user_id`, `hotspot_id`, `rating`) VALUES ('$user_id', '$hotspot_id', '$ratingNum')");
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
                    <?php 
                        if($hotspotCreated){
                    ?>
                    <h2>Hotspot has been submitted! Thank you.</h2>
                    <?php
                        }
                        else{
                    ?>
                    <form action="submission.php" method="POST" enctype="multipart/form-data">
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

                    <input type="text" class="textbox location-textbox" placeholder="Latitude" name="latitude" id="latitudeTextbox" value="<?php echo $latitude; ?>"/>
                    <input type="text" class="textbox location-textbox" placeholder="Longitude" name="longitude"id="longitudeTextbox" value="<?php echo $longitude; ?>"/>
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
                    <?php
                        }
                    ?>
                </div>
                <div class="large-sweeper"></div>
                <div class="large-sweeper"></div>
            </div>
        </div>
        <?php include 'footer.php' ?>
        <script src="./js/formValidation.js" type="text/javascript"></script>
        <script src="./js/submission.js" type="text/javascript"></script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->