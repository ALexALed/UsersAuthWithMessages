<?php
require("auth/UserSessionManager.php");
require('logger/Logger.php');
require("auth/UserManager.php");
require("lang_manage/LanguageManager.php");

$current_page_address = 'login.php';
$session_manager = new UserSessionManager();

$lang = LanguageManager::choiceLangDetect();
if ($lang=='rus'){
    $lang_manager = new LanguageManager(DICT_FILE_RUS);
}else {
    $lang_manager = new LanguageManager('');
}

$session_manager->registerLangInSession($lang);

$php_errors = '';

if ($session_manager->session_started()){
    header('Location: userinfo.php');
}

if ($_POST['username'] || $_POST['password']){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if (User::authUser($username, $password)){
        $session_manager->registerUserInSession($username);
        header('Location: userinfo.php');
    } else {
        $php_errors .= $lang_manager->get_word_translate("This login is not registered, or incorrect data");
    }
}
?>
