<!DOCTYPE html>
<html>
<head>
	<title>Consulta precio</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>

	<h1>Código: <?php echo !isset( $_GET["codigo"] ) ? "No hay codigo" : $_GET["codigo"]; ?></h1>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/main.js"></script>
</body>
</html>