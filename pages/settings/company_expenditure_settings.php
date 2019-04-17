<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(E_ALL);
    include 'includes/header.php';
    ?>
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
                            <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $current_user;?></p>
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
                        Settings
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Settings</li>
                        <li class="active">Expense Settings</li>
                    </ol>
                </section>
                <?php
                if (Input::exists() && Input::get('submit')) {
                    $type = Input::get('expense_type');
                    $arrayIncomeType = array("expenditure_name" => $type);
                    if (DB::getInstance()->checkRows("SELECT * FROM expenditure_sources WHERE expenditure_name='$type'")) {
                        $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;"> Expense Type ' . $type . ' exists in the database, enter a different type</p>
              </div>';
                    } else {
                        DB::getInstance()->insert("expenditure_sources", $arrayIncomeType);
                        $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
                    }
                }
                ?>
                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="row">
                            <div class="col-md-5 col-xs-12">
                                <div class="box-header with-border">
                                    <h3 class="box-title">New Expense Type</h3>

                                    <!-- <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div> -->
                                </div>
                                <!-- form start -->
                                <form role="form" action="" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputText">Expense Type</label>
                                            <input type="text" class="form-control" id="income_type" name="expense_type" required="true" placeholder="Enter Type">
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-7 col-xs-12">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Expense Types</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>EXPENSE TYPE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $income = DB::getInstance()->query("SELECT * FROM expenditure_sources");
                                            $x = 1;
                                            foreach ($income->results() as $income):
                                                ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $income->expenditure_name; ?></td>
                                                    <td><div class="btn-group">
                                                            <button type="button" class="btn btn-default">Action</button>
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Edit</a></li>
                                                                <li><a data-toggle="modal" href="#delete-form" style="color: #72afd2;">Delete</a></li>
                                                            </ul>
                                                        </div></td>
                                                </tr>

                                                <?php $x++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

<?php include 'includes/footer.php'; ?>



    </body>


</html>
