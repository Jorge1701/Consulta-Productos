<?php $uri = $_SERVER["REQUEST_URI"]; ?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#barraNavegacion">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/consultaprecio/">Ver sitio</a>
		</div>
		<div class="collapse navbar-collapse" id="barraNavegacion">
			<ul class="nav navbar-nav">
				<li class="<?php echo $uri == "/consultaprecio/productos.php" ? "active" : "" ?>"><a href="/consultaprecio/productos.php">Productos</a></li>
				<li class="<?php echo $uri == "/consultaprecio/promociones.php" ? "active" : "" ?>"><a href="/consultaprecio/promociones.php">Promociones</a></li>
				<li class="<?php echo $uri == "/consultaprecio/configuracion2.php" ? "active" : "" ?>"><a href="/consultaprecio/configuracion2.php">Configuración</a></li>
			</ul>
		</div>
	</div>
</nav>