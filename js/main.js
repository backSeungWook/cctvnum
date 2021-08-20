jQuery(function($){ 
	$("#ttable").DataTable({
		"info": false,   
		"responsive": true,
		"bFilter": true,
		"paging":   false, 
    "lengthChange": false,
    
		"fixedHeader": true
	}); 

	$("#ttable_filter").addClass("hidden");
	$("#ttable_wrapper").addClass("");

$("#serachInput").on("input", function (e) {

   e.preventDefault();
   $('#ttable').DataTable().search($(this).val()).draw();
});

}); 
