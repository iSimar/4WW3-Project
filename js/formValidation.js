var registerFormFields = {
    fullName: {value: null, validate: 'alphabetic'},
    birthDate: {value: null, validate: 'date'},
    email: {value: null, validate: 'email'},
    phone: {value: null, validate: 'numeric'}
}; //variable holder of all the validation fields on register page this will be used to loop through the keys and add a suffix from below, it will also be used to hold the changed value
//below are constant variable strings they will be used to append to strings from registerFormFields array
const registerErrorBoxSuffix = 'RegisterErrorBox'; //Suffix used to generate the error box div tag id 
const registerErrorBoxTitleSuffix = 'RegisterErrorBoxTitle'; //Suffix used to generate the error box title  div tag id
const registerErrorBoxDescSuffix = 'RegisterErrorBoxDesc'; //Suffix used to generate the error box description  div tag id
const registerButtonId = 'registerButton'; //id used for register button in registeration form

var submissionFormFields = {
    url: {value: null, validate: 'url'}
};//variable holder of all the validation fields on submission page this will be used to loop through the keys and add a suffix from below, it will also be used to hold the changed value
//below are constant variable strings they will be used to append to strings from submissionFormFields array
const submissionErrorBoxSuffix = 'SubmissionErrorBox'; //Suffix used to generate the error box div tag id 
const submissionErrorBoxTitleSuffix = 'SubmissionErrorBoxTitle'; //Suffix used to generate the error box title  div tag id
const submissionErrorBoxDescSuffix = 'SubmissionErrorBoxDesc'; //Suffix used to generate the error box description  div tag id
const submitButtonId = 'submitButton'; //id used for submit button in submission form

// this function is called when the page loads
window.onload = function() {
  bindRegisterInputFieldsChange(); // function call to bind all the register fields with on change callback function
  bindSubmissionInputFieldsChange(); // function call to bind all the submission fields with on change callback function
  $('#'+registerButtonId).click(onClickRegisterButton); //set on click jquery call back function when the register button is clicked on the registration form page
  $('#'+submitButtonId).click(onClickSubmitButton); //set on click jquery call back function when the submit button is clicked on the submission form page
};

function bindRegisterInputFieldsChange(){
    for (var field in registerFormFields) {
        $('#'+field).bind('input', function(e) {
            var fieldName = e.target.id; //back up field name
            registerFormFields[fieldName] = {value: $(this).val(), validate: registerFormFields[fieldName].validate}; //set the value of the field in the registeration validation fields holder array
            //remove the .textbox-error style class of the registeration field input tag
            $('#'+fieldName).removeClass('textbox-error');
            //remove the correspondent error box of the registeration field by removing the .show style class of the div tag
            $('#'+fieldName+registerErrorBoxSuffix).removeClass('show');
        });
    }
}

function bindSubmissionInputFieldsChange(){
    for (var field in submissionFormFields) {
        $('#'+field).bind('input', function(e) {
            var fieldName = e.target.id; //back up field name
            submissionFormFields[fieldName] = {value: $(this).val(), validate: submissionFormFields[fieldName].validate}; //set the value of the field in the submission validation fields holder array
            //remove the .textbox-error style class of the submission field input tag
            $('#'+fieldName).removeClass('textbox-error');
            //remove the correspondent error box of the submission field by removing the .show style class of the div tag
            $('#'+fieldName+submissionErrorBoxSuffix).removeClass('show');
        });
    }
}

//called when the register button on the register form page is clicked
function onClickRegisterButton(){
    //loop through registeration field ids
    for (var field in registerFormFields) {
        var validateType = capitalize(registerFormFields[field].validate); //field validation type, capitalize first letter
        var validationFunction = window['validate'+validateType]; //window['stringhere'] makes a function using a string, so window['stringhere']() means stringhere()
        var validationFunctionResponse = validationFunction(registerFormFields[field].value);
        if(!validationFunctionResponse.isValid){ //validate the function value using the validationFunction
            //add .textbox-error style class to the input field tag
            $('#'+field).addClass('textbox-error');
            //add .show style class to the error box of the input field
            $('#'+field+registerErrorBoxSuffix).addClass('show');
            //set the inner html of the field error box title
            $('#'+field+registerErrorBoxTitleSuffix).html(validationFunctionResponse.error);
            //set the inner html of the field error box description
            $('#'+field+registerErrorBoxDescSuffix).html(validationFunctionResponse.details);
        }
    }
}

