$(document).ready(function()
{
        $("#no-js-notice").hide();
        $("#main").show();
        $("#taskbar").show();
	$(".nohref").attr("href","javascript:void(null);");
	$("#lightbox_bg").css("width",$(window).width());
	$("#lightbox_bg").css("height",$(window).height());
});
function regBox()
{
	$("#lightbox").html($("#reg_content").html());
	$("#lightbox").fadeIn();
	$("#lightbox_bg").fadeIn();
}
function lightbox_div()
{
	$("#lightbox").fadeOut();
	$("#lightbox_bg").fadeOut();
}
function removeAlert(a)
{
	$("#alert"+a).slideUp();
}
function userMouseClick()
{
	$("#user_options").slideDown();
}
function _userMouseClick()
{
	$("#user_options").slideUp();
}
function nav(u)
{
	window.location = u;
}
function kext_do()
{
    alert("KONAMI CODE");
}