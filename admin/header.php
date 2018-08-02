<?php
/**
 * 模組名稱 module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright    The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package      模組名稱
 * @since        2.5.7
 * @author       作者
 * @version      $Id $
 **/

include '../../../include/cp_header.php';

defined('FRAMEWORKS_ART_FUNCTIONS_INI') || include_once XOOPS_ROOT_PATH . '/Frameworks/art/functions.ini.php';
include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/class/admin.php";

load_functions('admin');

if (!@include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/language/" . $xoopsConfig['language'] . "/main.php") {
    include_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/language/english/admin.php";
}
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    include_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new XoopsTpl();
}

xoops_cp_header();

// Define Stylesheet and JScript
$xoTheme->addStylesheet(XOOPS_URL . "/modules/" . $xoopsModule->getVar('dirname') . "/css/admin.css");
//$xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
//$xoTheme->addScript("browse.php?modules/" . $xoopsModule->getVar("dirname") . "/js/admin.js");
