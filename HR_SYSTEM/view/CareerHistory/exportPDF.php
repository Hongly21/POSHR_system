<?php
require '../../Config/conect.php';
require_once __DIR__ . '/exportPDF/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<h2 style="text-align:center;">Career History List</h2>';
$html .= '<table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th>Career</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Effective Date</th>
                    <th>Resignation Date</th>
                    <th>Remark</th>
                    <th>Increase</th>
                </tr>
            </thead>
            <tbody>';

$sql = "SELECT P.Description AS PositionDes, D.Description AS Dept, ch.*, sp.EmpName
        FROM careerhistory ch
        INNER JOIN hrstaffprofile sp ON ch.EmployeeID = sp.EmpCode
        INNER JOIN hrposition P ON P.Code = ch.PositionTitle
        INNER JOIN hrdepartment D ON D.Code = ch.Department
        ORDER BY ch.CreatedAt DESC";

$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['CareerHistoryType'] . '</td>
                <td>' . $row['EmployeeID'] . '</td>
                <td>' . $row['EmpName'] . '</td>
                <td>' . $row['PositionDes'] . '</td>
                <td>' . $row['Dept'] . '</td>
                <td>' . $row['StartDate'] . '</td>
                <td>' . $row['EndDate'] . '</td>
                <td>' . $row['Remark'] . '</td>
                <td>' . $row['Increase'] . '</td>
              </tr>';
}

$html .= '</tbody></table>';
$mpdf->WriteHTML($html);
$mpdf->Output('CareerHistory.pdf', 'D');
exit;
