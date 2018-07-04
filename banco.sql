drop database if exists financeiro;

create database financeiro;

create table categoria(
    id integer auto_increment primary key,
    tipo varchar(20) not null,
    descricao varchar(40) not null
);

desc categoria;
