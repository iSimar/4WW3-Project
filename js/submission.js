const useCurrentLocationButtonId = 'useCurrentLocation'; //id used for use current location button on search page
const longitudeTextboxId = 'longitudeTextbox'; //id used for search textbox field on search page
const latitudeTextboxId = 'latitudeTextbox';
var currentLocationLocked = false;

function onClickUseCurrentLocation() {
    if(!currentLocationLocked){ //if the use current location hasn't been clicked already'
        currentLocationLocked = true; //set the current location locked to true
        $('#'+useCurrentLocationButtonId).removeClass('underlined'); //remove underlined styled class from the current location button
        $('#'+useCurrentLocationButtonId).html('<h3>Finding your location...</h3>'); //change the current location button text
        if (navigator.geolocation) { //if browser can find the geo location
            navigator.geolocation.getCurrentPosition(function(position){ // find geo location pass callback function
                $('#'+useCurrentLocationButtonId).addClass('hide'); //add hide class - hides the current location button
                $('#'+longitudeTextboxId).val(position.coords.latitude); //fill the latitude textbox
                $('#'+latitudeTextboxId).val(position.coords.longitude); //fill the longitude textbox
            });
        } else {
            $('#'+useCurrentLocationButtonId).html('<h3>Geolocation is not supported by this browser.</h3>'); //if geolocation is not supported show this
        }
    }
}