function generateApiKey(e){
	e.preventDefault();
	$("#form button[type='submit']").prop("disable",true);
	if ($("[name='apiKeyField']").val() != "") {
			Swal.fire({
				title: 'Are you sure?',
				html: "if you generate another <b>API Key</b>, the current API Key <b>won't work</b>",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it'
				}).then((result) => {
				if (result.value) {
					Swal.fire({
						title: 'In progress...',
						html: 'Generating new <b>API Key</b>',
						timerProgressBar: true,
						onBeforeOpen: () => {
						Swal.showLoading()
						}
					});
					$.ajax({
						url: '../api/user.php?op=generate-apiKey',
						type: 'POST',
						dataType: 'JSON'
					})
					.done(function(data) {
						console.log(data);
						var res = JSON.parse(JSON.stringify(data));
						if (res.status == "success") {	
							Swal.fire({
							  icon: res.status,
							  title: res.title,
							  html: res.message,
							})
							$.post('../api/user.php?op=showApiKey', {},function(data, textStatus, xhr) {
								console.log(data);
								var res = JSON.parse(JSON.stringify(data));
								$("[name='apiKeyField']").val(res);
							});
						}
						else{
							Swal.fire(
							  data.title,
							  data.message,
							  data.status
							)
						}
					})
					.fail(function() {
						Swal.fire(
						  'Error',
						  'Has been occurred an error, try again.',
						  'error'
						)
					})
					.always(function() {
						console.log("complete");
					});
				}
		})
	}
	else{
		Swal.fire({
			title: 'In progress...',
			html: 'Generating new <b>API Key</b>',
			timerProgressBar: true,
			onBeforeOpen: () => {
			Swal.showLoading()
			}
		});
		$.ajax({
			url: '../api/user.php?op=generate-apiKey',
			type: 'POST',
			dataType: 'JSON'
		})
		.done(function(data) {
			console.log(data);
			var res = JSON.parse(JSON.stringify(data));
			if (res.status == "success") {	
				Swal.fire({
				  icon: res.status,
				  title: res.title,
				  html: res.message,
				})
				$.post('../api/user.php?op=showApiKey', {},function(data, textStatus, xhr) {
					console.log(data);
					$("[name='apiKeyField']").val(data);
				});
			}
			else{
				Swal.fire(
				  data.title,
				  data.message,
				  data.status
				)
			}
		})
		.fail(function() {
			Swal.fire(
			  'Error',
			  'Has been occurred an error, try again.',
			  'error'
			)
		})
		.always(function() {
			console.log("complete");
		});
	}
	
}
$("form").on("submit", function(e){
	generateApiKey(e);
})