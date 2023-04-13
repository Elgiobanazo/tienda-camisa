<?php 
    require_once 'models/Product.php';

    class ProductController{
        public function index(){
            $product = new Product();
            $products = $product->getAllRandom();

            require_once 'views/product/index.php';
        }

        public function create(){
            Utils::isAdmin();
            require_once 'views/product/create.php';
        }

        public function save(){
            Utils::isAdmin();
            
            if(isset($_POST)){
                $name = isset($_POST['name']) ? trim($_POST['name']) : false;
                $price = isset($_POST['price']) ? trim($_POST['price']) : false;
                $description = isset($_POST['description']) ? trim($_POST['description']) : false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
                $category_id = isset($_POST['category']) ? $_POST['category'] : false;

                $input_error = false;
                $error = array();

                if($name && $price && $description && $stock && $category_id){
                    // Campo nombre
                    if(!Utils::minAmount($name, 5)){
                        $error['name'] = 'El campo Nombre como minimo tiene que tener 5 caracteres';
                    }else if(!Utils::maxAmount($name, 50)){
                        $error['name'] = 'El campo Nombre como maximo puede tener 50 caracteres';
                    }

                    // Campo precio
                    if(!Utils::isFLoat($price)){
                        $error['price'] = 'El campo Precio solo puede contener numeros flotantes';
                    }

                    // Campo descripcion
                    if(!Utils::minAmount($description, 10)){
                        $error['description'] = 'El campo Descripción como minimo tiene que tener 10 caracteres';
                    }else if(!Utils::maxAmount($description, 3000)){
                        $error['description'] = 'El campo Descripción como maximo puede tener 3000 caracteres';
                    }

                    // Campo stock
                    if(!Utils::isInt($stock)){
                        $error['stock'] = 'El campo Stock solo puede contener numeros enteros';
                    }

                    // Campo categoria
                    if(!Utils::isInt($category_id)){
                        $error['category'] = 'El campo Categoria solo puede contener numeros enteros';
                    }

                    // Campo foto
                    $photo_pass = false;
                    if($_FILES['photo']['tmp_name'] != null){
                        $mimetype = $_FILES['photo']['type'];
                        $photo_name = time().'-'.$_FILES['photo']['name'];
                        $photo_pass = true;

                        // Comprobacion del formato del archivo enviado
                        if($mimetype != 'image/jpeg' && $mimetype != 'image/png' && $mimetype != 'image/jpg' && $mimetype != 'image/gif'){
                            $error['photo'] = 'el archivo subido no es una imagen';
                        }
                    }

                    if(empty($error)){
                        $product = new Product();
                        $product->setName($name);
                        $product->setPrice($price);
                        $product->setDescription($description);
                        $product->setStock($stock);
                        $product->setCategory_id($category_id);

                        if($photo_pass){
                            if(!is_dir('uploads/product-photos')){
                                mkdir('uploads/product-photos', 0777, true);
                            }

                            $product->setImage($photo_name);
                            move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/product-photos/$photo_name");
                        }

                        $save = $product->save();

                        if($save){
                            $_SESSION['create_product'] = 'successful';
                        }else{
                            $_SESSION['create_product'] = 'failed';
                        }
                    }else{
                       $input_error = true;
                    }
                }else{
                    $_SESSION['general_error']['product'] = 'Todos los campos que estan dentro de este cuadro son obligatorios';
                    $input_error = true;
                }

                if($input_error){

                    $_SESSION['input_old']['name'] = $name;
                    $_SESSION['input_old']['price'] = $price;
                    $_SESSION['input_old']['description'] = $description;
                    $_SESSION['input_old']['stock'] = $stock;

                    header('Location:'.base_url."product/create");

                    $_SESSION['input_error'] = $error;
                }else{
                    header("Location:".base_url."product/management");
                }
            }else{
                header('Location:'.base_url);
            }
        }

        public function management(){
            Utils::isAdmin();

            $product = new Product();
            $products = $product->getAll();

            require_once 'views/product/management.php';
        }

        public function delete(){
            Utils::isAdmin();

            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = (int)$_GET['id'];

                $product = new Product();
                $product->setId($id);
                $pro = $product->getOne();

                if($pro){
                    $delete = $product->delete();

                    if($delete){
                        unlink('uploads/product-photos/'.$pro->image);       
                        $_SESSION['delete_product'] = 'successful';   
                                    
                    }else{
                        $_SESSION['delete_product'] = 'failed';
                    }
                    header('Location:'.base_url.'product/management');   
                }else{
                    header('Location:'.base_url);
                }
            }else{
                header('Location:'.base_url);
            }
        }

        public function view(){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = (int)$_GET['id'];

                $product = new Product();
                $product->setId($id);
                $pro = $product->getOne();
                
                require_once 'views/product/view.php';
            }else{
                header('Location:'.base_url);
            }
        }

        public function edit(){
            Utils::isAdmin();

            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = (int)$_GET['id'];
                $product = new Product();
                $product->setId($id);
                $pro = $product->getOne();

                require_once 'views/product/edit.php';
            }else{
                header('Location:'.base_url);
            }
        }

        public function update(){
            Utils::isAdmin();
            
            if(isset($_POST)){
                $product_id = isset($_POST['id']) ? (int)$_POST['id'] : false;
                $name = isset($_POST['name']) ? trim($_POST['name']) : false;
                $price = isset($_POST['price']) ? trim($_POST['price']) : false;
                $description = isset($_POST['description']) ? trim($_POST['description']) : false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
                $category_id = isset($_POST['category']) ? $_POST['category'] : false;

                $error = array();

                if($name && $price && $description && $stock && $category_id && $product_id){
                    // Campo nombre
                    if(!Utils::minAmount($name, 5)){
                        $error['name'] = 'El campo Nombre como minimo tiene que tener 5 caracteres';
                    }else if(!Utils::maxAmount($name, 50)){
                        $error['name'] = 'El campo Nombre como maximo puede tener 50 caracteres';
                    }

                    // Campo precio
                    if(!Utils::isFLoat($price)){
                        $error['price'] = 'El campo Precio solo puede contener numeros flotantes';
                    }

                    // Campo descripcion
                    if(!Utils::minAmount($description, 10)){
                        $error['description'] = 'El campo Descripción como minimo tiene que tener 10 caracteres';
                    }else if(!Utils::maxAmount($description, 3000)){
                        $error['description'] = 'El campo Descripción como maximo puede tener 3000 caracteres';
                    }

                    // Campo stock
                    if(!Utils::isInt($stock)){
                        $error['stock'] = 'El campo Stock solo puede contener numeros enteros';
                    }

                    // Campo categoria
                    if(!Utils::isInt($category_id)){
                        $error['category'] = 'El campo Categoria solo puede contener numeros enteros';
                    }

                    // Campo foto
                    $photo_pass = false;
                    if($_FILES['photo']['tmp_name'] != null){
                        $mimetype = $_FILES['photo']['type'];
                        $photo_name = time().'-'.$_FILES['photo']['name'];
                        $photo_pass = true;

                        // Comprobacion del formato del archivo enviado
                        if($mimetype != 'image/jpeg' && $mimetype != 'image/png' && $mimetype != 'image/jpg' && $mimetype != 'image/gif'){
                            $error['photo'] = 'el archivo subido no es una imagen';
                        }
                    }

                    if(empty($error)){
                        $product = new Product();
                        $product->setId($product_id);
                        $product->setName($name);
                        $product->setPrice($price);
                        $product->setDescription($description);
                        $product->setStock($stock);
                        $product->setCategory_id($category_id);

                        if($photo_pass){
                            if(!is_dir('uploads/product-photos')){
                                mkdir('uploads/product-photos', 0777, true);
                            }

                            $product->setImage($photo_name);
                            move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/product-photos/$photo_name");
                        }

                        $update = $product->update();

                        if($update){
                            $_SESSION['update_product'] = 'successful';
                        }else{
                            $_SESSION['update_product'] = 'failed';
                        }
                    }else{
                        $_SESSION['input_error'] = $error;
                    }
                }else{
                    $_SESSION['general_error']['product'] = 'Todos los campos que estan dentro de este cuadro son obligatorios';
                }
             

                header('Location:'.base_url.'product/edit&id='.$product_id);
            }else{
                header('Location:'.base_url);
            }
        }
        
    }

?>