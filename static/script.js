function elementHelpEnableDisable(elem_id, help_text) {
    var elem = document.getElementById(elem_id);
    var help_elem = document.getElementById(elem_id + '_help');
    elem.onfocus = function () {
        help_elem.classList.add('help');
        help_elem.innerHTML = help_text;
     };
    elem.onblur = function () {
        help_elem.classList.remove('help');
        help_elem.innerHTML = "";
    };
}

function elementErrorEnableDisable(elem_id, error_text, enable) {
    var error_elem = document.getElementById(elem_id + '_error');
    if(enable && error_text){
        error_elem.classList.add('error');
        error_elem.innerHTML = error_text;
    } else {
        error_elem.classList.remove('error');
        error_elem.innerHTML = "";
    }
}

function serverErrorsEnableDisable(errs, enable){
    var error_elem = document.getElementById('server_errors_field');
    if (enable){
        if (errs){
            error_elem.classList.add('error');
            error_elem.innerHTML = errs;
        }
    }else {
        error_elem.classList.remove('error');
        error_elem.innerHTML = "";
    }
}

function validateLoginPasswordValue(base_element_id, field_name){
    var base_elem = document.getElementById(base_element_id).value;

    if (!base_elem){
        return field_name+' can not be empty';
    }

    if (/^[a-zA-Z1-9]+$/.test(base_elem) === false) {
        return 'In the '+field_name+' must be only numbers and letters';
    }
    if (base_elem.length < 4 || base_elem.length > 20) {
        return 'In the '+field_name+' must be between 4 and 20 characters';
    }
    if (parseInt(base_elem.substr(0, 1))) {
        return field_name+' must begin with a letter';
    }
}

function loginFormSubmitListener(evt) {
    var js_errs = false;
    var username_val_res = validateLoginPasswordValue('username', 'Login');
    elementErrorEnableDisable('username', get_translate_word(dict_array, username_val_res), true);
    var password_val_res = validateLoginPasswordValue('password', 'Password');
    elementErrorEnableDisable('password', get_translate_word(dict_array, password_val_res), true);

    if (username_val_res || password_val_res){
        js_errs = true;
    }

    if (js_errs || php_errs) {
        evt.preventDefault();
        php_errs = '';
        return false;
    }
}

function get_translate_word(dict_arr, word){
    if (dict_arr == null || !word || !(word.toLowerCase() in dict_arr)) {
        return word;
    }else{
        return dict_arr[word.toLowerCase()];
    }
}

function check_date(date_element_id) {
    var datevalue = document.getElementById(date_element_id).value;
    re = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
    if (datevalue!= '') {
        if (regs = datevalue.match(re)) {
           dateObj = new Date(regs[3], regs[2]-1, regs[1]);
            if (!(dateObj.getFullYear() == regs[3]
            && dateObj.getMonth() == regs[2]-1
            && dateObj.getDate() == regs[1])) {
                return "Invalid date";
            }
        } else {
                return "Invalid date format";
        }
    }
}

function signupFormSubmitListener(evt) {
    var js_errs = false;
    var username_val_res = validateLoginPasswordValue('username', 'Login');
    elementErrorEnableDisable('username', get_translate_word(dict_array, username_val_res), true);
    var password_val_res = validateLoginPasswordValue('password', 'Password');
    elementErrorEnableDisable('password', get_translate_word(dict_array, password_val_res), true);
    var date_error = check_date('birth_date');
    elementErrorEnableDisable('birth_date', get_translate_word(dict_array, date_error), true);
    var first_name_error = fieldEmptyCheck('first_name', 'First name');
    elementErrorEnableDisable('first_name', get_translate_word(dict_array, first_name_error), true);
    var last_name_error = fieldEmptyCheck('last_name', 'Last name');
    elementErrorEnableDisable('last_name', get_translate_word(dict_array, last_name_error), true);
    var patronymic_error = fieldEmptyCheck('patronymic', 'Patronymic');
    elementErrorEnableDisable('patronymic', get_translate_word(dict_array, patronymic_error), true);

    if (username_val_res || password_val_res || date_error || first_name_error || last_name_error || patronymic_error){
        js_errs = true;
    }

    if (js_errs || php_errs) {
        evt.preventDefault();
        php_errs = '';
        return false;
    }
}

function fieldEmptyCheck(field_id, field_name){
    var field_value = document.getElementById(field_id).value;
    if (!field_value){
        return field_name + ' is empty';
    }
}


function newmessageFormSubmitListener(evt) {
    var text_error = fieldEmptyCheck('text', 'Text');
    serverErrorsEnableDisable(text_error, true);

    if (text_error) {
        evt.preventDefault();
        return false;
    }
}