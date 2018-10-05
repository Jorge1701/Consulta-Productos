$( document ).ready( () => {

	$( inputImg ).change( () => {
		if ( inputImg.files && inputImg.files[0] ) {
			let r = new FileReader();
			r.onload = ( e ) => {
				imgMuestra.src = e.target.result;
			};
			r.readAsDataURL( inputImg.files[0] );
		}
	} );

} );