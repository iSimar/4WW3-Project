const useCurrentLocationButtonId = 'useCurrentLocation'; //id used for use current location button on search page
const searchTextBoxButtonId = 'searchTextBox'; //id used for search textbox field on search page
var currentLocationLocked = false;

// this function is called when the page loads
window.onload = function() {
  $('#'+useCurrentLocationButtonId).click(onClickUseCurrentLocation);
};

function onClickUseCurrentLocation() {
    if(!currentLocationLocked){ //if the use current location hasn't been clicked already'
        currentLocationLocked = true; //set the current location locked to true
        $('#'+useCurrentLocationButtonId).removeClass('underlined'); //remove underlined styled class from the current location button
        $('#'+useCurrentLocationButtonId).html('<h3>Finding your location...</h3>'); //change the current location button text
        if (navigator.geolocation) { //if browser can find the geo location
            navigator.geolocation.getCurrentPosition(function(position){ // find geo location pass callback function
                $('#'+searchTextBoxButtonId).val(position.coords.latitude+', '+position.coords.longitude);//change the current location button text
                $('#'+useCurrentLocationButtonId).html('<h3></h3>');
            });
        } else {
            $('#'+useCurrentLocationButtonId).html('<h3>Geolocation is not supported by this browser.</h3>'); //if geolocation is not supported show this
        }
    }
}