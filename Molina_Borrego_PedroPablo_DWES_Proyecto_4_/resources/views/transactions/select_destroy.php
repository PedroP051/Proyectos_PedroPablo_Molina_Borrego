
<?php

$currentPage = 'transactions-destroy-select';

include APP_ROOT . '/resources/views/layouts/header.php';

?>

<h1 class='mb-4'>Seleccionar Transacción para Eliminar</h1>

<table class='table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Seleccionar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['id']; ?></td>
                <td><?php echo $transaction['date']; ?></td>
                <td><?php echo $transaction['type'] === 'income' ? 'Ingreso' : 'Gasto'; ?></td>
                <td class='<?php echo $transaction['type'] === 'income' ? 'text-success' : 'text-danger'; ?>'>
                    <?php echo $transaction['amount']; ?> &euro;
                </td>
                <td>
                    <form method="POST" action="<?php echo str_replace('{id}', $transaction['id'], $routes->get('transactions.destroy')->getPath()); ?>">
                        <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php

include APP_ROOT . '/resources/views/layouts/footer.php';

?>
