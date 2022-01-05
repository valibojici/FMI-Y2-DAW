<?php
    function getUserInfo(&$conn, $user){
        $stmt = 'select * from admin_site where username = ?';
        $query = $conn->prepare($stmt);
        $query->bind_param('s', $user);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return null;
    }

    function getUserPermissions(&$conn, $id){
        $stmt = '
        select p.denumire 
        from permisiune p
        inner join admin_permisiune ap on p.id = ap.id_permisiune
        and ap.id_admin = ?
        ';
        $query = $conn->prepare($stmt);
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return $result->fetch_all();
        }
        return null;
    }

    function getTables(&$conn){
        $query = $conn->query('select table_name from information_schema.tables where table_schema = "id18160562_proiect"');
        $result = $query->fetch_all();
        return $result;
    }

    function getRows(&$conn, $tbl){
        $tbl = $conn->real_escape_string($tbl);
        $query = $conn->query('select * from ' . $tbl);
        if($query->num_rows > 0){
            return $query->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    function getColumnNames(&$conn, $tbl){
        $stmt = 'select column_name from information_schema.columns where table_name = ? and table_schema = "id18160562_proiect"';
        $query = $conn->prepare($stmt);
        $query->bind_param('s', $tbl);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0){
            return $result->fetch_all();
        }
        return null;
    }

    function idExists(&$conn, $tbl, $id){
        $result = $conn->query('select 1 from ' . $conn->real_escape_string($tbl) . ' where id = ' . $conn->real_escape_string($id));
        return $result->num_rows != 0;
    }

    function insert(&$conn, $tbl, $data){
        $tbl = $conn->real_escape_string($tbl);
        $col_names = [];
        $col_vals = [];
        foreach($data as $k => $v){
            array_push($col_names, $conn->real_escape_string($k));
            array_push($col_vals, "'" . $conn->real_escape_string($v) . "'");
        }
        $stmt = 'insert into ' . $tbl . ' (' . implode(',', $col_names) . ' ) values(' . implode(',',$col_vals) . ')';
        
        return $conn->query($stmt);
    }

    function delete(&$conn, $tbl, $id){
        $tbl = $conn->real_escape_string($tbl);
        $stmt = 'delete from ' . $tbl . ' where id = ?';
        $query = $conn->prepare($stmt);
        $query->bind_param('i', $id);
        $ok = $query->execute();
        return $ok;
    }

    function update(&$conn, $tbl, $data, $old_id){
        $tbl = $conn->real_escape_string($tbl);
        $old_id = $conn->real_escape_string($old_id);
        $col_names = [];
        $col_vals = [];
        foreach($data as $k => $v){
            array_push($col_names, $conn->real_escape_string($k));
            array_push($col_vals, "'" . $conn->real_escape_string($v) . "'");
        }
        $data = array_map(function($name, $val){
            return $name . '=' . $val;
        }, $col_names, $col_vals);

        $stmt = 'update ' . $tbl . ' set ' . implode(',', $data) . ' where id = ' . $old_id;

        return $conn->query($stmt);
    }
?>