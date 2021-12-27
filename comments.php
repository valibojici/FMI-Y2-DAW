<?php 
    session_start();

    require_once './includes/view/view.php';
    $view = new View(['title' => 'Comments | Hillside Hotel']);

    require_once './includes/model/connectDB.php';
    require_once './includes/model/comments.model.php';
    $conn = connectDB();

    if(isset($_SESSION['loggedin'])){
        require_once './includes/model/user.model.php';
        $user = getUserData($conn, $_SESSION['user_email']);
        $can_leave_comment = canLeaveComment($conn, $user['id']);
        $view->assign('can_leave_comment', $can_leave_comment);
    }
    
    $comments = getComments($conn);
    if($comments !== null){
        $view->assign('comments', $comments);
    }

    $view->render('./includes/view/comments.tpl.php');
?>