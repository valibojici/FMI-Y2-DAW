<?php
    function makeReservation(&$conn, $user_email, $room_type, $checkin, $checkout, $guests, $total){
        $stmt = "
        insert into rezervare(id_user,id_camera,check_in,check_out,nr_pers,suma_plata, data) 
        select
            (select id from user where upper(email) = upper(?) limit 1), 
            (select c.id
            from camera c 
            inner join tip_camera t on t.id = c.id_tip
            left join ( select id_camera 
                        from rezervare
                        where ? < check_out and ? > check_in and status != -1) r
            on c.id = r.id_camera
            where r.id_camera is null and upper(t.nume) = upper(?) limit 1), 
            ?, ?, ?, ?, CURRENT_DATE
        from dual";

        $query = $conn->prepare($stmt);
        $query->bind_param('ssssssii',
            $user_email,
            $checkin,
            $checkout,
            $room_type,
            $checkin,
            $checkout,
            $guests,
            $total
        );

        $result = $query->execute();

        return $result ? true : false;
    }

    function getUserReservations(&$conn, $user_id){
        $stmt = "select * from rezervare where id_user = ?";

        $query = $conn->prepare($stmt);
        $query->bind_param('i', $user_id);
        $query->execute();

        $result = $query->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    function getReservationInfo(&$conn, $id){
        $stmt = 'select * from rezervare where id = ?';
        $query = $conn->prepare($stmt);
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return null;
    }

    function deleteReservation(&$conn, $id){
        $stmt = 'delete from rezervare where id = ?';
        $query = $conn->prepare($stmt);
        $query->bind_param('i', $id);
        return $query->execute();
    }

    function updateOldReservations(&$conn){
        $stmt = '
        update rezervare 
        set status = -1
        where date(check_in) < date(CURRENT_DATE) and status = 0';
        $conn->query($stmt);
    }
?>