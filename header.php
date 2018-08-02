<?php
//載入XOOPS主設定檔（必要）
include_once "../../mainfile.php";
//載入自訂的共同函數檔
include_once "function.php";
if ($xoopsUser) {
    //判斷是否對該模組有管理權限（通常就是站長了）
    if (!isset($_SESSION['is_kw_club_Admin'])) {
        $_SESSION['is_kw_club_Admin'] = $xoopsUser->isAdmin($xoopsModule->mid());
    }

    //是否為「社團管理」的用戶
    if (!isset($_SESSION['isclubAdmin'])) {
        $_SESSION['isclubAdmin'] = $_SESSION['is_kw_club_Admin'] ? true : isclub(_MD_KWCLUB_ADMIN_GROUP);
    }

    //是否為「社團老師」的用戶
    if (!isset($_SESSION['isclubUser'])) {
        $_SESSION['isclubUser'] = $_SESSION['isclubAdmin'] ? true : isclub(_MD_KWCLUB_TEACHER_GROUP);
    }
} else {
    unset($_SESSION['is_kw_club_Admin']);
    unset($_SESSION['isclubAdmin']);
    unset($_SESSION['isclubUser']);
}

//工具列設定

//回模組首頁

$interface_menu[_MD_KWCLUB_INDEX_MYCLASS] = "index.php?op=myclass";
$interface_icon[_MD_KWCLUB_INDEX_MYCLASS] = "fa-chevron-right";

$interface_menu[_MD_KWCLUB_INDEX_TEACHER] = "index.php?op=teacher";
$interface_icon[_MD_KWCLUB_INDEX_TEACHER] = "fa-chevron-right";

if ($_SESSION['isclubUser']) {
    $interface_menu[_MD_KWCLUB_INDEX_FORM] = "club.php?op=class_form";
    $interface_icon[_MD_KWCLUB_INDEX_FORM] = "fa-chevron-right";

}

if ($_SESSION['isclubAdmin']) {
    $interface_menu[_MD_KWCLUB_REG] = "register.php";
    $interface_icon[_MD_KWCLUB_REG] = "fa-chevron-right";

    $interface_menu[_MD_KWCLUB_SETUP] = "config.php";
    $interface_icon[_MD_KWCLUB_SETUP] = "fa-chevron-right";
}

//模組後台
if ($_SESSION['is_kw_club_Admin']) {
    $interface_menu[_TAD_TO_ADMIN] = "admin/main.php";
    $interface_icon[_TAD_TO_ADMIN] = "fa-chevron-right";
}

if (!isset($_SESSION['club_year']) or empty($_SESSION['club_year'])) {
    get_club_info();
}
