<?php if($cat): ?>
    <h2><?= $cat->name ?></h2>  

    <?php if($products->num_rows >= 1): ?>
                    <?php while($pro = $products->fetch_object()): ?>
                        <div class="product-container">

                            <a href="<?= base_url ?>product/view&id=<?= $pro->id ?>">
                                <?php if($pro->image == null): ?>
                                    <img src="<?= base_url ?>assets/img/logo-camisa.png" alt="">
                                <?php else: ?>
                                    <img src="<?= base_url ?>uploads/product-photos/<?=$pro->image?>">
                                <?php endif; ?>
                                <span><?= $pro->name ?></span>
                            </a>
                            <p>$<?= $pro->price ?></p>
                            <?php if($pro->stock >= 1): ?>
                                <a href="<?= base_url ?>cart/add&id=<?= $pro->id ?>" class="green buy-button"><i style="margin-right: 5%" class="fa-solid fa-dollar-sign"></i>Comprar</a>
                            <?php else: ?>
                                <p style="color: red; padding: 10px 0; background-color: #ddd; margin: 11px 0 16.5px 0">¡No disponible!</p>
                            <?php endif ?>
                        </div>
                    <?php endwhile; ?>

                <?php else: ?>
                    <span>No hay productos disponibles por el momento</span>
                <?php endif; ?>
<?php else: ?>
    <h2>La categoria no existe</h2>
<?php endif ?>