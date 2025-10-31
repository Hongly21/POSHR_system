<?php
require '../../Config/conect.php';
require_once __DIR__ . '/exportExcel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header row
$sheet->setCellValue('A1', 'Career');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'Name');
$sheet->setCellValue('D1', 'Position');
$sheet->setCellValue('E1', 'Department');
$sheet->setCellValue('F1', 'Effective Date');
$sheet->setCellValue('G1', 'Resignation Date');
$sheet->setCellValue('H1', 'Remark');
$sheet->setCellValue('I1', 'Increase');

$sql = "SELECT P.Description AS PositionDes, D.Description AS Dept, ch.*, sp.EmpName
        FROM careerhistory ch
        INNER JOIN hrstaffprofile sp ON ch.EmployeeID = sp.EmpCode
        INNER JOIN hrposition P ON P.Code = ch.PositionTitle
        INNER JOIN hrdepartment D ON D.Code = ch.Department
        ORDER BY ch.CreatedAt DESC";

$result = $con->query($sql);
$rowIndex = 2;

while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A$rowIndex", $row['CareerHistoryType']);
    $sheet->setCellValue("B$rowIndex", $row['EmployeeID']);
    $sheet->setCellValue("C$rowIndex", $row['EmpName']);
    $sheet->setCellValue("D$rowIndex", $row['PositionDes']);
    $sheet->setCellValue("E$rowIndex", $row['Dept']);
    $sheet->setCellValue("F$rowIndex", $row['StartDate']);
    $sheet->setCellValue("G$rowIndex", $row['EndDate']);
    $sheet->setCellValue("H$rowIndex", $row['Remark']);
    $sheet->setCellValue("I$rowIndex", $row['Increase']);
    $rowIndex++;
}

// Output to browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="CareerHistory.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
