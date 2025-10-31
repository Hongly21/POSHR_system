<?php
include('../../root/Header.php');
include('../../Config/conect.php');

?>
<style>
    .filter-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .generate-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    .generate-btn:hover {
        background-color: #218838;
    }
</style>

<body>
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fas fa-money-bill-wave"></i>
                    Generate Salary
                </h5>
            </div>
            <div class="card-body">
                <div class="filter-section">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="month" class="form-label">Month:</label>
                            <select id="month" class="form-select">
                                <?php
                                $currentMonth = date('Y-m');
                                for ($i = 0; $i < 12; $i++) {
                                    $month = date('Y-m', strtotime($currentMonth . " -$i months"));
                                    echo "<option value='$month'>" . date('F Y', strtotime($month)) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button id="generateSalary" class="generate-btn w-100">
                                <i class="fas fa-sync me-2"></i>Generate
                            </button>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-striped" id="salaryTable">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all" class="form-check-input">
                            </th>
                            <th>Employee Code</th>
                            <th>Employee Name</th>
                            <th>Start Date</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Division</th>
                            <th>Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT hrstaffprofile.*, 
                                hrcompany.Description as CompanyName,
                                hrdepartment.Description as DepartmentName,
                                hrdivision.Description as DivisionName,
                                hrposition.Description as PositionName,
                                hrlevel.Description as LevelName 
                                FROM hrstaffprofile
                                LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
                                LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
                                LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
                                LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
                                LEFT JOIN hrlevel ON hrstaffprofile.Level = hrlevel.Code
                                ORDER BY EmpCode DESC";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' class='check-item' id='" . $row['EmpCode'] . "'></td>";
                            echo "<td>" . $row['EmpCode'] . "</td>";
                            echo "<td>" . $row['EmpName'] . "</td>";
                            echo "<td>" . $row['StartDate'] . "</td>";
                            echo "<td>" . $row['DepartmentName'] . "</td>";
                            echo "<td>" . $row['PositionName'] . "</td>";
                            echo "<td>" . $row['DivisionName'] . "</td>";
                            echo "<td>" . $row['CompanyName'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['codegenerate'])) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Salary Generated Successfully in $_GET[monthgenerate]',
                showConfirmButton: true
            })
        </script>";
    } elseif (isset($_GET['invalidmonth'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'On $_GET[invalidmonth] is already generated',
                showConfirmButton: true
            })
        </script>";
    }
    ?>
</body>

<script>
    $(document).ready(function() {
        $('#generateSalary').on('click', function() {
            var selectedEmpCodes = [];
            $('.check-item:checked').each(function() {
                selectedEmpCodes.push($(this).attr('id'));
            });

            if (selectedEmpCodes.length > 0) {
                var month = $('#month').val();
                window.location.href = '../../action/PRGenSalary/index.php?id=' + selectedEmpCodes.join(',') + '&month=' + month;
            } else {
                // alert('Please select at least one employee.');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select at least one employee.',
                    showConfirmButton: true
                })
            }

        });
        // select all 
        $('#select-all').on('change', function() {
            if ($(this).is(':checked')) {
                $('.check-item').prop('checked', true);
            } else {
                $('.check-item').prop('checked', false);
            }
        })

    })
</script>