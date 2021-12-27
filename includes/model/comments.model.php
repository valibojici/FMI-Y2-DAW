<?php 
    function getComments(&$conn){
        $result = $conn->query('
        select c.*, nume, prenume
        from comentariu c
        inner join user u on u.id = c.id_user
        where aprobat = 1');
        if($result->num_rows > 0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    function insertComment(&$conn, $id_user, $comment){
        $stmt = 'insert into comentariu(text,aprobat,id_user) values(?,0,?)';
        $query = $conn->prepare($stmt);
        $query->bind_param('si',$comment, $id_user);
        $ok = $query->execute();
        if(!$ok || $conn->affected_rows == 0){
            return false;
        }
        return true;
    }
 
    function canLeaveComment(&$conn, $id_user){
        $stmt = '
        select 1
        from dual 
        where ? not in (select id_user from comentariu) and ? in (select id_user from rezervare where status = 1)';
        $query = $conn->prepare($stmt);
        $query->bind_param('ii', $id_user, $id_user);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows == 1;
    }
?>