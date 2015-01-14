<?php

require('inc/settings.php');

/*
 * Класс для работы с БД
 */

class DBUsersManager
{
    private $db_handle;

    function __construct()
    {
        $this->db_handle = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db_handle->connect_errno) {
            new Logger("ОШИБКА: Не удалось подключиться к БД: {$this->$db_handle->connect_error}");
        }
    }

    function saveUser($username, $password, $first_name, $last_name, $patronymic,
                      $birth_date, $locations, $marital_status,
                      $education, $experience, $contacts, $other, $photo_path, $user_lang_code)
    {
        if (!$this->isRegisteredUser($username)) {
            $username = $this->db_handle->real_escape_string(htmlspecialchars($username));
            $password = md5(md5($this->db_handle->real_escape_string(htmlspecialchars($password))));
            $first_name = $this->db_handle->real_escape_string(htmlspecialchars($first_name));
            $last_name = $this->db_handle->real_escape_string(htmlspecialchars($last_name));
            $patronymic = $this->db_handle->real_escape_string(htmlspecialchars($patronymic));
            $birth_date = date("Y-m-d",strtotime(str_replace('/', '-', ($this->db_handle->real_escape_string($birth_date)))));
            $locations = $this->db_handle->real_escape_string(htmlspecialchars($locations));
            $marital_status = $this->db_handle->real_escape_string(htmlspecialchars($marital_status));
            $education = $this->db_handle->real_escape_string(htmlspecialchars($education));
            $experience = $this->db_handle->real_escape_string(htmlspecialchars($experience));
            $contacts = $this->db_handle->real_escape_string(htmlspecialchars($contacts));
            $other = $this->db_handle->real_escape_string(htmlspecialchars($other));
            $photo_path = $this->db_handle->real_escape_string(htmlspecialchars($photo_path));
            $user_lang_code = $this->db_handle->real_escape_string(htmlspecialchars($user_lang_code));

            $sql = "INSERT INTO `users`(`id`, `first_name`, `last_name`, `patronymic`, `birth_date`, `locations`, `marital_status`, `education`, `experience`, `contacts`, `other`, `photo_path`, `username`, `password`, `user_lang_code`) VALUES (null, '$first_name', '$last_name', '$patronymic', '$birth_date', '$locations', '$marital_status', '$education', '$experience', '$contacts', '$other', '$photo_path', '$username', '$password', '$user_lang_code')";
            $res = $this->db_handle->query($sql);
            if (!$this->db_handle->affected_rows || !$res) {
                new Logger("ОШИБКА записи нового пользователя в БД " . $this->db_handle->sqlstate);
                return false;
            } else {
                return true;
            }
        }
    }

    function isRegisteredUser($username)
    {
        $safe_username = $this->db_handle->real_escape_string(htmlspecialchars($username));
        $res = $this->db_handle->query("SELECT id FROM users WHERE (username='$safe_username')");
        if ($res->num_rows) {
            return true;
        } else {
            return false;
        }
    }

    function authUser($username, $password)
    {
        $safe_username = $this->db_handle->real_escape_string(htmlspecialchars($username));
        $safe_password = md5(md5($this->db_handle->real_escape_string(htmlspecialchars($password))));
        $res = $this->db_handle->query("SELECT id FROM users WHERE (username='$safe_username' AND password='$safe_password')");
        if ($res->num_rows) {
            return true;
        } else {
            return false;
        }
    }

    function getAllUsers(){
        $res = $this->db_handle->query("SELECT username, id FROM users");
        if ($res->num_rows) {
            $arr_users = array();
            while ($row = $res->fetch_assoc()) {
                $arr_users[] = $row;
            }
            $res->free();
            return $arr_users;
        }else{
            return false;
        }
    }


    function getUserDataById($id){
        $safe_id = $this->db_handle->real_escape_string(htmlspecialchars($id));
        $res = $this->db_handle->query("SELECT id, username, password, first_name, last_name, patronymic, birth_date, locations, marital_status, education, experience, contacts, other, photo_path, user_lang_code FROM users WHERE id='$safe_id'");
        if ($res->num_rows) {
            return $res->fetch_assoc();
        }else{
            return false;
        }
    }

    function getUserData($username){
        $safe_username = $this->db_handle->real_escape_string(htmlspecialchars($username));
        $res = $this->db_handle->query("SELECT id, username, password, first_name, last_name, patronymic, birth_date, locations, marital_status, education, experience, contacts, other, photo_path, user_lang_code FROM users WHERE username='$safe_username'");
        if ($res->num_rows) {
            return $res->fetch_assoc();
        }else{
            return false;
        }
    }

    function __destruct(){
        $this->db_handle->close();
    }
}