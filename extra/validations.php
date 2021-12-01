<?php
function validateDate($date){
    $matches = null;
    $ok = preg_match('/(\d\d\d\d)\-(\d\d)\-(\d\d)/', $date, $matches);
    if(!$ok) return false;
    
    $date = $matches[0];
    return strtotime($date) > strtotime(Date('Y-m-d'));
}

function validateName($name){
    if(strlen(trim($name)) == 0){
        return 'empty field';
    }
    return true;
}

function validatePhone($phn){
    if(strlen(trim($phn)) == 0){
        return 'empty field';
    }
    if(!preg_match('/^[0-9]+$/', $phn)){
        return 'only digits allowed';
    }
    return true;
}

function validateEmail($email){
    if(strlen(trim($email)) == 0){
        return 'empty field';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return 'invalid email';
    }
    return true;
}

function validatePass($pass){
    if(strlen($pass) == 0){
        return 'empty field';
    }
    return true;
}

function validateCardNumber($card){
    if(strlen(trim($card)) == 0){
        return 'empty field';
    }
    if(!preg_match('/\d{16}/', $card)){
        return 'invalid credit card number';
    }
    return true;
}

function validateCardYear($year){
    if(strlen(trim($year)) == 0){
        return 'empty field';
    }
    if(!preg_match('/\d{4}/', $year)){
        return 'invalid year';
    }
    return true;
}

function validateCardMonth($month){
    if(strlen(trim($month)) == 0){
        return 'empty field';
    }
    if(!preg_match('/\d{1,2}/', $month)){
        return 'invalid month';
    }
    return true;
}

function validateCardCVV($cvv){
    if(strlen(trim($cvv)) == 0){
        return 'empty field';
    }
    if(!preg_match('/\d{3}/', $cvv)){
        return 'invalid cvv';
    }
    return true;
}
?>