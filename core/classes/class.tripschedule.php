<?php

class TripSchedule extends Connection
{
    private $table = 'tbl_trip_schedule';
    public $pk = 'trip_schedule_id';
    public $name = 'trip_schedule_time';

    public function add()
    {
        $form = array(
            // $this->name             => $this->clean($this->inputs[$this->name]),
            'trip_schedule_time'    => $this->inputs['trip_schedule_time'],
            'route_id'              => $this->inputs['route_id'],
            'trip_schedule_fare'    => $this->inputs['trip_schedule_fare']
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            // $this->name             => $this->clean($this->inputs[$this->name]),
            'trip_schedule_time'    => $this->inputs['trip_schedule_time'],
            'route_id'              => $this->inputs['route_id'],
            'trip_schedule_fare'    => $this->inputs['trip_schedule_fare']
        );
        
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $BusRoutes = new BusRoutes();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['route'] = $BusRoutes->name($row['route_id']);
            $rows[] = $row;
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

}
