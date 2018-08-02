<?php
include_once "header.php";
require_once TADTOOLS_PATH . '/PHPExcel.php'; //引入 PHPExcel 物件庫
require_once TADTOOLS_PATH . '/PHPExcel/IOFactory.php'; //引入 PHPExcel_IOFactory 物件庫
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$club_year      = system_CleanVars($_REQUEST, 'club_year', '', 'int');
$club_year_text = club_year_to_text($club_year);

$objPHPExcel = new PHPExcel(); //實體化Excel

//----------內容-----------//
$objPHPExcel->setActiveSheetIndex(0); //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle($club_year_text); //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改
$objPHPExcel->getDefaultStyle()->getFont()->setName('Microsoft JhengHei')->setSize(12);

$i = 1;
$objActSheet->mergeCells("A{$i}:J{$i}")->setCellValue("A1", $club_year_text . _MD_KWCLUB_APPLY_EXCEL);

$objActSheet->getStyle('A:J')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER) //垂直置中
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
$objActSheet->getStyle('D:E')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //水平靠右
$objActSheet->getStyle('C')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //水平靠左

$i++;
$objActSheet->setCellValue("A{$i}", _MD_KWCLUB_REG_SN);
$objActSheet->setCellValue("B{$i}", _MD_KWCLUB_CLASS_YEAR);
$objActSheet->setCellValue("C{$i}", _MD_KWCLUB_CLASS_TITLE);
$objActSheet->setCellValue("D{$i}", _MD_KWCLUB_CLASS_MONEY);
$objActSheet->setCellValue("E{$i}", _MD_KWCLUB_CLASS_FEE);
$objActSheet->setCellValue("F{$i}", _MD_KWCLUB_REG_UID);
$objActSheet->setCellValue("G{$i}", _MD_KWCLUB_REG_NAME);
$objActSheet->setCellValue("H{$i}", _MD_KWCLUB_GRADE);
$objActSheet->setCellValue("I{$i}", _MD_KWCLUB_REG_CLASS);
$objActSheet->setCellValue("J{$i}", _MD_KWCLUB_REG_DATETIME);

$objActSheet->getStyle('A1:J1')->getFont()->setBold(true)->getColor()->setARGB('00FFFFFF');
$objActSheet->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00474747');

$objActSheet->getColumnDimension('A')->setWidth(8);
$objActSheet->getColumnDimension('B')->setWidth(20);
$objActSheet->getColumnDimension('C')->setWidth(40);
$objActSheet->getColumnDimension('D')->setWidth(8);
$objActSheet->getColumnDimension('E')->setWidth(8);
$objActSheet->getColumnDimension('F')->setWidth(15);
$objActSheet->getColumnDimension('G')->setWidth(10);
$objActSheet->getColumnDimension('H')->setWidth(8);
$objActSheet->getColumnDimension('I')->setWidth(6);
$objActSheet->getColumnDimension('J')->setWidth(20);

$i++;

$sql = "select a.`reg_sn`,b.`club_year`,b.`class_title`,b.`class_money`,b.`class_fee`,a.`reg_uid`,a.`reg_name`,a.`reg_grade`,a.`reg_class`,a.`reg_datetime` from `" . $xoopsDB->prefix("kw_club_reg") . "` as a
join `" . $xoopsDB->prefix("kw_club_class") . "` as b on a.`class_id` = b.`class_id`
join `" . $xoopsDB->prefix("kw_club_info") . "` as c on b.`club_year` = c.`club_year`
where b.`club_year`={$club_year} ORDER BY a.`reg_grade` DESC , a.`reg_class` ";

$result = $xoopsDB->query($sql) or die($sql);
while ($club_reg = $xoopsDB->fetchRow($result)) {
    $club_reg[1] = $club_year_text;
    if ($club_reg[7] == _MD_KWCLUB_KG) {
        $club_reg[7] = _MD_KWCLUB_KINDERGARTEN;
    } else {
        $club_reg[7] = $club_reg[7] . _MD_KWCLUB_G;
    }
    foreach ($club_reg as $key => $val) {
        // if ($key == 'club_year') {
        //     $val = $club_year_text;
        // }
        $objActSheet->setCellValueByColumnAndRow($key, $i, $val);
    }

    $objActSheet->getRowDimension($i)->setRowHeight(20);
    $i++;
}
$n = $i - 1;
$objActSheet->setCellValue("A{$i}", _MD_KWCLUB_TOTAL);
$objActSheet->setCellValue("B{$i}", "=count(A3:A{$n})");
$objActSheet->setCellValue("C{$i}", _MD_KWCLUB_REGISTER_DATA);

$objActSheet->getStyle("A1:J{$n}")->getBorders()->getAllborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setRGB('000000');

$objActSheet->getProtection()->setSheet(true);
$objActSheet->getProtection()->setSort(true);
$objActSheet->getProtection()->setInsertRows(true);
$objActSheet->getProtection()->setFormatCells(true);
$objActSheet->getProtection()->setPassword('1234');

$title = iconv('UTF-8', 'Big5', $club_year_text . _MD_KWCLUB_APPLY_EXCEL);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $title . '.xls');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;
