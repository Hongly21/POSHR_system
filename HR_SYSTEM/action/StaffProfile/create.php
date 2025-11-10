<?php
include('../../Config/conect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Staff details
    $empCode = $_POST['empCode'];
    $empName = $_POST['empName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $salary = $_POST['salary'];

    $img = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmp_name, "../../assets/images/$img");


    $checkSQL = "SELECT EmpCode FROM hrstaffprofile WHERE EmpCode = '$empCode' LIMIT 1";
    $checkRun = $con->query($checkSQL);

    if ($checkRun && $checkRun->num_rows > 0) {
        echo "Employee Code already exists!";
        exit;
    }

    //job details
    $company = $_POST['company'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $division = $_POST['division'];
    $level = $_POST['level'];
    $startdate = $_POST['startDate'];
    $proEnd = $_POST['probationDate'];
    $isProb = $_POST['isProb'];
    $telegram = $_POST['telegram'];
    $status = $_POST['status'];
    $lineManager = $_POST['lineManager'];
    $headdepartment = $_POST['hod'];
    $payparameter = $_POST['payParamter'];

    //contact details
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if ($empCode && $empName && $gender && $dob && $salary && $company && $position && $department && $division && $level && $status) {
        $empSQL = "INSERT INTO `hrstaffprofile` 
                        (`EmpCode`, `EmpName`, `Gender`, `Dob`, `Position`, `Department`, `Company`, `Level`,
                        `Division`, `StartDate`, `Status`, `Contact`, `Email`, `Address`,
                        `LineManager`, `Hod`, `Photo`, `IsProb`, `Salary`, `PayParameter`, 
                        `Telegram`, `ProbationDate`)
     VALUES ('$empCode', '$empName', '$gender', '$dob', '$position', '$department', '$company', '$level', '$division', 
     '$startdate', '$status', '$contact', '$email', '$address',
      '$lineManager', '$headdepartment', '$img', '$isProb', '$salary', '$payparameter', '$telegram', '$proEnd');";
        $runEmp = $con->query($empSQL);

        $sqlcareerhistory = "INSERT INTO careerhistory (
            CareerHistoryType, EmployeeID, PositionTitle, Department, Division, Company,
            StartDate, EndDate, Remark, Increase,
            CreatedAt, UpdatedAt
        ) VALUES (
            'New', '$empCode', '$position', '$department','$division','$company',
            '$startdate', '', '', '0',
            NOW(), NOW()
        );";
        $runcareerhistory = $con->query($sqlcareerhistory);


        // Family members
        if (!empty($_POST['family'])) {
            $familyMembers = json_decode($_POST['family'], true);

            foreach ($familyMembers as $member) {
                $name     = $member['name'];
                $relation = $member['relation'];
                $fgender  = $member['gender'];
                $istax    = $member['istax'];

                if ($name && $relation && $fgender) {
                    $sql = "INSERT INTO `hrfamily` (`EmpCode`, `RelationName`, `RelationType`, `Gender`, `IsTax`)
             VALUES ('$empCode', '$name', '$relation', '$fgender', '$istax')";
                    $runfamily = $con->query($sql);
                }
            }
        }
        //educations 
        if (!empty($_POST['education'])) {
            $educations = json_decode($_POST['education'], true);
            foreach ($educations as $education) {
                $institution = $education['institution'];
                $degree = $education['degree'];
                $fieldOfStudy = $education['fieldOfStudy'];
                $startDate = $education['startDate'];
                $endDate = $education['endDate'];

                if ($institution && $degree && $fieldOfStudy && $startDate && $endDate) {
                    $sql = "INSERT INTO `hreducation` (`EmpCode`, `Institution`, `Degree`, `FieldOfStudy`, `StartDate`, `EndDate`)
             VALUES ('$empCode', '$institution', '$degree', '$fieldOfStudy', '$startDate', '$endDate');";
                    $runeducation = $con->query($sql);
                }
            }
        }







        //documents 
        // documents (handle files and metadata properly)
        if (isset($_POST['document'])) {

            foreach ($_POST['document'] as $index => $doc) {
                $docType = $doc['docType'] ?? '';
                $description = $doc['description'] ?? '';
                $filePath = '';

                // Check if this document has a file uploaded
                if (isset($_FILES['document']['name'][$index]['docFile']) && !empty($_FILES['document']['name'][$index]['docFile'])) {
                    $fileName = time() . '_' . basename($_FILES['document']['name'][$index]['docFile']);
                    $tmpName  = $_FILES['document']['tmp_name'][$index]['docFile'];
                    $uploadDir = "../../assets/documents/";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $filePath = $uploadDir . $fileName;
                    move_uploaded_file($tmpName, $filePath);
                }

                // Insert into database
                if ($docType && $description) {
                    $sql = "INSERT INTO `hrstaffdocument` (`EmpCode`, `DocType`, `Description`, `Photo`)
                    VALUES ('$empCode', '$docType', '$description', '$fileName')";
                    $rundocument = $con->query($sql);
                }
            }
        }

        if ($rundocument && $runfamily && $runeducation) {
            echo "success";
        } else if ($runEmp && !$runfamily || !$runeducation || !$rundocument) {
            echo "Success add only staff";
        }
    } else {
        echo "All fields are required! Please fill all the required fields on Staff Profile form.";
        exit;
    }
} else {
    echo "Invalid request";
}
