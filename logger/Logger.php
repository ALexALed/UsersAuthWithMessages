<?php

require('inc/settings.php');

/*
 * Простое логгирование
 */
class Logger{
    function __construct($log_info){
        file_put_contents(LOG_FILE, $log_info."\n", FILE_APPEND | LOCK_EX);
    }
}