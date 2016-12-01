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
        <script async defer
            src="https://maps.googleapis.com/maps/api/js">
        </script>
    </head> <!-- ending head tag -->
    <body> <!-- starting body tag -->
        <?php include 'header.php' ?>
        <div class="content">
            <div class="inner-content search-results-inner-content">
                <h1 class="content-title">
                    Search Results
                </h1>
                <h2 class="content-title">
                    Wifi Hotspots around "<u>McMaster University</u>" with <u>Any</u> rating.
                </h2>
                <div class="small-sweeper"></div>
                <div class="blue-box search-results-search-box">
                    <h2>Redefine Search</h2>
                    <h2 class="small-h2">Location</h2>
                    <input type="search" class="textbox text-box-full-width" value="McMaster University" placeholder="(Optional)"/>
                    <h2 class="small-h2">Rating</h2>
                    <select class="dropdown">
                      <option selected>Any</option>
                      <option>5 Stars</option>
                      <option>4 Stars</option>
                      <option>3 Stars</option>
                      <option>2 Stars</option>
                      <option>1 Stars</option>
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
    </body><!-- ending body tag -->
</html><!-- ending html tag -->