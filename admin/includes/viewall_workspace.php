<form action="" method="post">
    <table class="table-bordered table-hover table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Image</th>
                <th>Status</th>
                <th>Tags</th>
                <th>Description</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $query = "SELECT * FROM workspaces";
                $select_workspaces = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($select_workspaces)) {
                    $workspaces_id = $row['workspace_id'];
                    $workspaces_name = $row['workspace_name'];
                    $workspaces_category = $row['workspace_category'];
                    $workspaces_amount = $row['workspace_amount'];
                    $workspaces_image = $row['workspace_image'];
                    $workspaces_status= $row['workspace_status'];
                    $workspaces_tags = $row['workspace_tags'];
                    $workspaces_description = $row['workspace_description'];
                    $workspaces_review = $row['workspace_review'];


                    echo "<tr>";
                    echo "<td>$workspaces_id</td>";
                    echo "<td>$workspaces_name</td>";
                $query = "SELECT * FROM categories WHERE cat_id = {$workspaces_category}";
                $select_categories_id = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_type =$row['cat_type'];

                    echo "<td>$cat_type</td>";
                }
                    
                    echo "<td>$workspaces_amount</td>";
                    echo "<td><img width='100' src='../images/$workspaces_image' alt='image'></td>";
                    echo "<td>$workspaces_status</td>";
                    echo "<td>$workspaces_tags</td>";
                    echo "<td> $workspaces_description</td>";
                    echo "<td> $workspaces_review</td>";
                    echo "<td><a href='workspace.php?source=edit_workspace&w_id={$workspaces_id}'>Edit</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='workspace.php?delete={$workspaces_id}'>Delete</a></td>";
                }
            ?>
        </tbody>

    </table>
</form>
<?php
    if (isset($_GET['edit'])) {
        $workspaces_id = $_GET['edit'];
        include "edit_workspace.php";

    }
?>
<?php 
    if (isset($_GET['delete'])) {
        $the_workspace_id = $_GET['delete'];
        
    $query = "DELETE FROM workspaces where workspace_id = {$the_workspace_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: workspace.php");
    }
?>