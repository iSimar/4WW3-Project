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
                //show full width map with mutiple markers, used if the results are within 10 miles of each other
                $showFullMap=0;
                //noResults bool for no results message
                $noResults=1;
                
                //get the query and rating get variables
                $query=$_GET['query'];
                $rating=$_GET['rating'];

                //range of accepted values for rating otherwise set to any
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
                

                //google api endpoint for getting the geocode based on places, phrases, address and etc.
                $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($query)."&sensor=false&region=canada";

                //curl request to get the long and lat from the search query
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

                //connect to database
                include 'connect.php';
                if($query != ''){
                    //if query is not empty
                    if($rating == 'any'){
                        //and rating is any
                        //sql for getting object within 10 miles of the search query
                        //also gets the objects whose names match the query
                        $sql = "(SELECT id, name, latitude, longitude, website, imageURL, rating, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:long) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM hotspots HAVING distance < 10 ORDER BY distance) UNION (SELECT id, name, latitude, longitude, website, imageURL, rating, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:long) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM hotspots WHERE name LIKE '%:query%')";
                    }
                    else{
                        //and rating is a number
                        //sql for getting object within 10 miles of the search query
                        //also gets the objects whose names match the query
                        //set a filter on the rating
                        $sql = "(SELECT id, name, latitude, longitude, website, imageURL, rating, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:long) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM hotspots WHERE rating=:rating HAVING distance < 10 ORDER BY distance) UNION (SELECT id, name, latitude, longitude, website, imageURL, rating, ( 3959 * acos( cos( radians(:lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:long) ) + sin( radians(:lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM hotspots WHERE rating=:rating AND name LIKE '%:query%')";
                    }
                }
                else{
                    //empty search query
                    if($rating == 'any'){
                        //grab all objects in the db
                        $sql = "SELECT id, name, latitude, longitude, website, imageURL, rating FROM hotspots";
                    }
                    else{
                        //grab objects based on rating only
                        $sql = "SELECT id, name, latitude, longitude, website, imageURL, rating FROM hotspots WHERE rating=:rating";
                    }
                }
               
                //run the sql query on the db and set to hotspots
                $hotspots = $db->prepare($sql);
                $hotspots->bindParam(':lat', $lat);
                $hotspots->bindParam(':long', $long);
                $hotspots->bindParam(':query', $query);
                $hotspots->bindParam(':rating', $rating);
                $hotspots->execute();
                
                //forloop through hotspots
                foreach ($hotspots as $hotspot) {
                    $noResults = 0; //don't show the no results message
                    if($hotspot['distance']){
                        if($hotspot['distance'] <= 10){ //if there exists a object that is within 10 miles of the search query then show the full map
                            $showFullMap = 1;
                            break;
                        }
                    }
                }

            ?>
            <div class="inner-content search-results-inner-content">
                <h1 class="content-title">
                    Search Results
                </h1>
                <h2 class="content-title">
                    Wifi Hotspots <?php if($query!=''){ ?>around "<u><?php echo $query; ?></u>" <?php } ?>with <u><?php if($rating==='any'){ echo 'Any'; }else{ echo $rating.' Stars'; } ?></u> rating.
                </h2>
                <div class="small-sweeper"></div>
                <div class="blue-box search-results-search-box">
                    <h2>Redefine Search</h2>
                    <form action="results.php" method="GET">
                    <h2 class="small-h2">Location</h2>
                    <input type="search" class="textbox text-box-full-width" value="<?php echo $query; ?>" placeholder="(Optional)" name="query"/>
                    <h2 class="small-h2">Rating</h2>
                    <select class="dropdown" name="rating">
                      <option value="any" <?php if($rating==='any'){ echo 'selected'; } ?>>Any</option>
                      <option value="5" <?php if($rating==5){ echo 'selected'; } ?>>5 Stars</option>
                      <option value="4" <?php if($rating==4){ echo 'selected'; } ?>>4 Stars</option>
                      <option value="3" <?php if($rating==3){ echo 'selected'; } ?>>3 Stars</option>
                      <option value="2" <?php if($rating==2){ echo 'selected'; } ?>>2 Stars</option>
                      <option value="1" <?php if($rating==1){ echo 'selected'; } ?>>1 Stars</option>
                    </select>
                    <div class="small-sweeper"></div>
                    <input type="submit" class="button" value="Search"/>
                    </form>
                </div>
                <div class="search-results-results-box">
                    <?php
                    //show the full map if true
                    if($showFullMap){
                    ?>
                    <div class="flat-line"></div>
                    <div id="searchAllResultsMap" style="width:100%;height:300px"></div>
                    <div class="small-sweeper"></div>
                    <?php
                    }
                    ?>
                    <div class="flat-line"></div>
                    <?php
                    //show the no results message
                        if($noResults){
                    ?>
                        <h2 class="content-title">
                            No results were found.
                        </h2>
                    <?php
                        }
                    ?>
                    <table>
                        <?php
                        //for loop through hotspots to render the listview
                        $hotspots = $db->prepare($sql);
                        $hotspots->bindParam(':lat', $lat);
                        $hotspots->bindParam(':long', $long);
                        $hotspots->bindParam(':query', $query);
                        $hotspots->bindParam(':rating', $rating);
                        $hotspots->execute();
                        foreach ($hotspots as $hotspot) {
                        ?>
                        <tr>
                            <td>
                                <div class="search-results-result-box">
                                    <div id="searchResultsMap-<?php echo $hotspot['id']; ?>" class="small-map" style="width:180px;height:180px"></div>
                                    <div class="details">
                                        <a href="hotspot.php?id=<?php echo $hotspot['id']; ?>">
                                            <h2><?php echo $hotspot['name']; ?></h2>
                                        </a>
                                        <?php if($hotspot['website'] != ''){ ?>
                                            <h3><?php echo $hotspot['website']; ?></h3>
                                        <?php } ?>
                                        <h3><?php echo $hotspot['latitude']; ?>, <?php echo $hotspot['longitude']; ?></h3>
                                        <br/>
                                        <h3>Rating: <?php echo $hotspot['rating']; ?>/5 Stars</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="large-sweeper"></div>
            </div>
        </div>
        <?php include 'footer.php' ?>
        <script>
        <?php
        if($showFullMap){
        ?>
        var allResultsMap = new google.maps.Map(
        document.getElementById('searchAllResultsMap'), 
                { 
                    center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>), 
                    zoom: 15
                }
        );
        <?php
        }
        ?>
        <?php
        //forloop through the hotspots to map them on the full map and the individual maps
        $hotspots = $db->prepare($sql);
        $hotspots->bindParam(':lat', $lat);
        $hotspots->bindParam(':long', $long);
        $hotspots->bindParam(':query', $query);
        $hotspots->bindParam(':rating', $rating);
        $hotspots->execute();
        foreach ($hotspots as $hotspot) {
        ?>
        <?php
        if($showFullMap){
        ?>
        var marker<?php echo $hotspot['id']; ?> = new google.maps.Marker({
            position: {lat: <?php echo $hotspot['latitude']; ?>, lng: <?php echo $hotspot['longitude']; ?>},
            map: allResultsMap
        });
        marker<?php echo $hotspot['id']; ?>.addListener('click', function() {
            new google.maps.InfoWindow({
                content: '<h3><?php echo $hotspot['name']; ?></h3><a class="small-link" href="hotspot.php?id=<?php echo $hotspot['id']; ?>">Learn More...</a>'
            }).open(allResultsMap, marker<?php echo $hotspot['id']; ?>);
        });
        <?php
        }
        ?>
        
        var map = new google.maps.Map(
            document.getElementById('searchResultsMap-<?php echo $hotspot['id']; ?>'), 
            { 
                center: new google.maps.LatLng(<?php echo $hotspot['latitude']; ?>, <?php echo $hotspot['longitude']; ?>), 
                zoom: 13
            }
        );
        var singleMarker= new google.maps.Marker({
            position: {lat: <?php echo $hotspot['latitude']; ?>, lng: <?php echo $hotspot['longitude']; ?>},
            map: map
        });
        <?php    
        }
        ?>
        </script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->