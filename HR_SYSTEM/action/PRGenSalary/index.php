<?php
include('../../Config/conect.php');


// $empCodes = explode(',', $_GET['id']);
// $month = $_GET['month'];
// // check this month and year in database if exist can not insert again
// $sqlcheck = "SELECT * FROM `hisgensalary` WHERE InMonth='$month'";
// $resultcheck = $con->query($sqlcheck);

// if ($resultcheck->num_rows > 0) {
//     echo "error";
//     header("location:../../view/PRGenSalary/emplist.php?invalidmonth=$month");
// } else {
//     foreach ($empCodes as $EmpCode) {

//         // get data from hrstaffprofile
//         $sqlstaffpro = "SELECT * FROM hrstaffprofile WHERE EmpCode = '$EmpCode'";
//         $resultstaffpro = $con->query($sqlstaffpro);
//         $rowstaffpro = $resultstaffpro->fetch_assoc();

//         $salary = $rowstaffpro['Salary'];
//         $payparameter = $rowstaffpro['PayParameter'];

//         $sqlprpaypolicy = "SELECT * FROM prpaypolicy WHERE id = '$payparameter'";
//         $resultprpaypolicy = $con->query($sqlprpaypolicy);
//         $rowprpaypolicy = $resultprpaypolicy->fetch_assoc();
//         $workday = $rowprpaypolicy['workday'];
//         $hourpermonth = $rowprpaypolicy['hourperweek'];
//         $salaryperhour = $salary / $hourpermonth;






//         //get data form allowance
//         $sqlallowance = "SELECT * FROM prallowance WHERE EmpCode = '$EmpCode'";
//         $resultallowance = $con->query($sqlallowance);
//         $rowallowance = $resultallowance->fetch_assoc();

//         $amountallowance = $rowallowance['Amount']; // allowance amount


//         //get data form overtime ot 
//         $sqlovertime = "SELECT * FROM provertime WHERE EmpCode = '$EmpCode'";
//         $resultovertime = $con->query($sqlovertime);
//         $rowovertime = $resultovertime->fetch_assoc();

//         $othour = $rowovertime['hour']; // overtime hour
//         $ottype = $rowovertime['OTType']; // overtime type

//         $sqlotsetting = "SELECT * FROM protrate where Code='$ottype'";
//         $resultotsetting = $con->query($sqlotsetting);
//         $rowotsetting = $resultotsetting->fetch_assoc();
//         $otrate = $rowotsetting['Rate']; // overtime rate





//         //get data form bonus
//         $sqlbonus = "SELECT * FROM prbonus WHERE EmpCode = '$EmpCode'";
//         $resultbonus = $con->query($sqlbonus);
//         $rowbonus = $resultbonus->fetch_assoc();

//         $amountbonus = $rowbonus['Amount']; // bouns


//         //get data form deduction
//         $sqldeduction = "SELECT * FROM prdeduction WHERE EmpCode = '$EmpCode'";
//         $resultdeduction = $con->query($sqldeduction);
//         $rowdeduction = $resultdeduction->fetch_assoc();

//         $amountdeduction = $rowdeduction['Amount']; // deduction amount


//         // get data from taxrate 

//         $sqltaxrate = "SELECT * FROM prtaxrate";
//         $resulttaxrate = $con->query($sqltaxrate);
//         $rowtaxrate = $resulttaxrate->fetch_assoc();

//         $amountfrom = $rowtaxrate['AmountFrom']; // taxrate amountfrom
//         $amountto = $rowtaxrate['AmountTo']; // taxrate amountto
//         $rate = $rowtaxrate['rate'] / 100; // taxrate rate



//         if ($salary >= $amountfrom && $salary <= $amountto) {
//             $Tax = $salary * $rate;
//         } else {
//             $Tax = 0;
//         }







//         // calculate 


//         $OTSalary = ($salaryperhour * $otrate) * $othour;

//         $GrossSalary = $salary + $amountallowance + $OTSalary + $amountbonus;

//         $LeaveTax = ($salary / $workday) * 0;

