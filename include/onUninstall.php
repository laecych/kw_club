<?php

/**
 * @param $module
 * @return bool
 */
function xoops_module_uninstall_kw_club(&$module)
{
    global $xoopsDB;
    $date = date('Ymd');
    rename(XOOPS_ROOT_PATH . '/uploads/kw_club', XOOPS_ROOT_PATH . "/uploads/kwclub_bak_{$date}");

    return true;
}



