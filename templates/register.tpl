{include file='header.tpl' title='Register'}
{include file='taskbar.tpl'}
<h2 class="shadowh2">Register</h2>
{foreach from=$errors key=k item=e}
	<div id="alert{$k}" class="error alert-box">{$e}<a id="alert_rem" onclick="removeAlert({$k});" href="javascript:void();">x</a></div> 
{/foreach}
<form action="do/register" class="nice" method="post">
	Username: <input class="input-text" type="text" name="username" maxlength="25">
	Password: <input class="input-text" type="password" name="password">
	Verify Password: <input class="input-text" type="password" name="ver_password">
	Email: <input class="input-text" type="text" name="email"><br/>
	<img src='captcha'>
	<br/>
	<input type="text" name="captcha" placeholder="Copy the text above." class="input-text"><br/>
	<input type="submit" name="submit" value="Register" class="nice small white button">
</form>
{include file='footer.tpl'}