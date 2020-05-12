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

//
// use XoopsModules\Kw_club;
// use XoopsModules\Kw_club\Common;

require __DIR__ . '/admin_header.php';

xoops_cp_header();
$adminObject        = \Xmf\Module\Admin::getInstance();
$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

//check or upload folders
// $configurator = new Configurator();
// $utility      = new Utility();
// foreach (array_keys($configurator->uploadFolders) as $i) {
//     $utility::createFolder($configurator->uploadFolders[$i]);
//     $adminObject->addConfigBoxLine($configurator->uploadFolders[$i], 'folder');
// }

$adminObject->displayNavigation(basename(__FILE__));

// //check for latest release
// $newRelease = $utility::checkVerModule($helper);
// if (!empty($newRelease)) {
//     $adminObject->addItemButton($newRelease[0], $newRelease[1], 'download', 'style="color : Red"');
// }

// //------------- Test Data ----------------------------
// if ($helper->getConfig('displaySampleButton')) {
//     xoops_loadLanguage('admin/modulesadmin', 'system');
//     require  dirname(__DIR__) . '/testdata/index.php';
//     $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');
//     $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');
//     //    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');

//     $adminObject->displayButton('left', '');
// }
// //------------- End Test Data ----------------------------

$adminObject->displayIndex();

// echo $utility::getServerStats();

require __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
