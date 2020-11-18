create database db_parkingsoft;
use db_parkingsoft;

create table roles (
id_roles tinyint(3) unsigned not null auto_increment ,
name_role varchar(15) not null,
description_role text not null,
role_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_roles)
)ENGINE=InnoDB default charset=utf8;

create table document_types (
id_document_type tinyint(3) unsigned not null auto_increment,
document_type_name varchar(30) not null unique,
document_type_acronym varchar(4) not null,
statu_type_acronym tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_document_type)
)ENGINE=InnoDB default charset=utf8;

create table membership_types (
id_membership_type int unsigned not null auto_increment,
membership_name varchar(40) not null,
price_membership float (9,3) unsigned null,
status_membership_type tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_membership_type)
)ENGINE=InnoDB default charset=utf8;

create table vehicle_types (
id_vehicle_type int unsigned not null auto_increment,
fk_id_rates int unsigned not null,
vehicle_name varchar(35) not null,
status_vehicle tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_vehicle_type)
)ENGINE=InnoDB default charset=utf8;

create  table block_types (
id_block_type int unsigned not null auto_increment,
name_block_type varchar(30) not null,
block_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_block_type)
)ENGINE=InnoDB default charset=utf8;

create table genders (
id_gender tinyint(3) unsigned not null auto_increment,
name_gender varchar(25) not null unique,
gender_acronym varchar(5) not null,
gender_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_gender)
)ENGINE=InnoDB default charset=utf8;

create table payment_methods (
id_payment_method int unsigned not null auto_increment,
payment_method varchar(35) not null,
payment_method_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_payment_method)
)ENGINE=InnoDB default charset=utf8;

create table roles_users (
pk_fk_document_number varchar(15) not null,
pk_fk_id_document_type tinyint(3) unsigned not null,
pk_fk_id_roles tinyint(3) unsigned not null,
roles_users_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(pk_fk_document_number,pk_fk_id_document_type,pk_fk_id_roles)
)ENGINE=InnoDB default charset=utf8;

create table log_errors (
id_error int unsigned not null auto_increment,
description_error text not null,
date_error date not null,
time_error time not null,
primary key(id_error)
)ENGINE=InnoDB default charset=utf8;

create table notifications(
id_notifications int unsigned not null auto_increment,
email varchar(80) not null,
sms text not null,
primary key(id_notifications)
)ENGINE=InnoDB default charset=utf8;

create table users (
document_number varchar(15) not null,
pk_fk_id_document_type tinyint(3) unsigned not null,
fk_id_gender tinyint(3) unsigned null,
name_user varchar(25) null unique,
first_name varchar(25) not null,
second_name varchar(25) null,
surname varchar(25) not null,
second_surname varchar(25) null,
birthdate date null,
address varchar(80) null,
telephone varchar(15) null,
email varchar(80) not null unique,
password_user varchar(50) not null,
name_file varchar(40) null,
type_file varchar(40) null,
photo_user blob null,
status_user tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(document_number,pk_fk_id_document_type)
)ENGINE=InnoDB default charset=utf8;

create table vehicles (
vehicle_plate varchar(10) not null,
fk_document_number varchar(15) null,
fk_id_document_type tinyint(3) unsigned null,
fk_id_vehicle_type int unsigned not null,
model_number varchar(15) null,
name_file varchar(40) null,
type_file varchar(40) null,
photo_vehicle blob null,
vehicle_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(vehicle_plate)
)ENGINE=InnoDB default charset=utf8;

create table blocks (
id_block int unsigned not null auto_increment,
fk_id_block_type int unsigned not null,
fk_id_ticket int unsigned null,
fk_vehicle_type int unsigned null,
block_number int(3) not null,
block_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_block)
)ENGINE=InnoDB default charset=utf8;

create table memberships (
id_membership int unsigned not null auto_increment,
fk_id_membership_type int unsigned not null,
fk_document_number varchar(15) null,
fk_id_document_type tinyint(3) unsigned null,
fk_id_block int unsigned not null,
start_date datetime not null,
end_date datetime null,
membership_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_membership)
)ENGINE=InnoDB default charset=utf8 ;

create table tickets (
id_ticket int unsigned not null auto_increment,
pk_fk_document_number varchar(15) not null,
pk_fk_document_type tinyint(3) unsigned not null,
entry_time time not null,
departure_time time null,
total_time time null,
tickets_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_ticket,pk_fk_document_number,pk_fk_document_type)
)ENGINE=InnoDB default charset=utf8;

