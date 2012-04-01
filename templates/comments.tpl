<div id="artwork_comments">
    <br/><br/>
    {if isset($artwork_comments) neq true}
        No Comments Yet!
    {else}
        {foreach from=$artwork_comments item=comment}
            <div class='artwork-comment'>
                {*<div class="comment-info">
                    <a href='u-{$comment['username']}'>
                        <img class='artwork-comment-avatar' src='{$comment['avatar']}'>
                    </a>
                </div>*}
                <div class="comment-content">
                    <span class="comment-info-username">{$comment['username']} said</span>
                    <span class="comment-content-info">{$comment['date']}</span><br/>
                    <span class="comment-content-p">{$comment['content']}</span>
                </div>
            </div>
        {/foreach}
    {/if}
    <div id="submit-comment">
        <form action="do/comment" method="POST" class="nice">
            <textarea cols="20" rows="6" name="comment" placeholder="Type your comment..."></textarea>
            <input type="hidden" name="art-id" value="{$artwork_id}">
            <div id="submit-comment-rating">
                {if $artwork_user_like eq true or $artwork_user_like === false}
                    You have already left a rating.
                {else}
                    Please leave a rating.<br/>
                    {if $artwork_user_like eq true or $artwork_user_like === false}<img src='img/silk/thumb_up_gray.png'>{else $artwork_user_like neq ''}<img src='img/silk/thumb_up.png'>{/if}
                    {if $artwork_user_like eq true or $artwork_user_like === false}<img src='img/silk/thumb_down_gray.png'>{else $artwork_user_like neq ''}<img src='img/silk/thumb_down.png'>{/if}
                {/if}
                <br/>
                <input type="submit" value="Submit" class="nice radius small white button" id="submit-comment-button">
            </div>
        </form>
    </div>
</div>