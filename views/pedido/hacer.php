
<?php if(isset($_SESSION['identity'])): ?>
<h1>Realizar pedido</h1>
<p>
    <a href="<?=base_url?>carrito/index">Ver detalle de compra</a>
</p>
<br>
<h3>Dirección para el envio</h3>
<form action="<?=base_url.'pedido/add'?>" method="POST">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia" required>
    
    <label for="localidad">Ciudad</label>
    <input type="text" name="localidad" required>
    
    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" required>
    
    <input type="submit" value="Confirmar pedido">
</form>
<?php else: ?>
<h1>Necesitas estar identificado</h1>
<p>Ingrese a su cuenta o registrese para poder continuar</p>
<?php endif; ?>
