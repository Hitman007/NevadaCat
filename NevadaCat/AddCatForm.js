jQuery(document).ready(function(){
	jQuery("#formButton").prop("type", "button");
	jQuery("#formButton").prop("value", "Next");
	showView(1);
});

function showView(viewNumber){
	if(viewNumber == 1){
		jQuery('#name-input-div').show();
		jQuery('#formButton').click(function(){
			showView(2);
		});
	}
	if(viewNumber == 2){
		jQuery('#name-input-div').css('display', 'none');
		jQuery('#product-input-div').slideDown('slow');
		jQuery('#formButton').click(function(){
			showView(3);
		});
	}
	if(viewNumber == 3){
		jQuery('#product-input-div').css('display', 'none');
		jQuery('#gender-input-div').slideDown('slow');
		jQuery('#formButton').click(function(){
			showView(4);
		});
	}
	if(viewNumber == 4){
		jQuery('#gender-input-div').css('display', 'none');
		jQuery('#upload-image-input-div').slideDown('slow');
		jQuery('#formButton').click(function(){
			showView(5);
		});
	}
	if(viewNumber == 5){
		jQuery("#add-cat-form").submit();
	}
}