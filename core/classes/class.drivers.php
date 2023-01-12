<?php

class Drivers extends Connection
{
    private $table = 'tbl_drivers';
    private $pk = 'driver_id';
    private $name = 'driver_fname';

    public function add()
    {
        if (isset($_FILES['file']['tmp_name'])) {
            $driver_img = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], '../assets/drivers/' . $driver_img);
        } else {
            $driver_img = "";
        }
        
        $form = array(
            $this->name        => $this->clean($this->inputs[$this->name]),
            'driver_mname'     => $this->inputs['driver_mname'],
            'driver_lname'     => $this->inputs['driver_lname'],
            'driver_img'       => $driver_img,
            'driver_address'   => $this->inputs['driver_address'],
            'driver_remarks'   => $this->inputs['driver_remarks'],
        );
        
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $driver_fname = $this->clean($this->inputs['driver_fname']);
        $driver_mname = $this->clean($this->inputs['driver_mname']);
        $driver_lname = $this->clean($this->inputs['driver_lname']);
        $is_exist = $this->select($this->table, $this->pk, "driver_fname = '$driver_fname' AND driver_mname = '$driver_mname' AND driver_lname = '$driver_lname' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name        => $this->clean($this->inputs[$this->name]),
                'driver_mname'     => $this->inputs['driver_mname'],
                'driver_lname'     => $this->inputs['driver_lname'],
                'driver_address'   => $this->inputs['driver_address'],
                'driver_remarks'   => $this->inputs['driver_remarks'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function uploadImage()
    {
        $id = $this->inputs['driver_id'];
        if (isset($_FILES['file']['tmp_name'])) {
            $driver_image = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], '../assets/drivers/' . $driver_image);
        } else {
            $driver_image = "";
        }

        $form = array(
            'driver_img' => $driver_image,
        );
        return $this->update($this->table, $form, "$this->pk = '$id'");
    }


    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }
    
    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['driver'] = $row['driver_fname']." ".$row['driver_mname']." ".$row['driver_lname'];
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

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }

    public static function fullname($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'driver_fname,driver_mname,driver_lname', "$self->pk  = '$primary_id'");
        $row = $result->fetch_array();
        return $row[0]." ".$row[1]." ".$row[2];
    }

    public static function number($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_contact_num', "$self->pk  = '$primary_id'");
        $row = $result->fetch_array();
        return $row[0];
    }
    
    public static function dataRow($primary_id, $field = "*")
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk  = '$primary_id'");
        $row = $result->fetch_array();
        return $row[$field];
    }
}
