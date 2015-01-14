<?php
require('inc/userinfo.inc.php');
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
<ul class="menu">
    <li><a href="messages.php"><?php echo $lang_manager->get_word_translate('Messages') ?></a></li>
    <li><a href="logout.php"><?php echo $lang_manager->get_word_translate('Logout') ?></a></li>
</ul>

<h3><?php echo $lang_manager->get_word_translate('Your credentials') ?></h3>

<div class="registerform">


    <div id="server_errors_field" class="server_errors_field"></div>

    <div class="userinfo">
    <table>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Login') ?>:</td>
            <td class="strong"><?php echo $user_data->username ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('First name') ?>:</td>
            <td class="strong"><?php echo $user_data->first_name ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Patronymic') ?>:</td>
            <td class="strong"><?php echo $user_data->patronymic ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Last name') ?>:</td>
            <td class="strong"><?php echo $user_data->last_name ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Birth date') ?>:</td>
            <td class="strong"><?php echo $user_data->birth_date ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Locations') ?>:</td>
            <td class="strong"><?php echo $user_data->locations ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Marital status') ?>:</td>
            <td class="strong"><?php echo $lang_manager->get_word_translate($user_data->marital_status) ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Education') ?>:</td>
            <td class="strong"><?php echo $user_data->education ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Experience') ?>:</td>
            <td class="strong"><?php echo $user_data->experience ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Contacts') ?>:</td>
            <td class="strong"><?php echo $user_data->contacts ?></td>
        </tr>
        <tr>
            <td><?php echo $lang_manager->get_word_translate('Other') ?>:</td>
            <td class="strong"><?php echo $user_data->other ?></td>
        </tr>
    </table>
    </div>
    <div class="foto">
        <img src="static/img/<?php echo $user_data->photo_path ?>" width="150" height="250">
    </div>
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
