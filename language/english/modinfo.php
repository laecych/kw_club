<?php
// if (!isset($_SESSION['language']) && empty($_REQUEST['language'])) {
//     $_SESSION['language'] = "tchinese_utf8";
// } else if (isset($_SESSION['language']) && !empty($_REQUEST['language'])) {
//     $_SESSION['language'] = $_REQUEST['language'];
// }

// if ($_SESSION['language'] == "english") {
//     require_once "../../modules/kw_club/language/english/modinfo.php";
// }
//require_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$_SESSION['language']}/modinfo.php";

// require_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/modinfo.php";

xoops_loadLanguage('modinfo_common', 'tadtools');

define('_MI_KWCLUB_NAME', 'Club Registration System');
define('_MI_KWCLUB_AUTHOR', 'Club Registration System');
define('_MI_KWCLUB_CREDITS', '');
define('_MI_KWCLUB_DESC', 'Club Registration System');
define('_MI_KWCLUB_AUTHOR_WEB', 'https://github.com/laecych');

//define('_MI_KWCLUB_NAME', 'Club Registration System');
//define('_MI_KWCLUB_AUTHOR', 'Club Registration System');
//define('_MI_KWCLUB_CREDITS', '');
//define('_MI_KWCLUB_DESC', 'National Small Community Registration System');
//define('_MI_KWCLUB_AUTHOR_WEB', 'https://github.com/laecych');

define('_MI_KWCLUB_SMNAME2', 'Teacher Profile');
define('_MI_KWCLUB_SMNAME3', 'My Club');
define('_MI_KWCLUB_SMNAME4', 'Registration Statistics');

define('_MI_KW_CLUB_SHOW_BLOCK_NAME', 'Club Registration System Block');
define('_MI_KW_CLUB_SHOW_BLOCK_DESC', 'Club Registration System Block Block (kw_club_show)');

define('_MI_KWCLUB_ADMIN_GROUP', 'Club Management');
define('_MI_KWCLUB_TEACHER_GROUP', 'Social Teacher');
define('_MI_KWCLUB_GROUP_NOTE', ': For community registration module, do not delete, do not modify ');
define('_MI_KWCLUB_SETUP_ADMIN', 'Management');
define('_MI_KWCLUB_SETUP_TEACHER', 'Club teacher setting');
define('_MI_KWCLUB_SCHOOL_GRADE', 'Set up grade');
define('_MI_KWCLUB_SCHOOL_GRADE_DESC', 'Set the grade that the school can register');
define('_MI_KWCLUB_SCHOOL_GK0', 'Kindergarten');
define('_MI_KWCLUB_SCHOOL_GK1', 'Grade 1');
define('_MI_KWCLUB_SCHOOL_GK2', 'Grade 2');
define('_MI_KWCLUB_SCHOOL_GK3', 'Grade 3');
define('_MI_KWCLUB_SCHOOL_GK4', 'Grade 4');
define('_MI_KWCLUB_SCHOOL_GK5', 'Grade 5');
define('_MI_KWCLUB_SCHOOL_GK6', 'Grade 6');
define('_MI_KWCLUB_SCHOOL_GK7', 'Grade 7');
define('_MI_KWCLUB_SCHOOL_GK8', 'Grade 8');
define('_MI_KWCLUB_SCHOOL_GK9', 'Grade 9');
define('_MI_KWCLUB_SCHOOL_GK10', 'Grade 10');
define('_MI_KWCLUB_SCHOOL_GK11', 'Grade 11');
define('_MI_KWCLUB_SCHOOL_GK12', 'Grade 12');

define('_MI_KWCLUB_SCHOOL_GV0', 'kid');
define('_MI_KWCLUB_SCHOOL_GV1', '1');
define('_MI_KWCLUB_SCHOOL_GV2', '2');
define('_MI_KWCLUB_SCHOOL_GV3', '3');
define('_MI_KWCLUB_SCHOOL_GV4', '4');
define('_MI_KWCLUB_SCHOOL_GV5', '5');
define('_MI_KWCLUB_SCHOOL_GV6', '6');
define('_MI_KWCLUB_SCHOOL_GV7', '7');
define('_MI_KWCLUB_SCHOOL_GV8', '8');
define('_MI_KWCLUB_SCHOOL_GV9', '9');
define('_MI_KWCLUB_SCHOOL_GV10', '10');
define('_MI_KWCLUB_SCHOOL_GV11', '11');
define('_MI_KWCLUB_SCHOOL_GV12', '12');

define('_MI_KWCLUB_SCHOOL_CLASS', 'Set up class');
define('_MI_KWCLUB_SCHOOL_CLASS_DESC', 'Set the class name that the school can register (please use ; separate)');
define('_MI_KWCLUB_SCHOOL_CLASS_DEFAULT', 'class 1;class 2;class 3;class 4');
