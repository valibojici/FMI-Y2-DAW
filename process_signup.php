<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $fname = trim($_POST['firstname']);
        $lname  = trim($_POST['lastname']);
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        require_once './model/connectDB.php';
        require_once './model/user.model.php';
        require_once './extra/validations.php';

        session_start();
        $conn = connectDB();

        $isOk = true;

        $val_result = validateName($fname);
        $isOk &= ($val_result === true);
        handleError($val_result, 'fname_error');

        $val_result = validateName($lname);
        $isOk &= ($val_result === true);
        handleError($val_result, 'lname_error');

        $val_result = validatePhone($phone);
        $isOk &= ($val_result === true);
        handleError($val_result, 'phone_error');

        $val_result = validateEmail($email);
        $isOk &= ($val_result === true);
        handleError($val_result, 'email_error');
        $val_result = emailExists($conn, $email) === true ? 'email already exists' : true;
        $isOk &= ($val_result === true);
        handleError($val_result, 'email_error');

        $val_result = validatePass($pass);
        $isOk &= ($val_result === true);
        handleError($val_result, 'pass_error');


        if($isOk){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $fname = trim($fname);
            $lname = trim($lname);

            $inserted = insertUser($conn, $fname, $lname, $phone, $email, $pass);

            if(!$inserted){
                // error on insert in db
                header('Location: signup.php');    
                exit;
            } else {
                // redirect
                header('Location: success_signup.php');
                exit;
            }
        } else {
            header('Location: signup.php');
            exit;   
        }
    }

    function handleError($validation_result, $error_type){
        if($validation_result !== true){
            $_SESSION[$error_type] = $validation_result;
            return false;
        }
        return true;
    }
 ?>