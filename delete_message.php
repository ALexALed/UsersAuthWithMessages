<?php
require("auth/UserSessionManager.php");
require('logger/Logger.php');
require("auth/UserManager.php");
require("lang_manage/LanguageManager.php");
require("messages/Message.php");

$current_page_address = 'view_message.php';

$session_manager = new UserSessionManager();

$lang = LanguageManager::choiceLangDetect();
if ($lang == 'rus') {
    $lang_manager = new LanguageManager(DICT_FILE_RUS);
} else {
    $lang_manager = new LanguageManager('');
}

$session_manager->registerLangInSession($lang);

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

$msg_id = $_GET["id"];

$msg = Message::getMessage($msg_id);

if (!$msg){
    header('Location: messages.php');
}

if ($user_data->id != $msg->addresse->id){
    header('Location: messages.php');
}

$msg->deleteMessage();
header('Location: messages.php');