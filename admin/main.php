<?php

use XoopsModules\Kw_club;

$GLOBALS['xoopsOption']['template_main'] = 'kw_club_adm_main.tpl';
require_once __DIR__ . '/admin_header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op        = system_CleanVars($_REQUEST, 'op', '', 'string');
$users_uid = system_CleanVars($_REQUEST, 'users_uid', '', 'string');

/**
 * @var xos_opal_Theme
 */
$xoTheme = $xoopsThemeFactory->createInstance(['contentTemplate' => @$xoopsOption['template_main']]);

switch ($op) {
    case 'save_club_admin':
        save_club_admin($users_uid);
        header("location: {$_SERVER['PHP_SELF']}?type=$type#setupTab2");
        exit;

    default:
        get_club_admin();
        $op = 'kw_club_admin';
        break;
}

/*-----------秀出結果區--------------*/
if (!isset($xoTheme)) {
    $xoTheme = &$GLOBALS['xoTheme'];
}
$xoopsTpl->assign('op', $op);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm3.css');
require_once __DIR__ . '/admin_footer.php';

//設定社團管理員
function get_club_admin()
{
    global $xoopsTpl, $xoopsDB;
    $groupid  = group_id_from_name(_MD_KWCLUB_ADMIN_GROUP);
    $user_arr = [];
    //列出群組中有哪些人
    if ($groupid) {
        /* @var \XoopsMemberHandler $memberHandler */
        $memberHandler = xoops_getHandler('member');
        $user_arr      = $memberHandler->getUsersByGroup($groupid);
    }

    $sql    = 'select uid,uname,name from ' . $xoopsDB->prefix('users') . ' order by uname';
    $result = $xoopsDB->query($sql) or web_error($sql);

    $myts    = MyTextSanitizer::getInstance();
    $user_ok = $user_yet = '';
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }
        $name  = $myts->htmlSpecialChars($name);
        $uname = $myts->htmlSpecialChars($uname);
        $name  = empty($name) ? '' : " ({$name})";
        if (!empty($user_arr) and in_array($uid, $user_arr)) {
            $user_ok .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
        } else {
            $user_yet .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
        }
    }
    //加入Token安全機制
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken();
    $xoopsTpl->assign('admin_token', $token->render());
    $xoopsTpl->assign('user_arr', implode(',', $user_arr));
    $xoopsTpl->assign('user_ok', $user_ok);
    $xoopsTpl->assign('user_yet', $user_yet);
}

//儲存社團管理員
/**
 * @param $users_uid
 */
function save_club_admin($users_uid)
{
    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $users   = explode(',', $users_uid);
    $groupid = group_id_from_name(_MD_KWCLUB_ADMIN_GROUP);
    //列出群組中有哪些人
    if ($groupid) {
        $memberHandler = xoops_getHandler('member');
        $user_arr      = $memberHandler->getUsersByGroup($groupid);
        //先從群組移除
        $memberHandler->removeUsersFromGroup($groupid, $user_arr);
        //再加入群組
        if (is_array($users)) {
            $memberHandler = xoops_getHandler('member');
            foreach ($users as $uid) {
                $memberHandler->addUserToGroup($groupid, $uid);
            }
        }
    }
}
