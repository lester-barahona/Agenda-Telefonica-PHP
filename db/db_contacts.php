<?php
require_once('db/connection.php');

class Db_contacts extends Connection{

    function __construct(){
        parent::__construct();
    }

    function insert_contact($data){
        extract($data);
        return $this->execute("call sp_insert_contact('$contact_name');");
    }

    function get_contact($id_contact){
        return $this->query("call sp_get_contact($id_contact);");
    }

    function get_contacts($search=''){
        return $this->query("call sp_get_contacts('$search');");
    }

    function delete_contact($id_contact){
        return $this->execute("call sp_delete_contact($id_contact);");
    }

    function update_contact($data){
        extract($data);
        return $this->execute("call sp_update_contact($id_contact,'$contact_name','$url_photo');");
    }

    function get_last_contact_id(){
        return $this->query("call sp_get_last_contact_id();");
    }
    function set_url_photo($id_contact,$ulr){
        return $this->query("call sp_set_url_photo($id_contact,'$ulr');");
    }

}
?>