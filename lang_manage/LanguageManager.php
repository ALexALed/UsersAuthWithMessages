<?php

/*
 * Этот класс реализует многоязыковую поддержку
 */

class LanguageManager
{
    private $dict_data;

    function __construct($dict_file_name)
    {
        if ($dict_file_name !== '') {
            $this->dict_file_name = $dict_file_name;
            $file_data = file_get_contents($dict_file_name);
            if ($file_data) {
                $words_data = explode("\n", $file_data);
                foreach ($words_data as $word_value) {
                    $word_value = str_replace("{", "", $word_value);
                    $word_value = str_replace("}", "", $word_value);
                    $word_translate_array = explode(":", $word_value);
                    if (count($word_translate_array) == 2) {
                        $this->dict_data[$word_translate_array[0]] = $word_translate_array[1];
                    } else {
                        new Logger("ОШИБКА: Не удалось распарсить запись словаря $dict_file_name $word_value");
                    }
                }
            } else {
                new Logger("ОШИБКА: Не удалось открыть файл словаря $dict_file_name");
            }
        }
    }

    function get_word_translate($word)
    {
        $word_translate = $word;
        if (is_array($this->dict_data)) {
            $lword = strtolower($word);
            if (array_key_exists($lword, $this->dict_data)) {
                $word_translate = $this->dict_data[$lword];
            } else {
                new Logger("ОШИБКА: В словаре нет перевода для слова $word");
            }
         }
        return $word_translate;
    }

    function get_current_dict(){
        return $this->dict_data;
    }

    static function choiceLangDetect(){
        $lang = '';
        if (isset($_GET['lang'])){
            $lang = $_GET['lang'];
        }elseif (isset($_SESSION['lang'])){
            $lang = $_SESSION['lang'];
        }
        return $lang;
    }
}