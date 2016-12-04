<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Search Results</title>
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
                $query=$_GET['query'];
                $rating=$_GET['rating'];

                if(is_numeric($rating)){
                    if(intval($rating) >=5 ){
                        $rating = 5;
                    }
                    elseif(intval($rating) <= 1){
                        $rating = 1;
                    }
                    else{
                        $rating = (int)$rating;
                    }
                }
                else{
                    $rating = 'any';
                }
                

                $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($query)."&sensor=false&region=canada";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = json_decode(curl_exec($ch));
                curl_close($ch);
                $lat = $response->results[0]->geometry->location->lat;
                $long = $response->results[0]->geometry->location->lng;

                include 'connect.php';
                $sql = "SELECT id, name, latitude, longitude, website, imageURL, rating, ( 3959 * acos( cos( radians(".$long.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$lat.") ) + sin( radians(".$long.") ) * sin( radians( latitude ) ) ) ) AS distance FROM hotspots HAVING distance < 10 ORDER BY distance";
                // echo $sql;
                // echo "<br/>";
                // echo "<br/>";
                // $sql = "SELECT * FROM hotspots";
                foreach ($db->query($sql) as $hotspot) {
                    print_r($hotspot);
                    echo "<br/>";
                    echo "<br/>";
                }
                // print_r($distance_query->fetchColumn());

            ?>
            <div class="inner-content search-results-inner-content">
                <h1 class="content-title">
                    Search Results
                </h1>
                <h2 class="content-title">
                    Wifi Hotspots around "<u><?php echo $query; ?></u>" with <u><?php if($rating==='any'){ echo 'Any'; }else{ echo $rating.' Stars'; } ?></u> rating.
                </h2>
                <div class="small-sweeper"></div>
                <div class="blue-box search-results-search-box">
                    <h2>Redefine Search</h2>
                    <h2 class="small-h2">Location</h2>
                    <input type="search" class="textbox text-box-full-width" value="<?php echo $query; ?>" placeholder="(Optional)"/>
                    <h2 class="small-h2">Rating</h2>
                    <select class="dropdown">
                      <option <?php if($rating==='any'){ echo 'selected'; } ?>>Any</option>
                      <option <?php if($rating==5){ echo 'selected'; } ?>>5 Stars</option>
                      <option <?php if($rating==4){ echo 'selected'; } ?>>4 Stars</option>
                      <option <?php if($rating==3){ echo 'selected'; } ?>>3 Stars</option>
                      <option <?php if($rating==2){ echo 'selected'; } ?>>2 Stars</option>
                      <option <?php if($rating==1){ echo 'selected'; } ?>>1 Stars</option>
                    </select>
                    <div class="small-sweeper"></div>
                    <a href="results_sample.php" class="button">Search</a>
                </div>
                <div class="search-results-results-box">
                    <div class="flat-line"></div>
                    <div id="searchAllResultsMap" style="width:100%;height:300px"></div>
                    <div class="small-sweeper"></div>
                    <div class="flat-line"></div>
                    <table>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-0" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>BSB Hotspot</h2>
                                        </a>
                                        <h3>1280 Main St W, Hamilton, Ontario</h3>
                                        <h3>43.2605813,-79.9216803</h3>
                                        <br/>
                                        <h3>Rating: 3/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-1" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>Starbuck Coffee Shop</h2>
                                        </a>
                                        <h3>1341 Main St W, Hamilton, Ontario</h3>
                                        <h3>43.2575522,-79.9188318</h3>
                                        <br/>
                                        <h3>Rating: 3/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-2" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>Williams Fresh Cafe Wifi</h2>
                                        </a>
                                        <h3>1309 Main St W, Hamilton, Ontario</h3>
                                        <h3>43.2574843,-79.9188905</h3>
                                        <br/>
                                        <h3>Rating: 4/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-3" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>Comp Sci Boys Wifi</h2>
                                        </a>
                                        <h3>1271 King St W, Hamilton, Ontario</h3>
                                        <h3>43.259926,-79.9169168</h3>
                                        <br/>
                                        <h3>Rating: 2/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-4" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>MDCL Student Wifi</h2>
                                        </a>
                                        <h3>1280 Main St W, Hamilton, Ontario</h3>
                                        <h3>43.2605415,-79.917716</h3>
                                        <br/>
                                        <h3>Rating: 5/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-5" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="individual_sample.php">
                                            <h2>Phoenix Bar Hotspot</h2>
                                        </a>
                                        <h3>1280 Main Street W., Hamilton, Ontario</h3>
                                        <h3>43.2620846,-79.9203285</h3>
                                        <br/>
                                        <h3>Rating: 5/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="large-sweeper"></div>
            </div>
        </div>
        <div class="footer"><!-- starting footer -->
            <h5 class="footer-text"> <!-- starting footer-text h5 tag -->
                All rights reserved, 2016. Simarpreet Singh. Made in Hamilton, ON.
            </h5><!-- ending footer-text h5 tag -->
        </div><!-- ending footer -->
        <script src="./js/results.js" type="text/javascript"></script>
        <script>
        var allResultsMap = new google.maps.Map(
        document.getElementById('searchAllResultsMap'), 
                { 
                    center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>), 
                    zoom: 15
                }
        );
        var marker = new google.maps.Marker({
            position: {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>},
            map: allResultsMap
        });
        marker.addListener('click', function() {
            new google.maps.InfoWindow({
                content: '<h3><?php echo $query; ?></h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
            }).open(allResultsMap, marker);
        });
        </script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->