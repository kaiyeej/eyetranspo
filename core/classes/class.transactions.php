<?php

class Transactions extends Connection
{
    private $table = 'tbl_transactions';
    public $pk = 'transaction_id';
    public $name = 'bus_id';

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
        $Users = new Users();
        $Buses = new Buses();
        $Trips = new Trips();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $count =1;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['count'] = $count;
            $row['bus'] = $Buses->name($row['bus_id']);
            $row['user'] = $Users->fullname($row['user_id']);
            $row['trip'] = $Trips->name($row['trip_id']);
            $count++;
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
}
