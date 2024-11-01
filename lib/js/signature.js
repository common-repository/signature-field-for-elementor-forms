( function( $ ) {
	"use strict";
	jQuery(document).ready(function($) {
		setTimeout(function(){ 
			$(".elementor").not(".elementor-location-popup").each(function(e){
	            $( ".elementor-signature-field", $(this) ).each(function( index ) {
	                elementor_signature_field($(this));
	            });
	        })
		}, 200);
		jQuery( document ).on( 'elementor/popup/show', () => {
			$( ".elementor-signature-field" ).each(function( index ) {
				elementor_signature_field($(this));
			});
        } );
		function elementor_signature_field(field){
			$(".elementor-upload-field-signature").attr("type","hidden");
			var data_id = field.data("id");
				var background = field.data("background");
				var color = field.data("color");
				var data = $("#form-field-"+data_id).val();
				var name = field.data("name");
				if( name == 1 ){
					name =true;
				}else{
					name =false;
				}
				field.signature({
					color: color,
					background: background,
					guideline: name,
					syncFormat: "PNG",
					syncField: $("#form-field-"+data_id),
					name: name,
					change: function(){
					}
				});	
				if( data !="" ) {
					field.signature('draw', data);
					$("#form-field-"+data_id).val(data);
				}else{
					$("#form-field-"+data_id).val("");
				}
		}
		$("body").on("click",".elementor-field-type-submit",function(){
			var form = $(this).closest("form");
			if( $(".elementor-upload-field-signature",form).length > 0 ) {
				var required = $(".elementor-upload-field-signature",form).attr("required");
				var check = $(".elementor-upload-field-signature",form).val();
				if( required == "required" && check == "" ){
					$(".elementor-upload-field-signature",form).attr("type","hidden");
				}
			}
		})
		$("body").on("click",".elementor_signature_clear img",function(){
			$(this).closest(".elementor-field-type-signature").find(".elementor-signature-field").signature('clear');
			$(this).closest(".elementor-field-type-signature").find("input").val("").attr("value","");
		})
		$("body").on("change",".elementor_signature_name",function(){
			var name = $(this).val();
			$(this).closest(".elementor-field-type-signaturer").find(".elementor-signature-field").signature('setname');
		})
		$("body").on("mouseleave",".elementor_signature_name",function(){
			var name = $(this).val();
			if( name != ""){
				$(this).closest(".elementor-field-type-signature").find(".elementor-signature-field").signature('setname');
			}
		})
		$( document ).on('reset', function(event){
			console.log(event);
			$( ".elementor_signature_clear" ).each(function( index ) {
				$(this).find("img").click();
			});
		});
	})
} )( jQuery );