//         $Amtobetax = $GrossSalary - ($amountdeduction + $LeaveTax);
//         $UntaxAm = $amountallowance + 0;

//         $NSSF = $GrossSalary * 0.013;

//         $NetSalary = $Amtobetax - $NSSF - $Tax;


//         // $sql="INSERT INTO `hisgensalary` (`ID`, `EmpCode`, `InMonth`, `Inyear`, `Salary`, `Allowance`, `OT`, `Bonus`, `Dedction`, `LeavedTax`, `Amtobetax`, `Grosspay`, `Family`, `UntaxAm`, `NSSF`, `NetSalary`) VALUES ('1', 'M1', '10', '2025', '500', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '1001');";

//         $sql = "INSERT INTO hisgensalary (EmpCode, InMonth, Salary, Allowance, OT, Bonus, Dedction, LeavedTax, Amtobetax, Grosspay, UntaxAm, NSSF, NetSalary)
//  VALUES ('$EmpCode', '$month', '$salary', '$amountallowance', '$OTSalary', '$amountbonus', '$amountdeduction', '$LeaveTax', '$Amtobetax', '$GrossSalary', '$UntaxAm', '$NSSF', '$NetSalary')";
//         $run = $con->query($sql);

//         if ($run) {
//             echo "success gerenrated";
//             header("location:../../view/PRGenSalary/emplist.php?codegenerate=$EmpCode &monthgenerate=$month");
//         } else {
//             echo "error" . $con->error;
//         }
//     }
//     $sql2 = "INSERT INTO prapprovesalary (InMonth, status ) VALUES ('$month', 'pending')";
//     $run2 = $con->query($sql2);
//     if (!$run2) {
//         echo "error" . $con->error;
//     }
// }









// ===============================================

include('../../Config/conect.php');

$empCodes = explode(',', $_GET['id']);
$month = $_GET['month'];

// check this month and year in database if exist can not insert again
$sqlcheck = "SELECT * FROM `hisgensalary` WHERE InMonth='$month'";
$resultcheck = $con->query($sqlcheck);

