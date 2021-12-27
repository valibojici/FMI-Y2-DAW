<?php
    session_start();

    // daca admin nu e logat atunci redirect la login
    if(!isset($_SESSION['admin'])){
        header('Location: login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $table = $_POST['table'] ?? null;

        // daca table = null sau nu exista in tabele care pot fi editate atunci error
        if($table === null || !in_array($table, $_SESSION['admin']['tables'])){
            // setez eroarea si ma intorc la index.php unde se alege tabelul
            $_SESSION['access_table_error'] = 1;
            header('Location: index.php');
            exit;
        }
        // daca e ok mergem sa vizualizam tabelul
        $_SESSION['admin']['table'] = $table;
        header('Location: view_table.php');

    } else {
        // altceva in afara de POST nu are sens
        header('Location: index.php');
        exit;
    }
?>