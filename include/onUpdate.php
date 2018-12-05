<?php

function xoops_module_update_kw_club(&$module, $old_version)
{
    global $xoopsDB;

    mk_group(_MI_KWCLUB_ADMIN_GROUP, _MI_KWCLUB_ADMIN_GROUP . _MI_KWCLUB_GROUP_NOTE);
    mk_group(_MI_KWCLUB_TEACHER_GROUP, _MI_KWCLUB_TEACHER_GROUP . _MI_KWCLUB_GROUP_NOTE);
    if (chk_chk1()) {
        go_update1();
    }

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

//檢查某欄位是否存在
function chk_chk1()
{
    global $xoopsDB;
    $sql    = "select count(`reg_parent`) from " . $xoopsDB->prefix("kw_club_reg");
    $result = $xoopsDB->query($sql);
    if (empty($result)) {
        return true;
    }

    return false;
}

// //執行更新
function go_update1()
{
    global $xoopsDB;
    $sql = "ALTER TABLE " . $xoopsDB->prefix("kw_club_reg") . " ADD `reg_parent` varchar(255) NOT NULL  COMMENT '報名者家長' after `reg_class`,  ADD `reg_tel` varchar(255) NOT NULL COMMENT '家長聯絡電話' after `reg_parent`";
    $xoopsDB->queryF($sql) or web_error($sql);

    return true;
}

function go_update2()
{
    global $xoopsDB;
    $sql = "ALTER TABLE " . $xoopsDB->prefix("kw_club_info") . " CHANGE `club_year` `club_year` varchar(20) COLLATE 'utf8_general_ci' NOT NULL COMMENT '社團年度' AFTER `club_id`;";
    $xoopsDB->queryF($sql) or web_error($sql);

    $sql = " CREATE TABLE " . $xoopsDB->prefix("kw_club_teacher") . "(
            `teacher_id` smallint(6) unsigned NOT NULL auto_increment COMMENT '教師編號',
            `teacher_title` varchar(255) NOT NULL default '' COMMENT '教師標題',
            `teacher_desc` varchar(255) NOT NULL default '' COMMENT '教師簡介',
            `teacher_sort` smallint(6) unsigned NOT NULL default '0' COMMENT '教師排序',
            `teacher_enable` enum('1','0') NOT NULL default '1' COMMENT '狀態',
            PRIMARY KEY  (`teacher_id`)) ENGINE=MyISAM;
            INSERT INTO `kw_club_teacher` (`teacher_id`, `teacher_title`, `teacher_desc`, `teacher_sort`, `teacher_enable`) VALUES
            (1,	'張老師',	'電腦教學',	0,	'1');";

    $xoopsDB->queryF($sql) or web_error($sql);

    return true;

}

//建立目錄
// function mk_dir($dir = "")
// {
// //若無目錄名稱秀出警告訊息
//     if (empty($dir)) {
//         return;
//     }

// //若目錄不存在的話建立目錄
//     if (!is_dir($dir)) {
//         umask(000);
// //若建立失敗秀出警告訊息
//         mkdir($dir, 0777);
//     }
// }

// //拷貝目錄
// function full_copy($source = "", $target = "")
// {
//     if (is_dir($source)) {
//         @mkdir($target);
//         $d = dir($source);
//         while (false !== ($entry = $d->read())) {
//             if ($entry == '.' || $entry == '..') {
//                 continue;
//             }

//             $Entry = $source . '/' . $entry;
//             if (is_dir($Entry)) {
//                 full_copy($Entry, $target . '/' . $entry);
//                 continue;
//             }
//             copy($Entry, $target . '/' . $entry);
//         }
//         $d->close();
//     } else {
//         copy($source, $target);
//     }
// }

// function rename_win($oldfile, $newfile)
// {
//     if (!rename($oldfile, $newfile)) {
//         if (copy($oldfile, $newfile)) {
//             unlink($oldfile);
//             return true;
//         }
//         return false;
//     }
//     return true;
// }

// function delete_directory($dirname)
// {
//     if (is_dir($dirname)) {
//         $dir_handle = opendir($dirname);
//     }

//     if (!$dir_handle) {
//         return false;
//     }

//     while ($file = readdir($dir_handle)) {
//         if ($file != "." && $file != "..") {
//             if (!is_dir($dirname . "/" . $file)) {
//                 unlink($dirname . "/" . $file);
//             } else {
//                 delete_directory($dirname . '/' . $file);
//             }

//         }
//     }
//     closedir($dir_handle);
//     rmdir($dirname);
//     return true;
// }

/*
function xoops_module_update_模組目錄(&$module, $old_version) {
GLOBAL $xoopsDB;

//if(!chk_chk1()) go_update1();

return true;
}

//檢查某欄位是否存在
function chk_chk1(){
global $xoopsDB;
$sql="select count(`欄位`) from ".$xoopsDB->prefix("資料表");
$result=$xoopsDB->query($sql);
if(empty($result)) return false;
return true;
}

//執行更新
function go_update1(){
global $xoopsDB;
$sql="ALTER TABLE ".$xoopsDB->prefix("資料表")." ADD `欄位` smallint(5) NOT NULL";
$xoopsDB->queryF($sql) or redirect_header(XOOPS_URL,3,  mysql_error());

return true;
}

//建立目錄
function mk_dir($dir=""){
//若無目錄名稱秀出警告訊息
if(empty($dir))return;
//若目錄不存在的話建立目錄
if (!is_dir($dir)) {
umask(000);
//若建立失敗秀出警告訊息
mkdir($dir, 0777);
}
}

//拷貝目錄
function full_copy( $source="", $target=""){
if ( is_dir( $source ) ){
@mkdir( $target );
$d = dir( $source );
while ( FALSE !== ( $entry = $d->read() ) ){
if ( $entry == '.' || $entry == '..' ){
continue;
}

$Entry = $source . '/' . $entry;
if ( is_dir( $Entry ) )    {
full_copy( $Entry, $target . '/' . $entry );
continue;
}
copy( $Entry, $target . '/' . $entry );
}
$d->close();
}else{
copy( $source, $target );
}
}

function rename_win($oldfile,$newfile) {
if (!rename($oldfile,$newfile)) {
if (copy ($oldfile,$newfile)) {
unlink($oldfile);
return TRUE;
}
return FALSE;
}
return TRUE;
}

function delete_directory($dirname) {
if (is_dir($dirname))
$dir_handle = opendir($dirname);
if (!$dir_handle)
return false;
while($file = readdir($dir_handle)) {
if ($file != "." && $file != "..") {
if (!is_dir($dirname."/".$file))
unlink($dirname."/".$file);
else
delete_directory($dirname.'/'.$file);
}
}
closedir($dir_handle);
rmdir($dirname);
return true;
}

 */
