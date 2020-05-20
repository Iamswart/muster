<?php include "includes/admin_header.php"; ?>



    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php 
                            if (isset($_POST['submit'])) {
                                $cat_type = $_POST['cat_type'];
                                if ($cat_type == "" || empty($cat_type)) {
                                    echo "This field cannot be empty";
                                }else {
                                    $query = "INSERT INTO categories (cat_type) ";
                                    $query .= "VALUE('{$cat_type}')";

                                    $create_category_query = mysqli_query($connection, $query);
                                    if (!$create_category_query) {
                                        die("QUERY FAILED" . mysqli_error($connection));
                                    }
                                    }
                                
                            }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                            <label for="cat_type">Add Category</label>
                            <input type="text" class="form-control" name="cat_type">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
                            </div>
                        </form>
                        <?php
                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";

                            }
                        ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $select_category = mysqli_query($connection,$query);

                                        while ($row = mysqli_fetch_assoc($select_category)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_type = $row['cat_type'];

                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_type}</td>";
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                            echo "<tr>";
                                        }
                                    ?>
                                    <?php
                                        if (isset($_GET['delete'])) {
                                            $the_cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                            $delete_category = mysqli_query($connection,$query);
                                            header("Location: categories.php");
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?php include "includes/admin_footer.php"; ?>
    