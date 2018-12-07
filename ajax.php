<?php
include_once "header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op      = system_CleanVars($_REQUEST, 'op', '', 'string');
$keyman  = system_CleanVars($_REQUEST, 'keyman', '', 'string');
$reg_sn  = system_CleanVars($_REQUEST, 'reg_sn', '', 'int');
$uid     = system_CleanVars($_REQUEST, 'uid', '', 'int');
$id      = system_CleanVars($_POST, 'id', '', 'string');
$value   = system_CleanVars($_POST, 'value', '', 'string');
$reg_uid = system_CleanVars($_POST, 'reg_uid', '', 'string');

switch ($op) {

    //更新教師簡介
    case "search_reg_uid":
        die(search_reg_uid($reg_uid));

    //更新教師簡介
    case "update_bio":
        die(update_bio($value, $uid));

    //更新註冊資訊
    case "update_reg":
        die(update_reg($id, $value, $reg_sn));

    //篩選使用者
    case "keyman":
        die(keyman($keyman));
}

//以身份證號自動取得姓名
function search_reg_uid($reg_uid)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $sql            = "select `reg_name` from " . $xoopsDB->prefix("kw_club_reg") . " where `reg_uid`='{$reg_uid}' order by reg_datetime desc limit 0,1";
    $result         = $xoopsDB->query($sql) or die($sql);
    list($reg_name) = $xoopsDB->fetchRow($result);
    $reg_name       = $myts->htmlSpecialChars($reg_name);
    return $reg_name;
}

function update_bio($value, $uid)
{
    global $xoopsDB;
    if (!$_SESSION['isclubAdmin']) {
        die(_MD_KWCLUB_FORBBIDEN);
    }

    $myts = MyTextSanitizer::getInstance();
    $val  = $myts->htmlSpecialChars($value);
    // $val = strip_tags($value);
    $sql = "update " . $xoopsDB->prefix("kw_club_teacher") . " set `teacher_desc`='{$val}' where `teacher_id`='{$uid}'";
    $xoopsDB->queryF($sql);
    return $value;
}

function update_reg($id, $value, $reg_sn)
{
    global $xoopsDB;
    if (!$_SESSION['isclubAdmin']) {
        die(_MD_KWCLUB_FORBBIDEN);
    }
    if (strpos($id, 'reg_name') !== false) {
        $col = 'reg_name';
    } elseif (strpos($id, 'reg_isreg') !== false) {
        $col = 'reg_isreg';
    } elseif (strpos($id, 'reg_grade') !== false) {
        $col = 'reg_grade';
    } elseif (strpos($id, 'reg_class') !== false) {
        $col = 'reg_class';
    } elseif (strpos($id, 'reg_uid') !== false) {
        $col = 'reg_uid';
    } elseif (strpos($id, 'reg_parent') !== false) {
        $col = 'reg_parent';
    } elseif (strpos($id, 'reg_tel') !== false) {
        $col = 'reg_tel';
    } else {
        return;
    }

    $myts = MyTextSanitizer::getInstance();
    $val  = $myts->htmlSpecialChars($value);
    $sql  = "update " . $xoopsDB->prefix("kw_club_reg") . " set `{$col}`='{$val}' where `reg_sn`='{$reg_sn}'";
    $xoopsDB->queryF($sql);

    if ($col == "reg_grade") {
        if ($val == _MD_KWCLUB_KG) {
            $value = _MD_KWCLUB_KINDERGARTEN;
        } else {
            $value = $val . _MD_KWCLUB_G;
        }
    }
    return $value;
}

function keyman($keyman)
{
    global $xoopsDB;
    $groupid  = group_id_from_name(_MD_KWCLUB_TEACHER_GROUP);
    $user_arr = array();
    //列出群組中有哪些人
    if ($groupid) {
        $member_handler = xoops_gethandler('member');
        $user_arr       = $member_handler->getUsersByGroup($groupid);
    }

    $where = !empty($keyman) ? "where name like '%{$keyman}%' or uname like '%{$keyman}%' or email like '%{$keyman}%'" : "";

    $sql    = "select uid,uname,name from " . $xoopsDB->prefix("users") . " $where order by uname";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $myts    = MyTextSanitizer::getInstance();
    $user_ok = $user_yet = "";
    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }
        $name  = $myts->htmlSpecialChars($name);
        $uname = $myts->htmlSpecialChars($uname);
        $name  = empty($name) ? "" : " ({$name})";
        if (!empty($user_arr) and in_array($uid, $user_arr)) {
            $user_ok .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
        } else {
            $user_yet .= "<option value=\"$uid\">{$uid} {$name} {$uname} </option>";
        }
    }
    return $user_yet;
}
