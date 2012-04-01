{if $artwork_exists neq true}
    {include file='header.tpl' title='Artwork Not Found'}
{else}
    {include file='header.tpl' title=$artwork_title}
{/if}
{include file='taskbar.tpl'}
{if $artwork_exists neq true}
    <h3 id="artwork_no_exist">Artwork Doesn't Exist</h3>
{else}
    <span id="artwork_flow">{$artwork_catflow}</span>
    <img id='artwork_image' src='{$artwork_path}' alt='$artwork_title'>
    <h3 id="artwork_title">
        <a href='u-{$artwork_uploader}'>
            <img src='{$artwork_uploader_avatar}' id='artwork_uploader_avatar'>
        </a>
        {$artwork_title}
    </h3>
    <div id="artwork_description">
        {$artwork_desc}
    </div>
    <span id="artwork_info">
        By {$artwork_uploader}, {$artwork_date}.
    </span><br/>
    <div id="ratings-container">
        <div id="ratings">
            {if $artwork_likes eq 0 and $artwork_dislikes eq 0}
                <i>No users have rated this piece.</i>
            {else}
                <div id="ratings-bar">
                    <div id="likes-bar" style="width:{$artwork_likes_percentage}%;"></div>
                    <div id="dislikes-bar" style="width:{$artwork_dislikes_percentage}%;"></div>
                </div>
                <span id="likes-dislikes-stats">{$artwork_likes} likes, {$artwork_dislikes} dislikes</span>
            {/if}
        </div>
    </div>
    {include file='comments.tpl' artwork_id=$artwork_id}
{/if}
{include file='footer.tpl'}