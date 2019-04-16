<?php

use XoopsModules\Tadtools;
use XoopsModules\Kv_club\Utility;

function xoops_module_install_kw_club(&$module)
{
    Utility::mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    Utility::mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    Tadtools\Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/kw_club');
    Tadtools\Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/kw_club/class');

    return true;
}


