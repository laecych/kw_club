<?php

// if (!isset($_SESSION['language']) && empty($_REQUEST['language'])) {
//     $_SESSION['language'] = "tchinese_utf8";
// } else if (isset($_SESSION['language']) && !empty($_REQUEST['language'])) {
//     $_SESSION['language'] = $_REQUEST['language'];
// }

// if ($_SESSION['language'] == "english") {
//     include_once "../../modules/kw_club/language/english/main.php";
// }

//include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$_SESSION['language']}/main.php";
//前後台語系
// define('_MD_KWCLUB_CLASS_ID', '社團ID');

define('_MD_KWCLUB_CLASS_YEAR', 'Club Period');
define('_MD_KWCLUB_CLASS_TITLE', 'Class Name');
define('_MD_KWCLUB_CLASS_NUM', 'Class Number');
define('_MD_KWCLUB_CATE_ID', 'Class Type');
define('_MD_KWCLUB_TEACHER_ID', 'Teacher ID');
define('_MD_KWCLUB_TEACHER_NAME', 'Teacher Name');
define('_MD_KWCLUB_TEACHER_EMAIL', 'Teacher Email');
define('_MD_KWCLUB_CLASS_WEEK', 'Class Week');
define('_MD_KWCLUB_CLASS_GRADE', 'Grade');
define('_MD_KWCLUB_CLASS_DATE', 'Date');
define('_MD_KWCLUB_CLASS_TIME', 'Time');
define('_MD_KWCLUB_CLASS_DATE_OPEN', 'Class start date');
define('_MD_KWCLUB_CLASS_DATE_CLOSE', 'Class termination date');
define('_MD_KWCLUB_CLASS_TIME_START', 'Class start time');
define('_MD_KWCLUB_CLASS_TIME_END', 'Class termination time');
define('_MD_KWCLUB_PLACE_ID', 'Location');
define('_MD_KWCLUB_CLASS_MENBER', 'Member');
define('_MD_KWCLUB_CLASS_MONEY', 'Club tuition');
define('_MD_KWCLUB_CLASS_FEE', 'Additional charges');
define('_MD_KWCLUB_CLASS_NOTE', 'Remarks');
define('_MD_KWCLUB_CLASS_REGNUM', 'Number of applicants');
define('_MD_KWCLUB_CLASS_REGNUM_FULL', 'Applicants is full！');
define('_MD_KWCLUB_CLASS_REG', 'Apply');
define('_MD_KWCLUB_CLASS_DATE_START', 'Registration start');
define('_MD_KWCLUB_CLASS_DATE_END', 'Registration Termination');
define('_MD_KWCLUB_CLASS_ISOPEN', 'Active');
define('_MD_KWCLUB_CLASS_ISCHECKED', 'Confirm');
define('_MD_KWCLUB_CLASS_DESC', 'Club introduce');
define('_MD_KWCLUB_CLASS_UID', 'UID');
define('_MD_KWCLUB_DOLLAR', 'TWD');
define('_MD_KWCLUB_PEOPLE', 'Person');
define('_MD_KWCLUB_COPY', 'Copy Club');

//前台選單
define('_MD_KWCLUB_INDEX_MYCLASS', 'My Classes');
define('_MD_KWCLUB_INDEX_TEACHER', 'Teacher profile');
define('_MD_KWCLUB_INDEX_FORM', 'Add class');
define('_MD_KWCLUB_REG', 'Result');

//教師列表
define('_MD_KWCLUB_CATEID', 'ID');
define('_MD_KWCLUB_CATE_TITLE', 'Name');
define('_MD_KWCLUB_CATE_DESC', 'Introduce');
define('_MD_KWCLUB_CATE_SORT', 'Sort');
define('_MD_KWCLUB_CATE_ENABLE', 'Status');

define('_MD_KWCLUB_REG_YEAR', 'Club Period');
define('_MD_KWCLUB_REG_NAME', ' Student Name');
define('_MD_KWCLUB_REG_GRADE', 'Grade');
define('_MD_KWCLUB_REG_CLASS', 'Class');
define('_MD_KWCLUB_REG_SN', 'Register SN');
define('_MD_KWCLUB_REG_UID', 'Taiwanese ID or ARC');
define('_MD_KWCLUB_REG_DATETIME', 'Date');
define('_MD_KWCLUB_REG_ISREG', 'Result');
define('_MD_KWCLUB_REG_ISFEE', 'Paid');
define('_MD_KWCLUB_REG_IP', 'IP');

