<?php 
    class OrderLine{
        private $id;
        private $order_id;
        private $product_id;
        private $unids;

        private $db;

        public function __construct(){
            $this->db = DataBase::connect();
        }

        // GETTERS
        public function getId(){
            return $this->id;
        }
        public function getOrder_id(){
            return $this->order_id;
        }
        public function getProduct_id(){
            return $this->product_id;
        }
        public function getUnids(){
            return $this->unids;
        }

        // SETTERS
        public function setId($id){
            $this->id = $id;
        }
        public function setOrder_id($order_id){
            $this->order_id = $order_id;
        }
        public function setProduct_id($product_id){
            $this->product_id = $product_id;
        }
        public function setUnids($unids){
            $this->unids = $unids;
        }  

        public function save(){
            $sql = "INSERT INTO orders_lines VALUES(NULL, {$this->getOrder_id()}, {$this->getProduct_id()}, {$this->getUnids()})";
            $save = $this->db->query($sql);

            $result = false;
            if($save){
                $result = true;
            }

            return $result;
        }
    }
?>