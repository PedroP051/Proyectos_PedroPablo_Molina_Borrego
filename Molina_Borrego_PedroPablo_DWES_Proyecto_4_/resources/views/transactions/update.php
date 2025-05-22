<?php

$currentPage = 'transactions-update';
include APP_ROOT . '/resources/views/layouts/header.php';

?>

<h1 class="mb-4">Actualizar Transacción</h1>

<?php
// Verificar si la variable $updated está configurada
if (isset($updated)) {
    if ($updated): ?>
        <div class="alert alert-success" role="alert">
            La transacción ha sido actualizada correctamente.
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Hubo un error al actualizar la transacción. Por favor, inténtalo de nuevo.
        </div>
    <?php endif;
} else {
    // Manejar casos donde $updated no está definido
    echo '<div class="alert alert-warning" role="alert">El estado de la actualización no está definido.</div>';
}
?>

<a href="<?php echo $routes->get('transactions.index')->getPath(); ?>" class="btn btn-primary mt-3">Volver a la lista</a>

<?php
include APP_ROOT . '/resources/views/layouts/footer.php';
?>

