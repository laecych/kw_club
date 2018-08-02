<?php
include_once "header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op     = system_CleanVars($_REQUEST, 'op', '', 'string');
$keyman = system_CleanVars($_REQUEST, 'keyman', '', 'string');
$reg_sn = system_CleanVars($_REQUEST, 'reg_sn', '', 'int');
$reg_sn = system_CleanVars($_POST, 'reg_sn', '', 'int');
$id     = system_CleanVars($_POST, 'id', '', 'string');
$value  = system_CleanVars($_POST, 'value', '', 'string');

switch ($op) {
    //更新註冊資訊
    case "update_reg":
        die(update_reg($id, $value, $reg_sn));

    //篩選使用者
    case "keyman":
        die(keyman($keyman));
}

function update_reg($id, $value, $reg_sn)
{
    global $xoopsDB;
    if (!$_SESSION['isclubAdmin']) {
        return '無修改權限';
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
