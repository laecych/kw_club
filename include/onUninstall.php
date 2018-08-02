<?php

function xoops_module_uninstall_kw_club(&$module)
{
    global $xoopsDB;
    $date = date("Ymd");
    rename(XOOPS_ROOT_PATH . "/uploads/kw_club", XOOPS_ROOT_PATH . "/uploads/kwclub_bak_{$date}");
    return true;
}

//刪除目錄
function delete_directory($dirname)
{
    if (is_dir($dirname)) {
        $dir_handle = opendir($dirname);
    }

    if (!$dir_handle) {
        return false;
    }

    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file)) {
                unlink($dirname . "/" . $file);
            } else {
                delete_directory($dirname . '/' . $file);
            }

        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
}

//拷貝目錄
function full_copy($source = "", $target = "")
{
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);
        while (false !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            $Entry = $source . '/' . $entry;
            if (is_dir($Entry)) {
                full_copy($Entry, $target . '/' . $entry);
                continue;
            }
            copy($Entry, $target . '/' . $entry);
        }
        $d->close();
    } else {
        copy($source, $target);
    }
}

function rm_group($name)
{
    $member_handler = xoops_gethandler('member');
    $group          = $member_handler->createGroup();
    $group->setVar("name", $name);
    $member_handler->insertGroup($group);
}
