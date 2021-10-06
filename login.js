    $("#resetButton").on("click",function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Submit your email',
      input: 'email',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Send',
      showLoaderOnConfirm: true,
      preConfirm: (email) => {
        Swal.fire({
              title: 'In progress...',
              html: 'Wait while we process your request ',
              timerProgressBar: true,
              onBeforeOpen: () => {
              Swal.showLoading()
              }
        });
        $.post('api/user.php?op=resetPasswordRequest', {email: email}, function(data, textStatus, xhr) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(xhr);
                    var response = JSON.parse(data);
                    if (response.status === 'success') {
                        Swal.fire({
                            title:response.title,
                            text:response.message,
                            icon:'success',
                            confirmButtonText:'Done'
                        })            
                    }
                    else if (response.status == 'error') {
                        Swal.fire({
                                title:response.title,
                                text:response.message,
                                icon:'warning',
                                confirmButtonText:'Try again'
                       });        
                    }

                });
          },
      allowOutsideClick: () => !Swal.isLoading()
    })
})
$("#formContainer").on('submit',function(e){
    e.preventDefault();
    if ($("#username").val() == "") {
        if ($("#password").val() == "") {
            Swal.fire({
                title:'There was a problem',
                text:'Please fill the email and password field',
                icon:'warning',
                confirmButtonText:'Try again'
             }); 
        }
        else{
            Swal.fire({
                title:'There was a problem',
                text:'Please fill the email field',
                icon:'warning',
                confirmButtonText:'Try again'
           });  
        }
    }
    else if ($("#password").val() == "") {
        if ($("#username").val() == "") {
            Swal.fire({
                title:'There was a problem',
                text:'Please fill the email and password field',
                icon:'warning',
                confirmButtonText:'Try again'
             }); 
        }
        else{
            Swal.fire({
                title:'There was a problem',
                text:'Please fill the password field',
                icon:'warning',
                confirmButtonText:'Try again'
           }); 
        }
    }
    else {
        var login=$("#username").val();
        var password=$("#password").val();

        $.post("api/user.php?op=sign-in",
            {"email":login,"password":password},
            function(data)
        {
            data = JSON.parse(data);
            if (data !== null)
            {
                console.log(data)
                $(location).attr("href","view/");   
            }
            else
            {
                Swal.fire({
                title:'There was a problem',
                text:'Your email or password is incorrect',
                icon:'warning',
                confirmButtonText:'Try again'
               });   
            }
        });
    }
})