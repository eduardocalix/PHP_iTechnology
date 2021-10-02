
CREATE DATABASE TiendaMaster;
USE TiendaMaster;

CREATE TABLE Usuarios(
Id              int(255) auto_increment not null,
Nombre          varchar(100) not null,
Apellidos       varchar(255),
Email           varchar(255) not null,
Password        varchar(255) not null,
Rol             varchar(20),
Image           varchar(255),
CONSTRAINT pk_Usuarios PRIMARY KEY(Id),
CONSTRAINT uq_email UNIQUE(Email)
)ENGINE=InnoDb;
INSERT INTO Usuarios VALUES(null,'Admin','Admin','admin@admin.com','contraseña','Admin',null);

CREATE TABLE Categorias(
Id              int(255) auto_increment not null,
Nombre          varchar(100) not null,
CONSTRAINT pk_Categorias PRIMARY KEY(Id)
)ENGINE=InnoDb;
INSERT INTO Categorias VALUES(null,'Manga Corta');
INSERT INTO Categorias VALUES(null,'Tirantes');
INSERT INTO Categorias VALUES(null,'Manga Larga');
INSERT INTO Categorias VALUES(null,'Sudadera');

CREATE TABLE Productos(
Id              int(255) auto_increment not null,
Categoria_Id    int(255) not null,
Nombre          varchar(100) not null,
Descripcion     text,
Precio          float(100,2) not null,
Stock           int(255) not null,
Oferta          varchar(2),
Fecha           date not null,
Image           varchar(255),
CONSTRAINT pk_Productos PRIMARY KEY(Id),
CONSTRAINT fk_Productos_Categorias FOREIGN KEY(CategoriaId) REFERENCES Categorias(Id)
)ENGINE=InnoDb;

CREATE TABLE Pedidos(
Id              int(255) auto_increment not null,
Usuario_Id      int(255) not null,
Provincia       varchar(100) not null,
Localidad       varchar(100) not null,
Direccion       varchar(255) not null,
Coste           float(200,2) not null,
Estado          varchar(20) not null,
Fecha           date,   
Hora            time,
CONSTRAINT pk_Pedidos PRIMARY KEY(Id),
CONSTRAINT fk_Pedidos_Usuarios FOREIGN KEY(Usuario_Id) REFERENCES Usuarios(Id)
)ENGINE=InnoDb;

CREATE TABLE LineasPedido(
Id              int(255) auto_increment not null,
Pedido_Id       int(255) not null,
Producto_Id     int(255) not null,
Unidades        int(255) not null,
CONSTRAINT pk_LiniasPedido PRIMARY KEY(Id),
CONSTRAINT fk_Lineas_Pedidos FOREIGN KEY(Pedido_Id) REFERENCES Pedidos(Id),
CONSTRAINT fk_Lineas_Productos FOREIGN KEY(Producto_Id) REFERENCES Productos(Id)
)ENGINE=InnoDb;


CREATE DATABASE FruteriaMaster;
USE FruteriaMaster;
CREATE TABLE Frutas(
Id          int(255) auto_increment not null,
Nombre      varchar(255) not null,
Descripcion text not null,
Precio float not null,
Fefcha date,
CONSTRAINT pk_Frutas PRIMARY KEY(Id)
);


