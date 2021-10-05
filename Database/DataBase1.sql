/*Base de datos para Tienda de productos temáticos*/

IF EXISTS(SELECT * FROM DBO.SYSDATABASES WHERE NAME = 'DBKonoha')
    BEGIN
		USE MASTER
        DROP DATABASE DBKonoha 
    END
GO
--Creamos la Base de datos
CREATE DATABASE DBKonoha
GO

USE DBKonoha
GO

--Creamos los esqumas de la base de datos
CREATE SCHEMA Productos --contiene todas las tablas del sistemas
GO

CREATE SCHEMA Acceso --Contiene la informacion de acceso de los usuarios
GO

/*
	contiene todos los usuarios que manejaran el sistema en las diferentes
	areas Manejo de proveedores, Producto y ventas, esta tabla es manejada solo por el administrador principal
*/
IF OBJECT_ID('Acceso.Usuarios')	IS NOT NULL
	DROP TABLE Acceso.Usuarios
ELSE
	BEGIN
		CREATE TABLE Acceso.Usuarios(
			id  INT IDENTITY (1,1) NOT NULL, --index de los usuarios
			nombre NVARCHAR(25) NOT NULL,	--primer nombre del usuario
			apellido NVARCHAR(25) NOT NULL, --primer apellido del usuario
			usuario NVARCHAR(26) NOT NULL,	--Primera letra del nombre en mayusculas más el apellido
									--eje: Pedro Picapiedra (PPicapiedra)
			clave NVARCHAR(20) NOT NULL --clave de acceso
		);
	END
GO

/*Segundo esquema controla las tablas de transaccion de los productos*/

IF OBJECT_ID('Productos.Producto')	IS NOT NULL
	DROP TABLE Productos.Producto
ELSE
	BEGIN
		CREATE TABLE Productos.Producto(
			idProducto INT IDENTITY NOT NULL,
			descripcion	NVARCHAR(100) NOT NULL,
			costo DECIMAL(8,2) NOT NULL,
			precioVenta DECIMAL(8,2) NOT NULL,
			stock DECIMAL(8,2) NOT NULL,
			imagen NVARCHAR(100) NOT NULL,
			idCategoria INT NOT NULL,
			idProveedor INT NULL
		);
	END
GO

IF OBJECT_ID('Productos.CategoriaProducto')	IS NOT NULL
	DROP TABLE Productos.CategoriaProducto
ELSE
	BEGIN
		CREATE TABLE Productos.CategoriaProducto(
			idCategoria INT IDENTITY NOT NULL,
			descripcion NVARCHAR(100)
		);
	END
GO

IF OBJECT_ID('Productos.Proveedores')	IS NOT NULL
	DROP TABLE Productos.Proveedores
ELSE
	BEGIN
		CREATE TABLE Productos.Proveedores(
			idProveedor INT IDENTITY NOT NULL,
			nombre NVARCHAR(100) NOT NULL,
			telefono NVARCHAR(9) NOT NULL,
			direccion NVARCHAR(300)
		);
	END
GO


IF OBJECT_ID('Productos.Compras')	IS NOT NULL
	DROP TABLE Productos.Compras
ELSE
	BEGIN
		CREATE TABLE Productos.Compras(
			idCompras INT IDENTITY(1,1) NOT NULL,
			idCategoriaProductos INT NOT NULL,
			idProducto INT NOT NULL,
			idUsuario INT NOT NULL,
			cantidad DECIMAL(8,2) NOT NULL
		);
	END
GO


/*Creacion de check constraint*/

USE DBKonoha
GO

--DEFINICION DE LLAVES PRIMARIAS
ALTER TABLE Acceso.Usuarios
	ADD CONSTRAINT PK_Acceso_Usuarios_id
		PRIMARY KEY NONCLUSTERED(id);
GO

ALTER TABLE Productos.Producto
	ADD CONSTRAINT PK_Productos_Producto_idProducto
		PRIMARY KEY CLUSTERED(idProducto)
GO

ALTER TABLE Productos.Proveedores
	ADD CONSTRAINT PK_Productos_Proveedores_idProovedor
		PRIMARY KEY CLUSTERED(idProveedor)
GO

ALTER TABLE Productos.CategoriaProducto
	ADD CONSTRAINT PK_Productos_CategoriaProducto_idCategoria
		PRIMARY KEY CLUSTERED(idCategoria)
GO

ALTER TABLE Productos.Compras
	ADD CONSTRAINT PK_Productos_Compras_idCompra
		PRIMARY KEY CLUSTERED(idCompras)
