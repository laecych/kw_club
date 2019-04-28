<?php

use XoopsModules\Tadtools;
use XoopsModules\Kw_club;

/**
 * @param $module
 * @param $old_version
 * @return bool
 */
function xoops_module_update_kw_club(&$module, $old_version)
{
    global $xoopsDB;

    Kw_club\Utility::mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    Kw_club\Utility::mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    if (method_exists('\XoopsModules\Kw_club\Utility', 'chk_chk1')) {
        Kw_club\Utility::go_update1();
    }
//    Tadtools\Utility::go_update2();
//    Tadtools\Utility::go_update3();

    //新增檔案欄位
    if (method_exists('\XoopsModules\Kw_club\Utility', 'chk_fc_tag')) {
        Kw_club\Utility::go_fc_tag();
    }

    return true;
}


