{include file='header.tpl' title='Upload'}
{include file='taskbar.tpl'}
<h2 class="shadowh2">Upload Artwork</h2>
{foreach from=$errors key=k item=e}
	<div id="alert{$k}" class="error alert-box">{$e}<a id="alert_rem" onclick="removeAlert({$k});" href="javascript:void();">x</a></div> 
{/foreach}
<form action='do/upload' method='post' class='nice' enctype="multipart/form-data">
    Title: <input type='text' name='title' class='input-text'>
    Description: <textarea name="desc"></textarea>
    <div class="fieldset-container">
        <fieldset>
            <legend>File</legend>
            <input type="file" name="artfile"><br/>
            Max size: 5MB. Allowed: JPEG, PNG, GIF.
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000"><br/>
        </fieldset>
    </div>
    Category:<br/>
    <select name="category">
        {$upload_categories}
    </select>
    <input type="submit" value="Upload" name="submit" class="nice small radius white button">
</form>
{include file='footer.tpl'}