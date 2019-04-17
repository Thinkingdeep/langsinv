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
                        Reports
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Reports</li>
                        <li class="active">Income Statement</li>
                    </ol>
                </section>
                <?php
                $sales_amount = 0;
                $purchases_amount = 0;
                if (Input::exists() && Input::get('search_income_statement') == 'search_income_statement') {
                    $from = Input::get('from');
                    $to = Input::get('to');
                    if (!empty($from) && !empty($to)) {
                        $header_income_statement = 'Income Statement from ' . $from . ' to ' . $to;
                        $sales_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2 AND payment_date BETWEEN '$from' AND '$to'"), 2);
                        $purchases_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 1 AND payment_date BETWEEN '$from' AND '$to'"), 2);
                    } else {
                        $header_income_statement = 'Income Statement';
                        $sales_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2"), 2);
                        $purchases_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 1"), 2);
                    }
                } else {
                    $header_income_statement = 'Income Statement';
                    $sales_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2"), 2);
                    $purchases_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 1"), 2);
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
                                    <h3 class="box-title"><?php echo $header_income_statement; ?></h3>
                                </div>
                                <form action="" method="post">
                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                        <div class="input-group ">
                                            <div class="input-group-addon">
                                                From
                                            </div>
                                            <input type="date" class="form-control" name="from" >
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                        <div class="input-group ">
                                            <div class="input-group-addon">
                                                To
                                            </div>
                                            <input type="date" class="form-control" name="to" >
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                                        <button type="submit" class="btn btn-primary" name="search_income_statement" value="search_income_statement">Search</button>
                                    </div>
                                </form>
                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="">
                                            <li><a data-toggle="modal" href="#" style="color: #72afd2;">Print </a></li>
                                            <li><a data-toggle="modal" href="#" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                            <li class="divider"></li>
                                            <li><a data-toggle="modal" href="#new-sale-form" style="color: #72afd2;">Sell</a></li>
                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Buy</a></li>
                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                            <li><a data-toggle="modal" href="#new-customer-form" style="color: #72afd2;">Add New Customer</a></li>
                                            <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Add New Supplier</a></li>
                                            <li><a data-toggle="modal" href="#new-income-form" style="color: #72afd2;">Record An Income</a></li>
                                            <li><a data-toggle="modal" href="#new-expense-form" style="color: #72afd2;">Record Stock Expense</a></li> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="examplexx" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>DETAILS</th>
                                        <th>DEBIT</th>
                                        <th>CREDIT</th>
                                        <th>BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales</td>
                                        <td></td>
                                        <td><?php echo $sales_amount; ?></td>
                                        <td><?php echo $sales_amount; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Credit purchases</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Sales revenue</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Opening stock</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Purchases</td>
                                        <td><?php echo $purchases_amount; ?></td>
                                        <td></td>
                                        <td><?php echo $purchases_amount; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Credit sales</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Cost of goods sold</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gross profit</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Incomes</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Expenses</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Net profit</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

            <?php include 'includes/footer.php'; ?>



    </body>


</html>
