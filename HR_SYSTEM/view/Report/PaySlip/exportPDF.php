<?php
require_once __DIR__ . '/vendor/autoload.php';
include('../../../Config/conect.php');


$month = isset($_GET['month']) ? $_GET['month'] : '';
$empcode = isset($_GET['empcode']) ? $_GET['empcode'] : '';

if (empty($month) || empty($empcode)) {
    echo "
      script>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Please select both employee code and month.',
        showConfirmButton: true
      })
      </script>
    ";
}

$sql = "SELECT 
            s.EmpCode,
            e.EmpName AS EmployeeName,
            d.Description AS DepartmentName,
            p.Description AS PositionName,
            c.Description AS CompanyName,
            s.InMonth,
            s.Salary,
            s.Allowance,
            s.OT,
            s.Bonus,
            s.Dedction,
            s.Grosspay,
            s.UntaxAm,
            s.NSSF,
            s.NetSalary
        FROM hisgensalary s
        LEFT JOIN hrstaffprofile e ON s.EmpCode = e.EmpCode
        LEFT JOIN hrdepartment d ON e.Department = d.Code
        LEFT JOIN hrposition p ON e.Position = p.Code
        LEFT JOIN hrcompany c ON e.Company = c.Code
        WHERE s.InMonth = '$month' AND s.EmpCode = '$empcode'";

$result = $con->query($sql);
//find EmpName
$sqlempname = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$empcode'";
$resultempname = $con->query($sqlempname);
$rowempname = $resultempname->fetch_assoc();
$empname = $rowempname['EmpName'];

if (!$result || $result->num_rows === 0) {
    echo "<script>alert('No payslip found for this employee in this month.'); window.close();</script>";
    exit;
}

// <div style="text-align:center;">
//             <img style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);" src="2.png" alt="Company Logo" >

//             <br>
//             <h2>PAYSLIP</h2>
//         </div>

// Build HTML
$html = '<div style="text-align:center;">
            <img style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);" src="2.png" alt="Company Logo" >
            
            <br>
            <h2>PAYSLIP</h2>
        </div>';

while ($row = $result->fetch_assoc()) {
    $html .= '
    <h3 style="text-align:center;">' . htmlspecialchars($row['CompanyName']) . '</h3>
    <p><strong>Employee Code:</strong> ' . htmlspecialchars($row['EmpCode']) . '<br>
    <strong>Employee Name:</strong> ' . htmlspecialchars($row['EmployeeName']) . '<br>
    <strong>Department:</strong> ' . htmlspecialchars($row['DepartmentName']) . '<br>
    <strong>Position:</strong> ' . htmlspecialchars($row['PositionName']) . '<br>
    <strong>Month:</strong> ' . htmlspecialchars($row['InMonth']) . '</p>

    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <tr style="background-color:#f2f2f2;">
            <th>Earnings</th>
            <th>Amount ($)</th>
        </tr>
        <tr><td>Basic Salary</td><td>' . $row['Salary'] . '</td></tr>
        <tr><td>Allowance</td><td>' . $row['Allowance'] . '</td></tr>
        <tr><td>Bonus</td><td>' . $row['Bonus'] . '</td></tr>
        <tr><td><strong>Total Gross Pay</strong></td><td><strong>' . $row['Grosspay'] . '</strong></td></tr>
    </table>
    <br>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <tr style="background-color:#f2f2f2;">
            <th>Deductions</th>
            <th>Amount ($)</th>
        </tr>
        <tr><td>NSSF</td><td>' . $row['NSSF'] . '</td></tr>
        <tr><td>Other Deductions</td><td>' . $row['Dedction'] . '</td></tr>
        <tr><td><strong>Total Deductions</strong></td><td><strong>' . $row['UntaxAm'] . '</strong></td></tr>
    </table>
    <h3 style="text-align:right;">Net Pay: $' . $row['NetSalary'] . '</h3>
    <h3 style="text-align:right;">BOUN Hongly' . '</h3>
    
    ';
}

// Generate PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Payslip_' . $empname . '_' . $month . '.pdf', 'D'); // 'D' forces download
