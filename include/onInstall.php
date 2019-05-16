<?php

use XoopsModules\Tadtools;
use XoopsModules\Kw_club;
use XoopsModules\Kw_club\Utility;

/**
 * @param $module
 * @return bool
 */

if (!class_exists('XoopsModules\kw_club\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/kw_club/class/Utility.php';
}

function xoops_module_install_kw_club(&$module)
{
    kw_club\Utility::mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    // Utility::mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    kw_club\Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/kw_club');
    kw_club\Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/kw_club/class');

    return true;
}
