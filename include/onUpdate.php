<?php

use XoopsModules\Tadtools;
use XoopsModules\Kw_club;

/**
 * @param $module
 * @param $old_version
 * @return bool
 */
if (!class_exists('XoopsModules\kw_club\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/kw_club/class/Utility.php';
}


function xoops_module_update_kw_club(&$module, $old_version)
{
    global $xoopsDB;

    Kw_club\Utility::mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    // Kw_club\Utility::mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    if (Kw_club\Utility::chk_fc_tag()) {
        Kw_club\Utility::go_fc_tag();
    }
    if (Kw_club\Utility::chk_db_regParent()) {
        Kw_club\Utility::go_update_dbReg();
    }
    Kw_club\Utility::go_update_dbclubYear();
    Kw_club\Utility::go_update_teacher();

    return true;
}
