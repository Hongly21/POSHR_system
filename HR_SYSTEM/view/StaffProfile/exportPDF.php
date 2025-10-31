<?php
require '../../Config/conect.php';
require_once '../CareerHistory/exportPDF/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<h2 style="text-align:center;">Staff List</h2>';
$html .= '<table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th>Code</th>
                    <th>EmpName</th>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Division</th>
                    <th>StartDate</th>
                    <th>Status</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>';

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

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['EmpCode'] . '</td>
                <td>' . $row['EmpName'] . '</td>
                <td>' . $row['CompanyName'] . '</td>
                <td>' . $row['PositionName'] . '</td>
                <td>' . $row['DepartmentName'] . '</td>
                <td>' . $row['DivisionName'] . '</td>
                <td>' . $row['StartDate'] . '</td>
                <td>' . $row['Status'] . '</td>
                <td>' . $row['Contact'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';
$mpdf->WriteHTML($html);
$mpdf->Output('StaffList.pdf', 'D');
exit;