define('_MD_KWCLUB_NEED_CONFIG', 'There is no clubs now!');
//by tad
if ($_SESSION['isclubAdmin']) {
define('_MD_KWCLUB_NEED_CONFIG', 'There is currently no registration period for the community, <a href="config.php?op=kw_club_info_form">Please set up the club registration period</a> first, then add the course!');
} else {
define('_MD_KWCLUB_NEED_CONFIG', 'There is currently no community period to be registered, please inform the administrator to set the club registration period!');
}
define('_MD_KWCLUB_SELECT_YEAR', 'Please choose the period of the club：');
define('_MD_KWCLUB_EMPTY_YEAR', 'There is no clubs period');
define('_MD_KWCLUB', 'Registration');
define('_MD_KWCLUB_LIST', 'List');
define('_MD_KWCLUB_APPLY_DATE', 'Registration period');
define('_MD_KWCLUB_APPLY_FROM_TO', 'To');
define('_MD_KWCLUB_EMPTY_CLUB', 'There is no class clubs！');
define('_MD_KWCLUB_FORBBIDEN', 'Error! No Permission');
define('_MD_KWCLUB_INFO_SETUP', 'Set up Registeration');
define('_MD_KWCLUB_YEAR', 'Club period');
define('_MD_KWCLUB_NOW_YEAR', 'Club period is：');
define('_MD_KWCLUB_ADMIN', 'Club period setting');
define('_MD_KWCLUB_BACKUP_NUM', 'Number of waiting list');
define('_MD_KWCLUB_STATISTICS', 'Statistics');
define('_MD_KWCLUB_ADD_CLUB', 'Club Add');
define('_MD_KWCLUB_ADD_CLUB_INFO', 'Add club period');
define('_MD_KWCLUB_NEED_CLUB_YEAR', 'Error！unknow club period');
define('_MD_KWCLUB_START_DATE', 'Registration start date');
define('_MD_KWCLUB_END_DATE', 'Registration end date');
define('_MD_KWCLUB_ISFREE', 'Registration type');
define('_MD_KWCLUB_UID', 'author');
define('_MD_KWCLUB_DATETIME', 'Time seting');
define('_MD_KWCLUB_ENABLE', 'is active');
define('_MD_KWCLUB_ENABLE_1', 'active');
define('_MD_KWCLUB_ENABLE_0', 'close');

define('_MD_KWCLUB_ID', 'number');
define('_MD_KWCLUB_Y', 'period');
define('_MD_KWCLUB_CLUB', 'club');
define('_MD_KWCLUB_PICK_CLUB', 'pick up club');
define('_MD_KWCLUB_ADD_CLASS', 'Add class');
define('_MD_KWCLUB_MODIFY_CLUB', 'edit class');

define('_MD_KWCLUB_SELECT', 'Please choose');
define('_MD_KWCLUB_SETUP', 'Set up');

define('_MD_KWCLUB_PLACE_TITLE', 'place');
define('_MD_KWCLUB_PLACE_DESC', 'describe');
define('_MD_KWCLUB_PLACE_SORT', 'order');
define('_MD_KWCLUB_PLACE_ENABLE', 'status');

define('_MD_KWCLUB_TEACHER_TITLE', 'Teacher');
define('_MD_KWCLUB_TEACHER_DESCS', 'Introduce');
define('_MD_KWCLUB_TEACHER_SORT', 'order');
define('_MD_KWCLUB_TEACHER_ENABLE', 'status');
define('_MD_KWCLUB_TEACHER_TITLE', 'Social Teacher');
define('_MD_KWCLUB_TEACHER_DESCS', 'Teacher Profile');
define('_MD_KWCLUB_TEACHER_SORT', 'Sort');
define('_MD_KWCLUB_TEACHER_ENABLE', 'Status');

