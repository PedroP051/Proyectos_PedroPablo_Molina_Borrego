<?php

namespace App\Http\Controllers;

use Symfony\Component\Routing\RouteCollection;
use App\Models\Transaction;

class TransactionController
{
    public function __construct()
    {
        // Asegurarse de que la sesión esté iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Inicia la sesión si aún no está iniciada
        }
        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));  // Genera un token aleatorio
        }
    }

    public function index(RouteCollection $routes)
    {
        $transactions = Transaction::readAll();
        require_once APP_ROOT . '/resources/views/transactions/index.php';
    }

    public function create(RouteCollection $routes)
    {
        require_once APP_ROOT . '/resources/views/transactions/create.php';
    }

    public function store(RouteCollection $routes)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $transaction = new Transaction();
            $transaction->setType($_POST['type']);
            $transaction->setAmount($_POST['amount']);
            $transaction->setDate($_POST['date']);

            $transaction->create(); 

            
            require_once APP_ROOT . '/resources/views/transactions/store.php';
        }
    }

    public function show(int $id, RouteCollection $routes)
    {
        

        $transaction = new Transaction();
        $transaction->read($id);

        require_once APP_ROOT . '/resources/views/transactions/show.php';
    }

    public function edit( RouteCollection $routes)
    {

        $transactions = Transaction::readAll();
        require_once APP_ROOT . '/resources/views/transactions/edit.php';
    }
    public function selectEdit(int $id, RouteCollection $routes)
    {
        // Leer la transacción específica según el ID
        $transaction = new Transaction();
       $transactions = Transaction::readAll(); 
       $transaction->read($id);
        
        // Pasar la transacción a la vista para editar
        require_once APP_ROOT . '/resources/views/transactions/selectedit.php';
    }
    
    public function update(RouteCollection $routes)
{
    // Verificar si el ID de la transacción está definido en $_POST
    if (!isset($_POST['transaction_id']) || empty($_POST['transaction_id'])) {
        die('Error: Falta el ID de la transacción.');
    }

    $id = (int) $_POST['transaction_id'];
    $transaction = new Transaction();

    try {
        // Leer la transacción por ID
        $transaction->read($id);
    } catch (\Exception $e) {
        die('Error: ' . $e->getMessage());
    }

    // Intentar actualizar la transacción
    if (isset($_POST['type'], $_POST['amount'], $_POST['date'])) {
        $transaction->setType(trim($_POST['type']));
        $transaction->setAmount((float) $_POST['amount']);
        $transaction->setDate(trim($_POST['date']));

        // Actualizar la transacción y almacenar el estado en $updated
        $updated = $transaction->update();
    } else {
        $updated = false; // Indicar que la actualización falló por falta de datos
    }

    // Cargar la vista y pasar $updated
    require_once APP_ROOT . '/resources/views/transactions/update.php';
}

    
   

    public function destroySelect(RouteCollection $routes)
    {
        $transactions = Transaction::readAll();

        require_once APP_ROOT . '/resources/views/transactions/select_destroy.php';
    }

    public function destroy(RouteCollection $routes)
    {
        $id = $_POST['transaction_id'];

        $transaction = new Transaction();
        $transaction->read($id);
        $transaction->delete();

        require_once APP_ROOT . '/resources/views/transactions/destroy.php';
    header('Location: ' . BASE_PATH . '../../../transactions/destroySelect');
    exit;
    }

    public function generar(RouteCollection $routes)
    {
        $transactions = Transaction::readAll();
        require_once APP_ROOT . '/resources/views/transactions/generar.php';
    }

    public function generarpdf(RouteCollection $routes)
    {
        $transactions = Transaction::readAll();
        require_once APP_ROOT . '/resources/views/transactions/generarpdf.php';
    }
     
}    

    
