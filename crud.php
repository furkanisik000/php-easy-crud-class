<?php

class CRUD {
    public $db;
    function get_data($table, $where, $input, $d) {
        $db = $this->db;
        $q = $db->prepare("SELECT * FROM $table WHERE $where");
        $q->execute($input);
        if ($d) {
            return $q->fetch(PDO::FETCH_ASSOC);
        } else {
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function add_data($table, $query, $input) {
        $db = $this->db;
        $a = "?";
        foreach ($query as $d) $a .= ",?";
		$a = substr($a,0,strlen($a)-2);
        $q = $db->prepare("INSERT INTO " . $table . "(" . implode(",", $query) . ") VALUES (" . $a . ")");
		$q->execute($input); 
        return $q;
    }

    function set_data($table, $query, $where, $input) {
        $db = $this->db;
        $q = $db->prepare("UPDATE " . $table . " SET " . implode("=?,", $query) . "=? WHERE $where");
        $q->execute($input);
        return $q;
    }

    function delete_data($table, $where, $input) {
        $db = $this->db;
        $q = $db->prepare("DELETE FROM " . $table . " WHERE $where");
        $q->execute($input); 
        return $q;
    }
}

?>
