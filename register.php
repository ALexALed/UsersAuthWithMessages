<?php
    require('inc/register.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include('inc/head.inc.html');
    ?>
</head>
<body>
<?php
    include('lang_manage/lang_menu.inc.html');
?>
<h3><?php echo $lang_manager->get_word_translate('To register, please fill in the form') ?></h3>
<div class="registerform">
    <div id="server_errors_field" class="server_errors_field"></div>
    <form enctype="multipart/form-data" action="register.php" method="post" id="registerform">
        <table>
            <tr>
                <td><label for="username"><?php echo $lang_manager->get_word_translate('Login') ?>:</label></td>
                <td><input type="text" name="username" id="username"></td>
                <td>
                    <div id="username_help"></div>
                    <div id="username_error"></div>
                </td>
            </tr>
            <tr>
                <td><label for="password"><?php echo $lang_manager->get_word_translate('Password') ?>:</label></td>
                <td><input type="password" name="password" id="password"></td>
                <td>
                    <div id="password_help"></div>
                    <div id="password_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="first_name"><?php echo $lang_manager->get_word_translate('First name') ?>:</label></td>
                <td><input type="text" name="first_name" id="first_name"></td>
                <td>
                    <div id="first_name_help"></div>
                    <div id="first_name_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="patronymic"><?php echo $lang_manager->get_word_translate('Patronymic') ?>:</label></td>
                <td><input type="text" name="patronymic" id="patronymic"></td>
                <td>
                    <div id="patronymic_help"></div>
                    <div id="patronymic_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="last_name"><?php echo $lang_manager->get_word_translate('Last name') ?>:</label></td>
                <td><input type="text" name="last_name" id="last_name"></td>
                <td>
                    <div id="last_name_help"></div>
                    <div id="last_name_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="birth_date"><?php echo $lang_manager->get_word_translate('Birth date') ?>:</label></td>
                <td><input type="text" name="birth_date" id="birth_date"></td>
                <td>
                    <div id="birth_date_help"></div>
                    <div id="birth_date_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="locations"><?php echo $lang_manager->get_word_translate('Locations') ?>:</label></td>
                <td><input type="text" name="locations" id="locations"></td>
                <td>
                    <div id="locations_help"></div>
                    <div id="locations_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="marital_status"><?php echo $lang_manager->get_word_translate('Marital status') ?>
                        :</label></td>
                <td><select name="marital_status" id="marital_status">
                        <option selected value="single"><?php echo $lang_manager->get_word_translate('Single') ?></option>
                        <option value="married"><?php echo $lang_manager->get_word_translate('Married') ?></option>
                    </select>
                </td>
                <td>
                    <div id="marital_status_help"></div>
                    <div id="marital_status_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="education"><?php echo $lang_manager->get_word_translate('Education') ?>:</label></td>
                <td><textarea name="education" id="education" rows="10" cols="45"></textarea></td>
                <td>
                    <div id="education_help"></div>
                    <div id="education_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="experience"><?php echo $lang_manager->get_word_translate('Experience') ?>:</label></td>
                <td><textarea name="experience" id="experience" rows="10" cols="45"></textarea></td>
                <td>
                    <div id="experience_help"></div>
                    <div id="experience_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="contacts"><?php echo $lang_manager->get_word_translate('Contacts') ?>:</label></td>
                <td><textarea name="contacts" id="contacts" rows="10" cols="45"></textarea></td>
                <td>
                    <div id="contacts_help"></div>
                    <div id="contacts_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="other"><?php echo $lang_manager->get_word_translate('Other') ?>:</label></td>
                <td><textarea name="other" id="other" rows="10" cols="45"></textarea></td>
                <td>
                    <div id="other_help"></div>
                    <div id="other_error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="photo"><?php echo $lang_manager->get_word_translate('Photo') ?>:</label></td>
                <td><input type="file" name="photo" id="photo" accept="image/gif,image/jpeg,image/png"></td>
                <td>
                    <div id="photo_help"></div>
                    <div id="photo_error"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?php echo $lang_manager->get_word_translate('Sign up') ?>"></td>
                <td></td>
            </tr>
        </table>
    </form>
</div>
<script>
    var php_errs = '<?php echo $php_errors ?>';
    serverErrorsEnableDisable(php_errs, true);
    var dict_array = <?php echo json_encode($lang_manager->get_current_dict()); ?>;
    elementHelpEnableDisable('username', '<?php echo $lang_manager->get_word_translate('User login must consist of numbers and letters of the Latin alphabet') ?>');
    elementHelpEnableDisable('password', '<?php echo $lang_manager->get_word_translate('The password should consist of numbers and letters of the Latin alphabet') ?>');
    elementHelpEnableDisable('birth_date', '<?php echo $lang_manager->get_word_translate('Date of birth must be in the format DD/MM/YYYY') ?>');
    form = document.getElementById('registerform');
    form.addEventListener("submit", signupFormSubmitListener);
</script>
</body>
</html>
