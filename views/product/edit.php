<?php if($pro): ?>
<h2>Editar producto <?= $pro->name ?></h2>
<?php if(isset($_SESSION['update_product']) && $_SESSION['update_product'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Los datos del producto fueron actualizados exitosamente</span>
<?php endif; ?>

<?php if(isset($_SESSION['update_product']) && $_SESSION['update_product'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de actualizar los datos del producto</span>
<?php endif ?>

<?php Utils::sessionDelete('update_product') ?>

<div class="create-product-container">
    <form action="<?= base_url ?>product/update" method="POST" enctype="multipart/form-data">    
        <div class="image-container product-image-container">
            <input type="file" name="photo" onchange="previewImage(event, '#imgPreview')">
            <?php if($pro->image != null): ?>
                <img src="<?= base_url ?>uploads/product-photos/<?= $pro->image ?>" alt="Image de la camisa" id="imgPreview">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/logo-camisa.png" alt="" id="imgPreview">
            <?php endif ?>
        </div>

        <div class="input-box input-create-product">
            <?php if(isset($_SESSION['general_error']['product'])): ?>
                <span class="red-alert" style="margin-bottom: 20px;"><?= $_SESSION['general_error']['product'] ?></span>
            <?php endif; ?>

            <?php if(isset($_SESSION['input_error']) && !empty($_SESSION['input_error'])): ?>
                <div class="red-alert alert-container" style="background-color: red; width: 90%; margin: 0 auto 10px auto; border-radius: 10px;">

                    <?php if(isset($_SESSION['input_error']['name'])): ?>
                        <p>- <?= $_SESSION['input-error']['name'] ?></p>
                    <?php endif ?> 

                    <?php if(isset($_SESSION['input_error']['price'])): ?>
                        <p>- <?= $_SESSION['input_error']['price'] ?></p>
                    <?php endif ?> 

                    <?php if(isset($_SESSION['input_error']['description'])): ?>
                        <p>- <?= $_SESSION['input_error']['description'] ?></p>
                    <?php endif ?> 

                    <?php if(isset($_SESSION['input_error']['stock'])): ?>
                        <p>- <?= $_SESSION['input_error']['stock'] ?></p>
                    <?php endif ?> 

                    <?php if(isset($_SESSION['input_error']['category'])): ?>
                        <p><?= $_SESSION['input_error']['category'] ?></p>
                    <?php endif ?> 

                </div>
            <?php endif ?>

            <input type="hidden" name="id" value="<?= $pro->id ?>">

            <div class="input-container">
                <input type="text" name="name" value="<?= $pro->name ?>" required>
                <label for="">Nombre</label>
            </div>

            <div class="input-container">
                <input type="text" name="price" value="<?= $pro->price ?>" required>
                <label for="">Precio</label>
            </div>

            <div class="input-container input-large-container">
                <textarea name="description" required><?= $pro->description ?></textarea>
                <label for="" id="label-description">Descripción</label>
            </div>

            <div class="input-container">
                <input type="text" name="stock" value="<?= $pro->stock ?>" required>
                <label for="">Stock</label>
            </div>

            <div class="input-container">
                <?php $categories = Utils::getAllCategories() ?>
                <select name="category">
                    <option value="" selected disabled>Categoria</option>
                    <?php while($cat = $categories->fetch_object()): ?>
                        <option value="<?= $cat->id ?>" <?= $pro->category_id == $cat->id ? 'selected' : ''; ?> ><?=$cat->name ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="blue" style="width: 180px; margin: 10px auto 0 auto; padding: 8px 0; font-size: 16px; border-radius: 5px"><i class="fa-solid fa-floppy-disk" style="margin-right: 10px; transform: scale(1.3)"></i> Guardar cambios</button>
        

            <?php 
                Utils::sessionDelete('input_error');
                Utils::sessionDelete('general_error');
            ?>
        </div>
    </form>
</div>
<?php else: ?>
    <h2>El producto no existe</h2>
<?php endif; ?>

<script>
    function previewImage(event, querySelector){

    //Recuperamos el input que desencadeno la acción
    const input = event.target;

    //Recuperamos la etiqueta img donde cargaremos la imagen
    $imgPreview = document.querySelector(querySelector);

    // Verificamos si existe una imagen seleccionada
    if(!input.files.length) return

    //Recuperamos el archivo subido
    file = input.files[0];

    //Creamos la url
    objectURL = URL.createObjectURL(file);

    //Modificamos el atributo src de la etiqueta img
    $imgPreview.src = objectURL;
                
    }
</script>