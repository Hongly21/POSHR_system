<?php include('../../root/Header.php');
include('../../Config/conect.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Career History</title>

</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Create Career History</h4>
                            <a href="index.php" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="careerHistoryForm" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employeeID" class="form-label required">Employee ID</label>
                                        <select class="form-select" id="employeeID" name="employeeID" required>
                                            <option value="">Select Employee</option>
                                            <?php
                                            $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE Status = 'Active' ORDER BY EmpName";
                                            $result = $con->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row['EmpCode']; ?>"><?php echo $row['EmpCode'] . ' - ' . $row['EmpName']; ?></option>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" readonly>
                                        <input type="hidden" name="department" id="department_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" class="form-control" id="position" readonly>
                                        <input type="hidden" name="positionTitle" id="position_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <input type="text" class="form-control" id="division" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <input type="text" class="form-control" id="level" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label required">Effective Date</label>
                                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="endDate" class="form-label">Resignation Date</label>
                                        <input type="date" class="form-control" id="endDate" name="endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="increase" class="form-label">Increase Amount</label>
                                        <input type="number" step="0.01" class="form-control" id="increase" name="increase">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="careerCode" class="form-label required">Career Code</label>
                                        <select name="careerCode" id="careerCode" class="form-select" required>
                                            <option value="">Select Career Code</option>
                                            <option value="NEW">New Join</option>
                                            <option value="PROMOTE">Promote</option>
                                            <option value="TRANSFER">Transfer</option>
                                            <option value="RESIGN">Resign</option>
                                            <option value="INCREASE">Increase Salary</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="remark" class="form-label">Remark</label>
                                        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btnsubmit">Save Career History</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            // Handle employee selection
            $('#employeeID').on('change', function() {
                const empCode = $(this).val(); //get empcodefrom selection box 
                if (empCode) {
                    $.ajax({
                        url: '../../action/CareerHistory/getEmployee.php',
                        data: {
                            "empCode": empCode,
                            "action": 'getDetails'
                        },
                        method: 'GET',
                        success: function(response) {
                            const data = JSON.parse(response); //convert json to object
                            console.log(data);
                            $('#company').val(data.CompanyName);
                            $('#department').val(data.DepartmentName);
                            $('#department_code').val(data.Department);
                            $('#position').val(data.PositionName);
                            $('#position_code').val(data.Position);
                            $('#division').val(data.DivisionName);
                            $('#level').val(data.LevelName);
                        }
                    });
                } else {
                    // Clear all fields
                    $('#company, #department, #department_code, #position, #position_code, #division, #level').val('');
                }
            });

            $('.btnsubmit').click(function() {
                var empID = $('#employeeID').val();
                var company = $('#company').val();
                var department = $('#department').val();
                var position = $('#position').val();
                var division = $('#division').val();
                var level = $('#level').val();
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                var increase = $('#increase').val();
                var careerCode = $('#careerCode').val();
                var remark = $('#remark').val();

                $.ajax({
                    url: '../../action/CareerHistory/create.php',
                    type: 'POST',
                    data: {
                        empID: empID,
                        company: company,
                        department: department,
                        position: position,
                        division: division,
                        level: level,
                        startDate: startDate,
                        endDate: endDate,
                        increase: increase,
                        careerCode: careerCode,
                        remark: remark,
                        action: "create"
                    },
                    success: function(response) {
                        alert(response);
                        window.location.href = "index.php";
                    },
                    // ,
                    // success: function(response) {
                    //     console.log(response);
                    //     if (response.trim() === "success") { // check actual response
                    //         Swal.fire({
                    //             icon: 'success',
                    //             title: 'Success',
                    //             text: 'Career history created successfully!',
                    //         }).then(() => {

                    //             $('form')[0].reset();

                    //             // Redirect to index page
                    //             window.location.href = "index.php";
                    //         });
                    //     } else {
                    //         Swal.fire({
                    //             icon: 'error',
                    //             title: 'Error',
                    //             text: 'Failed to create career history!',
                    //         });
                    //     }
                    // },
                    // error: function(xhr, status, error) {
                    //     console.error(xhr.responseText);
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Error',
                    //         text: 'There was an error creating the career history.',
                    //     });
                    // }
                });
            });


        });
    </script>
</body>