<?php
require_once('db/db_contacts.php');
require_once('ln/ln_emails.php');
require_once('ln/ln_phones.php');
class Ln_contacts{

    var $db_contacts;
    var $ln_emails;
    var $ln_phones;

    function __construct(){
       $this->db_contacts=new Db_contacts(); 
       $this->ln_emails=new Ln_emails();
       $this->ln_phones=new Ln_phones();
    }

    function action_controller(){
        if(isset($_GET['action'])){
            switch($_GET['action']){

                case 'insert':
                    $this->insert_contact($_POST);
                break;
                
                case 'update':
                    $this->update_contact($_POST);
                break;
                
                case 'delete':
                    $this->delete_contact($_GET['id_contact']);
                break;
            }
            exit();
        }
    }

    function insert_contact($data){
        $this->db_contacts->insert_contact($data);
        $last_contact_id=$this->get_last_contact_id();
        $this->db_contacts->set_url_photo($last_contact_id,$this->upload_photo($last_contact_id));
        $this->ln_emails->insert_emails($last_contact_id,$data['emails']);
        $this->ln_phones->insert_phones($last_contact_id,$data['phones']);
        header('Location:index.php');
    }

    function delete_contact($id_contact){
        $this->ln_phones->delete_phones($id_contact);
        $this->ln_emails->delete_emails($id_contact);
        $this->delete_photo($id_contact);
        $this->db_contacts->delete_contact($id_contact);
        $this->delete_photo($id_contact);
        header('Location:index.php');
    }

    function update_contact($data){
        $data['url_photo']= $this->upload_photo($data['id_contact']);
        $this->db_contacts->update_contact($data);
        $this->ln_phones->delete_phones($data['id_contact']);
        $this->ln_emails->delete_emails($data['id_contact']);
        $this->ln_emails->insert_emails($data['id_contact'],$data['emails']);
        $this->ln_phones->insert_phones($data['id_contact'],$data['phones']);
        header('Location:index.php');
    }

    function get_contact($id_contact){
        $contact= $this->db_contacts->get_contact($id_contact);
        if($contact){
            return $this->merge_phones_emails($contact[0]);
        }else{
            return false;
        }
    }

    function merge_phones_emails($contact){
        return array_merge($contact,array('phones'=>$this->ln_phones->get_phones($contact['id_contact']),
        'emails'=>$this->ln_emails->get_emails($contact['id_contact'])));
    }

    function get_contacts($search=''){
       $contacts= $this->db_contacts->get_contacts($search);
       for ($i=0; $i <count($contacts); $i++){
       $contacts[$i]= $this->merge_phones_emails($contacts[$i]);;                       
       }
       return $contacts;
    }

    function get_last_contact_id(){
        return $this->db_contacts->get_last_contact_id()[0]['id_contact'];
    }

    function upload_photo($id_contact){
        $dir='uploads/';
        if(isset($_FILES['photo'])&& $_FILES['photo']['name']!=''){
            $ext=strtolower(pathinfo($dir.$_FILES['photo']['name'],PATHINFO_EXTENSION)); 
            if(move_uploaded_file($_FILES['photo']['tmp_name'],$dir.'photo'.$id_contact.'.'.$ext)){
                return $dir.'photo'.$id_contact.'.'.$ext;
            }
        }else{
        return $dir.'photo-default.jpg';
        }
    }

    function delete_photo($id_contact){
        $contact=$this->get_contact($id_contact);
        if(file_exists($contact['url_photo']) && $contact['url_photo']!='uploads/photo-default.jpg'){
            unlink($contact['url_photo']); 
          }
    }

}
?>