<?php
include_once "header.php";
require_once TADTOOLS_PATH . '/PHPExcel.php'; //引入 PHPExcel 物件庫
require_once TADTOOLS_PATH . '/PHPExcel/IOFactory.php'; //引入 PHPExcel_IOFactory 物件庫
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$year        = system_CleanVars($_REQUEST, 'year', '', 'int');
$objPHPExcel = new PHPExcel(); //實體化Excel

//----------內容-----------//
$objPHPExcel->setActiveSheetIndex(0); //設定預設顯示的工作表
$objActSheet = $objPHPExcel->getActiveSheet(); //指定預設工作表為 $objActSheet
$objActSheet->setTitle("社團報名統計表"); //設定標題
$objPHPExcel->createSheet(); //建立新的工作表，上面那三行再來一次，編號要改
$objPHPExcel->getDefaultStyle()->getFont()->setName('微軟正黑體')->setSize(14);

$i = 1;
$objActSheet->mergeCells("A{$i}:J{$i}")->setCellValue("A1", $year . '社團報名統計表');

$objActSheet->getStyle('A:J')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER) //垂直置中
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
$objActSheet->getStyle('D:E')->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //水平靠左
// $objActSheet->getStyle('F')->getAlignment()
//     ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP) //垂直靠上
//     ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT) //水平靠左
//     ->setWrapText(true); //自動換行

$i++;
$objActSheet->setCellValue("A{$i}", '報名編號');
$objActSheet->setCellValue("B{$i}", '社團年度 ');
$objActSheet->setCellValue("C{$i}", '社團名稱');
$objActSheet->setCellValue("D{$i}", '社團學費');
$objActSheet->setCellValue("E{$i}", '額外費用');
$objActSheet->setCellValue("F{$i}", '身分證字號');
$objActSheet->setCellValue("G{$i}", '姓名');
$objActSheet->setCellValue("H{$i}", '年級');
$objActSheet->setCellValue("I{$i}", '班級');
$objActSheet->setCellValue("J{$i}", '報名日期');

$objActSheet->getStyle('A1:J1')->getFont()->setBold(true)->getColor()->setARGB('00FFFFFF');
$objActSheet->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00474747');

$objActSheet->getColumnDimension('A')->setWidth(8);
$objActSheet->getColumnDimension('B')->setWidth(8);
$objActSheet->getColumnDimension('C')->setWidth(15);
$objActSheet->getColumnDimension('D')->setWidth(8);
$objActSheet->getColumnDimension('E')->setWidth(8);
$objActSheet->getColumnDimension('F')->setWidth(15);
$objActSheet->getColumnDimension('G')->setWidth(10);
$objActSheet->getColumnDimension('H')->setWidth(5);
$objActSheet->getColumnDimension('I')->setWidth(5);
$objActSheet->getColumnDimension('J')->setWidth(20);

$i++;
$tbl    = $xoopsDB->prefix('kw_club_reg');
$sql    = "SELECT `reg_sn`,`reg_year`,`class_title`,`class_money`,`class_fee`,`reg_uid`,`reg_name`,`reg_grade`,`reg_class`,`reg_datetime` FROM `$tbl` WHERE `reg_year`={$year} ORDER BY `reg_grade`, `reg_class` DESC";
$result = $xoopsDB->query($sql) or web_error($sql);
while ($club_reg = $xoopsDB->fetchRow($result)) {

    foreach ($club_reg as $key => $val) {
        $objActSheet->setCellValueByColumnAndRow($key, $i, $val);
    }

    $objActSheet->getRowDimension($i)->setRowHeight(60);
    $i++;
}
$n = $i - 1;
$objActSheet->setCellValue("A{$i}", '共');
$objActSheet->setCellValue("B{$i}", "=count(A3:A{$n})");
$objActSheet->setCellValue("C{$i}", '報名資料');

$objActSheet->getStyle("A1:J{$n}")->getBorders()->getAllborders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setRGB('000000');

$objActSheet->getProtection()->setSheet(true);
$objActSheet->getProtection()->setSort(true);
$objActSheet->getProtection()->setInsertRows(true);
$objActSheet->getProtection()->setFormatCells(true);
$objActSheet->getProtection()->setPassword('1234');

$title = iconv('UTF-8', 'Big5', $year . '社團報名統計表');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $title . '.xls');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->setPreCalculateFormulas(false);
$objWriter->save('php://output');
exit;
