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
                        Payment Schedules
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Payment Schedules</li>
                        <li class="active">View Schedules</li>
                    </ol>
                </section>
                <?php
                if (Input::exists() && Input::get('delete_payment_schedule') == 'delete_payment_schedule') {
                    $id_stock = Input::get('id_stock');
                    if(DB::getInstance()->query("DELETE FROM payment_schedules WHERE id_stock = $id_stock")){
                        $entry_alert = submissionReport('success',"Record deleted successfully");
                    }
                }
                ?>
                <!-- Main content -->
                <section class="content">
<?php echo $entry_alert; ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="box-title">Showing payment schedules</h3>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6  pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="">
                                            <li><a data-toggle="modal" href="" style="color: #72afd2;">Print </a></li>
                                            <li class="divider"></li>
                                            <li><a data-toggle="modal" href="#new-sale-form" style="color: #72afd2;">Sell</a></li>
                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Buy</a></li>
                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                            <li><a data-toggle="modal" href="#new-customer-form" style="color: #72afd2;">Add New Customer</a></li>
                                            <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Add New Supplier</a></li>
                                            <li><a data-toggle="modal" href="#new-income-form" style="color: #72afd2;">Record An Income</a></li>
                                            <li><a data-toggle="modal" href="#new-expense-form" style="color: #72afd2;">Record Stock Expense</a></li>                       </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>PRODUCT</th>
                                        <th>INSTALMENTS</th>
                                        <th>TOTAL</th>
                                        <th>DATE 1</th>
                                        <th>DATE 2</th>
                                        <th>DATE 3</th>
                                        <th>DATE 4</th>
                                        <th>DATE 5</th>
                                        <th>DATE 6</th>
                                        <th style="width:70px;">OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    $query_schedule = DB::getInstance()->query("SELECT * FROM payment_schedules GROUP BY id_stock ORDER BY id_payment_schedule DESC");

                                    foreach ($query_schedule->results() as $query_schedule):
                                        $id_stock = $query_schedule->id_stock;
                                        $installments = countEntries('payment_schedules', 'id_payment_schedule', 'id_stock=' . $query_schedule->id_stock . ' AND id_client=' . $query_schedule->id_client);
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo getSpecificDetails('clients', 'name', 'id_client=' . $query_schedule->id_client); ?></td>
                                            <td><?php echo getProductName($id_stock); ?></td>
                                            <td><?php echo $installments; ?></td>
                                            <td><?php echo number_format(selectSum('payment_schedules', 'payment_amount', 'id_stock=' . $query_schedule->id_stock), 2); ?></td>
                                            <?php
                                            $query_date = DB::getInstance()->query("SELECT * FROM payment_schedules WHERE id_stock = $id_stock ORDER BY id_payment_schedule ASC");
                                            foreach ($query_date->results() as $query_date):
                                                ?>
                                                <td><?php echo $query_date->payment_date . '<br>(' . number_format($query_schedule->payment_amount, 2) . ')'; ?></td>
                                            <?php
                                            endforeach;
                                            switch ($installments) {
                                                case $installments == 2:
                                                    ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a data-toggle="modal" href="#delete_schedule<?php echo $query_schedule->id_payment_schedule; ?>" style="color: #72afd2;">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    break;
                                                case $installments == 3:
                                                    ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a data-toggle="modal" href="#delete_schedule<?php echo $query_schedule->id_payment_schedule; ?>" style="color: #72afd2;">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    break;
                                                case $installments == 4:
                                                    ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a data-toggle="modal" href="#delete_schedule<?php echo $query_schedule->id_payment_schedule; ?>" style="color: #72afd2;">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    break;
                                            }
                                            ?>
                                    <div class="modal modal-default fade" id="delete_schedule<?php echo $query_schedule->id_payment_schedule; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-danger text-center">INFORMATION</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="box-header text-center">
                                                            <h3 class="box-title text-success">This record will be deleted<br><br>Do you really want to continue?</h3>
                                                            <input type="hidden" name="id_stock" value="<?php echo $query_schedule->id_stock; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                        <button type="submit" name="delete_payment_schedule" value="delete_payment_schedule" class="btn btn-success btn-md">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>


                                    </tr>
                                    <?php
                                    $x++;
                                endforeach;
                                ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

<?php include 'includes/footer.php'; ?>



    </body>


</html>
