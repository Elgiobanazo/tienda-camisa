<?php
    class User{
        private $id;
        private $name;
        private $lastname;
        private $email;
        private $password;
        private $rol;
        private $image;

        private $db;

        public function __construct(){
            $this->db = DataBase::connect();
        }

        // GETTERS 
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getLastname(){
            return $this->lastname;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getRol(){
            return $this->rol;
        }
        public function getImage(){
            return $this->image;
        }

        // SETTERS
        public function setId($id){
            $this->id = $id;
        }
        public function setName($name){
            $this->name = $this->db->real_escape_string($name);
        }
        public function setLastname($lastname){
            $this->lastname = $this->db->real_escape_string($lastname);
        }
        public function setEmail($email){
            $this->email = $this->db->real_escape_string($email);
        }
        public function setPassword($password){
            $this->password = $this->db->real_escape_string(password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]));
        }
        public function setRol($rol){
            $this->rol = $rol;
        }
        public function setImage($image){
            $this->image = $this->db->real_escape_string($image);
        }

        // metodos o acciones del objeto para traer datos de la base de datos
        public function save(){
            $sql = "INSERT INTO users VALUES(NULL, '{$this->getName()}', '{$this->getLastname()}', '{$this->getEmail()}' , '{$this->getPassword()}', 'user', '";

            if($this->getImage() != NULL){
                $sql .= "{$this->getImage()}";
            }
            $sql .= "');";

            $save = $this->db->query($sql);

            $result = false;
            if($save){
                $result = true;
            }

            return $result;
        }

        public function getByEmail(){
            $sql = "SELECT * FROM users WHERE email = '{$this->getEmail()}'";
            $user = $this->db->query($sql);

            return $user->fetch_object();
        } 
    }

?>