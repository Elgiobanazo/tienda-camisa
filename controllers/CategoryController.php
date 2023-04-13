<?php 
    require_once 'models/Category.php';

    class CategoryController{
        public function create(){
            Utils::isAdmin();

            require_once 'views/category/create.php';
        }

        public function management(){
            Utils::isAdmin();

            $category = new Category();
            $categories = $category->getAll();

            require_once 'views/category/management.php';
        }

        public function save(){
            Utils::isAdmin();

            if(isset($_POST['name']) && !empty($_POST['name'])){
                $name = trim($_POST['name']);
                $error = '';

                if(!Utils::minAmount($name, 3)){
                    $error = 'Este campo como minimo tiene que tener 3 caracteres';
                }else if(!Utils::maxAmount($name, 20)){
                    $error = 'Este campo como maximo puede tener 20 caracteres';
                }

                $errorInput = false;
                if(empty($error)){
                    $category = new Category();
                    $category->setName($name);
                    // Guardar categoria
                    $save = $category->save();

                    if($save){
                        $_SESSION['save_category'] = 'successful';
                    }else{
                        $_SESSION['save_category'] = 'failed';
                        $errorInput = true;
                    }
                }else{
                   $_SESSION['input_error']['name'] = $error;
                   $errorInput = true;
                }
            }else{
                $_SESSION['input_error']['name'] = 'Este campo es obligatorio';
                $errorInput = true;
            }

            if($errorInput){
                $_SESSION['input_old']['name'] = $name;
                header('Location:'.base_url.'category/create');
            }else{
                header("Location:".base_url.'category/management');
            }
        }

        public function delete(){
            Utils::isAdmin();

            if(isset($_GET['id'])){
                $id = (int)$_GET['id'];
                
                $category = new Category();
                $category->setId($id);
                $cat = $category->getOne();
             
                if($cat != null){
                    $delete = $category->delete();

                    if($delete){
                        $_SESSION['delete_category'] = 'successful';
                    }else{
                        $_SESSION['delete_category'] = 'failed';
                    }

                    header('Location:'.base_url.'category/management');
                }else{
                    header('Location:'.base_url);
                }
            }else{
                header('Location:'.base_url);
            }
        }

        public function edit(){
            Utils::isAdmin();

            if(isset($_GET['id']) && !empty($_GET['id'])){
                $id = (int)$_GET['id'];
                $category = new Category();
                $category->setId($id);
                $cat = $category->getOne();

                if(empty($cat)){
                    header('Location:'.base_url);
                }
            }else{
                header('Location:'.base_url);
            }

            require_once 'views/category/edit.php';
        }

        public function update(){
            Utils::isAdmin();
            
            if(isset($_POST)){
                $name = isset($_POST['name']) ? trim($_POST['name']) : false;
                $id = isset($_POST['id']) ? (int)$_POST['id'] : false;

                if($name && $id){
                    $error = '';
                    if(!Utils::minAmount($name, 3)){
                        $error = 'Este campo como minimo tiene que tener 3 caracteres';
                    }else if(!Utils::maxAmount($name, 20)){
                        $error = 'Este campo como maximo puede tener 20 caracteres';
                    }

                    if(empty($error)){
                        $category = new category();
                        $category->setId($id);
                        $category->setName($name);
                        $update = $category->update();

                        if($update){
                            $_SESSION['edit_category'] = 'successful';
                        }else{
                            $_SESSION['edit_category'] = 'failed';
                        }
                    }else{
                        $_SESSION['input_error']['name'] = $error;
                    }                  
                }else{
                    $_SESSION['input_error']['name'] = 'Este campo es obligatorio';
                }
            }else{
                header("Location:".base_url);
            }

            header("Location:".base_url."category/edit&id=$id");
        }

        public function view(){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $category_id = (int)$_GET['id'];

                $category = new Category();
                $category->setId($category_id);
                $cat = $category->getOne(); 


                $products = $category->getAllProductsByCategory();

                require_once 'views/category/view.php';
            }else{
                header('Location:'.base_url);
            }
        }
    }


?>