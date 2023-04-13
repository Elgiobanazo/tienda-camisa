<?php 
    class Utils{
        // * VALIDACIONES *

        // Solo letras (incluyendo ñ y vocales con tildes)
        public static function onlyLetters(String $input){
            return preg_match('/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/', $input);
        }
        // Cantidad minima de un campo
        public static function minAmount(String $input, Int $number){
            return strlen($input) >= $number;
        }
        // Cantidad maxmima de un campo
        public static function maxAmount(String $input, Int $number){
            return strlen($input) <= $number;
        }
        // para verificar si el input es un email
        public static function formatEmail(String $email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        } 
        // Para verificar si el input es un numero entero
        public static function isInt($input){
            return filter_var($input, FILTER_VALIDATE_INT);
        }
        // Para verificar si el input es un numero flotante
        public static function isFloat($input){
            return filter_var($input, FILTER_VALIDATE_FLOAT);
        }


        // Para borrar sesiones
        public static function sessionDelete($session){
            if(isset($_SESSION[$session])){
                unset($_SESSION[$session]);
            }
        }

        // Conseguir todas las categorias
        public static function getAllCategories(){
            require_once 'models/Category.php';
            $category = new Category();
            $categories = $category->getAll();

            return $categories;
        }

        public static function isUser(){
            if(!isset($_SESSION['user'])){
                header('Location:'.base_url);
            }
        }

        public static function isAdmin(){
            if(!isset($_SESSION['admin'])){
                header('Location:'.base_url);
            }
        }

        public static function cartStats(){
            $stats = array(
                'total' => 0,
                'products' => 0
            );

            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $value){
                    $stats['total'] = $stats['total'] + $value['price'] * $value['unids'];
                    $stats['products'] = $stats['products'] + $value['unids'];
                }
            }

            return $stats;
        }

        public static function showStatus($status){
            $message = 'Pendiente';

            switch($status){
                case 'confirm': $message = 'Pendiente'; break;
                case 'preparation': $message = 'En preparación'; break;
                case 'ready': $message = 'Preparado para enviar'; break;
                case 'sended': $message = 'Enviado'; break;
            }

            return $message;
        }

        public static function showHourFormat12($hour){
            // De esta manera podemos convertir el formato de 24 horas en el formato de 12 horas
            return date("g:i a", strtotime("$hour"));
        }

        public static function showDateFormatSpanish($date){
            /* Primer parametro del metodo createFromFormat() es el formato de origen, en el 
            que está escrita nuestra fecha inicial, y el segundo parametro es la cadena o 
            string con la fecha en dicho formato de origen */ 
            $dateTime = DateTime::createFromFormat("Y-m-d", $date);

            // Utilizamos el metodo format para darle el formato que nosotros queramos
            $newFormat = $dateTime->format("d/m/Y");

            return $newFormat;
        }

    }
?>