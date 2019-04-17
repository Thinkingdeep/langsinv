<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(E_ALL);
    include 'includes/header.php';
    ?>
    <style type="text/css">
        .file {
            position: relative;
            overflow: hidden;
        }
        .picture_input{
            position: absolute;
            font-size: 50px;
            opacity: 0;
            right: 0;
            top: 0;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include 'includes/header_top.php'; ?>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $current_user_photo; ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $current_user; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php include'includes/side_nav.php' ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User profile
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="active">User profile</li>
                    </ol>
                </section>

                <?php
                if (Input::exists() && Input::get('save_basic_changes') == 'save_basic_changes') {
                    $file_name = $_FILES['userphoto']['name']; //get the file name for the photo
                    $file_tmp = $_FILES['userphoto']['tmp_name'];
                    $url = '';
                    if (!empty($file_name)) {
                        $file_ext = strtolower(substr($file_name, strpos($file_name, '.') + 1));
                        if (($file_ext == 'jpg') || ($file_ext == 'jpeg') || ($file_ext == 'png')) {
                            $new_file_name = renameUploadedFile($file_name, $file_ext);
                            move_uploaded_file($file_tmp, "assets/uploads/profile/" . $new_file_name);
                            $url = 'assets/uploads/profile/' . $new_file_name;
                        } else {
                            $entry_alert = submissionReport('error', 'Unsupported format of image selected, select a .jpeg or .jpg or .png image');
                        }
                    } else {
                        $url = $current_user_photo;
                    }
                    if (!empty($url)) {
                        $arrayUpdateContent = array("name" => Input::get('full_name'), "user_address" => Input::get('address'), "telephone" => Input::get('telephone'), "email" => Input::get('email'), "username" => Input::get('username'), "user_photo" => $url);
                        if (DB::getInstance()->update("users", $current_user_id, $arrayUpdateContent, "id_user")) {
                            $entry_alert = submissionReport('success', 'Record updated succcessfully');
                        } else {
                            $entry_alert = submissionReport('error', 'Failure in updating user information');
                        }
                    }
                } elseif (Input::exists() && Input::get('save_advanced_changes') == 'save_advanced_changes') {
                    $old_password = sha1(Input::get('old_password'));
                    $arrayInsertPassword = array("user_password" => $old_password, "id_user" => $current_user_id);
                    $arrayUpdatePassword = array("user_password" => sha1(Input::get('new_password')));
                    if (DB::getInstance()->checkRows("SELECT * from users WHERE id_user = $current_user_id AND user_password = '$old_password'")) {

                        if (DB::getInstance()->insert("user_password", $arrayInsertPassword)) {
                            DB::getInstance()->update("users", $current_user_id, $arrayUpdatePassword, "id_user");
                            $entry_alert = submissionReport('success', 'Password changed successfully');
                        } else {
                            $entry_alert = submissionReport('error', 'Failure in changing password');
                        }
                    } else {
                        $entry_alert = submissionReport('error', 'Old password entered is wrong');
                    }
                }
                ?>
                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $current_user_photo; ?>" alt="User profile picture">

                                    <h3 class="profile-username text-center"><?php echo $current_user; ?></h3>

                                    <p class="text-muted text-center"><?php echo $current_user_type; ?></p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">About Me</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class=" glyphicon glyphicon-user margin-r-5"></i> Name</strong>

                                    <p class="text-muted"><?php echo $current_user_name; ?></p>

                                    <hr>

                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                                    <p class="text-muted"><?php echo $current_user_address; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-phone margin-r-5"></i>Telephone</strong>
                                    <p class="text-muted"><?php echo $current_user_telephone; ?></p>
                                    <hr>

                                    <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
                                    <p class="text-muted"><?php echo $current_user_email; ?></p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#activity" data-toggle="tab">Account settings</a></li>
                                    <li><a href="#settings" data-toggle="tab">Security settings</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="form-group">
                                            <h4 class="text-success">Basic account settings</h4>
                                        </div>
                                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="full_name" value="<?php echo $current_user_name; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-2 control-label">Address</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" placeholder="Address" name="address" value="<?php echo $current_user_address; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTelephone" class="col-sm-2 control-label">Telephone</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputTelephone" placeholder="Telephone" name="telephone" value="<?php echo $current_user_telephone; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php echo $current_user_email; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTelephone" class="col-sm-2 control-label">Username</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputTelephone" placeholder="Username" name="username" value="<?php echo $current_user; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-sm-2 control-label">Upload photo</label>

                                                <div class="col-sm-10">
                                                    <input type="file" name="userphoto" id="exampleInputFile" accept="image/jpg,image/png,image/jpeg">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary" name="save_basic_changes" value="save_basic_changes">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="settings">
                                        <div class="form-group">
                                            <h4 class="text-success">Advanced account settings</h4>
                                        </div>
                                        <form class="form-horizontal" action="" method="post">
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-3 control-label">Old password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="inputName" name="old_password" placeholder="Old password" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-3 control-label">New password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName" class="col-sm-3 control-label">New password again</label>

                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password_again" name="new_password_again" placeholder="New password again" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p class="text-danger text-center" id="password_notification"></p>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary" name="save_advanced_changes" value="save_advanced_changes">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include 'includes/footer.php'; ?>



    </body>


</html>


