jQuery( document ).ready(function( $ ){
	$("#tab-basic").click(function(){
		$("#tab-basic-settings").addClass("wowapp-active");
		$("#tab-basic").addClass("nav-tab-active");
		$("#tab-advanced, #tab-support").removeClass("nav-tab-active");
		$("#tab-advanced-settings, #tab-support-content").removeClass("wowapp-active");
		$("#submit_woowapp").show();
	});
});

jQuery( document ).ready(function( $ ){
	$("#tab-advanced").click(function(){
		$("#tab-advanced-settings").addClass("wowapp-active");
		$("#tab-advanced").addClass("nav-tab-active");
		$("#tab-basic, #tab-support").removeClass("nav-tab-active");
		$("#tab-basic-settings, #tab-support-content").removeClass("wowapp-active");
		$("#submit_woowapp").show();
	});
});

jQuery( document ).ready(function( $ ){
	$("#tab-support").click(function(){
		$("#tab-support-content").addClass("wowapp-active");
		$("#tab-support").addClass("nav-tab-active");
		$("#tab-advanced, #tab-basic").removeClass("nav-tab-active");
		$("#tab-advanced-settings, #tab-basic-settings").removeClass("wowapp-active");
		$("#submit_woowapp").hide();
	});
});