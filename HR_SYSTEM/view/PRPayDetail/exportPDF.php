<?php
require '../../Config/conect.php';
require_once '../CareerHistory/exportPDF/vendor/autoload.php';
include('../../root/Header.php');

use Mpdf\Mpdf;

$empcode = $_GET['empCode'] ?? '';
$month = $_GET['month'] ?? '';

if (empty($empcode) || empty($month)) {
    die('
    <script>

    alert("Please provide both Employee Code and Month.");
    window.close();
    </script>');
}

// Fetch employee info
$sql = "SELECT hrstaffprofile.*, 
        hrcompany.Description as CompanyName,
        hrdepartment.Description as DepartmentName,
        hrposition.Description as PositionName
        FROM hrstaffprofile
        LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
        LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
        LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
        WHERE hrstaffprofile.EmpCode = '$empcode'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$empName = $row['EmpName'];
$department = $row['DepartmentName'];
$position = $row['PositionName'];
$company = $row['CompanyName'];

// Fetch salary info
$sql1 = "SELECT * FROM hisgensalary WHERE EmpCode = '$empcode' AND InMonth = '$month'";
$result1 = $con->query($sql1);
$row1 = $result1->fetch_assoc();

$salary = $row1['Salary'];
$allowance = $row1['Allowance'];
$Ot = $row1['OT'];
$bonus = $row1['Bonus'];
$Ded = $row1['Dedction'];
$leavetax = $row1['Family'];
$NSSF = $row1['NSSF'];
$NetSalary = $row1['NetSalary'];


$html = '
<style>
    body { font-family: sans-serif; font-size: 12pt; }
    .header { text-align: center; margin-bottom: 20px; }
    .header img { width: 80px; height: 80px; border-radius: 50%; }
    .info { margin-bottom: 20px; }
    .info p { margin: 4px 0; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; }
    th { background-color: #f0f0f0; }
    .total { font-weight: bold; background-color: #f9f9f9; }
    .netpay { text-align: right; font-size: 14pt; font-weight: bold; color: #27ae60; }
    #companyLogo{
    width: 80px;
    height: 80px;
    border-radius: 50%;
    }
</style>

<div class="header">
    <img id="companyLogo" src="2.png" alt="Company Logo">
    <h2>Salary Invoice</h2>
    <h4>' . htmlspecialchars($company) . '</h4>
    <p>Month: ' . htmlspecialchars($month) . '</p>
</div>

<div class="info">
    <p><strong>Employee Code:</strong> ' . htmlspecialchars($empcode) . '</p>
    <p><strong>Employee Name:</strong> ' . htmlspecialchars($empName) . '</p>
    <p><strong>Department:</strong> ' . htmlspecialchars($department) . '</p>
    <p><strong>Position:</strong> ' . htmlspecialchars($position) . '</p>
</div>

<table>
    <thead>
        <tr><th>Component</th><th>Description</th><th>Amount ($)</th></tr>
    </thead>
    <tbody>
        <tr><td>Basic Salary</td><td>Monthly Basic Salary</td><td>' . $salary . '</td></tr>
        <tr><td>Allowance</td><td>Additional Benefits</td><td>' . $allowance . '</td></tr>
        <tr><td>OT</td><td>Overtime</td><td>' . $Ot . '</td></tr>
        <tr><td>Bonus</td><td>Performance Bonus</td><td>' . $bonus . '</td></tr>
        <tr><td>Deduction</td><td>Total Deductions</td><td>' . $Ded . '</td></tr>
        <tr><td>Tax</td><td>Income Tax</td><td>' . $leavetax . '</td></tr>
        <tr><td>NSSF</td><td>Social Security</td><td>' . $NSSF . '</td></tr>
    </tbody>
    <tfoot>
        <tr class="total"><td colspan="2">Total Net Pay</td><td>$' . $NetSalary . '</td></tr>
    </tfoot>
</table>

<div class="netpay">Net Pay: $' . $NetSalary . '</div>
';


$mpdf = new Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('SalaryInvoice_' . $empcode . '_' . $month . '.pdf', 'D');
