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
/*
const headerEl = document.querySelector('header');


$(window).scroll(function(e){
	console.log(headerEl)
	if(headerEl.offsetTop() !== 0){
			if(!headerEl.hasClass('shadow')){
				headerEl.addClass('shadow');
			}
	}else{
		headerEl.removeClass('shadow');
	}
});*/

//gsap 으로 새로 구현 예정
//const header = $('header');
const header = document.querySelector('header')

$(window).scroll(function(e){
	//console.log(header.offset().top)
		if(header.getBoundingClientRect().top + window.scrollY !== 0){
			//console.log(header)
				if(!header.classList.contains('shadow')){
						header.classList.add('shadow');
				}
		}else{
				header.classList.remove('shadow');
		}
});