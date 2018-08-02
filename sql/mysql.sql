CREATE TABLE `kw_club_info` (
  `club_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `club_year` tinyint(3) unsigned NOT NULL COMMENT '社團年度',
  `club_start_date` datetime NOT NULL COMMENT '報名起始日',
  `club_end_date` datetime NOT NULL COMMENT '報名終止日',
  `club_isfree` enum('1','0') NOT NULL DEFAULT '0' COMMENT '報名方式',
  `club_backup_num` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '候補人數',
  `club_uid` mediumint(9) unsigned NOT NULL COMMENT '設定者',
  `club_datetime` datetime NOT NULL  COMMENT '設定時間',
  `club_enable` enum('1','0') NOT NULL  DEFAULT '1'  COMMENT '是否啟用',
   PRIMARY KEY (`club_id`),
  UNIQUE KEY `club_year` (`club_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `kw_club_cate` (
  `cate_id` smallint(6) unsigned NOT NULL auto_increment COMMENT '類型編號',
  `cate_title` varchar(255) NOT NULL default '' COMMENT '類型標題',
  `cate_desc` varchar(255) NOT NULL default '' COMMENT '類型說明',
  `cate_sort` smallint(6) unsigned NOT NULL default '0' COMMENT '類型排序',
  `cate_enable` enum('1','0') NOT NULL default '1' COMMENT '狀態',
PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM;

CREATE TABLE `kw_club_place` (
  `place_id` smallint(6) unsigned NOT NULL auto_increment COMMENT '地點編號',
  `place_title` varchar(255) NOT NULL default '' COMMENT '地點標題',
  `place_desc` varchar(255) NOT NULL default '' COMMENT '地點說明',
  `place_sort` smallint(6) unsigned NOT NULL default '0' COMMENT '地點排序',
  `place_enable` enum('1','0') NOT NULL default '1' COMMENT '狀態',
PRIMARY KEY  (`place_id`)
) ENGINE=MyISAM;


CREATE TABLE `kw_club_class` (
  `class_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `club_year` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '社團年度',
  `class_num` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '社團編號',
  `cate_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '社團類型',
  `class_title` varchar(255) NOT NULL DEFAULT '' COMMENT '社團名稱',
  `teacher_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '開課教師',
  `class_week` varchar(255) NOT NULL DEFAULT '0' COMMENT '上課星期',
  `class_date_open` date NOT NULL DEFAULT '0000-00-00' COMMENT '上課起始日',
  `class_date_close` date NOT NULL DEFAULT '0000-00-00' COMMENT '上課終止日',
  `class_time_start` time NOT NULL DEFAULT '00:00:00' COMMENT '起始時間',
  `class_time_end` time NOT NULL DEFAULT '00:00:00' COMMENT '終止時間',
  `place_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '上課地點',
  `class_grade` varchar(255) NOT NULL DEFAULT '' COMMENT '招收對象',
  `class_member` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '招收人數',
  `class_money` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '社團學費',
  `class_fee` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '額外費用',
  `class_regnum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '報名人數',
  `class_note` varchar(255) NOT NULL COMMENT '社團備註',
  `class_ischecked` enum('1','0') NOT NULL COMMENT '是否開班',
  `class_isopen` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否啟用',
  `class_desc` text NOT NULL COMMENT '社團簡介',
  `class_uid` mediumint(9) unsigned NOT NULL COMMENT '發佈者',
  `class_datetime` datetime NOT NULL COMMENT '發佈時間',
  `class_ip` varchar(255) NOT NULL COMMENT '發佈ip',
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `club_year_class_num` (`club_year`,`class_num`)
) ENGINE=MyISAM;



CREATE TABLE `kw_club_reg` (
  `reg_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '報名編號',
  `reg_uid` varchar(255) NOT NULL COMMENT '報名者編號',
  `class_id` smallint(6) unsigned NOT NULL  COMMENT '課程編號',
  `reg_name` varchar(255) NOT NULL  COMMENT '報名者姓名',
  `reg_grade` varchar(255) NOT NULL COMMENT '報名者年級',
  `reg_class` varchar(255) NOT NULL COMMENT '報名者班級',
  `reg_datetime` datetime NOT NULL COMMENT '報名日期',
  `reg_isreg` enum('正取','備取') NOT NULL  DEFAULT '正取' COMMENT '是否後補',
  `reg_isfee` enum('1','0') NOT NULL  DEFAULT '0' COMMENT '是否繳費',
  `reg_ip` varchar(255) NOT NULL default '' COMMENT '報名ip',
PRIMARY KEY (`reg_sn`),
UNIQUE KEY `class_id_reg_uid` (`class_id`,`reg_uid`)
) ENGINE=MyISAM;

CREATE TABLE `kw_club_files_center` (
  `files_sn` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
  `col_name` varchar(255) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` smallint(6) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `sort` smallint(6) unsigned NOT NULL default 0 COMMENT '排序',
  `kind` enum('img','file') NOT NULL default 'img' COMMENT '檔案種類',
  `file_name` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `file_type` varchar(255) NOT NULL default '' COMMENT '檔案類型',
  `file_size` int(10) unsigned NOT NULL default 0 COMMENT '檔案大小',
  `description` text NOT NULL COMMENT '檔案說明',
  `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '下載人次',
  `original_filename` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `hash_filename` varchar(255) NOT NULL default '' COMMENT '加密檔案名稱',
  `sub_dir` varchar(255) NOT NULL default '' COMMENT '檔案子路徑',
  PRIMARY KEY (`files_sn`)
) ENGINE=MyISAM;

