var table;
$(window).on('load', function(event) {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 2000,
	  timerProgressBar: true,
	  onOpen: (toast) => {
	    toast.addEventListener('mouseenter', Swal.stopTimer)
	    toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})
	var clipboard = new ClipboardJS("[actionToDo='copy']");
	clipboard.on('success', function(e) {
   	$(e.trigger).prop("title", "Copied");
    $(e.trigger).addClass('badge-primary');
		Toast.fire({
		  icon: 'success',
		  title: 'Text Copied'
		})
	});
})
function init(){
	listLinks();
	listCategories();
}

function listLinks(){
	table=$('#linkTable').DataTable(
	{
		"responsive": true,
		"aProcessing": true,//Active the processing of the databables
	    "aServerSide": true,//Pagination and filtered made from the server
		"ajax":
				{
					url: '../api/link.php?op=latestLinks',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true
	});
}
function listCategories(){
	table=$('#categoryTable').DataTable(
	{
		"responsive": true,
		"aProcessing": true,//Active the processing of the databables
	    "aServerSide": true,//Pagination and filtered made from the server
		"ajax":
				{
					url: '../api/category.php?op=listCount',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true
	});
}

init();