<?php
    require_once 'models/User.php';

    class UserController{
        public function register(){
            require_once 'views/user/register.php';
        }

        public function save(){
            if(isset($_POST)){
                $name = isset($_POST['name']) ? trim($_POST['name']) : false;
                $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : false;
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['password']) ? trim($_POST['password']) : false;

                $input_error = false;
                if($name && $lastname && $email && $password){
                    $error = array();

                    // * VALIDACIONES *

                    // Campo nombre
                    if(!Utils::onlyLetters($name)){
                        $error['name'] = 'El campo Nombre solo puede contener letras';
                    }else if(!Utils::minAmount($name, 3)){
                        $error['name'] = 'El campo Nombre como minimo tiene que tener 3 letras';
                    }else if(!Utils::maxAmount($name, 20)){
                        $error['name'] = 'El campo Nombre como maximo puede tener 20 caracteres';
                    }

                    // Campo Apellidos
                    if(!Utils::onlyLetters($lastname)){
                        $error['lastname'] = 'El campo Apellidos solo puede contener letras';
                    }else if(!Utils::minAmount($lastname, 3)){
                        $error['lastname'] = 'El campo Apellidos como minimo tiene que tener 3 letras';
                    }else if(!Utils::maxAmount($lastname, 40)){
                        $error['lastname'] = 'El campo Apellidos como maximo puede tener 40 caracteres';
                    }

                    // Campo Email  

                    // Para verificar si el email introducido está en la base de datos ya que el campo email es un campo unico
                    $userEmail = new User();
                    $userEmail->setEmail(strtolower($email));
                    $getEmailUser = $userEmail->getByEmail();

                    if(!Utils::formatEmail($email)){
                        $error['email'] = 'El campo email tiene que tener un formato de correo electronico';
                    }else if(!Utils::maxAmount($email, 255)){
                        $error['email'] = 'El campo Contraseña como maximo puede tener 255 caracteres';
                    }else if($getEmailUser != null){
                        $error['email'] = 'El correo ingresado ya esta en uso';
                    }

                    // Campo contraseña
                    if(!Utils::minAmount($password, 8)){
                        $error['password'] = 'El campo Contraseña como minimo tiene que tener 8 letras';
                    }else if(!Utils::maxAmount($password, 255)){
                        $error['password'] = 'El campo Contraseña como maximo puede tener 255 caracteres';
                    }

                    // Campo foto de perfil (campo no obligatorio)
                    // Comprobando si tiene un formato de imagen
                    $flag = false;
                    if($_FILES['photo']['tmp_name'] != null){
                        $flag = true;

                        $mimetype = $_FILES['photo']['type'];
                        $photoname = time().'-'.$_FILES['photo']['name'];

                        if($mimetype != 'image/jpeg' && $mimetype != 'image/png' && $mimetype != 'image/jpg' && $mimetype != 'image/gif'){
                            $error['photo'] = 'el archivo subido no es una imagen';
                        }
                    }

                    if(empty($error)){
                        $user = new User();
                        $user->setName($name);
                        $user->setLastname($lastname);
                        $user->setEmail(strtolower($email));                       
                        $user->setPassword($password);

                        if($flag == true){
                            // Si no existe esta carpeta con esta ruta
                            if(!is_dir('uploads/profile-pictures')){
                                // Entonces que me lo cree
                                mkdir('uploads/profile-pictures', 0777, true);
                            }
                            
                            move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/profile-pictures/$photoname");
                            $user->setImage($photoname);
                        }

                        $save = $user->save();
                        if($save){
                            $_SESSION['create_acount'] = 'successful';
                        }else{
                            $_SESSION['create_acount'] = 'failed';
                            $input_error = true;
                        }
                    }else{
                        $input_error = true;
                    }
                }else{
                    $_SESSION["general_error"]['register'] = "Todos los campos dentro de este cuadro son obligatorios";
                    $input_error = true;
                }

                if($input_error == true){
                    $_SESSION['input_error'] = $error;

                    $_SESSION['input_old']['name'] = $name;
                    $_SESSION['input_old']['lastname'] = $lastname;
                     $_SESSION['input_old']['email'] = $email;
                }
            }
            
            header('Location:'.base_url.'user/register');
        }

        public function login(){
            if(isset($_POST)){
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['password']) ? trim($_POST['password']) : false;

                if($email && $password){
                    $user = new User();
                    $user->setEmail($email);
                    $us = $user->getByEmail();

                    if($us != null){
                        if(password_verify($password, $us->password)){
                            $_SESSION['user'] = $us;

                            if($us->rol == 'admin'){
                                $_SESSION['admin'] = true;
                            }
                        }else{
                            $_SESSION['general_error']['login'] = 'La contraseña que ingresaste es incorrecta';
                        }
                    }else{  
                        $_SESSION['general_error']['login'] = 'El correo proporcionado no está conectado a una cuenta';
                    }
                }else{
                    $_SESSION['general_error']['login'] = 'Los dos campos son necesarios para inicar sesión';
                }
            }

            header('Location:'.base_url);
        }

        public function logout(){
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
            }

            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }

            header('Location:'.base_url);
        }
    }

?>