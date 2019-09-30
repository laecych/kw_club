<?php

define('_MB_KWCLUB', 'Club Registration');
define('_MB_KWCLUB_SELECT_YEAR', 'Please select the club period:');

if (isset($_SESSION['isclubAdmin'])) {
    define('_MB_KWCLUB_NEED_CONFIG', 'There is currently no registration period for the community, <a href="config.php?op=kw_club_info_form">Please set up the club registration period</a> first, then add the course!');
} else {
    define('_MB_KWCLUB_NEED_CONFIG', 'There is currently no community period to be registered, please inform the administrator to set the club registration period!');
}

define('_MB_KWCLUB_LIST', 'Club List');
define('_MB_KWCLUB_PAGEBAR_TOTAL', '(Total %s pen)');
define('_MB_KWCLUB_APPLY_DATE', 'Open registration period');
define('_MB_KWCLUB_NON_REGISTRATION_TIME', 'Now non-registration time');
define('_MB_KWCLUB_OVER_END_TIME', 'Stop registration and modification beyond the registration deadline');
define('_MB_KWCLUB_ADD_CLUB', 'Add a community');
define('_MB_KWCLUB_CLASS_TITLE', 'Club Name');
define('_MB_KWCLUB_CLASS_DATE', 'Class Date');
define('_MB_KWCLUB_CLASS_GRADE', 'Enrollee');
define('_MB_KWCLUB_CLASS_MONEY', 'Corporate Tuition');
define('_MB_KWCLUB_CLASS_FEE', 'Additional Fees');
define('_MB_KWCLUB_NUMBER_OF_RECRUITED', 'Enroll');
define('_MB_KWCLUB_NUMBER_OF_APPLICANTS', 'reported');
define('_MB_KWCLUB_AFTER_REGISTRATION', 'Alternate registration...');
define('_MB_KWCLUB_APPLY_FROM_TO', 'From to');
define('_MB_KWCLUB_1_5', '<span class="text_g">one to five</span> per week');
define('_MB_KWCLUB_W', 'every week <span class="text_g">%s</span>');
define('_MB_KWCLUB_DOLLAR', 'yuan');
define('_MB_KWCLUB_PEOPLE', 'People');
define('_MB_KWCLUB_CLASS_ENABLE', 'Starting');
define('_MB_KWCLUB_CLASS_UNABLE', 'Do not start');
define('_MB_KWCLUB_CLASS_ENABLE_DESC', 'The status changes to officially after the button is clicked');
define('_MB_KWCLUB_CLASS_UNABLE_DESC', 'After clicking the button, the status changes to not start');
define('_MB_KWCLUB_CLASS_BLANK', 'Undetermined');
define('_MB_KWCLUB_CLASS_BLANK_DESC', 'After clicking the button, the status changes to blank');
//define('_MB_KWCLUB_OVER_END_TIME', 'Stop registration and modification beyond the registration deadline');
define('_MB_KWCLUB_FULL_REGISTRATION', 'Enrollment is full');
define('_MB_KWCLUB_SIGNUP_TO_MAKE_UP', 'I want to sign up for an alternate');
define('_MB_KWCLUB_SIGNUP', 'I want to sign up');
//define('_MB_KWCLUB_NON_REGISTRATION_TIME', 'Now non-registration time');
define('_MB_KWCLUB_EMPTY_CLUB', 'There has been no new community added in this period!');
