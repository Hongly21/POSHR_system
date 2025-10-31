<?php
include('../../root/Header.php');

?>

<body>
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of the system.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Logout Successfully'
                    }).then(() => {
                        window.top.location.href = "login.php";


                    })
                } else {
                    window.history.back();
                }
            });
        }
    </script>
</body>