if ($resultcheck->num_rows > 0) {
    echo "error";
    header("location:../../view/PRGenSalary/emplist.php?invalidmonth=$month");
} else {
    foreach ($empCodes as $EmpCode) {

        // get data from hrstaffprofile
        $sqlstaffpro = "SELECT * FROM hrstaffprofile WHERE EmpCode = '$EmpCode'";
        $resultstaffpro = $con->query($sqlstaffpro);
        $rowstaffpro = $resultstaffpro->fetch_assoc();

        $salary = $rowstaffpro['Salary'];
        $payparameter = $rowstaffpro['PayParameter'];

        // get pay policy (work day & hours)
        $sqlprpaypolicy = "SELECT * FROM prpaypolicy WHERE id = '$payparameter'";
        $resultprpaypolicy = $con->query($sqlprpaypolicy);
        $rowprpaypolicy = $resultprpaypolicy->fetch_assoc();
        $workday = $rowprpaypolicy['workday'];
        $hourpermonth = $rowprpaypolicy['hourperweek'] * 4;
        $salaryperhour = $salary / $hourpermonth;


        //get data form allowance
        $sqlallowance = "SELECT * FROM prallowance WHERE EmpCode = '$EmpCode' AND FromDate <= '$month','-1' AND ToDate >= '$month','-31'";
        $resultallowance = $con->query($sqlallowance);
        $rowallowance = $resultallowance->fetch_assoc();
        $amountallowance = $rowallowance['Amount'];


        //get data form overtime ot 
        $sqlovertime = "SELECT * FROM provertime WHERE EmpCode = '$EmpCode'";
        $resultovertime = $con->query($sqlovertime);
        $rowovertime = $resultovertime->fetch_assoc();

        $othour = $rowovertime['hour'];
        $ottype = $rowovertime['OTType'];

        $sqlotsetting = "SELECT * FROM protrate WHERE Code='$ottype'";
        $resultotsetting = $con->query($sqlotsetting);
        $rowotsetting = $resultotsetting->fetch_assoc();
        $otrate = $rowotsetting['Rate'];


        //get data form bonus
        $sqlbonus = "SELECT * FROM prbonus WHERE EmpCode = '$EmpCode'";
        $resultbonus = $con->query($sqlbonus);
        $rowbonus = $resultbonus->fetch_assoc();
        $amountbonus = $rowbonus['Amount'];


        //get data form deduction
        $sqldeduction = "SELECT * FROM prdeduction WHERE EmpCode = '$EmpCode'";
        $resultdeduction = $con->query($sqldeduction);
        $rowdeduction = $resultdeduction->fetch_assoc();
        $amountdeduction = $rowdeduction['Amount'];


        //family
        $family = 0;


        //get data leavetax emp leave days

        $sqlleavecount = "
                    SELECT 
                        COUNT(*) AS total_unpaid_leave
                    FROM lmleaverequest
                    INNER JOIN lmleavetype 
                        ON lmleaverequest.LeaveType = lmleavetype.Code
                    WHERE lmleaverequest.EmpCode = '$EmpCode'
                    AND lmleavetype.IsDeduct = 1
                    AND (
                            lmleaverequest.FromDate <= LAST_DAY(CONCAT('$month', '-01'))
                            AND lmleaverequest.ToDate >= CONCAT('$month', '-01')
                        );
                    ";

        $resultleavecount = $con->query($sqlleavecount);
        $rowleavecount = $resultleavecount->fetch_assoc();

        $totalUnpaidLeave = $rowleavecount['total_unpaid_leave'] ?? 0;
        $leaveday = $totalUnpaidLeave;
        $LeaveTax = ($salary / $workday) * $totalUnpaidLeave;

        //get leaveday





        // calculate overtime
        $OTSalary = ($salaryperhour * $otrate) * $othour;

        // calculate gross salary
        $GrossSalary = $salary + $amountallowance + $OTSalary + $amountbonus - $LeaveTax - $amountdeduction;


        // amount to be taxed
        $Amtobetax = $GrossSalary - ($family + $UntaxAm);


        $UntaxAm = 375;


        // get and cal tax
        $sqltaxrate = "SELECT * FROM prtaxrate ORDER BY AmountFrom ASC";
        $resulttaxrate = $con->query($sqltaxrate);

        if ($resulttaxrate->num_rows > 0) {
            while ($rowtaxrate = $resulttaxrate->fetch_assoc()) {
                $from = $rowtaxrate['AmountFrom'];
                $to = $rowtaxrate['AmountTo'];
                $rate = $rowtaxrate['rate'] / 100;

                if ($Amtobetax >= $from && $Amtobetax <= $to) {
                    $Tax = $Amtobetax * $rate;
                    break;
                }
            }
        }



        // NSSF 1.3%
        $NSSF = $salary * 0.013;

        // net salary
        $NetSalary = $GrossSalary - $Tax - $NSSF;

        // insert data
        $sql = "INSERT INTO hisgensalary (
            EmpCode, InMonth, Salary, Allowance, OT, Bonus, Dedction, LeavedTax,
            Amtobetax, Grosspay, UntaxAm, NSSF, NetSalary, Family
        ) VALUES (
            '$EmpCode', '$month', '$salary', '$amountallowance', '$OTSalary', '$amountbonus',
            '$amountdeduction', '$LeaveTax', '$Amtobetax', '$GrossSalary',
            '$UntaxAm', '$NSSF', '$NetSalary','$Tax'
        )";

        $run = $con->query($sql);

        if ($run) {
            echo "success generated";
            header("location:../../view/PRGenSalary/emplist.php?codegenerate=$EmpCode&monthgenerate=$month");
        } else {
            echo "error: " . $con->error;
        }
    }

    $sql2 = "INSERT INTO prapprovesalary (InMonth, status) VALUES ('$month', 'pending')";
    $run2 = $con->query($sql2);
    if (!$run2) {
        echo "error: " . $con->error;
    }
}
