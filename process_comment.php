<?php 
    session_start();
    if(!$_SESSION['loggedin'] || $_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: comments.php');
        exit;
    }
    
    $comment = $_POST['comment'] ?? null;
    // daca nu e in post
    if($comment === null){
        header('Location: comments.php');
        exit;
    }


    require_once './includes/model/connectDB.php';
    require_once './includes/model/comments.model.php';
    require_once './includes/model/user.model.php';
    $conn = connectDB();
    // iau date despre user si daca poate lasa comment
    $user = getUserData($conn, $_SESSION['user_email']);
    
    if(!canLeaveComment($conn, $user['id'])){
        $_SESSION['message'] = 'You cannot leave a comment';
        header('Location: message.php');
        exit;
    }

    // daca comment e prea lung
    if(strlen($comment) > 65535){
        $_SESSION['message'] = 'Message too long.';
        header('Location: message.php');
        exit;
    }

    // daca nu a mai lasat comment si a facut macar 1 data check in la hotel
    $ok = insertComment($conn, $user['id'], $comment);
    $_SESSION['message'] = $ok ? 'Thank you for your comment. It must be approved by an admin first.' : 'Database error';
    header('Location: message.php');
?>