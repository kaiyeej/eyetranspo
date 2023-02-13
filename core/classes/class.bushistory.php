<?php

class BusHistory extends Connection
{
    private $table = 'tbl_trips';
    public $pk = 'trip_id';
    public $name = 'bus_id';

    public function show()
    {
        $rows = array();
        $TripSchedule = new TripSchedule();
        $Users = new Users();
        $Buses = new Buses();
        $rows = array();
        $count = 1;

        $bus_id = $this->inputs['bus_id'];

        if($bus_id == -1){
            $param = "";
        }else{
            $param = "bus_id = '$bus_id'";
        }

        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['count'] = $count;
            $row['bus'] = $Buses->name($row['bus_id']);
            $row['conductor'] = $row['user_id'] == 0 ? "---" : $Users->fullname($row['user_id']);
            $row['date'] = date('M d h:i A', strtotime($row["date_departed"]))." - ".date('M d h:i A', strtotime($row["date_arrived"]));
            $row['schedule'] = $TripSchedule->name($row['trip_schedule_id']);
            $rows[] = $row;

            $count++;
        }
        return $rows;
    }

    public function show_complaints()
    {
        $rows = array();
        $Trips = new Trips();
        $Users = new Users();
        $Buses = new Buses();
        $rows = array();
        $count = 1;

        $user_id = $this->inputs['user_id'];

        if($user_id == -1){
            $param = "";
        }else{
            $param = "AND user_id = '$user_id'";
        }

        $result = $this->select("tbl_transactions", '*', "remarks!='' $param");
        while ($row = $result->fetch_assoc()) {
            $row['count'] = $count;
            $row['bus'] = $row['bus_id'] == 0 ? "---" : $Buses->name($row['bus_id']);
            $row['passenger'] = $row['user_id'] == 0 ? "---" : $Users->fullname($row['user_id']);
            $row['trip'] = $Trips->name($row['trip_id']);
            $row['remarks'] = $row['remarks'];
            $rows[] = $row;

            $count++;
        }
        return $rows;
    }

    public function show_daily()
    {
        $rows = array();
        $Trips = new Trips();
        $Users = new Users();
        $Buses = new Buses();
        $rows = array();
        $count = 1;

        $user_id = $this->inputs['user_id'];
        $date_added = $this->inputs['date_added'];

        if($user_id == -1){
            $param = "";
        }else{
            $param = "AND user_id = '$user_id'";
        }

        $result = $this->select("tbl_transactions", '*', "DATE(date_added) = '$date_added' $param");
        while ($row = $result->fetch_assoc()) {
            $row['count'] = $count;
            $row['bus'] = $row['bus_id'] == 0 ? "---" : $Buses->name($row['bus_id']);
            $row['passenger'] = $row['user_id'] == 0 ? "---" : $Users->fullname($row['user_id']);
            $row['trip'] = $Trips->name($row['trip_id']);
            $row['remarks'] = $row['remarks'];
            $row['fare'] = number_format($row['fare'],2);
            $rows[] = $row;

            $count++;
        }
        return $rows;
    }



    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
    }

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function arrived(){

        $primary_id = $this->inputs['id'];
        $form = array(
            'status' => 'A',
        );
        
        return $this->update($this->table, $form, "$this->pk = $primary_id");
    }

}
