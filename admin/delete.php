<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: login.php');
        exit;
    }

    // daca nu a ales tabel
    if(!isset($_SESSION['admin']['table'])){
        header('Location: index.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: view_table.php');
        exit;
    }

    
    $table = $_SESSION['admin']['table'];
    $id = $_POST['id'] ?? null; // idul linie care trebuie stearsa

    // daca id nu e in post
    if($id === null){
        $_SESSION['delete_error'] = 'missing row id';
        header('Location: view_table.php');
        exit;
    }

    // daca admin nu are permisiune delete
    if(!in_array('delete', $_SESSION['admin']['permissions'])){
        $_SESSION['delete_error'] = 'you dont have "delete" permission';
        header('Location: view_table.php');
        exit;
    }

    require_once '../includes/model/connectDB.php';
    require_once '../includes/model/admin.model.php';
    
    $conn = connectDB();

    // verific daca id exista in BD
    if(!idExists($conn, $table, $id)){
        $_SESSION['delete_error'] = 'invalid id: ' . $id;
        header('Location: view_table.php');
        exit;
    }
    
    $ok = delete($conn, $table, $id);
    if($ok){
        $_SESSION['delete_success'] = 1;
    } else {
        $_SESSION['delete_error'] = $conn->error;
    }
    header('Location: view_table.php');
?>