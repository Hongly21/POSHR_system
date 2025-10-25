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
                             <a href="create.php" class="btn btn-sm btn-primary me-2">
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
                                             <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-warning me-2"><i class="fas fa-edit"></i></a>
                                             <button class="btn btn-sm btn-danger" onclick="deleteOvertime('<?php echo $row['ID']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                         </td>
                                         <td><?php echo $row['Empcode']; ?></td>
                                         <td><?php
                                                $empCode = $row['Empcode'];
                                                $sql2 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$empCode'";
                                                $run2 = $con->query($sql2);
                                                $row2 = $run2->fetch_assoc();
                                                echo $row2['EmpName'];
                                                ?></td>
                                         <td><?php
                                                $ottype = $row['OTType'];
                                                $sql3 = "SELECT Des FROM protrate WHERE Code='$ottype'";
                                                $run3 = $con->query($sql3);
                                                $row3 = $run3->fetch_assoc();
                                                echo $row3['Des'];
                                                ?></td>
                                         <td><?php echo $row['OTDate']; ?></td>
                                         <td><?php echo $row['FromTime']; ?></td>
                                         <td><?php echo $row['ToTime']; ?></td>
                                         <td><?php echo $row['hour']; ?></td>
                                         <td><?php echo $row['Reason']; ?></td>
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

 </body>


 <script>
     function deleteOvertime(code) {
         Swal.fire({
             title: 'Are you sure?',
             text: 'This will permanently delete the Leave Type record.',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel',
             confirmButtonColor: '#d33',
             cancelButtonColor: '#3085d6'
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     url: '../../action/PROvertime/delete.php',
                     method: 'GET',
                     data: {
                         Code: code
                     },
                     success: function(response) {
                         Swal.fire({
                             icon: 'success',
                             title: 'Deleted!',
                             text: 'The Overtime has been deleted.',
                             confirmButtonColor: '#3085d6',
                             timer: 1500,
                             showConfirmButton: false
                         }).then(() => {
                             location.reload(); // 🔄 Refresh the page
                         });
                     },
                     error: function(xhr, status, error) {
                         Swal.fire({
                             icon: 'error',
                             title: 'Delete Failed',
                             text: 'Could not delete the Overtime.',
                             footer: error
                         });
                     }
                 });
             }
         });
     }
 </script>