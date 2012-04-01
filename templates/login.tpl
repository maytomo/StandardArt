{include file='header.tpl' title='Login'}
{include file='taskbar.tpl'}
<h2 class="shadowh2">Login</h2>
{foreach from=$errors key=k item=e}
	<div id="alert{$k}" class="error alert-box">{$e}<a id="alert_rem" onclick="removeAlert({$k});" href="javascript:void();">x</a></div> 
{/foreach}
<form action="do/login" class="nice" method="post">
	Username: <input class="input-text" type="text" name="username" maxlength="25">
	Password: <input class="input-text" type="password" name="password">
	<br/>
	<input type="submit" name="submit" value="Login" class="nice small white button">
</form>
{include file='footer.tpl'}