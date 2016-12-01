<!DOCTYPE html> <!-- indicating html5 document type -->
<html>  <!-- starting html tag -->
    <head> <!-- starting head tag -->
        <meta charset="UTF-8"> <!-- setting document character type -->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!-- meta tag to set the viewport to scale for mobile devices -->
        <!-- setting title tag of the page -->
        <title>Spotted Wifi | Search</title>
        <!-- fetch and link css stylesheet file to the html page -->
        <link rel="stylesheet" type="text/css" href="./style.css">
        <!-- fetch and link google font to html page -->
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
        <!-- import jquery 3.1.1 core -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    </head> <!-- ending head tag -->
    <body>
        <?php include 'header.php' ?>
        <div class="content homepage-content">
            <div class="gray-box search-box">
                <h1>
                    Search Wifi Hotspots
                </h1>
                <input type="search" class="textbox text-box-full-width search-textbox show" placeholder="Postal Code or Address" id="searchTextBox"/>
                <a class="small-link-2 underlined" id="useCurrentLocation">
                    <h3>Use Current Location</h3>
                </a>
                <span class="form-label">
                    Rating:
                </span>
                <select class="dropdown">
                  <option selected>Any</option>
                  <option>5 Stars</option>
                  <option>4 Stars</option>
                  <option>3 Stars</option>
                  <option>2 Stars</option>
                  <option>1 Stars</option>
                </select>
                <a href="results_sample.php" class="button search-button">  
                    Search
                </a>
            </div>
        </div>
        <div class="footer"><!-- starting footer -->
            <h5 class="footer-text"> <!-- starting footer-text h5 tag -->
                All rights reserved, 2016. Simarpreet Singh. Made in Hamilton, ON.
            </h5><!-- ending footer-text h5 tag -->
        </div><!-- ending footer -->
        <script src="./js/search.js" type="text/javascript"></script>
    </body><!-- ending body tag -->
</html><!-- ending html tag -->