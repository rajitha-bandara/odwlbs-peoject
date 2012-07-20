$(document).ready(function() {
	// Collapse everything but the first menu:
	$("#VerColMenu > li > a").not(":first").find("+ ul").slideUp(1);
	// Expand or collapse:
	$("#VerColMenu > li > a").click(function() {
		$(this).find("+ ul").slideToggle("fast");
	});
});
