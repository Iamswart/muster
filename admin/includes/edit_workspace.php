<?php
 if (isset($_GET['w_id'])) {
    $the_workspace_id = $_GET['w_id'];
 }

    $query = "SELECT * FROM workspaces where workspace_id = $the_workspace_id";
    $select_workspace_by_id = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($select_workspace_by_id)) {
        $workspaces_id = $row['workspace_id'];
        $workspaces_name = $row['workspace_name'];
        $workspaces_category = $row['workspace_category'];
        $workspaces_amount = $row['workspace_amount'];
        $workspaces_image = $row['workspace_image'];
        $workspaces_status = $row['workspace_status'];
        $workspaces_tags = $row['workspace_tags'];
        $workspaces_description = $row['workspace_description'];
        $workspaces_review = $row['workspace_review'];

        if(isset($_POST['edit_workspace'])) {
        $workspaces_name = $_POST['title'];
        $workspaces_category = $_POST['workspace_category'];
        $workspaces_amount = $_POST['amount'];
        $workspaces_image = $_FILES['image']['name'];
        $workspaces_image_temp = $_FILES['image']['tmp_name'];
        $workspaces_status = $_POST['workspace_status'];
        $workspaces_tags = $_POST['tags'];
        $workspaces_description = $_POST['description'];

        move_uploaded_file($workspaces_image_temp, "../images/$workspaces_image");
        if (empty($workspaces_image)) {
            $query = "SELECT * FROM workspaces WHERE workspace_id = $the_workspace_id ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_image)) {
                $workspaces_image = $row['workspace_image'];
            }
        }

        $query = "UPDATE workspaces SET ";
        $query .= "workspace_name = '{$workspaces_name}', ";
        $query .= "workspace_category = '{$workspaces_category}', ";
        $query .= "workspace_amount = '{$workspaces_amount}', ";
        $query .= "workspace_image = '{$workspaces_image}', ";
        $query .= "workspace_status = '{$workspaces_status}', ";
        $query .= "workspace_tags = '{$workspaces_tags}', ";
        $query .= "workspace_description = '{$workspaces_description}' ";
        $query .= "WHERE workspace_id = '{$workspaces_id}' ";

        $update_workspace = mysqli_query($connection, $query);
        if ($update_workspace) {
            echo "<p class='bg-success'>Workspace updated . <a href='workspace.php'>View All Workspace</a></p>";
        }else {
            die("QUERY FAILED" . mysqli_error($connection));
        }
    

        
        }
    }


?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Workspace Name</label>
        <input value="<?php echo $workspaces_name; ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="workspace_category" id="">
        <option value="<?php echo $workspaces_category; ?>"></option>
       
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
        <input value="<?php echo $workspaces_amount; ?>" type="text" class="form-control" name="amount">
    </div>
    <div class="form-group">
        <img width="100" src="../images/<?php echo $workspaces_image; ?>" alt="">
        <input  type="file"  name="image">
    </div>
    <div class="form-group">
        <select name="workspace_status" id="">
        <option value="<?php echo $workspaces_status; ?>"><?php echo $workspaces_status; ?></option>
            
            <option>Available</option>
            <option>Unavailable</option>
        </select>
    </div>
   
    <div class="form-group">
        <label for="tags">Tags</label>
        <input value="<?php echo $workspaces_tags; ?>" type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="body" cols="30" rows="10" class="form-control"><?php echo $workspaces_description; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_workspace" value="Update Workspace">
    </div>
</form>