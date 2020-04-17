<h1>Gestión de productos</h1>
<a href="<?=base_url?>producto/crear" class="button button-small">Crear producto</a>
<!-- añadir producto -->
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha añadido al catálogo correctamente!</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red">El producto no ha podido ser ingresado al catálogo!</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
<!--eliminar producto-->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha eliminado del catálogo correctamente!</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El producto no ha podido ser eliminado del catálogo!</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
    
<table>
        <tr>
        <th>ID</th>
        <th>NOMBRE</th>   
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php while ($pro = $productos->fetch_object()): ?>
        <tr>
            <td><?=$pro->id?></td>
            <td><?=$pro->nombre?></td>    
            <td><?=$pro->precio?></td>
            <td><?=$pro->stock?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
    
</table>

