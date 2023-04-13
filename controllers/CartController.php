<?php 
    require_once 'models/Product.php';

    class CartController{
        public function index(){
            $cart = null;
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
            }

            require_once 'views/cart/index.php';
        }

        public function add(){
            $product_id = (int)$_GET['id'];
            $flag = false;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $index => $value){
                    if($value['product']->id == $product_id){
                        $_SESSION['cart'][$index]['unids']++;
                        $flag = true;
                    }
                }
            }

            if(!$flag){
                $product = new Product();
                $product->setId($product_id);
                $pro = $product->getOne();

                $cart = array(
                    'product_id' => $pro->id,
                    'price' => $pro->price,
                    'unids' => 1,
                    'product' => $pro
                );

                $_SESSION['cart'][] = $cart;
            }
               
            header('Location:'.base_url.'cart/index');  
        }

        public function deleteone(){
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_GET['index'])){
                $index = (int)$_GET['index'];
                unset($_SESSION['cart'][$index]);

                header('Location:'.base_url.'cart/index');
            }else{
                header('Location:'.base_url);
            }
        }

        public function deleteall(){
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                unset($_SESSION['cart']);
            }

            header('Location:'.base_url.'cart/index');
        }

        public function up(){
            if(isset($_SESSION['cart']) && isset($_GET['index'])){
                $index = (int)$_GET['index'];

                $product_id = $_SESSION['cart'][$index]['product_id'];
                $product = new Product();
                $product->setId($product_id);
                $pro = $product->getOne();

                if($pro->stock - $_SESSION['cart'][$index]['unids'] > 0){
                    $_SESSION['cart'][$index]['unids']++;
                }else{
                    $_SESSION['error_cart'] = "Solo está disponible {$pro->stock} unidades del producto {$_SESSION['cart'][$index]['product']->name}";
                }
            }

            header('Location:'.base_url.'cart/index');
        }

        public function down(){
            if(isset($_SESSION['cart']) && isset($_GET['index'])){
                $index = (int)$_GET['index'];

                $_SESSION['cart'][$index]['unids']--;

                if($_SESSION['cart'][$index]['unids'] == 0){
                    unset($_SESSION['cart'][$index]);
                }
            }

            header('Location:'.base_url.'cart/index');
        }
    }

?>