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
    $table = $_SESSION['admin']['table'];

    require_once '../includes/model/connectDB.php';
    require_once '../includes/model/admin.model.php';
    require_once '../includes/view/view.php';
    $view = new View(['title' => 'CRUD', 'table_name' => $table]);

    $conn = connectDB();
    // iau toate inreg din tabel
    $rows = getRows($conn, $table);
    
    // daca nu exista inreg
    if($rows === null){
        $view->assign('empty_table', 1);
        // iau numele coloanelor din BD
        $col_names = getColumnNames($conn, $table);
        $col_names = array_map(function($arr){ return $arr[0];}, $col_names);
        $view->assign('col_names', $col_names);
    }
    else{
        // iau numele coloanelor din rows
        $view->assign('col_names', array_keys($rows[0]));
        // setez inreg
        $view->assign('rows', $rows);
    }

    // INSERT

    if(isset($_SESSION['insert_error'])){
        // asta e setata din insert.php cand face redirect aici
        $view->assign('insert_error', $_SESSION['insert_error']);
        unset($_SESSION['insert_error']);
    } else if (isset($_SESSION['insert_success'])){
        // asta e setata din insert.php cand face redirect aici
        $view->assign('insert_success', 1);
        unset($_SESSION['insert_success']);
    }

    // DELETE

    if(isset($_SESSION['delete_error'])){
        // asta e setata din delete.php cand face redirect aici
        $view->assign('delete_error', $_SESSION['delete_error']);
        unset($_SESSION['delete_error']);
    } else if (isset($_SESSION['delete_success'])){
        // asta e setata din delete.php cand face redirect aici
        $view->assign('delete_success', 1);
        unset($_SESSION['delete_success']);
    }

    // UPDATE

    if(isset($_SESSION['update_error'])){
        // asta e setata din update.php cand face redirect aici
        $view->assign('update_error', $_SESSION['update_error']);
        unset($_SESSION['update_error']);
    } else if (isset($_SESSION['update_success'])){
        // asta e setata din update.php cand face redirect aici
        $view->assign('update_success', 1);
        unset($_SESSION['update_success']);
    }

    $view->render('../includes/view/admin/view_table.tpl.php');
?>