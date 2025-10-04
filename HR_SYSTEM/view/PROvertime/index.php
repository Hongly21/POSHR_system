 <?php
    include('../../root/Header.php');
    include('../../Config/conect.php');

    ?>

 <body>
     <div class="container-fluid mt-4 mb-4">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <div class="d-flex justify-content-between align-items-center">
                             <h4 class="mb-0">Overtime List</h4>
                             <a href="create.php" class="btn btn-primary">
                                 <i class="fas fa-plus me-2"></i>New Overtime
                             </a>
                         </div>
                     </div>
                     <div class="card-body">
                         <table id="overtimeTable" class="table table-striped table-bordered table-hover">
                             <thead>
                                 <tr>
                                     <th>Actions</th>
                                     <th>Employee Code</th>
                                     <th>EmpName</th>
                                     <th>OT Type</th>
                                     <th>OT Date</th>
                                     <th>From Time</th>
                                     <th>To Time</th>
                                     <th>Hours</th>
                                     <th>Reason</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $sql = "SELECT * FROM provertime";
                                    $run = $con->query($sql);
                                    while ($row = $run->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="../../action/PROvertime/delete.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <td><?php echo $row['Empcode'];?></td>
                                        <td><?php
                                            $empCode = $row['Empcode'];
                                            $sql2 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$empCode'";
                                            $run2 = $con->query($sql2);
                                            $row2 = $run2->fetch_assoc();
                                            echo $row2['EmpName'];
                                            ?></td>
                                        <td><?php
                                         $ottype=$row['OTType'];
                                            $sql3="SELECT Des FROM protrate WHERE Code='$ottype'";
                                            $run3=$con->query($sql3);
                                            $row3=$run3->fetch_assoc();
                                            echo $row3['Des'];
                                        ?></td>
                                        <td><?php echo $row['OTDate'];?></td>
                                        <td><?php echo $row['FromTime'];?></td>
                                        <td><?php echo $row['ToTime'];?></td>
                                        <td><?php echo $row['hour'];?></td>
                                        <td><?php echo $row['Reason'];?></td>
                                    </tr>


                                 <?php
                                    }

                                    ?>

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     <script>
         $(document).ready(function() {

             // Check for success message
             const urlParams = new URLSearchParams(window.location.search);
             const successMsg = urlParams.get('success');
             if (successMsg) {
                 Swal.fire({
                     icon: 'success',
                     title: 'Success!',
                     text: decodeURIComponent(successMsg),
                     timer: 3000,
                     timerProgressBar: true,
                     showConfirmButton: false
                 });
             }

             // Handle delete button click
             $('.delete-btn').click(function() {
                 const id = $(this).data('id');
                 Swal.fire({
                     title: 'Are you sure?',
                     text: "This action cannot be undone!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: 'var(--danger-color)',
                     cancelButtonColor: '#6c757d',
                     confirmButtonText: '<i class="fas fa-trash-alt me-2"></i>Yes, delete it!',
                     cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                     reverseButtons: true
                 }).then((result) => {
                     if (result.isConfirmed) {
                         window.location.href = `../../action/PROvertime/delete.php?id=${encodeURIComponent(id)}`;
                     }
                 });
             });
         });
     </script>
 </body>



