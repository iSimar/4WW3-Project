<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Result</title>
        <!-- fetch and link css stylesheet file to the html page -->
        <link rel="stylesheet" type="text/css" href="./style.css">
        <!-- fetch and link google font to html page -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
        <!-- import jquery 3.1.1 core -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <!-- import google maps api -->
        <script src="https://maps.googleapis.com/maps/api/js">
        </script>
    </head> <!-- ending head tag -->
    <body> <!-- starting body tag -->
        <?php include 'header.php' ?>
        <div class="content">
            <?php
            $id = $_GET['id'];
            include 'connect.php';
            $sql = "SELECT id, name, latitude, longitude, website, imageURL, rating FROM hotspots WHERE id=".$id;
            $hotspot_query = $db->query($sql);
            foreach ($hotspot_query as $tmp) {
                $hotspot = $tmp;
            }
            if($hotspot){
                $post_request = $_SERVER['REQUEST_METHOD'] === 'POST';
                $rating = $_POST['rating'];
                if($rating!= '' && isset($_SESSION['session_id']) && isset($_SESSION['session_username'])){
                    $username = $_SESSION['session_username'];
                    $user_id_query = $db->query("SELECT `id` FROM `users` WHERE username='$username'");
                    $user_id = $user_id_query->fetchColumn();
                    $insert_hotspot_query = $db->query("INSERT INTO `reviews`(`user_id`, `hotspot_id`, `rating`) VALUES ('$user_id', '$id', '$rating')");
                }
            }
            else{
                header("Location: https://{$_SERVER['HTTP_HOST']}/search.php");
            }
            $user_reviews_sql = "SELECT users.full_name, users.username, reviews.rating FROM users, reviews WHERE users.id=reviews.user_id AND reviews.hotspot_id=".$id;            
            ?>
            <div class="inner-content search-results-inner-content">
                <!-- object instance title -->
                <h1 class="content-title result-title">
                    <?php echo $hotspot['name'] ?> (<?php echo $hotspot['rating'] ?> Stars)
                </h1>
                <!-- object instance subtitles -->
                <h2 class="content-title">
                    <?php echo $hotspot['website'] ?>
                </h2>
                <h2 class="content-title">
                    <?php echo $hotspot['latitude'] ?>, <?php echo $hotspot['longitude'] ?>
                </h2>
                <div class="small-sweeper"></div>
                <div class="divider"></div>
                <div class="small-sweeper"></div>
                <div id="indiviualResultMap" style="width:100%;height:300px"></div>
                <!--<img src="./images/wide-map-placeholder.png" class="wide-map-placeholder" alt="map-holder"/>-->
                <div class="small-sweeper"></div>
                <div class="divider"></div>
                <div class="small-sweeper"></div>
                <!-- start of user review section -->
                <h1 class="content-title">
                    User Reviews
                </h1>
                <div class="small-sweeper"></div>
                <div class="user-reviews-box">
                <?php
                if(isset($_SESSION['session_id']) && isset($_SESSION['session_username'])){
                ?>
                <h3>Submit your review:</h3>
                <form action="hotspot.php?id=<?php echo $hotspot['id']; ?>" method="post">
                <select class="dropdown" name="rating">
                      <option value="5">5 Stars</option>
                      <option value="4">4 Stars</option>
                      <option value="3">3 Stars</option>
                      <option value="2">2 Stars</option>
                      <option value="1">1 Stars</option>
                </select>
                <input type="submit" class="button" value="Submit"/>
                </form>
                <div class="small-sweeper"></div>
                <div class="divider"></div>
                <div class="small-sweeper"></div>
                <?php
                }
                $noReviews = 1;
                foreach ($db->query($user_reviews_sql) as $review) {
                    $noReviews = 0;
                ?>
                <div class="user-review-box">
                    <a href="#">
                        <img class="dp-image" src="./images/dp.png" alt="user-dp"/>
                    </a>
                    <div class="details">
                        <a href="result.php">
                            <h2><?php echo $review['full_name']; ?> (<?php echo $review['username']; ?>)</h2>
                        </a>
                        <h3><?php echo $review['rating']; ?> Stars</h3>
                    </div>
                </div>
                <?php
                }
                if($noReviews){
                ?>
                <h3>No reviews yet.</h3>
                <?php
                }
                ?>
                </div>
                <div class="divider"></div>
                <div class="small-sweeper"></div>
                <div class="large-sweeper"></div>
            </div>
        </div>
        <div class="footer"><!-- starting footer -->
            <h5 class="footer-text"> <!-- starting footer-text h5 tag -->
                All rights reserved, 2016. Simarpreet Singh. Made in Hamilton, ON.
            </h5><!-- ending footer-text h5 tag -->
        </div><!-- ending footer -->
        <script src="./js/individual_result.js" type="text/javascript"></script>
        <script>
        var indiviualResultMap = new google.maps.Map(
            document.getElementById('indiviualResultMap'),  //id of the result map
            { 
                center: new google.maps.LatLng(<?php echo $hotspot['latitude'] ?>, <?php echo $hotspot['longitude'] ?>),  //center long lat
                zoom: 16 //zoom level
            }
        );
        var marker = new google.maps.Marker({
            position: {lat: <?php echo $hotspot['latitude'] ?>, lng: <?php echo $hotspot['longitude'] ?>}, //marker
            map: indiviualResultMap //map to set the marker
        });
        </script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->