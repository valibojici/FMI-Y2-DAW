<?php
    function insert_statistics(&$conn, $ip, $url, $session_id){
        $stmt = 'insert into statistici(ip, url, session_id) values(?, ?, ?)';
        $query = $conn->prepare($stmt);
        $query->bind_param('sss', $ip, $url, $session_id);
        return $query->execute();
    }

    function getVisitors(&$conn, $url){
        $query = $conn->prepare('select count(distinct ip) from statistici where url = ?');
        $query->bind_param('s', $url);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_row() : null;
    }

    function getVisits(&$conn, $url){
        $query = $conn->prepare('select count(distinct session_id) from statistici where url = ?');
        $query->bind_param('s', $url);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_row() : null;
    }

    function getViews(&$conn, $url){
        $query = $conn->prepare('select count(*) from statistici where url = ?');
        $query->bind_param('s', $url);
        $query->execute();
        $result = $query->get_result();
        return $result->num_rows > 0 ? $result->fetch_row() : null;
    }

?>