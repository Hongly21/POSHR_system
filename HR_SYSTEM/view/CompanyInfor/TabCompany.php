<?php include_once('../../root/Header.php');
include '../../root/DataTable.php'; ?>

<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add New
                    </button>
                </th>
                <th>CompanyCode</th>
                <th>CompanyName</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>

                <td>1</td>
                <td>CompanyName</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>

                <td>1</td>
                <td>CompanyName</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>

                <td>1</td>
                <td>CompanyName</td>
            </tr>
        </tbody>
    </table>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <Form action="" method="post">
                        <label for="companyCode">CompanyCode:</label>
                        <input type="text" name="companyCode"><br><br>
                        <label for="companyName">CompanyName:</label>
                        <input type="text" name="companyName">
                    </Form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>