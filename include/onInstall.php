<?php

function xoops_module_install_kw_club(&$module)
{
    mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_club");
    mk_dir(XOOPS_ROOT_PATH . "/uploads/kw_club/class");

    return true;
}

function mk_group($name = "", $description = "")
{
    global $xoopsDB;
    $sql           = "select groupid from " . $xoopsDB->prefix("groups") . " where `name`='$name'";
    $result        = $xoopsDB->query($sql) or web_error($sql);
    list($groupid) = $xoopsDB->fetchRow($result);
    if (empty($groupid)) {
        $sql = "insert into " . $xoopsDB->prefix("groups") . " (`name`, `description`) values('{$name}','{$description}')";
        $xoopsDB->queryF($sql) or web_error($sql);
        //取得最後新增資料的流水編號
        $groupid = $xoopsDB->getInsertId();
    }
    return $groupid;
}
