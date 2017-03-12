$(document).ready(function(){
	var source = $("img.lazy-only").attr("data-original");
	$("img.lazy-only").attr("src",source);
});