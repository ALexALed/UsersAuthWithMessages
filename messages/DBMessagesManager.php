<?php

require('inc/settings.php');

/*
 * Класс для работы с БД
 */

class DBMessagesManager
{
    private $db_handle;

    function __construct()
    {
        $this->db_handle = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->db_handle->connect_errno) {
            new Logger("ОШИБКА: Не удалось подключиться к БД: {$this->$db_handle->connect_error}");
        }
    }

    function saveMessage($sender, $addresse, $text, $message_date)
    {
        $sender = $this->db_handle->real_escape_string(htmlspecialchars($sender));
        $addresse = $this->db_handle->real_escape_string(htmlspecialchars($addresse));
        $text = $this->db_handle->real_escape_string(htmlspecialchars($text));
        $message_date = $this->db_handle->real_escape_string(htmlspecialchars($message_date));
        $new_message = true;
        $sql = "INSERT INTO `messages`(`id`, `sender_id`, `addressee_id`, `text`, `new_message`, `message_date`) VALUES (null, $sender,$addresse, '$text', $new_message,'$message_date')";
        $res = $this->db_handle->query($sql);
        if (!$this->db_handle->affected_rows || !$res) {
            new Logger("ОШИБКА записи нового сообщения в БД " . $this->db_handle->sqlstate);
            return false;
        } else {
            return true;
        }

    }

    function getAllUserMessages($user_id, $only_new){

        $safe_id = $this->db_handle->real_escape_string(htmlspecialchars($user_id));
        if($only_new){
            $res = $this->db_handle->query("SELECT `id`, `sender_id`, `text`, `message_date`, `new_message` FROM `messages` WHERE (`addressee_id`=$safe_id AND new_message) ORDER BY message_date DESC");
        }else{
            $res = $this->db_handle->query("SELECT `id`, `sender_id`, `text`, `message_date`, `new_message` FROM `messages` WHERE `addressee_id`=$safe_id ORDER BY message_date DESC");
        }
        if ($res->num_rows) {
            $arr_messages = array();
            while ($row = $res->fetch_assoc()) {
                $arr_messages[] = $row;
            }
            $res->free();
            return $arr_messages;
        }else{
            return false;
        }
    }

    function getMessage($id){
        $safe_id = $this->db_handle->real_escape_string(htmlspecialchars($id));
        $res = $this->db_handle->query("SELECT `id`, `sender_id`, `addressee_id`, `text`, `new_message`, `message_date` FROM `messages` WHERE `id`=$safe_id");
        if ($res->num_rows) {
            return $res->fetch_assoc();
        }else{
            return false;
        }
    }

    function deleteMessage($id){
        $safe_id = $this->db_handle->real_escape_string(htmlspecialchars($id));
        $this->db_handle->query("DELETE FROM `messages` WHERE `id`=$safe_id");
        if ($this->db_handle->affected_rows) {
            return true;
        }else{
            return false;
        }
    }

    function unsetNewMessage($id){
        $safe_id = $this->db_handle->real_escape_string(htmlspecialchars($id));
        $this->db_handle->query("UPDATE `messages` SET `new_message`=FALSE WHERE `id`=$safe_id");
        if ($this->db_handle->affected_rows) {
            return true;
        }else{
            return false;
        }
    }

    function __destruct(){
        $this->db_handle->close();
    }
}