define('_MD_KWCLUB_ADMIN_GROUP', 'Society Management');
define('_MD_KWCLUB_TEACHER_GROUP', 'Social Teacher');
define('_MD_KWCLUB_GROUP_NOTE', ': for community registration module, do not delete, do not modify ');

define('_MD_KWCLUB_SETUP_TEACHER', 'Society teacher setting');
define('_MD_KWCLUB_SORTBY_REG_NAME', 'order by name');
define('_MD_KWCLUB_SORTBY_REG_DATETIME', 'order by register');
define('_MD_KWCLUB_SORTBY_CLASS_TITLE', 'order by class name');
define('_MD_KWCLUB_SORTBY_REG_GRADE', 'order by grade');

define('_MD_KWCLUB_TODAY', 'Today');
define('_MD_KWCLUB_IS_BACKUP', 'waiting list');

define('_MD_KWCLUB_PAY_PDF', 'Society Registration Bills');
define('_MD_KWCLUB_TOTAL_PAY', 'Total tuition fee:');
define('_MD_KWCLUB_OTHER_PAY', 'Additional plus:');
define('_MD_KWCLUB_SIGN', 'Sign:');
define('_MD_KWCLUB_PAY_TOTAL', 'Total Contribution Amount');

define('_MD_KWCLUB_NEED_CATE_ID', 'No specified number');
define('_MD_KWCLUB_NEED_CLASS_ID', 'The specified community course number is not available');
define('_MD_KWCLUB_CLASS_SAME_TIME', 'Error!Conflict, please confirm again!');

define('_MD_KWCLUB_OFFICIALLY_ENROLL', 'Enroll');
define('_MD_KWCLUB_CANDIDATE', 'Preserve');
define('_MD_KWCLUB_APPLY_SUCCESS', 'Sucessful!');
define('_MD_KWCLUB_REPEAT_APPLY', 'Error!Repeat!');

define('_MD_KWCLUB_SURE_CANCEL_APPLY', 'Are you sure to cancel?');
define('_MD_KWCLUB_CANCEL', 'Cancel');
define('_MD_KWCLUB_CANCEL_APPLY', 'Yes！');
define('_MD_KWCLUB_DELETE_APPLY', 'Cancel');

define('_MD_KWCLUB_GRADE0', 'Kid');
define('_MD_KWCLUB_GRADE1', '1');
define('_MD_KWCLUB_GRADE2', '2');
define('_MD_KWCLUB_GRADE3', '3');
define('_MD_KWCLUB_GRADE4', '4');
define('_MD_KWCLUB_GRADE5', '5');
define('_MD_KWCLUB_GRADE6', '6');
define('_MD_KWCLUB_GRADE7', '7');
define('_MD_KWCLUB_GRADE8', '8');
define('_MD_KWCLUB_GRADE9', '9');
define('_MD_KWCLUB_GRADE10', '10');
define('_MD_KWCLUB_GRADE11', '11');
define('_MD_KWCLUB_GRADE12', '12');

define('_MD_KWCLUB_YEAR_TEXT_00', 'Summer vacation');
define('_MD_KWCLUB_YEAR_TEXT_01', 'First semester');
define('_MD_KWCLUB_YEAR_TEXT_11', 'Winter holiday');
define('_MD_KWCLUB_YEAR_TEXT_02', 'Second semester');

define('_MD_KWCLUB_KINDERGARTEN', 'kindergarten');
define('_MD_KWCLUB_KG', 'kid');

define('_MD_KWCLUB_GRADE', 'Grade');
define('_MD_KWCLUB_G', 'Year');
define('_MD_KWCLUB_CLASS', 'Class');
define('_MD_KWCLUB_CLICK_TO_EDIT', 'click to edit');
define('_MD_KWCLUB_CLICK_TO_EDIT_DESC', 'There is a <span class="editable">blue bottom line</span> in the above table, you can directly click Edit to modify ');
define('_MD_KWCLUB_CLICK_BIO_TO_EDIT_DESC', 'Administrator can click on the introduction to modify directly');

define('_MD_KWCLUB_APPLY_EXCEL', 'Society Registration Statistics Table');
define('_MD_KWCLUB_TOTAL', 'total');
define('_MD_KWCLUB_REGISTER_DATA', 'Registration');
define('_MD_KWCLUB_REGISTER_LIST', 'Registration list');

