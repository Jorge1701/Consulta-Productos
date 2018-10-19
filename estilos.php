<?php require_once( "clases/configuracion.php" ); ?>
<?php configuracion::definir(); ?>

<style type="text/css">
	:root {
		--col-fondo: <?php echo col_fondo ?>;
		--promo-col-fondo: <?php echo promo_col_fondo; ?>;
		--promo-col-letra: <?php echo promo_col_letra; ?>;
		--promo-alto-titulo: <?php echo promo_alto_titulo . "vh"; ?>;
		--promo-titulo-tam-letra: <?php echo promo_titulo_tam_letra . "vh"; ?>;
		--promo-separacion: <?php echo promo_separacion . "vh"; ?>;
		--promo-bordes: <?php echo promo_bordes . "vh"; ?>;
		--promo-sombra-titulo: .5vw .5vw .05vw black;
		--info-col-fondo: <?php echo info_col_fondo; ?>;
		--info-col-letra: <?php echo info_col_letra; ?>;
		--info-tam-letra-descripcion: <?php echo info_tam_letra_descripcion . "vh"; ?>;
		--info-tam-letra-marca: <?php echo info_tam_letra_marca . "vh"; ?>;
		--info-tam-letra-detalle: <?php echo info_tam_letra_detalle . "vh"; ?>;
		--info-margen: <?php echo info_margen . "vh"; ?>;
		--info-padding: <?php echo info_padding . "vh"; ?>;
		--info-bordes: <?php echo info_bordes . "vh"; ?>;
		--info-sombra: .5vw .5vw .05vw black;
		--precio-col-fondo: <?php echo precio_col_fondo; ?>;
		--precio-col-letra: <?php echo precio_col_letra; ?>;
		--precio-tam-letra: <?php echo precio_tam_letra . "vh"; ?>;
		--precio-padding: <?php echo precio_padding . "vh"; ?>;
		--precio-bordes: <?php echo precio_bordes . "vh"; ?>;
		--precio-sombra: 0 0 2vh .2vh var(--precio-col-fondo);

		--codigo-tam-letra: <?php echo codigo_tam_letra . "vh"; ?>;

		--tiempo: <?php echo tiempo . "s"; ?>;
	}
</style>