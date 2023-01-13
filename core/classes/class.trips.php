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
            'date_departed'     => $this->inputs['date_departed'],
            'date_arrived'      => $this->inputs['date_arrived'],
            'headings'          => $this->inputs['headings']
        );
        
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $rows = array();
        $Drivers = new Drivers();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
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