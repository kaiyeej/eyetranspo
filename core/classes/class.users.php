<?php

class Users extends Connection
{
    private $table = 'tbl_users';
    private $pk = 'user_id';
    private $name = 'username';

    public function add()
    {
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $pass = $this->inputs['password'];
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'user_contact_number' => $this->inputs['user_contact_number'],
                'user_category' => $this->inputs['user_category'],
                'date_added' => $this->getCurrentDate(),
                'username' => $this->inputs['username'],
                'password' => md5($pass),
                'status' => "A"
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'user_contact_number' => $this->inputs['user_contact_number'],
                'user_category' => $this->inputs['user_category'],
                'username' => $username
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }


    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function approved()
    {
        $form = array(
            'status' => "A"
        );

        $ids = implode(",", $this->inputs['ids']);
        foreach ((array) $this->inputs['ids'] as $user_id) {
            $this->sendNotif($user_id, 'Congratulations!', 'Your account was successfully verified.');
        }

        return $this->update($this->table, $form, "$this->pk IN($ids)");
    }

    function sendNotif($user_id, $title, $body)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $result = $this->select($this->table, "id_token", "$this->pk = '$user_id'");
        $idtoken = $result->fetch_assoc();

        $tokens = array($idtoken['id_token'], "");

        //Title of the Notification.
        //$title = "Title";

        //Body of the Notification.
        //$body = "Test";

        //Creating the notification array.
        $notification = array('title' => $title, 'body' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'priority' => 'high');

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAAKHerr0k:APA91bFat1gnsBdgVQm8kLKrW0EmgYakJyLZssbF8_S41WscrO_1qDWSI2JGJk4N5zu_Rc5_lyZJHOXwh9ioWYLfkOp8akdNgZzKDi9fJdgROeE_ajhnswpxDKCTIzONu9W_2D_cLbtK'; // key here

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
        return $response;
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
            $row['user_fullname'] = $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
            $row['category'] = $row['user_category'] == "A" ? "Admin" : ($row['user_category'] == "C" ? "Conductor" : "Passenger");
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

    public static function category($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_category', "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['user_category'] == "A" ? "Admin" : ($row['user_category'] == "C" ? "Conductor" : "Passenger");
    }

    public static function fullname($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_fname,user_mname,user_lname', "$self->pk  = '$primary_id'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[0] . " " . $row[1] . " " . $row[2];
        } else {
            return "---";
        }
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
