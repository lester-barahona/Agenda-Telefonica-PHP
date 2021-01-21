<?php
include_once('db/connection.php');
class Db_phones extends Connection{

    function __construct(){
        parent::__construct();
    }
  
    function get_phones($id_contact){
        return $this->query("call sp_get_phones($id_contact);");
    }

    function insert_phone($id_contact,$phone_number){
        return $this->execute("call sp_insert_phone($id_contact,'$phone_number');");
    }

    function delete_phones($id_contact){
        return $this->execute("call sp_delete_phones($id_contact);");
    }

}
?>