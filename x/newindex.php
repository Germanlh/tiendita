<?php
if(isset($_GET['op'])){
    $op=$_GET['op'];
}
else{
    $op=1;
}
    switch($op){
        case 1:
            $link="?op=2";
            $atext="dos";
            $page="1.php";
            break;
        case 2:
            $link="?op=3";
            $atext="tres";
            $page="2.php";
            break;
        case 3:
            $link="?op=1";
            $atext="uno";
            $page="3.php";
            break;

        default:
            break;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TIENDITA</title>
</head>
<body>
	<header>
		<a href=<?php echo "'".$link."'"; ?>><?php echo $atext; ?></a>
	</header>
    <main>
        <?php include $page;?>
    </main>
    <footer>
    </footer>    
</body>
</html>