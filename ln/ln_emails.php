<?php
include_once('db/db_emails.php');
class Ln_emails{
    var $db_emails;

    function __construct(){
        $this->db_emails=new Db_emails();
    }

    function get_emails($id_contact){
        return $this->db_emails->get_emails($id_contact);
    }
   
    function insert_email($id_contact,$email){
        $this->db_emails->insert_email($id_contact,$email);
    }

    function insert_emails($id_contact,$emails){
        foreach($emails as $email){
            $this->insert_email($id_contact,$email);
        }
    }

    function delete_emails($id_contact){
        $this->db_emails->delete_emails($id_contact);
    }
}
?>