<?php

use XoopsModules\Tadtools;
use XoopsModules\Kv_club\Utility;

function xoops_module_update_kw_club(&$module, $old_version)
{
    global $xoopsDB;

    Utility::mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    Utility::mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    if (Utility::chk_chk1()) {
        Utility::go_update1();
    }
    Utility::go_update2();
    Utility::go_update3();
    //新增檔案欄位
    if (Utility::chk_fc_tag()) {
        Utility::go_fc_tag();
    }

    return true;
}


