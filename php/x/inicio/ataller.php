<?php
	include("funciones.php");
	sinpermiso(0,1,0);
	?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="javascript" src=""></script>
		<style type="text/css"> </style>
		<title>CRM Krea</title>
	</head>
	<body>
		<header></header>
		<nav>
			<ul>
			<?php
				if($_SESSION['permisos']==TALLER){	
					muestrausr(0);
					}
				else{sinpermiso(0,1,1);}
			?>
			</ul>
		</nav>
		<section>
			<article>
			</article>
		</section>
		<section>
			<article>
			</article>
		</section>
		<footer>	</footer>	
	</body
</html>