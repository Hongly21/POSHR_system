<?php
require '../../Config/conect.php';
require_once '../CareerHistory/exportExcel/vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header row
$sheet->setCellValue('A1', 'Code');
$sheet->setCellValue('B1', 'EmpName');
$sheet->setCellValue('C1', 'Company');
$sheet->setCellValue('D1', 'Position');
$sheet->setCellValue('E1', 'Department');
$sheet->setCellValue('F1', 'Division');
$sheet->setCellValue('G1', 'StartDate');
$sheet->setCellValue('H1', 'Status');
$sheet->setCellValue('I1', 'Contact');

$sql = "SELECT hrstaffprofile.*, 
        hrcompany.Description as CompanyName,
        hrdepartment.Description as DepartmentName,
        hrdivision.Description as DivisionName,
        hrposition.Description as PositionName
        FROM hrstaffprofile
        LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
        LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
        LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
        LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
        ORDER BY EmpCode DESC";

$result = $con->query($sql);
$rowIndex = 2;

while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A$rowIndex", $row['EmpCode']);
    $sheet->setCellValue("B$rowIndex", $row['EmpName']);
    $sheet->setCellValue("C$rowIndex", $row['CompanyName']);
    $sheet->setCellValue("D$rowIndex", $row['PositionName']);
    $sheet->setCellValue("E$rowIndex", $row['DepartmentName']);
    $sheet->setCellValue("F$rowIndex", $row['DivisionName']);
    $sheet->setCellValue("G$rowIndex", $row['StartDate']);
    $sheet->setCellValue("H$rowIndex", $row['Status']);
    $sheet->setCellValue("I$rowIndex", $row['Contact']);
    $rowIndex++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="StaffList.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
