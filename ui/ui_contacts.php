<?php

require_once('ln/ln_contacts.php');

class Ui_contacts{
    
    var $ln;

    function __construct(){
        $this->ln=new Ln_contacts();
    }

    function action_controller(){
        $this->ln->action_controller();
    }

    function get_data_form(){
        $data=array(
            'data'=> array(
                'id_contact' => -1,
                'contact_name' => '',
                'url_photo'  => '',
                'phones'=> array(),
                'emails'=>array()
            ),
            'btn_text'=>'REGISTRAR',
            'action'=>'insert');

        if(isset($_GET['view'])){
            if($_GET['view']=='edit'){
                $data=array(
                    'data'=>$this->ln->get_contact($_GET['id_contact']),
                    'btn_text'=>'ACTUALIZAR',
                    'action'=>'update');
            }
        }
        
        return $data;
    }
    //-----------------------------------------------------------FORM 
    function get_form(){

        $data=$this->get_data_form();
        extract($data);

        ?>
        <form action="index.php?action=<?=$action?>" class="bg-light p-4 form-grid" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <input type="hidden" name="id_contact" value="<?=$data['id_contact']?>">
            </div>

            <div class="form-group">
                <label for="custom-file">Elige Una Foto</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file-input" name="photo"  accept="image/png, image/jpeg">
                    <label class="custom-file-label" for="customFile">Foto</label>
                </div> 
            </div>

            <div class="form-group">
                <label for="contact_name">Nombre</label>
                <input type="text" class="form-control" name="contact_name"  value="<?=$data['contact_name']?>" required>
            </div>

            <div class="form-group">
                <label for="telefonos">Telefono</label>
                <button type="button" class="btn btn-primary fas fa-plus font-weight-bold ml-2" id="add-phone"></button>   
            </div>
            <div class="form-group" id="container-phones">
                <?php
                if($data['phones']){
                 foreach($data['phones'] as $phone){ ?>
                <div class="form-row">
                    <div class="col-10">
                        <input type="number" name="phones[]" class="form-control mb-3" value="<?=$phone['phone_number']?>" required>
                    </div>
                    <div class="col-2">
                    <button type="button" class="btn btn-danger btn-delete-phone"><i class="fas fa-trash-alt"></i></button>  
                    </div>
                 </div>
                <?php }
                }else{?>
                 <div class="form-row">
                    <div class="col-10">
                        <input type="number" name="phones[]" class="form-control mb-3" value="" required>
                    </div>
                    <div class="col-2">
                    <button type="button"  class="btn btn-danger btn-delete-phone"><i class="fas fa-trash-alt"></i></button>  
                    </div>
                 </div>   
                <?php
                }?>   
            </div>

            <div class="form-group mt-5">
                <label for="telefonos">Correo</label>
                <button type="button" class="btn btn-primary fas fa-plus font-weight-bold ml-3" id="add-email"></button>   
            </div>
            <div class="form-group" id="container-emails">
                <?php
                if($data['phones']){
                 foreach($data['emails'] as $email){ ?>
                 <div class="form-row">
                    <div class="col-10">
                    <input type="email" class="form-control mb-3" name="emails[]" value="<?=$email['email']?>" required>
                    </div>
                    <div class="col-2">
                    <button type="button" class="btn btn-danger btn-delete-email"><i class="fas fa-trash-alt"></i></button>
                    </div>
                 </div>
                <?php }
                }else{
                ?>
                <div class="form-row">
                    <div class="col-10">
                    <input type="email" class="form-control mb-3" name="emails[]" value="" required>
                    </div>
                    <div class="col-2">
                    <button type="button" class="btn btn-danger btn-delete-email"><i class="fas fa-trash-alt"></i></button>
                    </div>
                 </div>
                 <?php }?>                  
            </div>
            
            <button type="submit" class="btn btn-primary mt-4"><?=$btn_text?><i class="fas fa-check pl-2"></i></button>
          </form>
         <?php
    }

    //-----------------------------------------------------SEARCH

    function get_table(){
        $search = "";
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }
        $data = $this->ln->get_contacts($search);

        ?>
        
        <form action="index.php" method="GET">
         <div class="form-row  text-center">
            <div class="form-group col-sm-8">
            <input class="form-control" type="search" name="search" value="<?=$search?>">
            </div>
            <div class="form-group col-sm-2">
              <button class="btn btn-info">BUSCAR <i class="fas fa-search pl-2"></i></button>
            </div>
            <div class="form-group col-sm-2">
            <a href="index.php" class="btn btn-info">TODOS <i class="fas fa-th-list pl-2"></i></a>
            </div>
         </div>
        </form>
        <div class="container container-grid p-4">
            <?php foreach($data as $contact){
                $this->get_target_contact($contact); 
            } 
            ?>
        </div>
        
        
        <?php
    }
//------------------------------------------------------------------CONTACT
    function get_target_contact($data){
        extract($data);
        ?>
        <div>
        <div class="card-full bg-light">
        <a href="index.php?action=delete&id_contact=<?=$id_contact?>" class="font-weight-bold text-center fas fa-trash-alt btn-delete"></a>
            <div class="img-container">
                <img src="<?=$url_photo.'?='.filemtime($url_photo)?>?>" class="photo-contact" alt="">
            </div>
            <div class="content-contact text-left p-3">
                 <h4 class="text-info"><?=$contact_name?></h4>
                 <a href="index.php?view=edit&id_contact=<?=$id_contact?>" class="font-weight-bold text-center far fa-edit btn-edit"></a>
                 <hr>
                <div class="list  text-left">
                <ul class="fa-ul">
                 <?php foreach($data['phones'] as $phone){?>
                    
                 <li><span class="fa-li"><i class="far fa-dot-circle pr-2"></i></span><?=$phone['phone_number']?></li>
                 <?php }?>
                 </ul>
                 <hr>
                 <ul class="fa-ul">
                 <?php foreach($data['emails'] as $email){?>
                 <li><span class="fa-li"><i class="far fa-dot-circle pr-2"></i></span><?=$email['email'];?></li>
                 <?php }?>
                 </ul>
                 </div>
                
            </div>
            </div>
        </div>
        <?php
    }
}
?>