//called when the submit button on the submission form page is clicked
function onClickSubmitButton(){
    //loop through submission field ids
    for (var field in submissionFormFields) {
        var validateType = capitalize(submissionFormFields[field].validate); //field validation type, capitalize first letter
        var validationFunction = window['validate'+validateType]; //window['stringhere'] makes a function using a string, so window['stringhere']() means stringhere()
        var validationFunctionResponse = validationFunction(submissionFormFields[field].value);
        if(!validationFunctionResponse.isValid){ //validate the function value using the validationFunction
            //add .textbox-error style class to the input field tag
            $('#'+field).addClass('textbox-error');
            //add .show style class to the error box of the input field
            $('#'+field+submissionErrorBoxSuffix).addClass('show');
            //set the inner html of the field error box title
            $('#'+field+submissionErrorBoxTitleSuffix).html(validationFunctionResponse.error);
            //set the inner html of the field error box description
            $('#'+field+submissionErrorBoxDescSuffix).html(validationFunctionResponse.details);
        }
    }
}

//this function takes a string value and checks if all the characters in the string are alphabets, returns a boolean value
function validateAlphabetic(value){
   if(value){ //if value isn't null
    if(/^[a-zA-Z\s]+$/.test(value)){ //use regex to see if all the characters are between a to z or A to Z
        return {isValid: true, error: null, details: null};
    }
    return {isValid: false, error: 'Must be alphabetic', details: '"'+value+'" contains other characters than letters.'};
   }
   return {isValid: false, error:'Empty Field', details: 'Please fill out this field to resolve this issue.'};
}

//this function takes a string value and checks if it is in MM/DD/YYYY format date, returns a boolean value
function validateDate(value){
   if(value){ //if value isn't null
    if(/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(value)){
        if(/^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/.test(value)){ //use regex to check if the the string is in date format (mm/dd/yyyy)
            return {isValid: true, error: null, details: null};
        }
        return {isValid: false, error: 'Invalid date', details: '"'+value+'"  date is invalid or out of bound.'};
    }
    return {isValid: false, error: 'Must be in date format', details: '"'+value+'" is NOT in MM/DD/YYYY date format.'};
   }
   return {isValid: false, error:'Empty Field', details: 'Please fill out this field to resolve this issue.'};
}

//this function takes a string value and checks if it in email formate (ex: test213@test1231.com), returns  a boolean value
function validateEmail(value){
   if(value){ //if value isn't null
    if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)){ //use regex to see if value is valid email format
        return {isValid: true, error: null, details: null};
    }
    return {isValid: false, error: 'Invalid email', details: '"'+value+'" is NOT a valid email. An email should be in email@example.com format.'};
   }
   return {isValid: false, error:'Empty Field', details: 'Please fill out this field to resolve this issue.'};
}

//this function take a string value and checks if all the characters are numeric, returns a boolean value
function validateNumeric(value){
   if(value){ //if value isn't null
        if(/^[0-9]+$/.test(value)){ //use regex to see if all the characters are between 0 to 9
            return {isValid: true, error: null, details: null};
        }
        return {isValid: false, error: 'Must be numeric', details: '"'+value+'" contains other characters than numbers.'};
   }
   return {isValid: false, error:'Empty Field', details: 'Please fill out this field to resolve this issue.'};
}

//this function take a string value and checks if its in url format (ex: https://test.com), returns a boolean value
function validateUrl(value){
    if(value){ //if value isn't null
        if(/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/.test(value)){ //use regex to see if all the characters are between a to z or A to Z
            return {isValid: true, error: null, details: null};
        }
        return {isValid: false, error: 'Must be valid url', details: '"'+value+'" is NOT a valid URL. A url should in https://www.example.com format.'};
    }
   return {isValid: true, error: null, details: null};
}

//utils function to capitalize first letter of string s
function capitalize(s){
    return s[0].toUpperCase() + s.slice(1);
}