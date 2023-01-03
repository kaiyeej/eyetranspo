<?php

class LoginUser extends Connection
{
    private $table = 'tbl_users';
    public $pk = 'user_id';
    public $name = 'user_fname';
    

    public function login()
    {

        $username = $this->inputs['username'];
        $password = $this->inputs['password'];

        $result = $this->select($this->table, "*", "username = '$username' AND password = md5('$password')");
        $row = $result->fetch_assoc();

        if ($row) {

            if($row['user_category'] == "A"){
                $cat = "Admin";
            }else{
                $cat = "User";
            }

            $_SESSION['et_status'] = "in";
            $_SESSION["et_username"] = $row['username'];
            $_SESSION["et_user_category"] = $row['user_category'];
            $_SESSION["et_user_cat"] = $cat;
            $_SESSION["et_user_id"] = $row['user_id'];

            $res = 1;
        } else {
            $res = 0;
        }

        // return $row[$this->name];

        return $res;
    }
    public function logout()
    {
        session_destroy();
        return 1;
    }
}
