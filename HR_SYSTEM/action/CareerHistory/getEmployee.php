<?php  include('../../Config/conect.php'); 


if (isset($_GET['action']) && $_GET['action'] == 'getDetails') {
    $empCode = $_GET['empCode'];
    $sql = "SELECT sp.*, 
            c.Description as CompanyName,
            d.Description as DepartmentName,
            p.Description as PositionName,
            dv.Description as DivisionName,
            l.Description as LevelName
            FROM hrstaffprofile sp
            LEFT JOIN hrcompany c ON sp.Company = c.Code
            LEFT JOIN hrdepartment d ON sp.Department = d.Code
            LEFT JOIN hrposition p ON sp.Position = p.Code
            LEFT JOIN hrdivision dv ON sp.Division = dv.Code
            LEFT JOIN hrlevel l ON sp.Level = l.Code
            WHERE sp.EmpCode = ?";

            $run = $con->prepare($sql);
            $run->bind_param("s", $empCode);
            $run->execute();
            $result = $run->get_result();
            $data = $result->fetch_assoc();
            echo json_encode($data);
            
        
        }
?>