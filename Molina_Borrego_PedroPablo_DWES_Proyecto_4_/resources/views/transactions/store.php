<?php

$currentPage = 'transactions-store';

include APP_ROOT . '/resources/views/layouts/header.php';

?>

<h1 class='mb-4'>Añadir Transacción</h1>

<p>La transacción se ha registrado con éxito en la base de datos.</p>

<a href="<?= BASE_PATH ?>/transactions/index">Ver todas las transacciones</a>

<?php include APP_ROOT . '/resources/views/layouts/footer.php'; ?>
