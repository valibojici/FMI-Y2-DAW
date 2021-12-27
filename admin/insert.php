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

    // daca admin nu are permisiune create
    if(!in_array('create', $_SESSION['admin']['permissions'])){
        $_SESSION['insert_error'] = 'you dont have "insert" permission';
        header('Location: view_table.php');
        exit;
    }

    require_once '../includes/model/connectDB.php';
    require_once '../includes/model/admin.model.php';
    
    $conn = connectDB();
    
    // iau numele coloanelor
    $col_names = getColumnNames($conn, $table);
    $col_names = array_map(function($arr){ return $arr[0];}, $col_names);
    
    // iau valorile coloanelor din POST
    $valori = array_map(function($col){
        return $_POST[$col] ?? null;
    }, $col_names);

    $insert_data = array_combine($col_names, $valori);

    foreach($insert_data as $key => $val){
        if($val === null){
            // nu sunt corecte coloanele din POST
            $_SESSION['insert_error'] = 'missing POST parameter: ' . $key;
            header('Location: view_table.php');
            exit;
        }
    }
    $isOk = insert($conn, $table, $insert_data);

    if(!$isOk){
        $_SESSION['insert_error'] = $conn->error;
    } else {
        $_SESSION['insert_success'] = 1;
    }
    header('Location: view_table.php');
?>