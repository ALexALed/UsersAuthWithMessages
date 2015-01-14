<?php
    require('inc/login.inc.php');
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
<h3><?php echo $lang_manager->get_word_translate('To enter you must enter your credentials') ?></h3>
<div class="loginform">
    <div id="server_errors_field" class="server_errors_field"></div>
    <form action="login.php" method="post" id="loginform">
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
                <td></td>
                <td><input type="submit" value="<?php echo $lang_manager->get_word_translate('Enter') ?>"><a class="link" href="register.php"><?php echo $lang_manager->get_word_translate('Sign up') ?></a></td>
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
    form = document.getElementById('loginform');
    form.addEventListener("submit", loginFormSubmitListener);
</script>
</body>
</html>
