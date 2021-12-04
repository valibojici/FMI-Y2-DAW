<?php

function getRoomTypeImages($conn){
    $sql = 'SELECT path FROM imagine_tip_camera;';
    $query = $conn->query($sql);

    $result = $query->fetch_all();
    
    return array_map(function ($arr){return $arr[0]; }, $result);
}

function getAvailableRoomTypes($conn, $checkin, $checkout, $guests){
    $stmt = '
    select t.nume as nume
    from camera c
    left join (
        select id_camera
        from rezervare
        where ? < check_out and ? > check_in
        ) r
    on c.id = r.id_camera
    inner join tip_camera t on c.id_tip = t.id
    where r.id_camera is null and t.capacitate >= ?;';

    $query = $conn->prepare($stmt);
    
    $query->bind_param('ssi', $checkin, $checkout, $guests);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    else return null;
}

function getRoomInfo($conn, $name){
    $stmt = '
    select descriere, capacitate, pret
    from tip_camera
    where nume = ?';

    $query = $conn->prepare($stmt);
    
    $query->bind_param('s', $name);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }
    else return null;
}

function getRoomImages($conn, $name){
    $stmt = '
    select i.path as path
    from imagine_tip_camera i
    inner join tip_camera t on t.id = i.id_tip
    where t.nume = ?';

    $query = $conn->prepare($stmt);
    
    $query->bind_param('s', $name);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    else return null;
}

function getMaxRoomCapacity($conn){
    $sql = 'select max(t.capacitate) as capacitate
    from camera c
    inner join tip_camera t on t.id = c.id_tip';
    
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return $result->fetch_assoc();
    }
    return null;
}

function getRoomTypes($conn){
    $sql = 'select * from tip_camera';
    
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return null;
}

function getRoomNumberAndType($conn, $id){
    $stmt = '
    select c.numar as numar, t.nume as nume
    from camera c
    inner join tip_camera t on t.id = c.id_tip
    where c.id = ?';

    $query = $conn->prepare($stmt);
    $query->bind_param('i', $id);
    $query->execute();

    $result = $query->get_result();
    $result = $result->fetch_assoc();
    return $result;
}