<?php
include_once('Classes.php');
$pdo=Tools::connect();

$role = 'create table Roles(id int not null auto_increment primary key,
	role varchar(32)not null unique)default charset="utf8"';

$customers = 'create table Customers(id int not null 
	auto_increment primary key,
	login varchar(32)not null unique,
	pass varchar(128)not null,
	roleid int,
	foreign key(roleid) references Roles(id) on update cascade,
	email varchar(32) not null unique)default charset="utf8"';

$albums = 'create table Albums(id int not null auto_increment primary key,
	name varchar(50)not null,
	info varchar(300),
	datetame timestamp default CURRENT_TIMESTAMP)default charset="utf8"';

$images='create table Images(id int not null auto_increment primary key,
	albumid int,
	foreign key(albumid) references Albums(id),
	imagepath varchar(255))default charset="utf8"';

$pdo->exec($role);
$pdo->exec($customers);
$pdo->exec($albums);
$pdo->exec($images);

?>