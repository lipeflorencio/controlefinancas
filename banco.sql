drop database if exists financeiro;

create database financeiro;

use financeiro;

create table categoria(
    id integer auto_increment primary key,
    tipo varchar(20) not null,
    nome varchar(40) not null
);

desc categoria;
