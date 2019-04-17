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
                        Sales
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Sales</li>
                        <li class="active">View Sales</li>
                    </ol>
                </section>
                <?php
                $bal_msg = "";
                $edit_msg = "Edit";
                $del_msg = "Delete";
                if (Input::exists() && Input::get('save_payment') == 'save_payment') {

                    $arrayPayment = array("payment_amount" => Input::get('balance_pay'), "id_stock_price_type" => 2, "payment_date" => date("Y-m-d h:i:s"), "payment_receipt" => Input::get('sales_receipt'), "id_stock" => Input::get('product_id'));

                    if (DB::getInstance()->insert("payments", $arrayPayment)) {

                        $entry_alert = submissionReport("success", "Payment recorded successfully");
                        Redirect::to();
                    } else {
                        $entry_alert = submissionReport("error", "Failed to submit payment");
                    }
                }
                if (Input::exists() && Input::get('search_sales') == 'search_sales') {
                    $from = Input::get('from');
                    $to = Input::get('to');
                    if (!empty($from) && !empty($to)) {
                        $sales_header = 'Showing Sales from ' . $from . ' to ' . $to;
                        $from = $from . ' 00:00:00';
                        $to = $to . ' 23:59:59';
                        $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND p.payment_date BETWEEN '$from' AND '$to' AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
                    } else {
                        $sales_header = 'Showing Sales';
                        $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
                    }
                } else {
                    $sales_header = 'Showing Sales';
                    $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
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
                                    <h3 class="box-title"><?php echo $sales_header; ?></h3>
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
                                        <button type="submit" class="btn btn-primary" name="search_sales" value="search_sales">Search</button>
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
                                            <li><a data-toggle="modal" href="index.php?page=print&columns=5&type=report&sub_type=purchases&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
                                            <!--                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                                                        <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
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
                                        <th>DATE</th>
                                        <th>PRODUCT</th>
                                        <th>SALES_PRICE</th>
                                        <th>SALES_BALANCE</th>
                                        <th>CUSTOMER</th>
                                        <th style="width:70px;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    foreach ($sales_query->results() as $sales_query):
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $sales_query->payment_date; ?></td>
                                            <td><?php echo getProductName($sales_query->id_stock); ?></td>
                                            <td><?php
                                                $sales_price = $sales_query->stock_price;
                                                echo number_format($sales_query->stock_price, 2);
                                                ?></td>
                                            <td><?php
                                                $total_pay = selectSum('payments', 'payment_amount', 'id_stock ="' . $sales_query->id_stock . '" AND id_stock_price_type = 2');
                                                $balance = $sales_price - $total_pay;
                                                if ($balance > 0) {
                                                    $bal_msg = "Pay Balance";
                                                } else {
                                                    $bal_msg = "";
                                                }
                                                echo number_format($balance, 2);
                                                ?></td>
                                            <td><a href="index.php?page=view_sales_single&id=<?php echo $sales_query->id_client; ?>&user=<?php echo $sales_query->name; ?>&product=<?php echo getProductName($sales_query->id_stock); ?>&idstock=<?php echo $sales_query->id_stock; ?>"><?php echo $sales_query->name; ?></a></td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="#pay-sales-balance-form<?php echo $sales_query->id_stock; ?>" style="color: #72afd2;"><?php echo $bal_msg; ?> </a></li>
                                                        <li><a data-toggle="modal" href="#sales-edit-form" style="color: #72afd2;"><?php echo $edit_msg; ?></a></li>
                                                        <li><a data-toggle="modal" href="#" style="color: #72afd2;"><?php echo $del_msg; ?></a></li>
                                                    </ul>
                                                </div></td>
                                    <div class="modal modal-default fade" id="pay-sales-balance-form<?php echo $sales_query->id_stock; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center text-primary">BALANCE PAYMENT FORM</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title text-success">Sales Payment</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row form-group">
                                                                <div class="col-xs-8">
                                                                    <label class="text-info">Customer Name</label>
                                                                    <input type="text" class="form-control" name="customer" required="true" autocomplete="
                                                                           off" value="<?php echo $sales_query->name; ?>">
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <label class="text-info">Receipt</label>
                                                                    <p><strong  class="text-danger"  style="font-size: 25px;"><?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?></strong></p>
                                                                    <input type="hidden" name="sales_receipt" value="<?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?>">

                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Product</label>
                                                                    <input type="text" class="form-control" name="product" required="true" autocomplete="
                                                                           off" value="<?php echo $sales_query->stock_make . ' ' . $sales_query->stock_model; ?>">
                                                                    <input type="hidden" class="form-control" name="product_id" required="true" autocomplete="
                                                                           off" value="<?php echo $sales_query->id_stock; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Sales Price</label>
                                                                    <input type="text" class="form-control" disabled="true" required="true" autocomplete="
                                                                           off" value="<?php echo number_format($sales_price, 2); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Amount Paid</label>
                                                                    <input type="text" class="form-control" disabled="true" id="amount" autocomplete="
                                                                           off" value="<?php echo number_format($total_pay, 2); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Balance</label>
                                                                    <input type="text" class="form-control" id="balance" disabled="true" autocomplete="
                                                                           off" value="<?php echo number_format(($balance), 2); ?>" >
                                                                    <input type="hidden" class="form-control" id="outstanding_balance"  autocomplete="
                                                                           off" value="<?php echo $balance; ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Amount To Pay</label>
                                                                    <input type="number" class="form-control" name="balance_pay" id="balance_pay" required="true" autocomplete="
                                                                           off">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="save_payment" value="save_payment" class="btn btn-success btn-md">Record</button>
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
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

            <?php include 'includes/footer.php'; ?>



    </body>


</html>
