<div id="taskbar" class="container">
 	<h2><a href="./">StandArt</a></h2>
		<div id="buttons">
			{if $loggedin eq true}
			<div id="userbutton" onClick="userMouseClick();">
			<span class="noselect" onSelectStart="return false;">{$user}</span>
			</div>
                        <div id="submitbutton" onclick="nav('upload');">
                            <span class="noselect" onSelectStart="return false;">Submit</span>
                        </div>
			{/if}
		</div>
		<div id="user_options" onClick="_userMouseClick();">
			<ul>
			<li onClick="nav('u-{$user}');"><img src='img/silk/information.png'><div>Profile</div></li>
			<li onClick="nav('settings');"><img src='img/silk/wrench.png'><div>Settings</div></li>
			<li onClick="nav('do/logout');"><img src='img/silk/door_in.png'><div>Logout</div></li>
			</ul>
		</div>
		<div id="userbox">
		{if $loggedin neq true}
			<form action="do/login" class="nice" method="post">
				<input type="text" name="username" placeholder="Username" class="input-text">
				<input type="password" name="password" placeholder="Password"class="input-text">
				<input type="submit" name="submit" value="Login" class="nice small white submit button">
				<span>or</span> <a href='register.php' class='nohref' onClick='javascript:regBox();'>Register</a>.
			</form>
		{/if}
		</div>
	</div>
	<div id="lightbox">
	</div>
	<div id="reg_content" style="display:none;">
		<h2 class="shadowh2">Register</h2>
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
		<input type="button" class="nice small white button next" onClick="javascript:lightbox_div();" value="Close">
	</div>
	<div id="main">