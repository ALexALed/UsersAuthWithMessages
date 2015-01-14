<?php
require("auth/UserSessionManager.php");
require('logger/Logger.php');
require("auth/UserManager.php");
require("lang_manage/LanguageManager.php");

$current_page_address = 'userinfo.php';

$session_manager = new UserSessionManager();

$lang = LanguageManager::choiceLangDetect();
if ($lang == 'rus') {
    $lang_manager = new LanguageManager(DICT_FILE_RUS);
} else {
    $lang_manager = new LanguageManager('');
}

$session_manager->registerLangInSession($lang);

$php_errors = '';

if (!$session_manager->session_started()) {
    header('Location: login.php');
}

if ($_SESSION['session_username']) {
    $user = $_SESSION['session_username'];
    $user_data = User::getRegisteredUserByUserName($user);
    if (!$user_data){
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}