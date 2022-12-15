<?php

class Logs extends Connection
{
    private $table = 'tbl_logs';
    public $pk = 'log_id';

    public function show()
    { 
        
        if($_SESSION['cdms_user_category'] == "A"){
            $param = "";
        }else{
            $param = "user_id='$_SESSION[cdms_user_id]' ORDER BY date_added ASC";
        }
        
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        $Users = new Users();
        while ($row = $result->fetch_assoc()) {
            $row['user'] = $Users->fullname($row['user_id']);
            $rows[] = $row;
        }
        return $rows;
    }

}
