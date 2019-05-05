<!DOCTYPE html>
<html>
    <?php include 'includes/header.php'; ?>
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
                    <?php include 'includes/side_nav.php'; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <?php
                if (Input::exists() && Input::get('save_payment') == 'save_payment') {
                $amount = Input::get('balance_pay');
                $payment_date = date("Y-m-d h:i:s");
                $receipt = Input::get('sales_receipt');
                $idstock = Input::get('product_id');
                $sales_price = Input::get('sales_price');
                $balance = Input::get('outstanding_balance');
                $idclient = Input::get('idclient');
                $arrayPayment = array("payment_amount" => $amount, "id_stock_price_type" => 2, "payment_date" => $payment_date, "payment_receipt" => $receipt, "id_stock" => $idstock);
                if ($amount <= $balance) {
                if (DB::getInstance()->insert("payments", $arrayPayment)) {

                $entry_alert = submissionReport("success", "Payment recorded successfully");
//                            Redirect::to("index.php?page=print_receipt&type=cash_sale&idstock=" . $idstock . "&price=" . $sales_price . "&amt_pd=" . $amount . "&bal=" . ($balance - $amount) . "&ticket=" . $receipt . "&idclient=" . $idclient . "&occurred=" . $payment_date . "");
                } else {
                $entry_alert = submissionReport("error", "Failed to submit payment");
                }
                } else {
                $entry_alert = submissionReport("warning", "Your balance is " . number_format($balance, 2) . ". Enter amount not exceeding the balance");
                }
                } elseif (Input::exists() && Input::get('save_purchase_payment') == 'save_purchase_payment') {
                $idclient = Input::get('idclient');
                $idstock = Input::get('idstock');
                $purchase_price = Input::get('purchase_price');
                $amount_paid = Input::get('amount_paid');
                $purchase_balance = Input::get('purchase_balance');
                $amount_to_pay = Input::get('amount_to_pay');
                $payment_receipt = Input::get('payment_receipt');
                $payment_date = date("Y-m-d h:i:s");
                $arrayPayment = array("payment_amount" => $amount_to_pay, "id_stock_price_type" => 1, "payment_date" => $payment_date, "payment_receipt" => $payment_receipt, "id_stock" => $idstock);
                if ($amount_to_pay <= $purchase_balance) {
                if (DB::getInstance()->insert("payments", $arrayPayment)) {

                $entry_alert = submissionReport("success", "Payment recorded successfully");
//                            Redirect::to("index.php?page=print_receipt&type=cash_purchase&idstock=" . $idstock . "&price=" . $purchase_price . "&amt_pd=" . $amount_to_pay . "&bal=" . ($purchase_balance - $amount_to_pay) . "&ticket=" . $payment_receipt . "&idclient=" . $idclient . "&occurred=" . $payment_date . "");
                } else {
                $entry_alert = submissionReport("error", "Failed to submit payment");
                }
                } else {
                $entry_alert = submissionReport("warning", "Your balance is " . number_format($purchase_balance, 2) . ". Enter amount not exceeding the balance");
                }
                } elseif (Input::exists() && Input::get('save_purchase_edit') == 'save_purchase_edit') {
                $idstock = Input::get('idstock');
                $idsupplier = Input::get('idclient');
                $brand = Input::get('stock_name');
                $chasis_number = Input::get('chasis_number');
                $engine_number = Input::get('engine_number');
                $plate_number = Input::get('plate_number');
                $car_color = Input::get('car_color');
                $purchase_price = Input::get('purchase_price');
                $arrayStock = array("id_client" => $idsupplier, "id_stock_name" => $brand, "chasis_number" => $chasis_number, "engine_number" => $engine_number
                , "plate_number" => $plate_number, "id_stock_color" => $car_color);

                $arrayStockPrice = array("stock_price" => $purchase_price);
                if (DB::getInstance()->update("stock", $idstock, $arrayStock, "id_stock")) {
                DB::getInstance()->updateMany("stock_prices", $arrayStockPrice, "id_stock=$idstock AND id_stock_price_type=1");
                $entry_alert = submissionReport('success', 'Record updated successfully');
                } else {
                $entry_alert = submissionReport('error', 'Failed to update record');
                }
                } elseif (Input::exists() && Input::get('delete_purchase') == 'delete_purchase') {
                $idstock = Input::get('idstock');
                if (DB::getInstance()->query("DELETE FROM stock WHERE id_stock = $idstock")) {
                DB::getInstance()->query("DELETE FROM stock_prices WHERE id_stock = $idstock AND id_stock_price_type=1");
                DB::getInstance()->query("DELETE FROM payments WHERE id_stock = $idstock");
                $entry_alert = submissionReport('success', 'Record deleted successfully');
                } else {
                $entry_alert = submissionReport('error', 'Failure in deleting record');
                }
                } elseif (Input::exists() && Input::get('delete_sale') == 'delete_sale') {
                $idstock = Input::get('idstock');
                $arrayStock = array("stock_status" => 'NOT SOLD');
                if (DB::getInstance()->update('stock', $idstock, $arrayStock, 'id_stock')) {
                DB::getInstance()->query("DELETE FROM stock_prices WHERE id_stock = $idstock AND id_stock_price_type=2");
                DB::getInstance()->query("DELETE FROM payments WHERE id_stock = $idstock AND id_stock_price_type = 2");
//                        DB::getInstance()->update('stock',$idstock,$arrayStock,'id_stock');
                $entry_alert = submissionReport('success', 'Record deleted successfully');
                } else {
                $entry_alert = submissionReport('error', 'Failure in deleting record');
                }
                }
                ?>

                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h4><?php echo number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2"), 2); ?></h4>

                                    <p>Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-up"></i>
                                </div>
                                <a href="index.php?page=view_sales" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h4><?php echo number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 1"), 2); ?></h4>

                                    <p>Purchases</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <a href="index.php?page=view_purchases" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h4><?php echo countEntries("stock", "id_stock", "stock_status='NOT SOLD'"); ?></h4>

                                    <p>Current stock</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <a href="index.php?page=view_stock" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h4><?php echo countEntries('clients', 'id_client', 'id_client_type = 2'); ?></h4>

                                    <p>Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-user-plus"></i>
                                </div>
                                <a href="index.php?page=view_customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 col-xs-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs">
                                    <li class="pull-left header"><i class="fa fa-pie-chart"></i>Reports</li>
                                    <li class="active"><a href="#sales-report" data-toggle="tab">Sales</a></li>
                                    <li><a href="#purchase-report" data-toggle="tab">Purchases</a></li>
                                    <li><a href="#customer-payment-report" data-toggle="tab">Debtors</a></li>
                                    <li><a href="#supplier-payment-report" data-toggle="tab">Creditors</a></li>
                                    <li><a href="#income-report" data-toggle="tab">Incomes</a></li>
                                    <li><a href="#expense-report" data-toggle="tab">Expenses</a></li>
                                    <li><a href="#income-statement-report" data-toggle="tab">Income Statement</a></li>
                                    <!--<li><a href="#balance-sheet-report" data-toggle="tab">Balance Sheet</a></li>-->
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="sales-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <?php
                                        $bal_msg = "";
                                        $edit_msg = "Edit";
                                        $del_msg = "Delete";
                                        if (Input::exists() && Input::get('search_sales') == 'search_sales') {
                                        $from = Input::get('from');
                                        $to = Input::get('to');
                                        if (!empty($from) &&!empty($to)) {
                                        $sales_header = 'Sales from ' . $from . ' to ' . $to;
                                        $from = $from . ' 00:00:00';
                                        $to = $to . ' 23:59:59';
                                        $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND p.payment_date BETWEEN '$from' AND '$to' AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
                                        } else {
                                        $sales_header = 'Recent Sales';
                                        $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
                                        }
                                        } else {
                                        $sales_header = 'Recent Sales';
                                        $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 GROUP BY s.id_stock DESC");
                                        }
                                        ?>
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title"><?php echo $sales_header; ?></h3>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">From</div>
                                                            <input type="date" class="form-control" name="from" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">To</div>
                                                            <input type="date" class="form-control" name="to" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                                                        <button type="submit" class="btn btn-primary" name="search_sales" value="search_sales">Search</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>DATE & TIME</th>
                                                        <th>PRODUCT</th>
                                                        <th>SALES_PRICE</th>
                                                        <th>BALANCE</th>
                                                        <th>CUSTOMER</th>
                                                        <th style="width: 70px;">OPTIONS</th>
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
                                                        <td>
                                                            <?php
                                                            $sales_price = $sales_query->stock_price;
                                                            echo number_format($sales_query->stock_price, 2);
                                                            ?>
                                                        </td>
                                                        <!--<td>-->
                                                        <?php
                                                        $total_pay = selectSum('payments', 'payment_amount', 'id_stock ="' . $sales_query->id_stock . '" AND id_stock_price_type = 2');
                                                        $balance = $sales_price - $total_pay;
                                                        ?>
                                                        <!--</td>-->

                                                        <td><?php
                                                            echo number_format($balance, 2);
                                                            ?></td>

                                                        <td><?php echo $sales_query->name; ?></td>
                                                        <td><div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="index.php?page=view_sales_single&id=<?php echo $sales_query->id_client; ?>&user=<?php echo $sales_query->name; ?>&product=<?php echo getProductName($sales_query->id_stock); ?>&idstock=<?php echo $sales_query->id_stock; ?>" style="color: #72afd2;">View Payments</a></li>
                                                                    <li><a data-toggle="modal" href="#pay-sales-balance-form<?php echo $sales_query->id_stock; ?>" style="color: #72afd2;">Pay Balance</a></li>
                                                                    <li id="delete_link"><a data-toggle="modal" href="#sales_delete_form<?php echo $sales_query->id_stock; ?>" style="color: #72afd2;">Delete</a></li>

                                                                </ul>
                                                            </div>
                                                        </td>
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
                                                                                <input type="hidden" name="idclient" value="<?php echo $sales_query->id_client; ?>">
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
                                                                                       off" value="<?php echo getProductName($sales_query->id_stock); ?>">
                                                                                <input type="hidden" class="form-control" name="product_id" required="true" autocomplete="
                                                                                       off" value="<?php echo $sales_query->id_stock; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Sales Price</label>
                                                                                <input type="text" class="form-control" disabled="true" required="true" autocomplete="
                                                                                       off" value="<?php echo number_format($sales_price, 2); ?>">
                                                                                <input type="hidden" name="sales_price" value="<?php echo $sales_price; ?>">
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
                                                                                <input type="hidden" id="outstanding_balance" name="outstanding_balance"  autocomplete="
                                                                                       off" value="<?php echo $balance; ?>" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Amount To Pay</label>
                                                                                <input type="number" class="form-control" name="balance_pay" id="balance_pay" required="true" autocomplete="
                                                                                       off" onkeyup="controlPaymentInput()">
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
                                                <div class="modal modal-default fade" id="sales_delete_form<?php echo $sales_query->id_stock; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-center text-danger">DELETE ALERT</h4>
                                                            </div>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="idstock" value="<?php echo $sales_query->id_stock; ?>">
                                                                <div class="modal-body">
                                                                    <p class="text-danger text text-center" style="font-size: 16px;">Are you sure you want to delete this record?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success btn-md" name="delete_sale" value="delete_sale">OK</button>
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
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="purchase-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <?php
                                        $del_msg = "";
                                        $bal_msg = "";
                                        $price_msg = "";
                                        if (Input::exists() && Input::get('search_purchases') == 'search_purchases') {
                                        $from = Input::get('from');
                                        $to = Input::get('to');
                                        $purchases_header = 'Purchases from ' . $from . ' to ' . $to;
                                        $query_purchase = DB::getInstance()->query("SELECT * FROM stock WHERE id_stock_price_type = 1 AND purchase_date BETWEEN '$from' AND '$to' ORDER BY id_stock DESC");
                                        } else {
                                        $purchases_header = 'Recent Purchases';
                                        $query_purchase = DB::getInstance()->query("SELECT * FROM stock WHERE id_stock_price_type = 1 ORDER BY id_stock DESC");
                                        }
                                        ?>
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title"><?php echo $purchases_header; ?></h3>
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
                                                        <button type="submit" class="btn btn-primary" name="search_purchases" value="search_purchases">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example3" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>DATE</th>
                                                        <th>PRODUCT</th>
                                                        <th>PURCHASE_PRICE</th>
                                                        <th>PURCHASE_BALANCE</th>
                                                        <th>SUPPLIER</th>
                                                        <th>STATUS</th>
                                                        <th style="width: 70px;">OPTIONS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $x = 1;
                                                    foreach ($query_purchase->results() as $query_purchase):
                                                    $product = getProductName($query_purchase->id_stock);
                                                    $supplier = DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client');
                                                    $idstock = $query_purchase->id_stock;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $query_purchase->purchase_date; ?></td>
                                                        <td><?php echo $product; ?></td>
                                                        <td><?php
                                                            echo number_format(getProuctPrice('stock_prices', $query_purchase->id_stock, 1), 2);
                                                            $cost_price = getProuctPrice('stock_prices', $query_purchase->id_stock, 1);
                                                            ?>
                                                        </td>
                                                        <?php
                                                        $total_pay = selectSum('payments', 'payment_amount', 'id_stock ="' . $query_purchase->id_stock . '" AND id_stock_price_type = 1');
                                                        $balance = $cost_price - $total_pay;
                                                        ?>
                                                        <td><?php echo number_format($balance, 2); ?></td>
                                                        <td><?php echo $supplier; ?></td>
                                                        <td><?php
                                                            echo $query_purchase->stock_status;
                                                            $status = $query_purchase->stock_status;
                                                            ?></td>
                                                        <td><div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="index.php?page=view_purchases_single&id=<?php echo $query_purchase->id_client; ?>&user=<?php echo $supplier; ?>&product=<?php echo getProductName($query_purchase->id_stock); ?>&idstock=<?php echo $query_purchase->id_stock; ?>" style="color: #72afd2;">View Payment</a></li>
                                                                    <li><a data-toggle="modal" href="#pay-purchases-balance-form<?php echo $query_purchase->id_stock; ?>" style="color: #72afd2;">Pay Balance</a></li>
                                                                    <li ><a data-toggle="modal" href="#pay-purchases-edit-form<?php echo $query_purchase->id_stock; ?>" style="color: #72afd2;">Edit</a></li>
                                                                    <li id="delete_link"><a data-toggle="modal" href="#purchases_delete_form<?php echo $idstock; ?>" style="color: #72afd2;">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                <div class="modal modal-default fade" id="pay-purchases-balance-form<?php echo $query_purchase->id_stock; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-primary text-center">BALANCE PAYMENT FORM</h4>
                                                            </div>
                                                            <form action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title text-success">Purchase Payment</h3>
                                                                    </div>
                                                                    <div class="box-body">
                                                                        <input type="hidden" name="idclient" value="<?php echo $query_purchase->id_client; ?>">
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-8">
                                                                                <label class="text-info">Supplier Name</label>
                                                                                <input type="text" class="form-control" disabled="true" value="<?php echo DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client'); ?>" >
                                                                            </div>

                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Receipt</label>
                                                                                <p><strong  class="text-danger"  style="font-size: 25px;"><?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?></strong></p>
                                                                                <input type="hidden" name="payment_receipt" value="<?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?>">

                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Product</label>
                                                                                <input type="text" class="form-control" disabled="true" value="<?php
                                                                                echo getProductName($query_purchase->id_stock);
                                                                                ?>">
                                                                                <input type="hidden" name="idstock" value="<?php echo $query_purchase->id_stock; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Purchase Price</label>
                                                                                <input type="text" class="form-control" disabled="true" value="<?php echo number_format($cost_price, 2); ?>">
                                                                                <input type="hidden" name="purchase_price" value="<?php echo $cost_price; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Amount Paid</label>
                                                                                <input type="text" class="form-control" disabled="true" value="<?php echo number_format($total_pay, 2); ?>">
                                                                                <input type="hidden" name="amount_paid" value="<?php echo $total_pay; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Balance</label>
                                                                                <input type="text" class="form-control" disabled="true"  value="<?php echo number_format($balance, 2); ?>">
                                                                                <input type="hidden" name="purchase_balance" value="<?php echo $balance; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Amount To Pay</label>
                                                                                <input type="text" class="form-control" name="amount_to_pay" value="" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="save_purchase_payment" value="save_purchase_payment" class="btn btn-success btn-md">Record</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <div class="modal modal-default fade" id="pay-purchases-edit-form<?php echo $query_purchase->id_stock; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-primary text-center">STOCK EDIT FORM</h4>
                                                            </div>
                                                            <form action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title text-success">Purchase Edit</h3>
                                                                    </div>
                                                                    <div class="box-body">

                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Supplier Name</label>
                                                                                <select class="form-control select2 " name="idclient" style="width: 100%">
                                                                                    <option value="<?php echo $query_purchase->id_client; ?>"><?php echo DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client'); ?></option>
                                                                                    <?php
                                                                                    $supplier_query = "SELECT * FROM clients WHERE id_client_type = 2";
                                                                                    $suppliers = DB::getInstance()->query($supplier_query);
                                                                                    foreach ($suppliers->results() as $suppliers) {
                                                                                    ?>
                                                                                    <option value="<?php echo $suppliers->id_client; ?>"><?php echo $suppliers->name . ' ' . $suppliers->address . ' ' . $suppliers->telephone; ?></option>

                                                                                    <?php } ?>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <input type="hidden" name="idstock" value="<?php echo $idstock; ?>">
                                                                            <?php
                                                                            $id_stock_name = 0;
                                                                            $stock_make = '';
                                                                            $chasis = '';
                                                                            $engine = '';
                                                                            $plate = '';
                                                                            $id_stock_color = 0;
                                                                            $color = '';

                                                                            $stock_query = DB::getInstance()->query("SELECT * FROM stock_name n,stock_color c,stock s WHERE s.id_stock_name = n.id_stock_name AND s.id_stock_color = c.id_stock_color AND s.id_stock = $idstock");
                                                                            foreach ($stock_query->results() as $stock_query) {
                                                                            $id_stock_name = $stock_query->id_stock_name;
                                                                            $stock_make = $stock_query->stock_make . ' ' . $stock_query->stock_model;
                                                                            $chasis = $stock_query->chasis_number;
                                                                            $engine = $stock_query->engine_number;
                                                                            $plate = $stock_query->plate_number;
                                                                            $id_stock_color = $stock_query->id_stock_color;
                                                                            $color = $stock_query->color_name;
                                                                            }
                                                                            ?>
                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Brand</label>
                                                                                <select  class="form-control select2 " name="stock_name"  style="width: 100%;" required>
                                                                                    <option value="<?php echo $id_stock_name; ?>" ><?php echo $stock_make; ?></option>
                                                                                    <?php
                                                                                    $brand_names = DB::getInstance()->query("SELECT * FROM stock_name");
                                                                                    foreach ($brand_names->results() as $brand) {
                                                                                    ?>
                                                                                    <option  value="<?php echo $brand->id_stock_name; ?>"><?php echo $brand->stock_manufacturer . ': ' . $brand->stock_make . ' ' . $brand->stock_model; ?></option>    
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Chasis Number</label>
                                                                                <input type="text" class="form-control" name="chasis_number" placeholder="Enter" required="true" autocomplete="
                                                                                       off" value="<?php echo $chasis; ?>">
                                                                            </div>
                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Engine Number</label>
                                                                                <input type="text" class="form-control" name="engine_number" placeholder="Enter" required="true" autocomplete="
                                                                                       off" value="<?php echo $engine; ?>">
                                                                            </div>

                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Plate Number</label>
                                                                                <input type="text" class="form-control" name="plate_number" placeholder="Enter" required="true" autocomplete="
                                                                                       off" value="<?php echo $plate; ?>">
                                                                            </div>
                                                                            <div class="col-xs-4">
                                                                                <label class="text-info">Color</label>
                                                                                <select class="form-control select2 " name="car_color" style="width: 100%" required="true">
                                                                                    <option value="<?php echo $id_stock_color; ?>"><?php echo $color; ?></option>
                                                                                    <?php
                                                                                    $color_query = "SELECT * FROM stock_color";
                                                                                    $stock_colors = DB::getInstance()->query($color_query);
                                                                                    foreach ($stock_colors->results() as $colors) {
                                                                                    ?>
                                                                                    <option value="<?php echo $colors->id_stock_color; ?>"><?php echo $colors->color_name; ?></option>

                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Purchase Price</label>
                                                                                <input type="text" class="form-control" name="purchase_price" value="<?php echo $cost_price; ?>" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="save_purchase_edit" value="save_purchase_edit" class="btn btn-success btn-md">Record</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <div class="modal modal-default fade" id="purchases_delete_form<?php echo $query_purchase->id_stock; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-center text-danger">DELETE ALERT</h4>
                                                            </div>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="idstock" value="<?php echo $query_purchase->id_stock; ?>">
                                                                <div class="modal-body">
                                                                    <p class="text-danger text text-center" style="font-size: 16px;">Are you sure you want to delete this record?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success btn-md" name="delete_purchase" value="delete_purchase">OK</button>
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
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="customer-payment-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Showing Debtors</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example4" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>CLIENT</th>
                                                        <th>PRODUCT</th>
                                                        <th>DEBT AMOUNT</th>
                                                        <th>PAYMENT DATE</th>
                                                        <th>OPTIONS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $x=1;
                                                    $query_sales = DB::getInstance()->query("SELECT * FROM stock s,stock_prices p WHERE s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type = 2");
                                                    foreach ($query_sales->results() as $query_sales):
                                                    $idstock = $query_sales->id_stock;
                                                    $purchase_price = $query_sales -> stock_price;
                                                    $amount_paid = selectSum('payments','payment_amount','id_stock = '.$idstock.' AND id_stock_price_type=2');
                                                    $debtor = getSpecificDetails('client_orders o,clients c','name','o.id_client = c.id_client AND o.id_stock = '.$idstock.'');
                                                    $debt_amount = $purchase_price - $amount_paid;
                                                    if($debt_amount>0){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x;?></td>
                                                        <td><?php echo $debtor;?></td>
                                                        <td><?php echo getProductName($idstock);?></td>
                                                        <td><?php echo number_format($debt_amount,2);?></td>
                                                        <td></td>
                                                        <td><div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="#pay-purchases-balance-form" style="color: #72afd2;">Pay Balance</a></li>
                                                                    <li ><a data-toggle="modal" href="#pay-purchases-edit-form" style="color: #72afd2;">Edit</a></li>
                                                                    <li id="delete_link"><a data-toggle="modal" href="#purchases_delete_form" style="color: #72afd2;">Delete</a></li>
                                                                </ul>
                                                            </div></td>
                                                    </tr>
                                                    <?php }
                                                    $x++;
                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="supplier-payment-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Supplier Payments</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example5" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>CLIENT</th>
                                                        <th>PRODUCT</th>
                                                        <th>TOTOAL COST</th>
                                                        <th>AMOUNT PAID</th>
                                                        <th>BALANCE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $payments_query = DB::getInstance()->query("SELECT * FROM clients c,stock s, stock_prices p WHERE c.id_client = s.id_client AND s.id_stock = p.id_stock AND p.id_stock_price_type = 2 AND c.id_client_type = 2 GROUP BY s.id_stock ");
                                                    $x = 1;
                                                    foreach ($payments_query->results() as $payments_query):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $payments_query->name; ?></td>
                                                        <td><?php echo getProductName($payments_query->id_stock); ?></td>
                                                        <td><?php
                                                            $cost_price = getProuctPrice('stock_prices', $payments_query->id_stock, $payments_query->id_stock_price_type);
                                                            echo number_format($cost_price, 2);
                                                            ?></td>
                                                        <td><?php
                                                            $total_pay = selectSum("payments", "payment_amount", "id_stock_price_type = 1 AND id_stock =$payments_query->id_stock");
                                                            echo number_format($total_pay, 2);
                                                            ?></td>
                                                        <td><?php echo number_format(($cost_price - $total_pay), 2) ?></td>
                                                    </tr>
                                                    <?php
                                                    $x++;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="income-report" style="position: relative; height: auto;">
                                        <?php
                                        if (Input::exists() && Input::get('search_income') == 'search_income') {
                                        $from = Input::get('from');
                                        $to = Input::get('to');
                                        if (!empty($from) &&!empty($to)) {
                                        $income_header = 'Incomes Received from ' . $from . ' to ' . $to;
                                        $from = $from . ' 00:00:00';
                                        $to = $to . ' 23:59:59';
                                        $income_query = DB::getInstance()->query("SELECT * FROM incomes i, income_sources s, clients c WHERE c.id_client = i.id_client AND i.income_date BETWEEN '$from' AND '$to' AND s.id_income_source = i.id_income_source");
                                        } else {
                                        $income_header = 'Recent Incomes Received';
                                        $income_query = DB::getInstance()->query("SELECT * FROM incomes i, income_sources s, clients c WHERE c.id_client = i.id_client AND s.id_income_source = i.id_income_source");
                                        }
                                        } else {
                                        $income_header = 'Recent Incomes Received';
                                        $income_query = DB::getInstance()->query("SELECT * FROM incomes i, income_sources s, clients c WHERE c.id_client = i.id_client AND s.id_income_source = i.id_income_source");
                                        }
                                        ?>
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title"><?php echo $income_header; ?></h3>
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
                                                        <button type="submit" class="btn btn-primary" name="search_income" value="search_income">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example7" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>DATE</th>
                                                        <th>INCOME FROM</th>
                                                        <th>INCOME TYPE</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $x = 1;
                                                    foreach ($income_query->results() as $income_query):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $income_query->income_date; ?></td>
                                                        <td><?php echo $income_query->name; ?></td>
                                                        <td><?php echo $income_query->source_name; ?></td>
                                                        <td><?php echo number_format($income_query->income_amount, 2); ?></td>
                                                    </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="expense-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <?php
                                        if (Input::exists() && Input::get('search_expense') == 'search_expense') {
                                        $from = Input::get('from');
                                        $to = Input::get('to');
                                        if (!empty($from) &&!empty($to)) {
                                        $expense_header = 'Expenses from ' . $from . ' to ' . $to;
                                        $from = $from . ' 00:00:00';
                                        $to = $to . ' 23:59:59';
                                        $expense_query = DB::getInstance()->query("SELECT * FROM expenditures e, expenditure_sources sr, stock s WHERE s.id_stock = e.id_stock AND sr.id_expenditure_source = e.id_expenditure_source AND e.expense_date BETWEEN '$from' AND '$to' ORDER BY e.expense_date DESC");
                                        } else {
                                        $expense_header = 'Recent Expenses';
                                        $expense_query = DB::getInstance()->query("SELECT * FROM expenditures e, expenditure_sources sr, stock s WHERE s.id_stock = e.id_stock AND sr.id_expenditure_source = e.id_expenditure_source ORDER BY e.expense_date DESC");
                                        }
                                        } else {
                                        $expense_header = 'Recent Expenses';
                                        $expense_query = DB::getInstance()->query("SELECT * FROM expenditures e, expenditure_sources sr, stock s WHERE s.id_stock = e.id_stock AND sr.id_expenditure_source = e.id_expenditure_source ORDER BY e.expense_date DESC");
                                        }
                                        ?>
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title"><?php echo $expense_header; ?></h3>
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
                                                        <button type="submit" class="btn btn-primary" name="search_expense" value="search_expense">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example6" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>DATE</th>
                                                        <th>EXPENDITURE ON</th>
                                                        <th>EXPENSE TYPE</th>
                                                        <th>AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $x = 1;
                                                    foreach ($expense_query->results() as $expense_query):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $expense_query->expense_date; ?></td>
                                                        <td><?php
                                                            $product = DB::getInstance()->getName('stock_name', $expense_query->id_stock_name, 'stock_make', 'id_stock_name')
                                                            . ' ' . DB::getInstance()->getName('stock_name', $expense_query->id_stock_name, 'stock_model', 'id_stock_name');
                                                            echo $product;
                                                            ?></td>
                                                        <td><?php echo $expense_query->expenditure_name; ?></td>
                                                        <td><?php echo number_format($expense_query->expense_amount, 2); ?></td>
                                                    </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="income-statement-report" style="position: relative; height: auto;">
                                        <?php
                                        $sales_amount = 0;
                                        if (Input::exists() && Input::get('search_income_statement') == 'search_income_statement') {
                                        $from = Input::get('from');
                                        $to = Input::get('to');
                                        if (!empty($from) &&!empty($to)) {
                                        $header_income_statement = 'Income Statement from ' . $from . ' to ' . $to;
                                        $sales_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2 AND payment_date BETWEEN '$from' AND '$to'"), 2);
                                        } else {
                                        $header_income_statement = 'Income Statement';
                                        }
                                        } else {
                                        $header_income_statement = 'Income Statement';
                                        $sales_amount = number_format(selectSum("payments", "payment_amount", "id_stock_price_type = 2"), 2);
                                        }
                                        ?>
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title"><?php echo $header_income_statement ?></h3>
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
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
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
                                        <!-- </div> -->
                                    </div>
                                    <div class="chart tab-pane" id="balance-sheet-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Balance Sheet</h3>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">
                                                                From
                                                            </div>
                                                            <input type="date" class="form-control" name="balance_date" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5">
                                                        <div class="input-group ">
                                                            <div class="input-group-addon">
                                                                To
                                                            </div>
                                                            <input type="date" class="form-control" name="balance_date" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                                                        <input type="submit" class="btn btn-primary" name="search" value="Search">
                                                    </div>
                                                </form>
                                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary">Options</button>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <!-- <li><a data-toggle="modal" href="index.php?page=print&columns=4&type=report&sub_type=balance_sheet&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li> -->
                                                            <!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                                                                                        <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-hover">
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
                                                    </tr>
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </section>
                    </div>
                </section>
                <!-- /.content -->
            </div>
<?php include 'includes/footer.php'; ?>
    </body>
</html>
