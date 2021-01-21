 drop database if exists db_contacts;
 create database db_contacts;
 use db_contacts;
 
   create table contacts(
	id_contact int auto_increment primary key,
    contact_name varchar(50) unique not null,
    url_photo  varchar(50) default ''
 );
 
 create table phones(
 id_phone int auto_increment primary key,
 phone_number varchar(20) unique not null,
 id_contact int,
 foreign key(id_contact) references contacts(id_contact)
 );
 
 create table emails(
 id_email int auto_increment primary key,
 email varchar(80)  unique not null,
 id_contact int,
 foreign key(id_contact) references contacts(id_contact)
 );
 
 -- -----------------------INSERTS---------------------------
 insert into contacts(contact_name,url_photo) values('Lester Barahona','uploads/photo1.jpg');
 insert into phones(id_contact,phone_number) values(1,'62507315'),(1,'62416687');
 insert into emails(id_contact,email) values (1,'letybarahonaaguirre@gmail.com');
 
 insert into contacts(contact_name,url_photo) values('Ana Ruiz','uploads/photo2.jpg');
 insert into phones(id_contact,phone_number) values(2,'88875351'),(2,'89863545');
 insert into emails(id_contact,email) values (2,'emaildeana@gmail.com'),(2,'emaildeana2@gmail.com');
 
 insert into contacts(contact_name,url_photo) values('Karen Molina','uploads/photo3.jpg');
 insert into phones(id_contact,phone_number) values(3,'89186753'),(3,'80803421'),(3,'46797867');
 insert into emails(id_contact,email) values (3,'emaildekaren@gmail.com'),(3,'emaildekaren2@gmail.com');
 
 insert into contacts(contact_name,url_photo) values('Maria Roman','uploads/photo4.jpg');
 insert into phones(id_contact,phone_number) values(4,'62507325'),(4,'8811223344');
 insert into emails(id_contact,email) values (4,'mariaRoman@gmail.com'),(4,'mariaRoman2@gmail.com');
 
 insert into contacts(contact_name,url_photo) values('Kristel Morales','uploads/photo5.jpg');
 insert into phones(id_contact,phone_number) values(5,'54908753'),(5,'90783421'),(5,'87546767');
 insert into emails(id_contact,email) values (5,'emaildekristel@gmail.com'),(5,'emaildekristel2@gmail.com');
 
 -- --------------------------------------------------------PROCEDURES TEST
 call sp_get_contacts('');
 call sp_get_contact(1);
 call sp_update_contact(1,'Pedro juanes','uploads/photo1.jpg');
 call sp_get_last_contact_id();
 call sp_insert_contact('Holas','laruta');
