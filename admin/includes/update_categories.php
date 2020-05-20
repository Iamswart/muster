<form action="" method="post">
    <div class="form-group">
        <label for="cat_type">Edit Category</label>
        <?php
            if (isset($_GET['edit'])) {
                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $select_categories_id = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_type = $row['cat_type'];
               
        ?>
        <input value="<?php if(isset($cat_type)) {echo $cat_type;} ?>" type="text" class="form-control" name="cat_type">
        <?php }} ?>
        <?php
            if (isset($_POST['update_category'])) {
                $the_cat_type = $_POST['cat_type'];
                $query = "UPDATE categories SET cat_type = '{$the_cat_type}' WHERE cat_id = {$cat_id} ";
                $update_query = mysqli_query($connection,$query);

                if (!$update_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }

            }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" name="update_category" class="btn btn-primary" value="update">
    </div>
</form>