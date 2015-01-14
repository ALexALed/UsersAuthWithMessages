<?php
require("auth/UserSessionManager.php");
require('logger/Logger.php');
require("auth/UserManager.php");
require("lang_manage/LanguageManager.php");
require("messages/Message.php");

$current_page_address = 'new_message.php';

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

$user_data = false;
if ($_SESSION['session_username']) {
    $user = $_SESSION['session_username'];
    $user_data = User::getRegisteredUserByUserName($user);
    if (!$user_data){
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}

$addressee_id = $_GET["adressee"];

$all_adresses = User::getAllUsers();

if ($_POST['addressee'] && $_POST['text']) {
    $message = new Message($user_data, User::getUserById($_POST['addressee']), $_POST['text'], date('Y-m-d'));
    $message->saveMessage();
    header('Location: messages.php');
}





