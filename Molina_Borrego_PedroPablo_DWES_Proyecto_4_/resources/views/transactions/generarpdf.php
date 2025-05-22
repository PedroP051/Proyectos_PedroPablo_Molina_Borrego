<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../database/DB.php'; // Ajusta la ruta si es necesario

use Mpdf\Mpdf;

// Crear instancia de mPDF
$mpdf = new Mpdf();

// Obtener datos de la base de datos
$balances = obtenerBalances(); // Debes implementar esta función en tu modelo

// Iniciar contenido del PDF
$html = '<h1>Informe Financiero</h1>';
$html .= '<h2>Balance Anual</h2>';
$html .= generarTablaBalanceAnual($balances);
$html .= '<h2>Balance Mensual</h2>';
$html .= generarTablaBalanceMensual($balances);
$html .= '<h2>Estadísticas</h2>';
$html .= generarEstadisticas($balances);

// Escribir contenido en el PDF
$mpdf->WriteHTML($html);

// Generar salida
$mpdf->Output('informe_financiero.pdf', 'D');

// Función para generar la tabla de balance anual
function generarTablaBalanceAnual($balances) {
    $html = '<table border="1"><tr><th>Año</th><th>Ingresos</th><th>Gastos</th><th>Balance</th></tr>';
    foreach ($balances['anual'] as $anio => $data) {
        $html .= "<tr><td>{$anio}</td><td>\${$data['ingresos']}</td><td>\${$data['gastos']}</td><td>\${$data['balance']}</td></tr>";
    }
    $html .= '</table>';
    return $html;
}

// Función para generar la tabla de balance mensual
function generarTablaBalanceMensual($balances) {
    $html = '<table border="1"><tr><th>Mes</th><th>Año</th><th>Ingresos</th><th>Gastos</th><th>Balance</th></tr>';
    foreach ($balances['mensual'] as $mes => $data) {
        $html .= "<tr><td>{$data['mes']}</td><td>{$data['anio']}</td><td>\${$data['ingresos']}</td><td>\${$data['gastos']}</td><td>\${$data['balance']}</td></tr>";
    }
    $html .= '</table>';
    return $html;
}

// Función para generar estadísticas
function generarEstadisticas($balances) {
    $html = '<ul>';
    $html .= "<li>Mes con más ingresos: {$balances['estadisticas']['mes_mas_ingresos']}</li>";
    $html .= "<li>Mes con más gastos: {$balances['estadisticas']['mes_mas_gastos']}</li>";
    $html .= "<li>Mejor balance: {$balances['estadisticas']['mejor_balance']}</li>";
    $html .= "<li>Peor balance: {$balances['estadisticas']['peor_balance']}</li>";
    $html .= '</ul>';
    return $html;
}

require_once __DIR__ . '/../../../Database/DB.php'; 

function obtenerBalances() {
    $db = new \Database\DB();
    $balances = [
        'anual' => [],
        'mensual' => [],
        'estadisticas' => [],
    ];

    // Balance anual
    $db->prepare("
        SELECT YEAR(date) as anio,
               SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as ingresos,
               SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as gastos
        FROM transactions
        GROUP BY anio
    ");
    $db->execute();
    $anualData = $db->fetchAll();
    foreach ($anualData as $row) {
        $balances['anual'][$row['anio']] = [
            'ingresos' => $row['ingresos'],
            'gastos' => $row['gastos'],
            'balance' => $row['ingresos'] - $row['gastos']
        ];
    }

    // Balance mensual
    $db->prepare("
        SELECT YEAR(date) as anio, MONTH(date) as mes,
               SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as ingresos,
               SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as gastos
        FROM transactions
        GROUP BY anio, mes
        ORDER BY anio, mes
    ");
    $db->execute();
    $mensualData = $db->fetchAll();
    foreach ($mensualData as $row) {
        $balances['mensual'][] = [
            'anio' => $row['anio'],
            'mes' => $row['mes'],
            'ingresos' => $row['ingresos'],
            'gastos' => $row['gastos'],
            'balance' => $row['ingresos'] - $row['gastos']
        ];
    }

    // Estadísticas (mes con más ingresos, más gastos, mejor y peor balance)
    $db->prepare("
        SELECT MONTH(date) as mes,
               SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as ingresos,
               SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as gastos
        FROM transactions
        GROUP BY mes
    ");
    $db->execute();
    $estadisticas = $db->fetchAll();
    
    if (!empty($estadisticas)) {
        $maxIngresos = max(array_column($estadisticas, 'ingresos'));
        $maxGastos = max(array_column($estadisticas, 'gastos'));
        $maxBalance = max(array_map(fn($row) => $row['ingresos'] - $row['gastos'], $estadisticas));
        $minBalance = min(array_map(fn($row) => $row['ingresos'] - $row['gastos'], $estadisticas));

        $balances['estadisticas'] = [
            'mes_mas_ingresos' => array_values(array_filter($estadisticas, fn($row) => $row['ingresos'] == $maxIngresos))[0]['mes'] ?? null,
            'mes_mas_gastos' => array_values(array_filter($estadisticas, fn($row) => $row['gastos'] == $maxGastos))[0]['mes'] ?? null,
            'mejor_balance' => array_values(array_filter($estadisticas, fn($row) => ($row['ingresos'] - $row['gastos']) == $maxBalance))[0]['mes'] ?? null,
            'peor_balance' => array_values(array_filter($estadisticas, fn($row) => ($row['ingresos'] - $row['gastos']) == $minBalance))[0]['mes'] ?? null,
        ];
    }

    return $balances;
}
