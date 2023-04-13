<?php
    require_once 'models/Order.php';
    require_once 'models/Product.php';
    require_once 'models/OrderLine.php';

    class OrderController{
        public function index(){
            $flag = false;
            if(isset($_SESSION['user'])){
                $flag = true;
            }

            require_once 'views/order/index.php';
        }

        public function save(){
            Utils::isAdmin();

            if(isset($_POST)){
                $departament = isset($_POST['departament']) ? trim($_POST['departament']) : false;
                $city = isset($_POST['city']) ? trim($_POST['city']) : false;
                $address = isset($_POST['address']) ? trim($_POST['address']) : false;

                $input_error = false;
                if($departament && $city && $address){
                    $error = array();

                    // Campo departamento
                    if(!Utils::onlyLetters($departament)){
                        $error['departament'] = 'El campo Departamento solo puede contener letras';
                    }else if(!Utils::minAmount($departament, 3)){
                        $error['departament'] = 'El campo Departamento como minimo tiene que tener 3 letras';
                    }else if(!Utils::maxAmount($departament, 30)){
                        $error['departament'] = 'El campo Departamento como maximo puede tener 30 letras';
                    }

                    // Campo ciudad
                    if(!Utils::onlyLetters($city)){
                        $error['city'] = 'El campo Ciudad solo puede contener letras';
                    }else if(!Utils::minAmount($city, 3)){
                        $error['city'] = 'El campo Ciudad como minimo tiene que tener 3 letras';
                    }else if(!Utils::maxAmount($city, 30)){
                        $error['city'] = 'El campo Ciudad como maximo puede tener 30 letras';
                    }

                    // Campo dirección
                    if(!Utils::minAmount($address, 10)){
                        $error['address'] = 'El campo Dirección como minimo tiene que tener 10 letras';
                    }else if(!Utils::maxAmount($address, 100)){
                        $error['address'] = 'El campo Dirección como maximo puede tener 100 letras';
                    }

                    if(empty($error)){
                        $user_id = $_SESSION['user']->id;

                        $order = new Order();
                        $order->setUser_id($user_id);
                        $order->setDepartament($departament);
                        $order->setCity($city);
                        $order->setAddress($address);

                        $stats = Utils::cartStats();
                        $order->setCost($stats['total']);

                        $save = $order->save();

                        $lastid = $order->getlast()->id;
                        $orderline = new OrderLine();  
                        
                        $product = new Product();

                        foreach($_SESSION['cart'] as $index => $value){
                            $orderline->setOrder_id($lastid);
                            $orderline->setProduct_id($value['product_id']);
                            $orderline->setUnids($value['unids']);

                            $product->setId($value['product_id']);
                            $pro = $product->getOne();

                            $product->setStock($pro->stock);

                            $updateStock = $product->updateStock($value['unids']);
                            $ordersave = $orderline->save();
                        }

                        if($ordersave && $save && $updateStock){
                            unset($_SESSION['cart']);
                            header('Location:'.base_url.'order/confirm');
                        }else{
                            $_SESSION['save_order'] = 'failed';
                            $input_error = true;
                        }                        
                    }else{
                        $input_error = true;
                    }
                }else{
                    $_SESSION["general_error"]['order'] = "Todos los campos dentro de este cuadro son obligatorios";
                    $input_error = true;
                }

                if($input_error){
                    $_SESSION['input_error'] = $error;

                    $_SESSION['input_old']['departament'] = $departament;
                    $_SESSION['input_old']['city'] = $city;
                    $_SESSION['input_old']['address'] = $address;

                    header('Location:'.base_url.'order/index');
                }
            }else{
                header('Location:'.base_url);
            }
        }

        public function confirm(){
            Utils::isUser();

            $order = new Order();   

            $order->setUser_id($_SESSION['user']->id);
            $last_id = $order->getLast();
            $order->setId($last_id->id);
            
            $dataOrder = $order->getOne();
            $products = $order->getProductsById();               

            require_once 'views/order/confirm.php';
        }

        public function management(){
            Utils::isAdmin();

            $order = new Order();
            $orders = $order->getAll();

            require_once 'views/order/management.php';
        }
        

        public function view(){
            Utils::isUser();

            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = (int)$_GET['id'];

                $order = new Order();
                $order->setId($id);
                $ord = $order->getOne();
                $user_id = (int)$_SESSION['user']->id;
                $order->setUser_id($user_id);

                $order_id = $order->getLast();
                $products = $order->getProductsById();
                $user = $order->getUserByOrderId();

                require_once 'views/order/view.php';
            }else{
                header('Location'.base_url);
            }
        }
        
        public function myorders(){
            Utils::isUser();

            $order = new Order();
            $user_id = (int)$_SESSION['user']->id;
            $order->setUser_id($user_id);
            $orders = $order->getOrdersByUser();
            require_once 'views/order/myorders.php';
        }

        public function statusUpdate(){
            Utils::isAdmin();

            if(isset($_POST['status']) && isset($_POST['id'])){
                $id = (int)$_POST['id'];
                $status = $_POST['status'];

                $order = new Order();
                $order->setId($id);
                $order->setStatus($status);
                $update = $order->statusUpdate();

                if($update){
                    $_SESSION['update_status'] = 'successful';
                }else{
                    $_SESSION['update_status'] = 'failed';
                }

                header('Location:'.base_url."order/view&id=$id");
            }else{
                header('Location:'.base_url);
            }
        }
    }
?>