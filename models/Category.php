<?php

    class Category{
        private $id;
        private $name;

        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        // GETTERS 
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }

        // SETTERS 
        public function setId($id){
            $this->id = $id;
        }
        public function setName($name){
            $this->name = $this->db->real_escape_string($name);
        }

        public function getAll(){
            $categories = $this->db->query("SELECT * FROM categories ORDER BY id DESC");
            return $categories;
        }

        public function getOne(){
            $category = $this->db->query("SELECT * FROM categories WHERE id = {$this->getId()};");
            return $category->fetch_object();
        }
        
        public function getAllProductsByCategory(){
            $sql = "SELECT p.*, c.name AS 'category_name' FROM products p INNER JOIN categories c ON p.category_id = c.id WHERE p.category_id = {$this->getId()}";
            $products = $this->db->query($sql);
            return $products;
        }

        public function save(){
            $save = $this->db->query("INSERT INTO categories VALUES(NULL, '{$this->getName()}')");

            $result = false;
            if($save){
                $result = true;
            }

            return $result;
        }

        public function update(){
            $update = $this->db->query("UPDATE categories SET name = '{$this->getName()}' WHERE id = {$this->getId()}");

            $result = false;
            if($update){
                $result = true;
            }

            return $result;
        }

        public function delete(){
            $delete = $this->db->query("DELETE FROM categories WHERE id = {$this->getId()};");

            $result = false;
            if($delete){
                $result = true;
            }

            return $result;
        }
    }
?>