GO

--DEFINICION DE LLAVES FORANEAS
ALTER TABLE	Productos.Producto
	ADD CONSTRAINT FK_Productos_Producto_idProducto$TienenUn$Productos_CategoriaProducto_idCategoria
		FOREIGN KEY (idCategoria)
			REFERENCES Productos.CategoriaProducto(idCategoria)
GO
ALTER TABLE	Productos.Producto
	ADD CONSTRAINT FK_Productos_Proveedores_idProveedor$TienenVarios$Productos_Insumo_idInsumo
		FOREIGN KEY (idProveedor)
			REFERENCES Productos.Proveedores(idProveedor)
GO

ALTER TABLE	Productos.Compras
	ADD CONSTRAINT FK_Productos_Compras_idCompras$TienenUn$Productos_CategoriaProducto_idCategoria
		FOREIGN KEY (idCategoriaProductos)
			REFERENCES Productos.CategoriaProducto(idCategoria)
GO
ALTER TABLE	Productos.Compras
	ADD CONSTRAINT FK_Productos_Compras_idCompras$TienenVarios$Productos_Producto_idProducto
		FOREIGN KEY (idProducto)
			REFERENCES Productos.Producto(idProducto)
GO
ALTER TABLE	Productos.Compras
	ADD CONSTRAINT FK_Productos_Compras_idCompras$TienenUn$Acceso_Usuario_id
		FOREIGN KEY (idUsuario)
			REFERENCES Acceso.Usuarios(id)
GO

USE DBKonoha
GO


CREATE FUNCTION Acceso.NombrePropios
(
	@cadenaDeIngreso VARCHAR(2000)
)
RETURNS VARCHAR(2000) AS
BEGIN
	-- Colocar todo el texto en minúsculas
	SET @cadenaDeIngreso = LOWER(@cadenaDeIngreso);

	-- Luego buscar el primer caracter de la cadena y
	-- convertirlo a mayúscula
	SET @cadenaDeIngreso = STUFF(@cadenaDeIngreso, 1, 1, UPPER(SUBSTRING(@cadenaDeIngreso, 1, 1)));

	-- Inicializar una variable que sea igual al segundo caracter
	DECLARE @i INT = 2;

	-- Recorrer toda la cadena de caracteres hasta el final
	WHILE @i < LEN(@cadenaDeIngreso)
	BEGIN
		-- Si el caracter es un espacio
		IF SUBSTRING(@cadenaDeIngreso, @i, 1) = ' '
		BEGIN
			SET @cadenaDeIngreso = STUFF(@cadenaDeIngreso, @i + 1, 1, UPPER(SUBSTRING(@cadenaDeIngreso, @i + 1,1)));
		END
		-- Incrementar el contador
		SET @i = @i + 1
	END
	RETURN @cadenaDeIngreso
END;
GO


CREATE PROCEDURE SP_InsertarUsuario
(
    @nombre NVARCHAR(25),
    @apellido NVARCHAR(25),
    @clave NVARCHAR(20)
)
AS
BEGIN
    DECLARE @existe int;
    DECLARE @Usuario nVarchar(26);
    SET @existe = 0;
    IF (@nombre = '' OR @apellido = '' )
        BEGIN
            RAISERROR(N'Hay campos abligatorios sin llenar', 16, 1, @nombre, @apellido);
            RETURN 0
        END
    ELSE
        BEGIN
            SET @usuario = UPPER(LEFT(@nombre, 1)) + Acceso.NombrePropios(@apellido)

            SELECT @existe = COUNT(Acceso.Usuarios.usuario) FROM Acceso.Usuarios WHERE usuario = @usuario;
            IF (@existe > 0)
                BEGIN
                    RAISERROR(N'Ya existe un usuario con el nombre  "%s %s"', 16, 1, @nombre, @apellido);
                    RETURN 0
                END     
            ELSE
                BEGIN
                    INSERT INTO Acceso.Usuarios(nombre, apellido, usuario, clave)
                        VALUES (    Acceso.NombrePropios(@nombre),
                                    Acceso.NombrePropios(@apellido), 
                                    @usuario, 
                                    @clave)
                    RETURN 1
                END
            
        END
END
GO

--SP_InsertarUsuario(nombre, apellido, usuario, clave)
EXEC SP_InsertarUsuario 'eduardo','calix','nose'
--Agregar Categorias 


----------------------------------------------------------
--Modulo Proveedor

