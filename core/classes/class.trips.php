<?php

class Trips extends Connection
{
    private $table = 'tbl_trips';
    public $pk = 'trip_id';
    public $name = 'bus_id';

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'trip_schedule_id'  => $this->inputs['trip_schedule_id'],
            'user_id'           => $this->inputs['user_id'],
            'date_departed'     => $this->inputs['date_departed'],
            'date_arrived'      => $this->inputs['date_arrived'],
            'headings'          => $this->inputs['headings']
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'trip_schedule_id'  => $this->inputs['trip_schedule_id'],
            'user_id'           => $this->inputs['user_id'],
            'date_departed'     => $this->inputs['date_departed'],
            'date_arrived'      => $this->inputs['date_arrived'],
            'headings'          => $this->inputs['headings']
        );
        
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $TripSchedule = new TripSchedule();
        $Users = new Users();
        $Buses = new Buses();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $count = 1;
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

    public function trip_sched($trip_id)
    {
        $TripSchedule = new TripSchedule();
        $result = $this->select($this->table, "trip_schedule_id", "$this->pk = '$trip_id'");
        $trip_schedule_id =  $result->fetch_assoc();
        return $TripSchedule->route_name($trip_schedule_id['trip_schedule_id']);
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

        $this->update($this->table, $form, "$this->pk = $primary_id");

        $form_ = array(
            'status' => 'F',
        );
        
        return $this->update('tbl_transactions', $form_, "$this->pk = $primary_id");
    }

}
