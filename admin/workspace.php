<?php include "includes/admin_header.php"; ?>



    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Administrator</small>
                        </h1>
                        <?php 
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];

                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'add_workspace';
                                    include "includes/add_workspace.php";
                                    break;
                                case 'edit_workspace';
                                    include "includes/edit_workspace.php";
                                    break;
                                case '200';
                                    echo "NICE 200";
                                    break;
                                
                                default:
                                    include "includes/viewall_workspace.php";
                                    break;
                            }
                        ?>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <?php include "includes/admin_footer.php"; ?>