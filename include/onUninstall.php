<?php

use XoopsModules\Tadtools;
use XoopsModules\Kv_club\Utility;

function xoops_module_uninstall_kw_club(&$module)
{
    global $xoopsDB;
    $date = date('Ymd');
    rename(XOOPS_ROOT_PATH . '/uploads/kw_club', XOOPS_ROOT_PATH . "/uploads/kwclub_bak_{$date}");

    return true;
}