define('_MD_KWCLUB_NEED_REG_SN', 'Error! No registration number');
define('_MD_KWCLUB_NOT_REG_TIME', 'Currently not the registration time!<br>The registration period is ');
define('_MD_KWCLUB_SCHOOL_YEAR', 'School Year');

define('_MD_KWCLUB_FREE_APPLY', 'Free registration');
define('_MD_KWCLUB_FREE_APPLY_DESC', '(Do not log in to register)');
define('_MD_KWCLUB_LOGIN_APPLY', 'Login Registration');
define('_MD_KWCLUB_LOGIN_APPLY_DESC', '(The unit roster module must be installed, upload the relevant information of the applicant)');

define('_MD_KWCLUB_W0', 'Sun');
define('_MD_KWCLUB_W1', 'Mon');
define('_MD_KWCLUB_W2', 'Tue');
define('_MD_KWCLUB_W3', 'Wed');
define('_MD_KWCLUB_W4', 'Thu');
define('_MD_KWCLUB_W5', 'Fri');
define('_MD_KWCLUB_W6', 'Sat');
define('_MD_KWCLUB_ALL_WEEK', 'Mon、Tue、Wed、Thu、Fri');
define('_MD_KWCLUB_1_5', 'Every <span class="text_g">Mon to Fri</span>');
define('_MD_KWCLUB_W', 'Every <span class="text_g">%s</span> Time ');
// <{$smarty.const._MD_KWCLUB_W|sprintf:$data.class_week}>
define('_MD_KWCLUB_WEEK', 'Week ');

define('_MD_KWCLUB_NOT_EMPTY_CLASS', 'Warning!! This course has already registered for students and cannot be deleted!');

define('_MD_KWCLUB_ALL_USERS', 'All users');
define('_MD_KWCLUB_PICKED_USERS', 'Selected users');
define('_MD_KWCLUB_SEARCH_KEY', 'Please enter your name, email or account...');
define('_MD_KWCLUB_SEARCH', 'Search');

define('_MD_KWCLUB_NOT_PAY', 'Unpaid');
define('_MD_KWCLUB_PAID', 'Paid');
define('_MD_KWCLUB_CLICK_TO', 'Click to edit：');

define('_MD_KWCLUB_DETIAL', 'Details');
define('_MD_KWCLUB_EMAPY_REGISTER', 'No one signed up during this period！');

define('_MD_KWCLUB_PLACE_SETUP', 'Set up Place');
define('_MD_KWCLUB_PLACE_LIST', 'Place list');
define('_MD_KWCLUB_CLUB_YEAR_LIST', 'Club list');
define('_MD_KWCLUB_CATE_SETUP', 'Set up Type');
define('_MD_KWCLUB_CATE_LIST', 'Type list');

define('_MD_KWCLUB_TEACHER_SETUP', 'Set up Teacher');
define('_MD_KWCLUB_TEACHER_LIST', 'Teacher List');

define('_MD_KWCLUB_SETUP_TEACHER', 'Set up Teacher');

define('_MD_KWCLUB_LIST_MODE', 'List mode');
define('_MD_KWCLUB_EXPORT_PDF', 'PDF');
define('_MD_KWCLUB_PAID_LIST', 'Paid list');
define('_MD_KWCLUB_PAY_MODE', 'Pay mode');
define('_MD_KWCLUB_EXPORT_EXCEL', 'Excel');

define('_MD_KWCLUB_PAGEBAR_TOTAL', '（ %s in total）');
// <{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}>

define('_MD_KWCLUB_APPLY_RESULT', ' Registration result');
define('_MD_KWCLUB_MY_ALL_CLASS', ' Registration list');

define('_MD_KWCLUB_PAY_STATUS', "Total %s TWD，Paid:<span style='color: green'>%s</span> TWD，Unpaid:<span style='color: red'>%s</span> TWD");
// <{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$money:$in_money:$un_money}>

define('_MD_KWCLUB_APPLY_CLASS', 'Sign up「%s」');
// <{$smarty.const._MD_KWCLUB_APPLY_CLASS|sprintf:$class.class_title}>

