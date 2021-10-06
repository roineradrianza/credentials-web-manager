function Update(e){
	e.preventDefault();
	$("[type='submit']").prop("disable",true);
	var password=$("#password").val();
  if ($("#confirmPassword").val() !== password) {
    Swal.fire({
      title:'Please, verify one of the fields',
      text:'Check that the password and confirm password field match',
      icon:'warning',
      confirmButtonText:'Done'
  	});
   $("[type='submit']").prop("disabled",false);   
  }
  else{
		var firstName = $("#firstName").val();
		var lastName = $("#lastName").val();
		var formData = new FormData(document.getElementById("profileForm"));
		console.log(formData);
		Swal.fire({
			title: 'In progress...',
			html: 'Processing user changes ',
			timerProgressBar: true,
			onBeforeOpen: () => {
			Swal.showLoading()
			}
		});
		$.ajax({
			url: '../api/user.php?op=updateProfile',
			type: 'POST',
			dataType: 'JSON',
			data: formData,
		    contentType: false,
		    processData: false
		})
		.done(function(data) {
			console.log(data);
			var res = JSON.parse(JSON.stringify(data));
			if (res.status == "success") {
				Swal.fire({
				  icon: res.status,
				  title: res.title,
				  text: res.message,
				})
				$("#fullNameLabel").text(firstName + " " +lastName);
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
$("#profileForm").on("submit", function(e){
	Update(e);
})