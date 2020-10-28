<?php
if(isset($_GET['op'])){
    $op=$_GET['op'];
    switch($op){
        case 1:
            $link="";
            break;
        default:
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIENDITA</title>
</head>
<body>
	<header>
		<a href="?op=1"><?php echo $link ?></a>
	</header>

    
</body>
</html>