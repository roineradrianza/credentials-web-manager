let table;
let table_currently_signed;
$(window).on('load', function(event) {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})
});
function init(){
	list();
	listCurrentlySigned();
}
function cleanForm(modalForm){
	$('form').trigger("reset");
	$("#"+modalForm).modal('toggle');
}
function Save(e){
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
		var formData = new FormData(document.getElementById("userForm"));
		console.log(formData);
		Swal.fire({
			title: 'In progress...',
			html: 'Processing new user ',
			timerProgressBar: true,
			onBeforeOpen: () => {
			Swal.showLoading()
			}
		});
		$.ajax({
			url: '../api/user.php?op=CreateAndEdit',
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
				cleanForm("userFormModal");
				table.ajax.reload();
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
function Edit(e){
	e.preventDefault();
	$("[type='submit']").prop("disable",true);
	var password=$("#passwordEdit").val();
  if ($("#confirmPasswordEdit").val() !== password) {
    Swal.fire({
        title:'Please, verify one of the fields',
        text:'Check that the password and confirm password field match',
        icon:'warning',
        confirmButtonText:'Done'
   });
   $("[type='submit']").prop("disabled",false);   
  }
  else{
		var formData = new FormData(document.getElementById("userFormEdit"));
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
			url: '../api/user.php?op=CreateAndEdit',
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
				cleanForm("userEditModal");
				table.ajax.reload();
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
$("#userForm").on("submit", function(e){
	Save(e);
})
$("#userFormEdit").on("submit", function(e){
	Edit(e);
})
function list(){
	table=$('#usersTable').DataTable(
	{
		"responsive": true,
		"aProcessing": true,//Active the processing of the databables
	    "aServerSide": true,//Pagination and filtered made from the server
		"ajax":
				{
					url: '../api/user.php?op=list',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true
	});
}

function listCurrentlySigned(){
	table_currently_signed = $('#usersCurrentlySignedTable').DataTable(
	{
		"responsive": true,
		"aProcessing": true,//Active the processing of the databables
	    "aServerSide": true,//Pagination and filtered made from the server
		"ajax":
				{
					url: '../api/user.php?op=list-currently-signed',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true
	});
}
function showUser(id){
	$("#userEditModal").modal("toggle");
	$.ajax({
		url: '../api/user.php?op=show',
		type: 'POST',
		dataType: 'JSON',
		data: {"userID": id},
	})
	.done(function(data) {
		var res = JSON.parse(JSON.stringify(data));
		console.log(data);
		$("#modalTitle").text("Edit " + data.firstName + " " + data.lastName);
		$("#userID").val(data.userID);
		$("#firstNameEdit").val(data.firstName);
		$("#lastNameEdit").val(data.lastName);
		$("#emailEdit").val(data.email);
		$("#emailCompare").val(data.email);
		$("#typeEdit").val(data.type);
	})
}
function deleteUser(id){
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it'
		}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '../api/user.php?op=delete',
				type: 'POST',
				dataType: 'JSON',
				data: {userID: id},
			})
			.done(function(data) {
				var res = JSON.parse(JSON.stringify(data));
				Swal.fire({
					icon: res.status,
					title: res.title,
					text: res.message
				  });
				if (res.status == "success") {
					table.ajax.reload();
				}
			})
			.fail(function() {
				console.error("error");
			})
		
		}
	})
}

function logoutUser(id){
	$.ajax({
		url: '../api/user.php?op=logout-external',
		type: 'POST',
		dataType: 'JSON',
		data: {userID: id},
	})
	.done(function(data) {
		var res = JSON.parse(JSON.stringify(data));
		Swal.fire({
			icon: res.status,
			title: res.title,
			text: res.message
		});
		if (res.status == "success") {
			table_currently_signed.ajax.reload();
		}
	})
	.fail(function() {
		console.error("error");
	})
}
init();