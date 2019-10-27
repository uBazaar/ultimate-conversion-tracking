(function( $ ) {
	'use strict';

	 $(function(){

		 $('#uct-save-admin-settings').click(function(event){

			 var inputs = $("#uct-admin-settings-form").find('input');
			 var settings = {};

			 inputs.each(function (index, el) {
	 				settings[$(el).attr('id')] = $(el).attr('value');
				});

				$.ajax({
					url:    ajaxurl,
					method: 'POST',
					data: {
						settings: settings,
						action: 'save_admin_settings'
					}
				}).done(function( response ) {
					if ( true === response.success ) {
						if(response.data.success == true ){
							$('#uct-settings-notice').addClass("notice notice-success");
							$('#uct-settings-notice').html('Settings Saved');
						}
					}
					else {
						error_codes    = response.data.codes;
						error_messages = response.data.messages;
					}
				});
			event.preventDefault();
	 });

	 $( window ).load(function() {

	 });

})( jQuery );