CREATE PROCEDURE SP_AgregarProveedor
(
	@nombre NVARCHAR(100),
	@telefono NVARCHAR(9),
	@direccion NVARCHAR(300)
)
AS
BEGIN
	DECLARE @existe int;
	SET @existe = 0;
	SELECT @existe = COUNT(Productos.Proveedores.idProveedor) FROM Productos.Proveedores WHERE nombre = @nombre;
	IF (@existe > 0)
		BEGIN
			RAISERROR(N'Ya existe un proveedor con el nombre  "%s"', 16, 1, @nombre);
			RETURN 0			
		END
	ELSE
		BEGIN
			INSERT INTO Productos.Proveedores(nombre, telefono, direccion)
				VALUES(@nombre, @telefono, @direccion)
			RETURN 1
		END
END
GO

--SP_AgregarProveedor(nombre,telefono,direccion)
EXEC SP_AgregarProveedor 'Pablo Marmol','9999-9999','Piedra Dura'
-------------------------------------------------
--Modulo Categoria de Producto
CREATE PROCEDURE SP_AgregarCategoriaProducto
(
	@descripcion NVARCHAR(100)
)
AS
BEGIN
	DECLARE @existe int;
	SET @existe = 0;

	SELECT @existe = COUNT(Productos.CategoriaProducto.idCategoria) FROM Productos.CategoriaProducto WHERE descripcion=@descripcion;
	IF (@existe > 0)
		BEGIN
			RAISERROR(N'Ya existe una Categoria de producto con el nombre "%s"', 16, 1,@descripcion);
			RETURN 0
			
		END
	ELSE
		BEGIN
			INSERT INTO Productos.CategoriaProducto(descripcion)
				VALUES(@descripcion)
			RETURN 1
		END
END
GO

EXEC SP_AgregarCategoriaProducto 'Laveros'
EXEC SP_AgregarCategoriaProducto 'Ropa'
EXEC SP_AgregarCategoriaProducto 'Hogar'

-------------------------------------------------------------------------------------------------------------------
--Modulo Producto 
CREATE PROCEDURE SP_AgregarProducto
(
	@descripcion NVARCHAR(100),
	@costo DECIMAL(8,2),
	@precioVenta DECIMAL(8,2),
	@stock DECIMAL(8,2),
	@idCategoria INT,
	@idProveedor INT,
	@imagen NVARCHAR(100)
)
AS
BEGIN
	DECLARE @existe int;
	SET @existe = 0;
	SELECT @existe = COUNT(Productos.Producto.idProducto) FROM Productos.Producto WHERE descripcion = @descripcion;
	IF (@existe > 0)
		BEGIN
			RAISERROR(N'Ya existe un Producto con el nombre %s"', 16, 1,@descripcion);
			RETURN 0
		END
	ELSE
		BEGIN
			INSERT INTO Productos.Producto(descripcion, costo, precioVenta, stock,idCategoria,  idProveedor,imagen)
				VALUES(@descripcion, @costo, @precioVenta, @stock,@idCategoria, @idProveedor,@imagen)
			RETURN 1
		END
END
GO


EXEC SP_AgregarProducto 'Naruto', 60, 100, 3, 1, 1,'hola'
EXEC SP_AgregarProducto 'Akatsuki', 15, 20, 3, 2, 1,'hola'
EXEC SP_AgregarProducto 'Kunay', 50, 70, 3, 1, 1,'hola'
EXEC SP_AgregarProducto 'Churiken', 55, 80, 3, 1, 1,'hola'

-------------------------------------------------------------------------------------------------------------------
--Modulo Compras
CREATE PROCEDURE SP_AgregarCompras
(
	@idCategoria INT,
	@idProducto INT,
	@idUsuario INT,
	@cantidad DECIMAL(8,2)
)
AS
BEGIN
	DECLARE @contar int;
	SET @contar = @cantidad;
	IF (@contar = 0)
		BEGIN
			RAISERROR(N'La cantidad no puede ser cero', 16, 1);
			RETURN 0
		END
	ELSE
		BEGIN
			INSERT INTO Productos.Compras(idCategoriaProductos,  idProducto,idUsuario,cantidad )
				VALUES(@idCategoria, @idProducto,@idUsuario,@cantidad)
			RETURN 1
		END
END
GO


EXEC SP_AgregarCompras 1, 1, 1, 20
EXEC SP_AgregarCompras 2, 3, 1, 30
EXEC SP_AgregarCompras 3, 2, 1, 10
EXEC SP_AgregarCompras 1, 4, 1, 20
