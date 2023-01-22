<?php

class Homepage extends Connection
{

    
    public function total_drivers(){
        $result = $this->select('tbl_drivers', 'count(driver_id)');
        $row = $result->fetch_array();
        return $row[0];
    }

    public function total_users(){
        $result = $this->select('tbl_users', 'count(user_id)');
        $row = $result->fetch_array();
        return $row[0];
    }

    public function total_trips(){
        $result = $this->select('tbl_trip_schedule', 'count(trip_schedule_id)');
        $row = $result->fetch_array();
        return $row[0];
    }
    
    public function total_buses(){
        $result = $this->select('tbl_buses', 'count(bus_id)',);
        $row = $result->fetch_array();
        return $row[0];
    }
}

?>
