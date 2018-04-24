<input type="button" id="info" name="button" value="Обновить">

<script>
	$('#info').click(function(){

		$.ajax({
			type: "POST",
			url: "/ajax/update_data",
			dataType: "json",
			data: {
				table: 'info'
			},
			success: function(data){
			}
		});
	});

</script>