	jQuery( document ).ready( function ( $ ) {
	
		$('#create_post').attr('disabled',true);
		$('#post_title').keyup(function(){
			if($(this).val().length > 3) {
				$('#create_post').attr('disabled', false);
			} else {
				$('#create_post').attr('disabled',true);	
			}
		});

		$('#create_post').click(function(event){
			post_via_ajax();
		});
		
		// Return Post Title Field Value
		function returnNewPostTitle(){
			var newPostTitleValue = $('#post_title').val();
			return newPostTitleValue;
		}
	
		// AJAX > Get City Posts
		function post_via_ajax()
		{
			var pva_ajax_url = pva_params.pva_ajax_url;
			
			$.ajax({
				type: 'POST',
				url: pva_ajax_url,
				data: {
					action: 'pva_create',
					post_title: 'heerp'
				},
				beforeSend: function ()
				{
					console.log('sending');
				},
				success: function(data)
				{
					console.log('yay');
				},
				error: function()
				{
					console.log('nay');
					
				}
			})
		}
	});
