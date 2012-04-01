<?php
if(!defined("IN_SA")) exit();
$db = new DBConnect;
$u = @$_GET['u'];
if($u)
{
	$u = mysql_real_escape_string($u);
	$q = mysql_query("SELECT * FROM users WHERE username='$u'");
	if(mysql_num_rows($q) > 0)
	{
		$f = mysql_fetch_array($q);
		$smarty->assign('profile_username',htmlspecialchars($f['username']));
		$smarty->assign('profile_date',$f['date']);
		$smarty->assign('profile_exists',true);
		$smarty->assign('profile_rank',$f['rank']);
		$smarty->assign('profile_rank_symbol',rankSymbol($f['rank']));
		$smarty->assign('profile_rank_string',rankString($f['rank']));
		$q = mysql_query("SELECT * FROM profile WHERE userid='{$f['userid']}'");
		$pf = array();
		while($p = mysql_fetch_array($q))
		{
			$pf[$p['field']] = $p['value'];
		}
		$avatar = (isset($pf['avatar'])) ? $pf['avatar'] : 'img/avatar.png';
		$smarty->assign('profile_avatar',$avatar);
	}
	else
	{
		none();
	}
}
else
{
	none();
}
function none()
{
	$smarty->assign('profile_username','');
	$smarty->assign('profile_exists',false);
}
function rankSymbol($rank)
{
	switch($rank)
	{
		case 100:
			return '$'; //'Staff'
			break;
		case 99:
			return '+'; //Admins
			break;
		case 98:
			return '£'; //Official Accounts
			break;
		case 97:
			return '^'; //Community Volunteers
			break;
		case 96:
			return '¢'; //Creative Team
			break;
		case 95:
			return '©'; //Policy Enforcement
			break;
		case 94:
			return '%'; //Prints Team
			break;
		case 93:
			return '°'; //Alumni
			break;
		case 92:
			return '`'; //Senior Member
			break;
		case 91:
			return '='; //Beta Tester
			break;
		case 90:
			return '*'; //Premium User
			break;
		case 2:
			return '~'; //Regular Member
			break;
		case 1:
		case 0:
			return '!'; //Banned Member/Deactivated Account
			break;
		default:
			return '?'; //I dunno
			break;
	}
}
function rankString($rank)
{
	switch($rank)
	{
		case 100:
			return 'StandArt Staff';
			break;
		case 99:
			return 'General Administrator';
			break;
		case 98:
			return 'Official Account';
			break;
		case 97:
			return 'Community Volunteer';
			break;
		case 96:
			return 'Creative Team';
			break;
		case 95:
			return 'Policy Enforcement';
			break;
		case 94:
			return 'Prints Team';
			break;
		case 93:
			return 'standardArt Alumni';
			break;
		case 92:
			return 'Senior Member';
			break;
		case 91:
			return 'Official Beta Tester';
			break;
		case 90:
			return 'Premium User';
			break;
		case 2:
			return 'Member';
			break;
		case 1:
			return 'Deactivated Member';
			break;
		case 0:
			return 'Banned Member';
			break;
		default:
			return '?';
			break;
	}
}
?>