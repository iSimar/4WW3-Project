// this function is called when the page loads
window.onload = function() {
  initResultsMap();
};

function initResultsMap() {
  //markers to set on the map
  const mockMarkers = [
      {
          name: 'BSB Hotspot',
          latitude:  43.2605813,
          longitude: -79.9216803
      },
      {
          name: 'Starbuck Coffee Shop',
          latitude:  43.2575522,
          longitude: -79.9188318
      },
      {
          name: 'Williams Fresh Cafe Wifi',
          latitude:  43.2574843,
          longitude: -79.9188905
      },
      {
          name: 'Starbuck Coffee Shop',
          latitude:  43.2575522,
          longitude: -79.9188318
      },
      {
          name: 'Comp Sci Boys Wifi',
          latitude:  43.259926,
          longitude: -79.9169168
      },
      {
          name: 'MDCL Student Wifi',
          latitude:  43.2605415,
          longitude: -79.917716
      },
      {
          name: 'Phoenix Bar Hotspot',
          latitude:  43.2620846,
          longitude: -79.9203285
      }

  ];
  var allResultsMap = new google.maps.Map(
        document.getElementById('searchAllResultsMap'), 
        { 
            center: new google.maps.LatLng(43.261433, -79.9222597), 
            zoom: 15
        }
  );
  var marker0 = new google.maps.Marker({
        position: {lat: mockMarkers[0].latitude, lng: mockMarkers[0].longitude},
        map: allResultsMap
  });
  marker0.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[0].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker0);
  });
  var marker1 = new google.maps.Marker({
        position: {lat: mockMarkers[1].latitude, lng: mockMarkers[1].longitude},
        map: allResultsMap
  });
  marker1.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[1].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker1);
  });
  var marker2 = new google.maps.Marker({
        position: {lat: mockMarkers[2].latitude, lng: mockMarkers[2].longitude},
        map: allResultsMap
  });
  marker2.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[2].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker2);
  });
  var marker3 = new google.maps.Marker({
        position: {lat: mockMarkers[3].latitude, lng: mockMarkers[3].longitude},
        map: allResultsMap
  });
  marker3.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[3].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker3);
  });
  var marker4 = new google.maps.Marker({
        position: {lat: mockMarkers[4].latitude, lng: mockMarkers[4].longitude},
        map: allResultsMap
  });
  marker4.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[4].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker4);
  });
  var marker5 = new google.maps.Marker({
        position: {lat: mockMarkers[5].latitude, lng: mockMarkers[5].longitude},
        map: allResultsMap
  });
  marker5.addListener('click', function() {
        new google.maps.InfoWindow({
            content: '<h3>'+mockMarkers[5].name+'</h3><a class="small-link" href="individual_sample.php">Learn More...</a>'
        }).open(allResultsMap, marker5);
  });

  for(var i = 0; i<mockMarkers.length-1; i++){
    var map = new google.maps.Map(
        document.getElementById('searchResultsMap-'+i), 
        { 
            center: new google.maps.LatLng(mockMarkers[i].latitude, mockMarkers[i].longitude), 
            zoom: 13
        }
    );
    var singleMarker= new google.maps.Marker({
        position: {lat: mockMarkers[i].latitude, lng: mockMarkers[i].longitude},
        map: map
    });
  }
}