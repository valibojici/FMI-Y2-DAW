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

    // daca admin nu are permisune update
    if(!in_array('update', $_SESSION['admin']['permissions'])){
        $_SESSION['update_error'] = 'you dont have "update" permission';
        header('Location: view_table.php');
        exit;
    }
    
    require_once '../includes/model/connectDB.php';
    require_once '../includes/model/admin.model.php';
    
    $conn = connectDB();
    
    // o sa fie updatata linia cu old_id din tabel
    $old_id = $_POST['old_id'] ?? null;

    if($old_id === null){
        $_SESSION['update_error'] = 'missing POST parameter: old_id';
        header('Location: view_table.php');
        exit;
    }
    
    // iau numele coloanelor din BD
    $col_names = getColumnNames($conn, $table);
    $col_names = array_map(function($arr){ return $arr[0];}, $col_names);
    
    // iau valorile coloanelor din POST
    $valori = array_map(function($col){
        return $_POST[$col] ?? null;
    }, $col_names);

    $update_data = array_combine($col_names, $valori);

    foreach($update_data as $key => $val){
        if($val === null){
            // nu sunt corecte coloanele din POST
            $_SESSION['update_error'] = 'missing POST parameter: ' . $key;
            header('Location: view_table.php');
            exit;   
        }
    }

    // verific daca old_id exista in BD
    if(!idExists($conn, $table, $old_id)){
        $_SESSION['update_error'] = 'invalid old_id ' . $old_id;
        header('Location: view_table.php');
        exit;
    }
    
    $isOk = update($conn, $table, $update_data, $old_id);
    if(!$isOk){
        $_SESSION['update_error'] = $conn->error;
    } else {
        $_SESSION['update_success'] = 1;
    }
    header('Location: view_table.php');
?>