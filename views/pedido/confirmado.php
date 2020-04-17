<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>

    <h1>Pedido confirmado</h1>
    <p>
        El pedido se ha realizado con exito, una vez realizada la transferencia
        bancaria a la cuenta 7894268791253DSXF con el costo del pedido, será procesado y enviado.
    </p>
    <br>
    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido</h3>

        Numero de pedido: <?=$pedido->id?><br>
        Total: $<?=$pedido->costo?><br>
        Productos:  
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while($producto = $productos->fetch_object()): ?>
                <tr>
                    <td><?php if($producto->imagen != NULL): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito">
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/logo2.png" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td><a href="<?= base_url ?>producto/ver&id=<?= $producto->id?>"><?= $producto->nombre?></a></td>
                    <td><?= $producto->precio?></td>
                    <td><?= $producto->unidades?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>


<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'confirm'): ?>
    <h1>Tu pedido no ha podido confirmarse</h1>
<?php endif; ?>
