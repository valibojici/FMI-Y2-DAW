<?php

function insertUser(&$conn, $fname,$lname,$phone,$email,$hashed_pass){
    $query = $conn->prepare('insert into user(nume,prenume,telefon,email,parola,status) values (?, ?, ?, ?, ?, 0)');

    $query->bind_param('sssss',$lname, $fname, $phone, $email, $hashed_pass);
    $ok = $query->execute();
    $query->close();
    return $ok;
}

function emailExists(&$conn, $email){
    $result = query($conn, ['1'], $email);
    return $result !== [];
}

function getUserData(&$conn, $email){
    $result = query($conn, ['*'], $email);
    return $result === [] ? null : $result[0];
}

function query(&$conn, $cols, $email){
    $stmt = 'select ' . implode(',', $cols) . ' from user where email = ?';
    $query = $conn->prepare($stmt);
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function deleteUnverifiedUsers(&$conn){
    $stmt = 'delete from user where status = 0 and creat_la < DATE_SUB(NOW(),INTERVAL 15 MINUTE)';
    $conn->query($stmt);
}

function verifyUser(&$conn, $email){
    $stmt = 'update user set status = 1 where email = ? and status = 0';
    $query = $conn->prepare($stmt);
    $query->bind_param('s', $email);
    $ok = $query->execute();
    if(!$ok || $conn->affected_rows == 0){
        return false;
    }
    return true;
}
 