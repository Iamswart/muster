<?php 
    if (isset($_POST['add_workspace'])) {
        $workspaces_name = $_POST['title'];
        $workspaces_category = $_POST['workspace_category'];
        $workspaces_amount = $_POST['amount'];
        $workspaces_image = $_FILES['image']['name'];
        $workspaces_image_temp = $_FILES['image']['tmp_name'];
        $workspaces_status = $_POST['workspace_status'];
        $workspaces_tags = $_POST['tags'];
        $workspaces_description = $_POST['description'];

        move_uploaded_file($workspaces_image_temp, "../images/$workspaces_image");

        $query = "INSERT INTO workspaces(workspace_name, workspace_category, workspace_amount, workspace_image, workspace_status, workspace_tags, workspace_description)";
        $query .= "VALUES('{$workspaces_name}', '{$workspaces_category}', '{$workspaces_amount}', '{$workspaces_image}', '{$workspaces_status}', '{$workspaces_tags}', '{$workspaces_description}')";

        $add_workspace_query = mysqli_query($connection,$query);
        if (!$add_workspace_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        echo "<p class='bg-success'> Workspace Successfully Added. Will you like to <a href='workspace.php?source=add_workspace'>Add new workspace</a>?</p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Workspace Name</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="workspace_category" id="">
            <?php 
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);

                if (!$select_categories) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_type = $row['cat_type'];

                    echo "<option value='$cat_id'>{$cat_type}</option>";
                }
            ?>
        </select>

    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" class="form-control" name="amount">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file"  name="image">
    </div>
    <div class="form-group">
        <select name="workspace_status" id="">
            <option>Status</option>
            <option>Available</option>
            <option>Unavailable</option>
        </select>
    </div>
   
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="body" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_workspace" value="Add Workspace">
    </div>
</form>