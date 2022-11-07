drop database if exists blog;
create database blog;
use blog;
create table roles(
    id int not null primary key auto_increment,
    nombre varchar(255) not null
);

create table usuarios(
    id int not null primary key auto_increment,
    nombre varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    rol_id int not null,
    fecha_creacion datetime not null default current_timestamp(),
    foreign key (rol_id) references roles(id)
    on delete restrict on update cascade
);


create table articulos(
    id int not null primary key auto_increment,
    titulo varchar(255) not null,
    imagen varchar(255) not null,
    texto text not null,
    fecha_creacion datetime not null default current_timestamp(),
    usuario_id int not null,
    foreign key (usuario_id) references usuarios(id)
    on delete restrict on update cascade
    );


create table comentarios(
    id int not null primary key auto_increment,
    comentario varchar(255) not null,
    usuario_id int not null,
    articulo_id int not null,
    estado int not null,
    fecha_creacion datetime not null default current_timestamp(),
    foreign key (usuario_id) references usuarios(id),
    foreign key (articulo_id) references articulos(id)
);

insert into roles values (1,'administrador');
insert into roles values (2,'Registrado');

insert into usuarios values (null,'jose romero','jrb@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','1','2021-05-06 12:33:00');
insert into usuarios values (null,'alejandra alvares','alev@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','2','2021-05-06 12:33:00');
insert into usuarios values (null,'brenda aquino','bra@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','1','2021-05-06 12:33:00');
insert into usuarios values (null,'veronica sachiñas','vrs@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','2','2021-05-06 12:33:00');

insert into articulos values (null,'Articulo 1','img5.jpg','Texto Articulos 1','2021-05-06 12:33:00',1);
insert into articulos values (null,'Articulo 2','img4.jpg','Texto Articulos 2','2021-05-06 12:33:00',2);
insert into articulos values (null,'Articulo 3','img3.jpg','Texto Articulos 3','2021-05-06 12:33:00',3);
insert into articulos values (null,'Articulo 4','img2.jpg','Texto Articulos 4','2021-05-06 12:33:00',2);

insert into comentarios values (null,'comentario 1',1,1,0,'2021-05-31 12:26:00');
insert into comentarios values (null,'comentario 2',1,1,1,'2021-05-31 12:26:00');
insert into comentarios values (null,'comentario 3',1,2,0,'2021-05-31 12:26:00');
insert into comentarios values (null,'comentario 1',2,3,0,'2021-05-06 12:26:00');
insert into comentarios values (null,'comentario 2',3,3,1,'2021-05-06 12:26:00');

create view view_usuarios as
select u.id, u.nombre, u.email, u.password, r.nombre as rol, u.fecha_creacion
from usuarios u, roles r
where u.rol_id = r.id;

create view view_articulos as
select a.id, a.titulo, a.imagen, a.texto, a.usuario_id, u.nombre as autor, a.fecha_creacion
from articulos a, usuarios u
where a.usuario_id = u.id;

create view view_comentarios as
select c.id, c.comentario, c.usuario_id, u.nombre as autor, c.articulo_id, a.titulo, a.usuario_id as prop_art, c.estado, a.fecha_creacion
from comentarios c
 inner join usuarios u
 on c.usuario_id = u.id
 inner join articulos a
 on c.articulo_id = a.id;

