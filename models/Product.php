<?php
    class Product{
        private $id;
        private $category_id;
        private $name;
        private $description;
        private $price;
        private $stock;
        private $offert;
        private $date;
        private $image;

        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        // GETTERS
        public function getId(){
            return $this->id;
        }
        public function getCategory_id(){
            return $this->category_id;
        }
        public function getName(){
            return $this->name;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getStock(){
            return $this->stock;
        }
        public function getOffert(){
            return $this->offert;
        }
        public function getDate(){
            return $this->date;
        }
        public function getImage(){
            return $this->image;
        }

        // SETTERS
        public function setId($id){
            $this->id = $id;
        }
        public function setCategory_id($category_id){
            $this->category_id = $category_id;
        }
        public function setName($name){
            $this->name = $this->db->real_escape_string($name);
        }
        public function setDescription($description){
            $this->description = $this->db->real_escape_string($description);
        }
        public function setPrice($price){
            $this->price = $this->db->real_escape_string($price);
        }
        public function setStock($stock){
            $this->stock = $this->db->real_escape_string($stock);
        }
        public function setOffert($offert){
            $this->offert = $this->db->real_escape_string($offert);
        }
        public function setDate($date){
            $this->date = $date;
        }
        public function setImage($image){
            $this->image = $image;
        }

        public function save(){
            $sql = "INSERT INTO products VALUES(NULL, {$this->getCategory_id()}, '{$this->getName()}', '{$this->getDescription()}', {$this->getPrice()}, {$this->getStock()}, 'NULL', CURDATE(), '";

            if($this->getImage() != null){
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

        public function getOne(){
            $product = $this->db->query("SELECT * FROM products WHERE id = {$this->getId()}");
            return $product->fetch_object();
        }

        public function getAll(){
            $products = $this->db->query("SELECT * FROM products ORDER BY id DESC");

            return $products;
        }

        public function getAllRandom(){
            $products = $this->db->query("SELECT * FROM products ORDER BY RAND()");
            return $products;
        }

        public function update(){
            $sql = "UPDATE products SET category_id = {$this->getCategory_id()}, name = '{$this->getName()}', description = '{$this->getDescription()}', price = {$this->getPrice()}, stock = {$this->getStock()} WHERE id = {$this->getId()}";

            if($this->getImage() != null){
                $sql .= ", image ='{$this->getImage()}'";
            }

            $update = $this->db->query($sql);

            $result = false;
            if($update){
                $result = true;
            }

            return $result;
        }

        public function delete(){
            $delete = $this->db->query("DELETE FROM products WHERE id = {$this->getId()}");

            $result = false;
            if($delete){
                $result = true;
            }

            return $result;
        }
        
        public function updateStock($stock){
            $sql = "UPDATE products SET stock = {$this->getStock()} - $stock WHERE id = {$this->getId()};";

            $update = $this->db->query($sql);

            $result = false;
            if($update){
                $result = true;
            }

            return $result;            
        }
    }
?>