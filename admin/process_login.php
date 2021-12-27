<?php   
    session_start();

    // daca admin nu e logat atunci redirect la login
    if(isset($_SESSION['admin'])){
        header('Location: login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: index.php');
        exit;
    }
    $user = $_POST['username'] ?? null;
    $pass = $_POST['password'] ?? null;

    // daca nu e in post => eroare
    if($user === null || $pass === null){
        quit();
    }
 
    require_once '../includes/model/connectDB.php';
    require_once '../includes/model/admin.model.php';
    $conn = connectDB();

    // iau date despre user din BD
    $admin_info = getUserInfo($conn, $user);

    // verific daca user exista
    if($admin_info === null){
        quit();
    }

    // verific daca parola se potriveste
    $db_pass = $admin_info['parola'];
    if(!password_verify($pass, $db_pass)){
        quit();
    }

    // iau permisiunile
    $permissions = getUserPermissions($conn, $admin_info['id']) ?? [];
    if($permissions != []){
        $permissions = array_map(function($arr){return $arr[0];}, $permissions); // altfel era [ [0=>...], [0=>...], ... ]
    }

    // iau tabelele
    $tables = getTables($conn) ?? [];
    if($tables != []){
        $tables = array_map(function($arr){return $arr[0]; }, $tables);
    }

    // daca nu are permisiune admin filtrez tabele de admin
    if(!in_array('admin', $permissions)){
        $tables = array_filter($tables, function($elem){
            return $elem != 'admin_site' && $elem != 'permisiune' && $elem != 'admin_permisiune';
        });
    }

    // ok setez ce tabele are voie sa vada, permisiuni, si date despre user 
    $_SESSION['admin']['tables'] = $tables;
    $_SESSION['admin']['permissions'] = $permissions; 
    $_SESSION['admin']['userinfo'] = $admin_info;
    // dupa mergem in index.php sa alegem tabelul de editat
    header('Location: index.php');
 
    function quit(){
        $_SESSION['admin_login_error'] = 1;
        header('Location: login.php');
        exit;
    }
?>