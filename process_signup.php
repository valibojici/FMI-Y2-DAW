<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: signup.php');
        exit;   
    }
    
    session_start();
    
    $fname = $_POST['firstname'] ?? null;
    $lname  = $_POST['lastname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $pass = $_POST['password'] ?? null;
    $captcha = $_POST['g-recaptcha-response'] ?? null;

    $_SESSION['signup_fname'] = $fname;
    $_SESSION['signup_lname'] = $lname;
    $_SESSION['signup_email'] = $email;
    $_SESSION['signup_phone'] = $phone;

    foreach([$fname, $lname, $phone, $email, $pass, $captcha] as $var){
        // nu sunt setate in POST
        if($var === null){
            header('Location: signup.php');
            exit;   
        }
    } 
    
    require_once './includes/model/connectDB.php';
    require_once './includes/model/user.model.php';
    require_once './includes/extra/validations.php';
    require_once './includes/extra/captcha.php';

    // fac post request la google api si imi da JSON cu raspunsul daca e ok captcha
    $captcha_response = verify($captcha);
    // scot din JSON success
    $captcha_response = json_decode($captcha_response, true)['success'];
    // daca nu e ok
    if(!$captcha_response){
        handleError('Please complete the CAPTCHA.', 'captcha_error');
    }

    $isOk = $captcha_response;

    // fname 
    $val_result = validateName($fname);
    $isOk &= ($val_result === true);
    handleError($val_result, 'fname_error');

    // lname
    $val_result = validateName($lname);
    $isOk &= ($val_result === true);
    handleError($val_result, 'lname_error');

    // phone
    $val_result = validatePhone($phone);
    $isOk &= ($val_result === true);
    handleError($val_result, 'phone_error');

    // email
    $val_result = validateEmail($email);
    $isOk &= ($val_result === true);
    handleError($val_result, 'email_error');
    
    // pass
    $val_result = validatePass($pass);
    $isOk &= ($val_result === true);
    handleError($val_result, 'pass_error');

    // daca mai exista email
    $conn = connectDB();
    $val_result = emailExists($conn, $email) === true ? 'email already exists' : true;
    $isOk &= ($val_result === true);
    handleError($val_result, 'email_error');

    if(!$isOk){
        // daca au fost erori la validare
        header('Location: signup.php');
        exit;   
    }

    // daca e ok pana acum hashuiesc parola si inserez in BD
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $inserted = insertUser($conn, $fname, $lname, $phone, $email, $pass);

    if(!$inserted){
        // error on insert in db
        header('Location: signup.php');    
        exit;
    }

    // mail confirmare
    require_once './includes/extra/mail.php';

    $to_name = $fname . ' ' . $lname;

    # hashuiesc email+parola+salt
    $hash = password_hash($email . $pass . 'nk*C6c6@h2-jc932;.L', PASSWORD_BCRYPT);

    #trimit mail cu emailul utilizatorului si hashul de mai sus
    $url = 'https://hillside-hotel.000webhostapp.com/confirm_signup.php?email=' . urlencode($email) . '&hash=' . urlencode($hash);
    $email_content = "Click <a href='$url'>here</a> to verify your account.";

    // daca n a mers sa trimit mail
    if(!sendMail($email, $to_name, 'Verify your account | Hillside Hotel', $email_content)){
        echo 'email error';
        exit;
    }
    
    // altfel redirect
    $_SESSION['message'] = 'We send you an email to verify your account. You must verify your account to login.';
    header('Location: message.php');
    exit;

    function handleError($validation_result, $error_type){
        // daca validation_result != true (e un string cu eroare) atunci avem o eroare si setez in session 
        // la ce a fost eroare si ce eroare
        if($validation_result !== true){
            $_SESSION[$error_type] = $validation_result;
            return false;
        }
        return true;
    }
 ?>