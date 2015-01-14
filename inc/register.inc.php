<?php
require("auth/UserSessionManager.php");
require('logger/Logger.php');
require("auth/UserManager.php");
require("lang_manage/LanguageManager.php");

$current_page_address = 'register.php';

$session_manager = new UserSessionManager();

$lang = LanguageManager::choiceLangDetect();
if ($lang == 'rus') {
    $lang_manager = new LanguageManager(DICT_FILE_RUS);
} else {
    $lang_manager = new LanguageManager('');
}

$session_manager->registerLangInSession($lang);

$php_errors = '';

if ($session_manager->session_started()) {
    header('Location: userinfo.php');
}

if ($_POST['username'] || $_POST['password']) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (User::isRegisteredUser($username)) {
        $php_errors .= $lang_manager->get_word_translate("This login is alredy registered");
    } else {
        $uploadfile = UPLOAD_DIR.basename($username.$_FILES['photo']['name']);
        if ($uploadfile) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
        }
        $new_user = new User($username, $password,
            $_POST['first_name'], $_POST['last_name'],
            $_POST['patronymic'], $_POST['birth_date'],
            $_POST['locations'], $_POST['marital_status'],
            $_POST['education'], $_POST['experience'],
            $_POST['contacts'], $_POST['other'],
            basename($uploadfile), $_SESSION["lang"]);
        $save_result = $new_user->save();
        if (!$save_result) {
            $php_errors .= $lang_manager->get_word_translate("Failed to write user data");
        } else {
            $session_manager->registerUserInSession($username);
            header('Location: userinfo.php');
        }
    }
}