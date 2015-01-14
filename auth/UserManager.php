<?php

require("DBUsersManager.php");

/*
 * Класс для работы с пользователями
 */
class User{
    private $first_name;
    private $last_name;
    private $patronymic;
    private $birth_date;
    private $locations;
    private $marital_status;
    private $education;
    private $experience;
    private $contacts;
    private $other;
    private $photo_path;
    private $user_lang_code;
    private $username;
    private $password;
    private $id;
    private $db_user_manager;

    function __construct($username, $password, $first_name, $last_name, $patronymic,
                         $birth_date, $locations, $marital_status,
                         $education, $experience, $contacts, $other, $photo_path, $user_lang_code){

        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->patronymic = $patronymic;
        $this->birth_date = $birth_date;
        $this->locations = $locations;
        $this->marital_status = $marital_status;
        $this->education = $education;
        $this->experience = $experience;
        $this->contacts = $contacts;
        $this->other = $other;
        $this->photo_path = $photo_path;
        $this->user_lang_code = $user_lang_code;
        $this->username = $username;
        $this->password = $password;
    }

    /*
     * Доступ к членам класса
     */
    function __get($name){
        return $this->$name;
    }

    /*
     * Статический метод для определения зарегистрированных логинов
     */
    static function isRegisteredUser($username){
        $db_user_manager = new DBUsersManager();
        return $db_user_manager->isRegisteredUser($username);
    }

    static function authUser($username, $password){
        $db_user_manager = new DBUsersManager();
        return $db_user_manager->authUser($username, $password);
    }


    /*
     * Получает данные зарегистрированного пользователя
     */
    static function getRegisteredUserByUserName($username){
        $db_user_manager = new DBUsersManager();

        $user_fields_arr = $db_user_manager->getUserData($username);
        if ($user_fields_arr){
                $user_obj = new User($user_fields_arr['username'], $user_fields_arr['password'],
                $user_fields_arr['first_name'], $user_fields_arr['last_name'], $user_fields_arr['patronymic'],
                $user_fields_arr['birth_date'], $user_fields_arr['locations'], $user_fields_arr['marital_status'],
                $user_fields_arr['education'], $user_fields_arr['experience'], $user_fields_arr['contacts'],
                $user_fields_arr['other'], $user_fields_arr['photo_path'], $user_fields_arr['user_lang_code']);
            $user_obj->id = $user_fields_arr['id'];
            return $user_obj;
        } else {
            return false;
        }
    }

    static function getUserById($id){
        $db_user_manager = new DBUsersManager();

        $user_fields_arr = $db_user_manager->getUserDataById($id);
        if ($user_fields_arr){
            $user_obj = new User($user_fields_arr['username'], $user_fields_arr['password'],
                $user_fields_arr['first_name'], $user_fields_arr['last_name'], $user_fields_arr['patronymic'],
                $user_fields_arr['birth_date'], $user_fields_arr['locations'], $user_fields_arr['marital_status'],
                $user_fields_arr['education'], $user_fields_arr['experience'], $user_fields_arr['contacts'],
                $user_fields_arr['other'], $user_fields_arr['photo_path'], $user_fields_arr['user_lang_code']);
            $user_obj->id = $user_fields_arr['id'];
            return $user_obj;
        } else {
            return false;
        }
    }

    static function getAllUsers(){
        $db_user_manager = new DBUsersManager();
        return $db_user_manager->getAllUsers();
    }

    /*
     * Сохранение пользователя в БД
     */
    public function save(){
        $this->createDBUserManager();
        return $this->db_user_manager->saveUser($this->username, $this->password, $this->first_name,
            $this->last_name, $this->patronymic, $this->birth_date, $this->locations, $this->marital_status,
            $this->education, $this->experience, $this->contacts, $this->other, $this->photo_path, $this->user_lang_code);
    }

    public function __toString(){
        return $this->username;
    }

    /*
     * Менеджер для работы с БД
     */
    private function createDBUserManager(){
        if(!$this->db_user_manager){
            $this->db_user_manager = new DBUsersManager();
        }
    }

}