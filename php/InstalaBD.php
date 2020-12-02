<?php
/******Conectamos con la Mysql *************************************************************/
$server = "localhost";
$usr = "xito";
$psw = "g2r4*2YL1";

$cnxdb= new mysqli($server, $usr, $psw);//Conexion Base de datos
if($cnxdb->connect_error){die("No se ha establecido la Conexion");}

/****** Creamos la Base de Datos ************************************************************/
$sql = "CREATE DATABASE tiendita DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci";
if ($cnxdb->query($sql) === TRUE) {/*echo "Base de Datos Creada.";*/} 
else { die("Error al Crear la Base de Datos:". $cnxdb->error);}

/****** Seleccionamos Base de datos ********************************************************/
$cnxdb->select_db("tiendita");

/*********** Creamos Tabla USUARIOS **********************************/
$sql="CREATE TABLE usuarios ( 
		mail varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
		psw varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
		nombre varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
		permisos tinyint,
		PRIMARY KEY (mail)
		) CHARACTER SET utf8 COLLATE utf8_general_ci"; 

if ($cnxdb->query($sql) === TRUE) {/*echo "Tabla Usuarios Creada.";*/} 
else { die("Error al Crear la Tabla Usuarios:". $cnxdb->error);}

/*********** Agregamos el primer super usuario ***********************************************************/
//$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$psw=password_hash("12345", PASSWORD_DEFAULT);
$sql= "INSERT INTO usuarios (mail,psw,nombre, permisos)
		VALUES ('admin@admin','".$psw."','administrador', 1)
		";
if ($cnxdb->query($sql) === TRUE) {/*echo "Registro agregado a Usuarios.";*/} 
else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
		
/*********** Creamos Tabla DIRECTORIO*****************************************************************
$sql="CREATE TABLE directorio( 
		idcliente varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		PRIMARY KEY(idcliente),
		status tinyint,
		tipo tinyint,
		idempresa varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		nombres varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		apellidos varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		direccion varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		colonia varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ciudad varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		estado varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		codpos smallint,
		tel1 varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
		tel2 varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
		cel varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
		email1 varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		email2 varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idvendedor varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ventaanterior timestamp,
		ventaultima timestamp
		) CHARACTER SET utf8 COLLATE utf8_general_ci "; 
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Directorio: ".mysql_error();
}

/*********** Creamos Tabla EMPRESA*******************************************************************
$sql="CREATE TABLE empresa( 
		idempresa varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		PRIMARY KEY(idempresa),
		status tinyint,
		ncomercial varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		razonsocial varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci,
		rfc varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		calle varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		numero smallint,
		colonia varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ciudad varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		estado varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		codpos smallint,
		tel1 varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
		tel2 varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci,
		email1 varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
		email2 varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idcliente1 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idcliente2 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idcliente3 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idvendedor varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ventaanterior timestamp,
		ventaultima timestamp
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Empresa: ".mysql_error();
}

/*********** Creamos Tabla CALENDARIO ****************************************************************
$sql="CREATE TABLE calendario( 
		idusuario varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idcliente varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		status tinyint,
		evento varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci,
		fechainicio date,
		horainicio time,
		fechafin date,
		horafin time,
		comentarios text CHARACTER SET utf8 COLLATE utf8_general_ci,
		prioridad tinyint,
		idevcal varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		) CHARACTER SET utf8 COLLATE utf8_general_ci "; 
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Calendario: ".mysql_error();
}

/*********** Creamos Tabla RECADOS ******************************************************************
$sql="CREATE TABLE recados( 
		iddestinatario varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idreceptor varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		emisor varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci,
		fecha datetime,
		tipo tinyint,
		mensaje tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
		tel varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		empresa varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
		status tinyint,
		idrecado varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Recados: ".mysql_error();
}

/*********** Creamos Tabla NOTA ********************************************************************
$sql="CREATE TABLE nota( 
		idcotizacion varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
		datecotiza datetime,
		idnota varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci,
		datenota datetime,
		dateentrega datetime,
		prioridad tinyint,
		idcliente varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		importe int,
		iva int,
		adelanto1 int,
		adelanto2 int,
		adelanto3 int,
		metpago1 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		metpago2 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		metpago3 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		liquidado tinyint,
		dateliquidado datetime,
		factura int,
		datefactura datetime,
		identrega varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		dateentregareal datetime,
		otrab1 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		otrab2 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		otrab3 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		otrab4 varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Nota: ".mysql_error();
}

/*********** Creamos Tabla TRABAJOS ******************************************************************
$sql="CREATE TABLE trabajos( 
		idnota varchar (13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		status tinyint,
		prioridad tinyint,
		acabados tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
		cantidad int,
		material varchar (20) CHARACTER SET utf8 COLLATE utf8_general_ci,
		base int,
		altura int,
		tecnicaimp varchar (13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		punitario int,
		importe int,
		diseno datetime,
		impresion datetime,
		produccion datetime,
		instalacion datetime
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Trabajos: ".mysql_error();
}

/*********** Creamos Tabla VENTAS estadistica ***********************************************************
$sql="CREATE TABLE ventas( 
		lunes datetime,
		sabado datetime,
		implunes int,
		impmartes int,
		impmiercoles int,
		impjueves int,
		impviernes int,
		impsabado int,
		numnotas int,
		notassaldadas int
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Ventas: ".mysql_error();
}

/*********** Creamos Tabla SEMAFORO estadistica ********************************************************
$sql="CREATE TABLE semaforo( 
		idcliente varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		idvendedor varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ncomercial varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
		ventaanterior datetime,
		ventaultima datetime
		) CHARACTER SET utf8 COLLATE utf8_general_ci ";
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla Semaforo: ".mysql_error();
}

/**Cerramos la Conexion a la Base de datos ******************************************************/
$cnxdb->close();
/************************************************************************************************/
?>