<?php
require("auth/UserSessionManager.php");
$session_manager = new UserSessionManager();
$session_manager->destroySession();
header('Location: login.php');