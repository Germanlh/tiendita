<?php
/**************************************************************************************************/
$conexiondb=mysql_connect("localhost","xito","g2r4*2YL1");
if(!$conexiondb){die("No se Ha establecido la Conexion".mysql_error());}
//mysql_query("SET NAMES 'utf8'");

/*********** Creamos Base de datos de Mysql *************************************************************/
$sql="CREATE DATABASE crmkrea DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci";
if(!mysql_query($sql, $conexiondb)){	echo "No se ha creado la Base de Datos".mysql_error();	}

/*********** Seleccionamos Base de datos ****************************************************************/
mysql_select_db("crmkrea",$conexiondb); 

/*********** Creamos Tabla USUARIOS*******************************************************************/
$sql="CREATE TABLE usuarios ( 
		idkrea varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci,
		PRIMARY KEY(idkrea),
		status tinyint,
		usuario varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
		password varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci,
		permisos tinyint
		) CHARACTER SET utf8 COLLATE utf8_general_ci "; 
if(!mysql_query($sql,$conexiondb)){
echo "<br><br>No se ha creado la Tabla usuarios: ".mysql_error();
}
/*********** Agregamos el primer super usuario ***********************************************************/
$query=mysql_query("INSERT INTO 
			usuarios (idkrea,status,usuario, password, permisos)
			VALUES ('1111111111111',1,'program', 'margorp', 1)
			");
		if(!$query){die("PROBLEMAS: ".mysql_error());	}

/*********** Creamos Tabla DIRECTORIO*****************************************************************/
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

/*********** Creamos Tabla EMPRESA*******************************************************************/
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

/*********** Creamos Tabla CALENDARIO ****************************************************************/
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

/*********** Creamos Tabla RECADOS ******************************************************************/
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
/****************************************************/
/****************************************************/
/****************************************************/
/****************************************************/
/*********** Creamos Tabla NOTA ********************************************************************/
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

/*********** Creamos Tabla TRABAJOS ******************************************************************/
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

/*********** Creamos Tabla VENTAS estadistica ***********************************************************/
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

/*********** Creamos Tabla SEMAFORO estadistica ********************************************************/
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

/************************ Cerramos la Conexion a la Base de datos*****************************************/
mysql_close($conexiondb);
/************************************************************************************************/
?>