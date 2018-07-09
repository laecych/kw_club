<?php

function xoops_module_install_kw_club(&$module)
{
    mk_group("社團管理");
    mk_group("社團老師");
    mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_club");
    mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_club/class");

    return true;
}

function mk_group($name = "")
{
    global $xoopsDB;
    $sql           = "select groupid from " . $xoopsDB->prefix("groups") . " where `name`='$name'";
    $result        = $xoopsDB->query($sql) or web_error($sql);
    list($groupid) = $xoopsDB->fetchRow($result);
    if (empty($groupid)) {
        $sql = "insert into " . $xoopsDB->prefix("groups") . " (`name`) values('{$name}')";
        $xoopsDB->queryF($sql) or web_error($sql);
        //取得最後新增資料的流水編號
        $groupid = $xoopsDB->getInsertId();
    }
    return $groupid;
}

// function mk_group($name)
// {
//     $member_handler = xoops_gethandler('member');
//     $group          = $member_handler->createGroup();
//     $group->setVar("name", $name);
//     $member_handler->insertGroup($group);
// }
