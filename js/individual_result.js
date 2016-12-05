// this function is called when the page loads
window.onload = function() {
  initIndividualResultMap(); //init result map
};


// function initIndividualResultMap(){
//     var indiviualResultMap = new google.maps.Map(
//         document.getElementById('indiviualResultMap'),  //id of the result map
//         { 
//             center: new google.maps.LatLng(43.2575522, -79.9188318),  //center long lat
//             zoom: 16 //zoom level
//         }
//    );
//    var marker = new google.maps.Marker({
//         position: {lat: 43.2575522, lng: -79.9188318}, //marker
//         map: indiviualResultMap //map to set the marker
//   });
// }