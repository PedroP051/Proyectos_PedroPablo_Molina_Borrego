<?php

$currentPage = 'transactions-edit';

include APP_ROOT . '/resources/views/layouts/header.php';
$transactions = $transactions ?? [];
?>

<h1 class='mb-4'>Editar Transacciones</h1>

<table class='table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?php echo htmlspecialchars($transaction['id']); ?></td>
                <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                <td><?php echo $transaction['type'] === 'income' ? 'Ingreso' : 'Gasto'; ?></td>
                <td class='<?php echo $transaction['type'] === 'income' ? 'text-success' : 'text-danger'; ?>'>
                    <?php echo htmlspecialchars($transaction['amount']); ?> &euro;
                </td>
                <td>

                    <!-- Botón para editar -->
                    <a href='<?php echo str_replace('{id}', $transaction['id'], $routes->get('transactions.select_edit')->getPath()) ?>' class='btn btn-warning'>Editar</a>

                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include APP_ROOT . '/resources/views/layouts/footer.php'; ?>
