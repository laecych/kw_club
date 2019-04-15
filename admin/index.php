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
require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require __DIR__ . '/header.php';

$adminObject = \Xmf\Module\Admin::getInstance();

$adminObject->displayNavigation('index.php');
$adminObject->displayIndex();

require __DIR__ . '/footer.php';
xoops_cp_footer();
