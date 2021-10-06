$("#registerForm").on('submit',function(e)
{
    e.preventDefault();
    var firstName=$("#firstName").val();
    var lastName=$("#lastName").val();
    var email = $("#email").val();
    var password=$("#password").val();
    if ($("#confirm_password").val() !== password) {
      Swal.fire({
          title:'Please, verify one of the fields',
          text:'Check that the password and confirm password field match',
          icon:'warning',
          confirmButtonText:'Done'
     });
     $("[type='submit']").prop("disabled",false);   
    }
    else{
        Swal.fire({
          title: 'In progress...',
          html: 'Wait while we process your request ',
          timerProgressBar: true,
          onBeforeOpen: () => {
          Swal.showLoading()
          }
        });
        $.post("api/user.php?op=sign-up",
            {"firstName": firstName, "lastName": lastName,"email":email,"password":password},
            function(data)
        {
            var response = JSON.parse(data);  
            if (response.status == "success")
            {
                Swal.fire({
                  title: response.title,
                  text: response.message,
                  icon: response.status,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Done'
                }).then((result) => {
                  if (result.value) {
                    location.href="view/";
                  }
                })
            }
            else
            {
                Swal.fire({
                title: response.title,
                text: response.message,
                icon:'warning',
                confirmButtonText:'Try again'
               });   
            }
        });
    }
})