<?php
    function getFacilities(&$conn){
        $query = $conn->query('select * from facilitate');
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    function getFacilityImages(&$conn, $name)
    {
        $stmt = 'select * 
        from imagine_facilitate i 
        inner join facilitate f on f.id = i.id_facilitate
        and upper(f.denumire) = upper(?)';

        $query = $conn->prepare($stmt);
        $query->bind_param('s', $name);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

?>