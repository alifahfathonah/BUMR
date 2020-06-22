/**
 * Extra JS 
 */

$(function()
{

	$(document).ready(function () {
		
		$('[data-toggle="tooltip"]').tooltip();
		
		/** Disable form submit, but load stripe when creditcard is selected */
		$('#creditcard_continue').hide();		
		$('input[name="pay_method"]').change(function() {
			if(document.getElementById('creditcard_select').checked) {
				$('#payment_continue').hide();
				$('#creditcard_continue').show();
			}else{
			 	$('#payment_continue').show();
				$('#creditcard_continue').hide();
			}
			

		});		

			
		$('input[name="account_type"]').change(function() {
		    var isBusinessAccount = $('input:checked[name="account_type"]').val() == "business";

		    	$('.business_input').toggleClass("hide");
		   
		});
		/**
		$('#upload-form').submit(function() {
			$('#description').html($('#editor').html());
			$('#description').val($('#editor').html());
		});
		*/
		$('.lightbox').lightbox();	
		//$('#editor').wysiwyg();
		$('.wysiwyg').redactor({
            plugins: ['source','video'],
            formatting: ['p', 'blockquote', 'pre','h3', 'h4',]
        });
		
		

		
				
		$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});
		
		
		/** Withdraw page option toggles */
				
		$('input[name="service"]').change(function() {
		    var isPaypal = $('input:checked[name="service"]').val() == "paypal";
		    $('#paypal_options').toggleClass("hide");
		    $('#swift_options').toggleClass("hide");
		});
			
		

		
		
		
		
		
		
				
	});	
});
