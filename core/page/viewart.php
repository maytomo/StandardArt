<?php
if(!defined("IN_SA")) exit();
$db = new DBConnect;
$a = @$_GET['a'];
if($a)
{
    $a = mysql_real_escape_string($a);
    $q = $db->query("SELECT * FROM artwork WHERE id=$a");
    if(mysql_num_rows($q) == 0)
    {
        $smarty->assign('artwork_exists', false);
    }
    else
    {
        $smarty->assign('artwork_exists', true);
        $f = mysql_fetch_array($q);
        $smarty->assign('artwork_id',$f['id']);
        $smarty->assign('artwork_title', $f['title']);
        $smarty->assign('artwork_desc', Markdown($f['descr'],false));
        $time = timezones($f['date']);
        $smarty->assign('artwork_date',ago($time));
        $smarty->assign('artwork_path', $f['path']);
        $smarty->assign('artwork_status', $f['status']);
        $smarty->assign('artwork_deleted', deletedString($f['deleted']));
        $uploader = $db->query("SELECT * FROM users WHERE userid='{$f['userid']}'");
        $uploader = mysql_fetch_array($uploader);
        $avatar = $db->query("SELECT value FROM profile WHERE userid='{$f['userid']}' AND field='avatar'");
        $avatar = mysql_fetch_array($avatar);
        $smarty->assign('artwork_uploader', $uploader['username']);
        $smarty->assign('artwork_uploader_avatar',$avatar['value']);
        $smarty->assign('artwork_catflow', categoryFlow($f['cat']));
        $rating = $db->query("SELECT * FROM rating WHERE artid='{$f['id']}'");
        $likes = 0;
        $dislikes = 0;
        while($r = mysql_fetch_array($rating)){if($r['like']) $likes++; else $dislikes++;}
        //One liners = good at programming
        $smarty->assign('artwork_likes', $likes);
        $smarty->assign('artwork_dislikes', $dislikes);
        if($likes > 0) $smarty->assign('artwork_likes_percentage',($likes/($likes+$dislikes))*100);
        else $smarty->assign('artwork_likes_percentage',0);
        if($dislikes > 0)$smarty->assign('artwork_dislikes_percentage',($dislikes/($likes+$dislikes))*100);
        else $smarty->assign('artwork_dislikes_percentage',0);
        $username = mysql_real_escape_string(@$_SESSION['username']);
        $uid = $db->query("SELECT userid FROM users WHERE username='$username'");
        $uid = mysql_fetch_array($uid);
        $uid = $uid['userid'];
        $urate = $db->query("SELECT * FROM rating WHERE userid='$uid' AND artid='{$f['id']}'");
        if(mysql_num_rows($urate) == 0)
            $smarty->assign('artwork_user_like','');
        else
        {
            $urate = mysql_fetch_array($urate);
            if($urate['like']) $smarty->assign('artwork_user_like',true);
            else $smarty->assign('artwork_user_like',false);
        }
        getComments($f['id']);
    }
}
function deletedString($d)
{
    switch($d)
    {
        case 0:
            return 'against the rules.';
        case 1:
            return 'deleted by user.';
        case 2:
            return 'removed when account was closed.';
    }
}
function categoryFlow($cat)
{
    global $db;
    $arrow = "≫";
    $flow = "<a href='./'>Home</a>";
    $flowa = array();
    $cat = mysql_real_escape_string($cat);
    $c = $db->query("SELECT * FROM categories WHERE id='$cat'");
    if(mysql_num_rows($c) != 0)
    {
        $c = mysql_fetch_array($c);
        $flowa[] = $c;
        while($c['parent'] != 0)
        {
            $c = $db->query("SELECT * FROM categories WHERE id='{$c['parent']}'");
            $c = mysql_fetch_array($c);
            $flowa[] = $c;
        }
        if(count($flowa) > 1)
            $flowa = array_reverse($flowa);
        foreach($flowa as $c)
        {
            $flow .= " ".$arrow." <a href='cat-{$c['id']}'>{$c['name']}</a>";
        }
    }
    return $flow;
}
function timezones($time)
{
    global $db;
    $username = mysql_real_escape_string(@$_SESSION['username']);
    $t = $db->query("SELECT userid FROM users WHERE username='$username'");
    $t = mysql_fetch_array($t);
    $t = $db->query("SELECT value FROM profile WHERE userid='{$t['userid']}' AND field='timezone'");
    if(mysql_num_rows($t) == 0) return $time;
    $t = mysql_fetch_array($t);
    $t = $t['value'];
    return $time + (getOffset(0,$t)*60*60);
}
function getOffset($source,$offset)
{
    $gmtOffset = $source - $offset; 
    if($gmtOffset <> 0)
    {
        return $gmtOffset;
    }
}
function getComments($art)
{
    global $db,$smarty;
    $res = $db->query("SELECT * FROM comments WHERE artid='$art'");
    $comments = array();
    while($comment = mysql_fetch_array($res))
    {
        $um = $db->query("SELECT * FROM users WHERE userid='{$comment['userid']}'");
        $uf = mysql_fetch_array($um);
        $comment['username'] = $uf['username'];
        $um = $db->query("SELECT * FROM profile WHERE userid='{$comment['userid']}' AND field='avatar'");
        $uf = mysql_fetch_array($um);
        $comment['avatar'] = $uf['value'];
        $comment['content'] = Markdown($comment['content'],false);
        $comment['date'] = ago($comment['date']);
        $comments[] = $comment;
    }
    if(count($comments)>0)
    {
        $smarty->assign('artwork_comments',$comments);
    }
}
?>
