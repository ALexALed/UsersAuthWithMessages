<?php

/*
 * Класс для работы с сессиями
 */
class UserSessionManager
{
    private $session_username;

    function __construct()
    {
        session_start();
        $this->session_username = $_SESSION["session_username"];
    }

    /*
     * Опеределяет авторизацию пользователя
     */
    function session_started()
    {
        if (isset($this->session_username)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Регистрирует пользователя в сессии
     */
    function registerUserInSession($username)
    {
        $_SESSION["session_username"] = $username;
    }

    /*
     * Регистрирует язык в сессии
     */
    function registerLangInSession($lang)
    {
        $_SESSION["lang"] = $lang;
    }

    /*
     * Уничтожает сессию
     */
    function destroySession(){
        session_destroy();
    }

}

