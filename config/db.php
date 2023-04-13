<?php
    class DataBase{
        public static function connect(){
            $connection = new mysqli('localhost', 'root', "", 'tienda_camisa');
            $connection->query("SET NAMES utf8");
            return $connection;
        }
    }
?>