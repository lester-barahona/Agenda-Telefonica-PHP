<?php
include_once('db/db_phones.php');
class Ln_phones{
    var $db_phones;

    function __construct(){
        $this->db_phones=new Db_phones();
    }

    function get_phones($id_contact){
        return $this->db_phones->get_phones($id_contact);
    }
   
    function insert_phone($id_contact,$email){
        $this->db_phones->insert_phone($id_contact,$email);
    }

    function insert_phones($id_contact,$emails){
        foreach($emails as $email){
            $this->insert_phone($id_contact,$email);
        }
    }
    
    function delete_phones($id_contact){
        $this->db_phones->delete_phones($id_contact);
    }
}

?>