create table bills(
id_bill int unsigned not null auto_increment,
pk_fk_document_numer varchar(15) not null,
pk_fk_document_type tinyint(3) unsigned not null,
fk_id_ticket int unsigned not null,
fk_id_membership int unsigned null,
fk_id_payment_method int unsigned not null,
date_bill datetime not null,
subtotal_value float (9,3) unsigned not null,
iva_value float(9,3) unsigned not null,
total_value float(9,3) unsigned not null,
bill_status tinyint(2) unsigned not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_bill,pk_fk_document_numer,pk_fk_document_type)
)ENGINE=InnoDB default charset=utf8;

create table rates (
id_rate int unsigned not null auto_increment,
minute_rate float unsigned not null,
hourly_rate float(9,3) unsigned not null,
day_rate float(9,3) unsigned not null,
rate_status tinyint(2) not null,
created_att timestamp not null,
updated_att timestamp null,
primary key(id_rate)
)ENGINE=InnoDB default charset=utf8;

alter table users add constraint pk_fk_id_document_types foreign key(pk_fk_id_document_type) references document_types(id_document_type) on delete restrict on update cascade;
alter table users add constraint fk_id_genders foreign key(fk_id_gender) references genders(id_gender) on delete restrict on update cascade;
alter table vehicles add constraint fk_document_numbers foreign key(fk_document_number) references users(document_number) on delete restrict on update cascade;
alter table vehicles add constraint fk_id_document_types foreign key(fk_id_document_type) references users(pk_fk_id_document_type) on delete restrict on update cascade;
alter table vehicles add constraint fk_id_vehicle_types foreign key(fk_id_vehicle_type) references vehicle_types(id_vehicle_type) on delete restrict on update cascade;
alter table tickets add constraint pk_fk_document_numbers foreign key(pk_fk_document_number) references users(document_number) on delete restrict on update cascade;
alter table tickets add constraint pk_fk_document_typest foreign key(pk_fk_document_type) references users(pk_fk_id_document_type) on delete restrict on update cascade;
alter table blocks add constraint fk_id_block_types foreign key(fk_id_block_type) references block_types(id_block_type) on delete restrict on update cascade;
alter table blocks add constraint fk_id_tickets foreign key(fk_id_ticket) references tickets(id_ticket) on delete restrict on update cascade;
alter table blocks add constraint fk_vehicle_types foreign key(fk_vehicle_type) references vehicle_types(id_vehicle_type) on delete restrict on update cascade;
alter table memberships add constraint fk_id_membership_types foreign key(fk_id_membership_type) references membership_types(id_membership_type) on delete restrict on update cascade;
alter table memberships add constraint fk_document_numbersm foreign key(fk_document_number) references users(document_number) on delete restrict on update cascade;
alter table memberships add constraint fk_id_document_typem foreign key(fk_id_document_type) references users(pk_fk_id_document_type) on delete restrict on update cascade;
alter table memberships add constraint fk_id_blocks foreign key(fk_id_block) references blocks(id_block) on delete restrict on update cascade;
alter table bills add constraint pk_fk_document_numers foreign key(pk_fk_document_numer) references users(document_number) on delete restrict on update cascade;
alter table bills add constraint pk_fk_document_types foreign key(pk_fk_document_type) references users(pk_fk_id_document_type) on delete restrict on update cascade;
alter table bills add constraint fk_id_ticketsb foreign key(fk_id_ticket) references tickets(id_ticket) on delete restrict on update cascade;
alter table bills add constraint fk_id_memberships foreign key(fk_id_membership) references memberships(id_membership) on delete restrict on update cascade;
alter table bills add constraint fk_id_payment_methods foreign key(fk_id_payment_method) references payment_methods(id_payment_method) on delete restrict on update cascade;
alter table roles_users add constraint pk_fk_document_numbersru foreign key(pk_fk_document_number) references users(document_number) on delete restrict on update cascade;
alter table roles_users add constraint pk_fk_id_document_typesru foreign key(pk_fk_id_document_type) references users(pk_fk_id_document_type) on delete restrict on update cascade;
alter table roles_users add constraint pk_fk_id_rolesru foreign key(pk_fk_id_roles) references roles(id_roles) on delete restrict on update cascade;
alter table vehicle_types add constraint fk_id_rate foreign key(fk_id_rates) references rates(id_rate) on delete restrict on update cascade;


