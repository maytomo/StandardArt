{include file='header.tpl' title='Profile'}
{include file='taskbar.tpl'}
{if $profile_exists neq true}
<b>User Doesn't Exist!</b>
{else}
<div id="profile_avatar_container"><img id='profile_avatar' src='{$profile_avatar}'></div><h4 id="profile_name">
{*<span id="p_rank">{$profile_rank_symbol}</span>*}
{$profile_username}</h4>
<span id="p_rank_string">{$profile_rank_string}</span>
{/if}
{include file='footer.tpl'}