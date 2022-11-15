<?php
namespace App;


class User
{

    function user($name,$email){

        $this->name=$name;
        $this->email=$email;
    }

    function name($name='Erini') {
        if($name){
            $this->name=$name;
        }
        return $this->name;
    }

    function email($email='erini@gmail.com') {
        if($email){
            $this->email=$email;
        }
        return $this->email;
    }

}



?>
