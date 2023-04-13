<?php
    class Order{
        private $id;
        private $user_id;
        private $departament;
        private $city;
        private $address;
        private $cost;
        private $status;

        private $db;

        public function __construct(){
            $this->db = DataBase::connect();
        }

        // GETTERS 
        public function getId(){
            return $this->id;
        }
        public function getUser_id(){
            return $this->user_id;
        }
        public function getDepartament(){
            return $this->departament;
        }
        public function getCity(){
            return $this->city;
        }
        public function getAddress(){
            return $this->address;
        }
        public function getCost(){
            return $this->cost;
        }
        public function getStatus(){
            return $this->status;
        }

        // SETTERS
        public function setId($id){
            $this->id = $id;
        }
        public function setUser_id($user_id){
            $this->user_id = $user_id;
        }
        public function setDepartament($departament){
            $this->departament = $this->db->real_escape_string($departament);
        }
        public function setCity($city){
            $this->city = $this->db->real_escape_string($city);
        }
        public function setAddress($address){
            $this->address = $this->db->real_escape_string($address);
        }
        public function setCost($cost){
            $this->cost = $cost;
        }
        public function setStatus($status){
            $this->status = $status;
        }

        public function getAll(){
            $orders = $this->db->query("SELECT * FROM orders ORDER BY id DESC");
            return $orders;
        }

        public function save(){
            $sql = "INSERT INTO orders VALUES(NULL, {$this->getUser_id()}, '{$this->getDepartament()}', '{$this->getCity()}', '{$this->getAddress()}', {$this->getCost()}, 'confirm', CURDATE(), CURTIME())";

            $save = $this->db->query($sql);

            $result = false;
            if($save){
                $result = true;
            }

            return $result;
        }

        public function getlast(){
            $lastId = $this->db->query("SELECT * FROM orders WHERE user_id = {$this->getUser_id()} ORDER BY id DESC LIMIT 1");

            return $lastId->fetch_object();
        }

        public function getOne(){
            $sql = "SELECT * FROM orders WHERE id = {$this->getId()}";
            $order = $this->db->query($sql);
            return $order->fetch_object();
        }

        public function getProductsById(){
            $sql = "SELECT p.*, ol.unids FROM orders_lines ol 
                    INNER JOIN products p ON p.id = ol.product_id
                    WHERE ol.order_id = {$this->getId()};";

            $products = $this->db->query($sql);

            return $products;
        }

        public function getUserByOrderId(){
            $sql = "SELECT * FROM users WHERE id = (SELECT user_id FROM orders WHERE id = {$this->getId()})";
            $user = $this->db->query($sql);

            return $user->fetch_object();
        }

        public function getOrdersByUser(){
            $sql = "SELECT * FROM orders WHERE user_id = {$this->getUser_id()} ORDER BY id DESC";

            $orders = $this->db->query($sql);

            return $orders;
        }

        public function statusUpdate(){
            $sql = "UPDATE orders SET status = '{$this->getStatus()}' WHERE id = {$this->getId()}";

            $update = $this->db->query($sql);

            $result = false;
            if($update){
                $result = true;
            }

            return $result;
        }
    }
?>