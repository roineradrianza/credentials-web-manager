	let params = new URLSearchParams(location.search);
	var resetCode = params.get('code');
	$("form").on("submit",function(e)
	{
		restorePassword(e);	
	})
function restorePassword(e)
{
	e.preventDefault(); //Won't activate the default action of the event
	$("#btnRestorePassword").prop("disabled",true);
	var formData = new FormData($("form")[0]);
	formData.append("resetCode",resetCode);
	if ($("#confirm_password").val() !== $("#password").val() ) {
      Swal.fire({
	      title:'Please, verify one of the fields',
	      text:'Check that the password and confirm password field match',
	      icon:'warning',
	      confirmButtonText:'Done'
     });
     $("#btnSave").prop("disabled",false);   
	}
	else{
		$.ajax({
			url: "../api/user.php?op=resetPassword",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(data)
		    { 
		    	var response = JSON.parse(data);
				    if (response.status === 'success') {
				    	Swal.fire({
								  title: response.title,
								  text: response.message,
								  icon: response.status,
								  confirmButtonColor: '#3085d6',
								  confirmButtonText: 'Sign In'
								}).then((result) => {
								  if (result.value) {
											location.href="../login.php";
								  }
								})
								$("#btnRestorePassword").prop("disabled",false);
				    } 
				   else{
		            Swal.fire({
		            title: response.title,
		            text: response.message,
		            icon: response.status,
		            confirmButtonText: 'Try again'
		           });   
								$("#btnRestorePassword").prop("disabled",false);
				   }                   
		    }

		});
	}

}