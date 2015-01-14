<?php

require("DBMessagesManager.php");

class Message{
    private $sender;
    private $addresse;
    private $text;
    private $message_date;
    private $new_message;
    private $id;
    private $db_message_manager;

    function __construct($sender, $addresse, $text, $message_date){
        $this->sender = $sender;
        $this->addresse = $addresse;
        $this->text = $text;
        $this->message_date = $message_date;
    }

    function saveMessage(){
        $this->createDBMessageManager();
        return $this->db_message_manager->saveMessage($this->sender->id, $this->addresse->id, $this->text, $this->message_date);
    }

    /*
     * Доступ к членам класса
     */
    function __get($name){
        return $this->$name;
    }

    static function getAllUserMessages($user, $only_new){
        $db_message_manager = new DBMessagesManager();
        $db_messages_array = $db_message_manager->getAllUserMessages($user->id, $only_new);
        $messages_array = array();
        if (is_array($db_messages_array)) {
            foreach ($db_messages_array as $value) {
                $msg = new Message(User::getUserById($value['sender_id']),
                    User::getUserById($value['addressee_id']), $value['text'],
                    $value['message_date']);
                $msg->id = $value['id'];
                $msg->new_message = $value['new_message'];
                $messages_array[] = $msg;
            }
        }
        return $messages_array;
    }

    static function getMessage($id){
        $db_message_manager = new DBMessagesManager();
        $message_array = $db_message_manager->getMessage($id);
        $msg = new Message(User::getUserById($message_array['sender_id']),
            User::getUserById($message_array['addressee_id']), $message_array['text'],  $message_array['message_date']);
        $msg->id = $message_array['id'];
        $msg->new_message = $message_array['new_message'];
        return $msg;
    }

    function deleteMessage(){
        $db_message_manager = new DBMessagesManager();
        return $db_message_manager->deleteMessage($this->id);
    }

    function unsetNewMessage(){
        $db_message_manager = new DBMessagesManager();
        return $db_message_manager->unsetNewMessage($this->id);
    }

    public function __toString(){
        return $this->$sender." ".$this->text;
    }

    /*
     * Менеджер для работы с БД
     */
    private function createDBMessageManager(){
        if(!$this->db_message_manager){
            $this->db_message_manager = new DBMessagesManager();
        }
    }






}