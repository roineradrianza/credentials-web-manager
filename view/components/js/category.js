var table;
var doc = "category";
$(window).on('load', function(event) {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})
});
function init(){
	list();
}
function list(){
	table=$('#categoryTable').DataTable(
	{
		"responsive": true,
		"aProcessing": true,//Active the processing of the databables
	    "aServerSide": true,//Pagination and filtered made from the server
		"ajax":
				{
					url: '../api/category.php?op=list',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true
	});
}
function cleanForm(modalForm){
	$('form').trigger("reset");
	$("#"+modalForm).modal('toggle');
}
/*Form switch*/
function insertForm(){
 $("#modalTitle").text('New ' + doc);
 $("#insertForm").attr('form-type','insert');
 $("form").trigger('reset');
}
function editForm(id, fields){
	$("form").trigger('reset');
	$("#insertForm").attr('form-type','update');
	$("#modalTitle").text('Edit ' + doc);
	$("#id").val(id);
	console.log(fields);
	for (let [key, value] of fields) {
		$("#"+key).val(value);
	}
	if (doc == "link") {
		$('#categoryID').selectpicker('refresh');
	}
	$('#insertModal').modal('toggle');
}
$("#insertForm").on('submit', function (e) {
	e.preventDefault();
	if ($(this).attr('form-type') == 'insert') {
		Save();
	}	
	else{
		Update();
	}
})
/*Form processes*/
function deleteData(id){
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
				url: '../api/category.php?op=delete',
				type: 'POST',
				dataType: 'JSON',
				data: {id: id},
			})
			.done(function(data) {
				console.log(data);
				var res = JSON.parse(JSON.stringify(data));
				if (res.status == "success") {
					Swal.fire({
					  icon: res.status,
					  title: res.title,
					  text: res.message
					});
					table.ajax.reload();
				}
				else{
					Swal.fire({
					  icon: res.status,
					  title: res.title,
					  text: res.message
					})
				}
			})
			.fail(function() {
				Swal.fire({
				  icon: 'error',
				  title: 'Oops!',
				  text: 'Something wrong has occured...'
				})
			})
		
		}
	})
}
function Save(){
	$("[type='submit']").prop("disable",true);
	var formData = new FormData(document.getElementById("insertForm"));
	console.log(formData);
	Swal.fire({
		title: 'In progress...',
		html: 'Processing new Category',
		timerProgressBar: true,
		onBeforeOpen: () => {
		Swal.showLoading()
		}
	});
	$.ajax({
		url: '../api/category.php?op=CreateAndEdit',
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
			cleanForm("insertModal");
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
function Update(){
	$("[type='submit']").prop("disable",true);
	var formData = new FormData(document.getElementById("insertForm"));
	console.log(formData);
	Swal.fire({
		title: 'In progress...',
		html: 'Processing link changes ',
		timerProgressBar: true,
		onBeforeOpen: () => {
		Swal.showLoading()
		}
	});
	$.ajax({
		url: '../api/category.php?op=CreateAndEdit',
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
			cleanForm("insertModal");
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
init();