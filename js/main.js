const header = document.querySelector('header')
const toTopEl = document.querySelector('#to-top')


//테이블 
jQuery(function($){ 
	$("#ttable").DataTable({
		"info": false,   
		"responsive": true,
		"bFilter": true,
		"paging":   false, 
    "lengthChange": false,
    "language": {
      "emptyTable": "데이터가 없습니다.",
			"zeroRecords": "찾을 내용이 없습니다."
    },
		"fixedHeader": true
	}); 

	$("#ttable_filter").addClass("hidden");
	$("#ttable_wrapper").addClass("");

	$("#serachInput").on("input", function (e) {
		e.preventDefault();
		$('#ttable').DataTable().search($(this).val()).draw();
	});
}); 


//스크롤
window.addEventListener('scroll', _.throttle(function(){
	if(header.getBoundingClientRect().top + window.scrollY !== 0){
		console.log(header)
			if(!header.classList.contains('shadow')){				
				header.classList.add('shadow');
			}
			else
			{
				header.classList.remove('shadow2');	
			}
			gsap.to(toTopEl, .2, {
				x: 0
			});
	}else{
		
			header.classList.add('shadow2');
			gsap.to(toTopEl,.2,{
				x: 100
			});
	}
},300));

toTopEl.addEventListener('click',function(){
  gsap.to(window,.5,{
    scrollTo:0//화면의 위치를 0PX 로 이동 0.7 초동안 gsap.to 인수 값 만큼(지속시간)
  });
});