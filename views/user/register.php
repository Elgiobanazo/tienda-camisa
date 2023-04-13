<h2>Crear cuenta nueva</h2>
<div class="register-conteiner">
    <?php if(isset($_SESSION['create_acount']) && $_SESSION['create_acount'] == 'successful'): ?>
        <span class="green-alert" style="margin-bottom: 20px; width: 100%; font-size: 20px; padding: 10px; box-sizing: border-box">La cuenta fue creada exitosamente</span>
    <?php elseif(isset($_SESSION['create_acount']) && $_SESSION['create_acount'] == 'failed'): ?>
        <span class="red-alert" style="margin-bottom: 20px; width: 100%; font-size: 20px; padding: 10px; box-sizing: border-box">Error al momento de crear la cuenta</span>
    <?php endif ?>

    <?php Utils::sessionDelete('create_acount') ?>
    <form action="<?= base_url ?>user/save" method="POST" enctype="multipart/form-data">
        <?php if(isset($_SESSION['input_error']['photo'])): ?>
            <span class="red-alert" style="margin: 0 auto 10px;"><?= $_SESSION['input_error']['photo'] ?></span>
        <?php endif; ?>

        <div class="image-container">
            <img src="<?= base_url ?>assets/img/camera-logo.png" id="imgPreview">
            <input type="file" name="photo" accept="image/*" onchange="previewImage(event, '#imgPreview')">
        </div>


        <div class="input-box">
            <?php if(isset($_SESSION["general_error"]['register'])): ?>
                <span class="red-alert" style="margin-bottom: 20px;"><?=$_SESSION["general_error"]['register'] ?></span>
            <?php endif; ?>

            <?php if(isset($_SESSION['input_error'])): ?>
                <div style="background-color: red; width: 90%; margin: 0 auto 10px auto; border-radius: 10px;">
                    <?php if(isset($_SESSION['input_error']['name'])): ?>
                        <span class="red-alert">- <?= $_SESSION['input_error']['name'] ?></span>
                    <?php endif; ?>    

                    <?php if(isset($_SESSION['input_error']['lastname'])): ?>
                        <span class="red-alert">- <?= $_SESSION['input_error']['lastname'] ?></span>
                    <?php endif; ?>    

                    <?php if(isset($_SESSION['input_error']['email'])): ?>
                        <span class="red-alert">- <?= $_SESSION['input_error']['email'] ?></span>
                    <?php endif; ?>    

                    <?php if(isset($_SESSION['input_error']['password'])): ?>
                        <span class="red-alert">- <?= $_SESSION['input_error']['password'] ?></span>
                    <?php endif; ?>    
                </div>
            <?php endif; ?>

            <div class="input-container">
                <input type="text" name="name" <?= isset($_SESSION['input_old']['name']) ? "value='{$_SESSION['input_old']['name']}'" : ''; ?> required>
                <label for="name">Nombre</label>
            </div>
       
            <div class="input-container">
                <input type="text" name="lastname" <?= isset($_SESSION['input_old']['lastname']) ? "value='{$_SESSION['input_old']['lastname']}'" : ''; ?> required>
                <label for="lastname">Apellidos</label>
            </div>

            <div class="input-container input-large-container">
                <input type="text" name="email" <?= isset($_SESSION['input_old']['email']) ? "value='{$_SESSION['input_old']['email']}'" : ''; ?>  required>
                <label for="email">Correo electronico</label>
            </div>

            <div class="input-container input-large-container">
                <input type="password" name="password" required>
                <label for="password">Contraseña</label>
            </div>
            <button type="submit" class="green create-account-button">Crear cuenta</button>
        </div>
    </form>
    <?php 
        Utils::sessionDelete('general_error');
        Utils::sessionDelete('input_error');
        Utils::sessionDelete('input_old');
     ?>
</div>

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