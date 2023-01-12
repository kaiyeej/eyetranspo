<?php

class Buses extends Connection
{
    private $table = 'tbl_buses';
    public $pk = 'bus_id';
    public $name = 'bus_number';

    public function add()
    {
        $is_exist = $this->select($this->table, $this->pk, "bus_number = '$this->name'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name     => $this->clean($this->inputs[$this->name]),
                'driver_id'              => $this->inputs['driver_id'],
                'bus_plate_number'       => $this->inputs['bus_plate_number'],
                'bus_operator'           => $this->inputs['bus_operator'],
                'bus_max_capacity'       => $this->inputs['bus_max_capacity'],
                'bus_route'              => $this->inputs['bus_route'],
                'bus_remarks'            => $this->inputs['bus_remarks'],
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $is_exist = $this->select($this->table, $this->pk, "bus_number = '$this->name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name     => $this->clean($this->inputs[$this->name]),
                'driver_id'              => $this->inputs['driver_id'],
                'bus_plate_number'       => $this->inputs['bus_plate_number'],
                'bus_operator'           => $this->inputs['bus_operator'],
                'bus_max_capacity'       => $this->inputs['bus_max_capacity'],
                'bus_route'              => $this->inputs['bus_route'],
                'bus_remarks'            => $this->inputs['bus_remarks'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function cancel()
    {
        $ids = implode(",", $this->inputs['ids']);
        $form = array(
            'status' => 'C'
        );

        return $this->update($this->table, $form, "$this->pk IN($ids)");
    }

    public function show()
    {
        $rows = array();
        $Drivers = new Drivers();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['driver'] = $Drivers->fullname($row['driver_id']);
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