define('_MD_KWCLUB_APPLY_NOTE', 'Please be sure to fill in the correct information! Otherwise the admission will be cancelled!');

define('_MD_KWCLUB_KEYIN', 'Please fill in');
define('_MD_KWCLUB_CHECK_OK', 'Information is correct and the registration is confirmed!');
define('_MD_KWCLUB_MYCLASS', 'Check out my clubs');

define('_MD_KWCLUB_NOT_FOUND', 'There is no any  %s registrations! )');
// <{$smarty.const._MD_KWCLUB_NOT_FOUND|sprintf:$reg_uid}>

define('_MD_KWCLUB_CLASS_ENABLE', 'OPEN');
define('_MD_KWCLUB_CLASS_UNABLE', 'CLOSE');
define('_MD_KWCLUB_CLASS_UNDONE', 'Not yet registered');
define('_MD_KWCLUB_CLASS_ENABLE_DESC', 'Click to alter the status becomes OPEN');
define('_MD_KWCLUB_CLASS_UNABLE_DESC', 'Click to alter the status becomes Close');
define('_MD_KWCLUB_CLASS_BLANK', 'Undecided');
define('_MD_KWCLUB_CLASS_BLANK_DESC', 'Click to alter the status becomes BLANK');

define('_MD_KWCLUB_FULL_REGISTRATION', 'Full');
define('_MD_KWCLUB_SIGNUP_TO_MAKE_UP', 'Registration candidate');
define('_MD_KWCLUB_SIGNUP', 'Sign up');
define('_MD_KWCLUB_NON_REGISTRATION_TIME', 'Now is not the time to register');
define('_MD_KWCLUB_REGISTERED_LIST', 'Registration list');

define('_MD_KWCLUB_NUMBER_OF_RECRUITED', 'Recruit');
define('_MD_KWCLUB_NUMBER_OF_APPLICANTS', 'Registed');
define('_MD_KWCLUB_FULL', 'Full');
define('_MD_KWCLUB_AFTER_REGISTRATION', 'Alternate registration');
define('_MD_KWCLUB_EDIT_TAECHER_NOTE', 'To change the list of teachers, go to <a href="config.php#setupTab2" target="_blank">social teacher settings</a> page setting');

define('_MD_KWCLUB_EDIT_CATE_NOTE', 'To change the community type, go to <a href="config.php#setupTab3" target="_blank">social type setting</a> page setting');
define('_MD_KWCLUB_EDIT_PLACE_NOTE', 'To modify the class location, please go to <a href="config.php#setupTab4" target="_blank">class setting</a> page setting');

define('_MD_KWCLUB_SIGNUP_STATUS', 'Register at %s, from %s, registration number: %s');
// <{$smarty.const._MD_KWCLUB_SIGNUP_STATUS|sprintf:$data.reg_datetime:$data.reg_ip:$data.reg_sn}>
define('_MD_KWCLUB_OVER_END_TIME', 'Stop the registration deadline or the payment has been stopped and the application is modified');
define('_MD_KWCLUB_SIGNUP_FOR_STU', 'Help students sign up');
define('_MD_KWCLUB_PID_WRONG', 'Invalid');
define('_MD_KWCLUB_GC_WRONG', 'Grage or Class Error');

define('_MD_KWCLUB_TEACHER_CLASS', 'Histroy');
define('_MD_KWCLUB_TXTLOCK', 'Locked');
define('_MD_KWCLUB_TXTUNLOCK', 'Unlocked');
define('_MD_KWCLUB_CAPTCHA_ERROR', 'Error');
define('_MD_KWCLUB_CAPTCHA', 'Verification');

define('_MD_KWCLUB_TEACHER_DESC', "<a href=../../edituser.php?op=avatarform'>Click here to upload photos</a>, <a href='../../edituser.php '> Click here to edit 'Personal Introduction'</a>.");

define('_MD_KWCLUB_REG_PARENT', ' Parent Name');
define('_MD_KWCLUB_REG_TEL', ' Phone Number');
define('_MD_KWCLUB_LANGUAGE', 'English');
