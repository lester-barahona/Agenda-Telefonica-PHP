<?php
include_once('db/connection.php');
class Db_emails extends Connection{

    function __construct(){
        parent::__construct();
    }
  
    function get_emails($id_contact){
        return $this->query("call sp_get_emails($id_contact);");
    }

    function insert_email($id_contact,$email){
         
        $this->execute("call sp_insert_email($id_contact,'$email');");
    }

    function delete_emails($id_contact){
        return $this->execute("call sp_delete_emails($id_contact);");
    }
}
 ?>   