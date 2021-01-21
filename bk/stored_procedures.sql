/*-------------PROCEDURES DB_CONTACTS------------------*/
-- --------------------------------------------------------- CONTACTS
create procedure `sp_get_contact`(`p_id` int)
select * from contacts where id_contact=p_id;

create procedure `sp_get_contacts`(`p_buscar` varchar(50))
select * from contacts where contact_name like concat('%',p_buscar,'%');

create procedure `sp_insert_contact`(`p_contact_name` varchar(50))
insert into contacts(contact_name) values (p_contact_name);

create procedure `sp_delete_contact`(`p_id` int)
delete from contacts where id_contact=p_id;

create procedure `sp_update_contact`(`p_id` int,`p_contact_name` varchar(50),`p_url_photo` varchar(50))
update contacts set  contact_name=p_contact_name, url_photo=p_url_photo where id_contact=p_id;

create procedure `sp_set_url_photo`(`p_id` int,`p_url` varchar(50))
update contacts set url_photo=p_url where id_contact=p_id;

create procedure `sp_get_last_contact_id`()
select MAX(id_contact) as id_contact from contacts;

-- -------------------------------------------------------PHONES
create procedure `sp_insert_phone`(`p_id_contact` int,`p_phone_number` varchar(20))
insert into phones(id_contact,phone_number) values(p_id_contact,p_phone_number);

create procedure `sp_delete_phones`(`p_id` int)
delete from phones where id_contact=p_id;

create procedure `sp_get_phones`(`p_id_contact` int)
select * from phones where id_contact=p_id_contact;
-- -------------------------------------------------------EMAILS
create procedure `sp_insert_email`(`p_id_contact` int,`p_email` varchar(80))
insert into emails(id_contact,email) values(p_id_contact,p_email);

create procedure `sp_delete_emails`(`p_id` int)
delete from emails where id_contact=p_id;

create procedure `sp_get_emails`(`p_id_contact` int)
select * from emails where id_contact=p_id_contact;

  