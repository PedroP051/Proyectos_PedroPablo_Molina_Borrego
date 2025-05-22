<?php

$currentPage = 'transactions-edit-selected';
include APP_ROOT . '/resources/views/layouts/header.php';

// Obtener ID de la transacción desde la URI
$id = $_SERVER['REQUEST_URI'];
preg_match('/\/select_edit\/(\d+)/', $id, $matches);
$id = $matches[1] ?? null;

if (!$id) {
    echo "<p class='text-danger'>Error: Falta el ID de la transacción.</p>";
    include APP_ROOT . '/resources/views/layouts/footer.php';
    exit;
}


if (!$transaction) {
    echo "<p class='text-danger'>Error: La transacción no existe.</p>";
    include APP_ROOT . '/resources/views/layouts/footer.php';
    exit;
}

?>

<h1 class='mb-4'>Editar Transacción</h1>

<form action='<?php echo $routes->get('transactions.update')->getPath(); ?>' method='POST'>
    <input type='hidden' name='transaction_id' value='<?php echo $transaction->getId(); ?>'>
    <div class='mb-3'>
        <label for='type' class='form-label'>Tipo:</label>
        <select id='type' name='type' class='form-control' required>
            <option value='income'>Ingreso</option>
            <option value='expense'>Gasto</option>
        </select>
    </div>

    <div class='mb-3'>
        <label for='amount' class='form-label'>Cantidad (€):</label>
        <input type='number' step='0.01' id='amount' name='amount' class='form-control' required>
    </div>

    <div class='mb-3'>
        <label for='date' class='form-label'>Fecha:</label>
        <input type='date' id='date' name='date' class='form-control' required>
    </div>

    <button type='submit' class='btn btn-warning mt-3'>Editar Transacción</button>
</form>


<?php include APP_ROOT . '/resources/views/layouts/footer.php'; ?>
