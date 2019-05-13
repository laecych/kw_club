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

use XoopsModules\Kw_club;

include dirname(__DIR__) . '/preloads/autoloader.php';

require  dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
//require  dirname(__DIR__) . '/include/common.php';

/** @var Kw_club\Helper $helper */
$helper = Kw_club\Helper::getInstance();

/** @var \Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

require_once XOOPS_ROOT_PATH . '/header.php';

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');
$helper->loadLanguage('main');

if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}





//xoops_cp_header();
//global $xoTheme;
// Define Stylesheet and JScript
//$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . 'assets/css/admin.css');
//$xoTheme->addScript("browse.php?Frameworks/jquery/jquery.js");
//$xoTheme->addScript("browse.php?modules/" . $xoopsModule->getVar("dirname") . "/js/admin.js");
