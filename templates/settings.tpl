{include file='header.tpl' title='Settings'}
{include file='taskbar.tpl'}
{if $loggedin neq true}
	You need to be logged in!
{else}
<h2 class='shadowh2'>Settings</h2>
{if isset($smarty.session.settings_done)}
	<div id="alert-1" class="success alert-box">Settings Updated!<a id="alert_rem" onclick="removeAlert(-1);" href="javascript:void();">x</a></div> 
{/if}
{foreach from=$errors key=k item=e}
	<div id="alert{$k}" class="error alert-box">{$e}<a id="alert_rem" onclick="removeAlert({$k});" href="javascript:void();">x</a></div> 
{/foreach}
<form action="do/settings" method="POST" class="nice" enctype="multipart/form-data">
    <div class="fieldset-container">
	<fieldset>
	<legend>Avatar</legend>
	<input type="file" name="avatar"><input type="hidden" name="MAX_FILE_SIZE" value="50000"><br/>
	Allowed Files: JPEG, PNG, GIF. Max Size: 50kb<br/><br/>
	<input class="nice white small radius button" type="submit" value="Change" name="change-avatar-submit">
	</fieldset>
    </div>
</form>
<form action="do/settings" method="POST" class="nice">
    <div class="fieldset-container">
        <fieldset>
            <legend>Timezone</legend>
            <select name="timezone">
                <option value="-11">UTC -11:00 Midway, Samoa</option>
                <option value="-10">UTC -10:00 Hawaii</option>
                <option value="-9">UTC -09:00 Anchorage</option>
                <option value="-8">UTC -08:00 Los Angeles</option>
                <option value="-7">UTC -07:00 Phoenix, Denver</option>
                <option value="-6">UTC -06:00 Chicago, Mexico City</option>
                <option value="-5">UTC -05:00 Detroit, Toronto, New York</option>
                <option value="-4">UTC -04:00 Puerto Rico</option>
                <option value="-3">UTC -03:00 Buenos Aires, Sao Paulo</option>
                <option value="-2">UTC -02:00 South Georgia</option>
                <option value="-1">UTC -01:00 Cape Verde</option>
                <option value="0" SELECTED>UTC ±00:00 London, Dublin</option>
                <option value="1">UTC +01:00 Paris, Rome, Vatican, Berlin</option>
                <option value="2">UTC +02:00 Istanbul, Cairo, Jerusalem</option>
                <option value="3">UTC +03:00 Moscow, Baghdad, Tehran</option>
                <option value="4">UTC +04:00 Dubai, Kabul</option>
                <option value="5">UTC +05:00 Tashkent, Mawson, Katmandu</option>
                <option value="6">UTC +06:00 Vostok</option>
                <option value="7">UTC +07:00 Bangkok, Saigon</option>
                <option value="8">UTC +08:00 Singapore, Taipei, Hong Kong, Shanghai</option>
                <option value="9">UTC +09:00 Tokyo</option>
                <option value="10">UTC +10:00 Melbourne</option>
                <option value="11">UTC +11:00 Macquarie, Norfolk</option>
                <option value="12">08:45 (UTC +12:00) Fiji, Auckland, South Pole</option>
            </select>
            <input type="submit" value="Change" name="change-timezone-submit" class="small white radius button nice">
        </div>
</form>
{/if}
{include file='footer.tpl'}