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
                                    <i class="fa fa-arrow-down"></i>
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
                                    <i class="fa fa-arrow-up"></i>
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

                                    <p>Stock count</p>
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
                                    <h4><?php echo countEntries('clients', 'id_client', 'id_client_type = 1'); ?></h4>

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
                                    <li><a href="#customer-payment-report" data-toggle="tab">Customer Payments</a></li>
                                    <li><a href="#supplier-payment-report" data-toggle="tab">Supplier Payments</a></li>
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
                                            if (!empty($from) && !empty($to)) {
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
                                                        <th>RECEIPT</th>
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
                                                            <td><a href="index.php?page=view_sales_single&id=<?php echo $sales_query->stock_sold_to; ?>"><?php echo $sales_query->name; ?></a></td>
                                                            <td><?php echo $sales_query->payment_receipt; ?></td>
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
                                        if (Input::exists() && Input::get('save_price') == 'save_price') {
                                            $stock_id = Input::get('id_stock');
                                            $sales_price = Input::get('sales_price');
                                            $arraySalesPrice = array("stock_price" => $sales_price, "id_stock_price_type" => 2, "id_stock" => $stock_id);

                                            if (DB::getInstance()->insert("stock_prices", $arraySalesPrice)) {
                                                $entry_alert = submissionReport("success", "Price set successfully");
                                            } else {
                                                $entry_alert = submissionReport("error", "Failed to set product price");
                                            }
                                        } elseif (Input::exists() && Input::get('search_purchases') == 'search_purchases') {
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
                                                        <th>SALES_PRICE</th>
                                                        <th>STATUS</th>
                                                        <th style="width: 70px;">ACTION</th>
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
                                                            <td><a href="index.php?page=view_purchases_single&id=<?php echo $query_purchase->id_client; ?>"><?php echo $supplier; ?></a></td>
                                                            <?php
                                                            $sales_price = getProuctPrice('stock_prices', $query_purchase->id_stock, 2);
                                                            if ($sales_price <= 0) {
                                                                echo '<td><button class="btn btn-primary">NOT SET</button></td>';
                                                            } else {
                                                                ?>
                                                                <td><?php
                                                                    echo number_format($sales_price, 2);
                                                                }
                                                                ?></td>

                                                            <td><?php
                                                                echo $query_purchase->stock_status;
                                                                $status = $query_purchase->stock_status;
                                                                if (($balance > 0) && ($status == 'NOT SOLD') && ($sales_price <= 0)) {
                                                                    $bal_msg = 'Pay Balance';
                                                                    $del_msg = 'Delete';
                                                                    $price_msg = 'Set Price';
                                                                } elseif (($balance > 0) && ($sales_price > 0)) {
                                                                    $bal_msg = 'Pay Balance';
                                                                } elseif (($balance > 0) && ($status == 'NOT SOLD' || $status == 'SOLD') && ($sales_price <= 0)) {
                                                                    $bal_msg = 'Pay Balance';
                                                                } elseif ($balance <= 0 && $sales_price <= 0) {
                                                                    $price_msg = 'all';
                                                                } else {
                                                                    $del_msg = '';
                                                                    $bal_msg = '';
                                                                    $price_msg = 'none';
                                                                }
                                                                ?></td>
                                                            <td><div class="btn-group">
                                                                    <button type="button" class="btn btn-default">Action</button>
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                        <span class="caret"></span>
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu" style="">
                                                                        <li style="display: none;"><a data-toggle="modal" href="#set-sales_price-form<?php echo $idstock; ?>" style="color: #72afd2;">SET PRICE</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                    <div class="modal modal-default fade" id="set-sales_price-form<?php echo $idstock; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title text-primary text-center">PRODUCT PRICING FORM</h4>
                                                                </div>
                                                                <form action="" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="box-header with-border">
                                                                            <h3 class="box-title text-success">Product</h3>
                                                                        </div>
                                                                        <div class="box-body">
                                                                            <input type="hidden" name="id_stock" value="<?php echo $idstock; ?>">
                                                                            <div class="row form-group">
                                                                                <div class="col-xs-12">
                                                                                    <label class="text-info">Product Name</label>
                                                                                    <input type="text" class="form-control" disabled="true" value="<?php
                                                                                    echo DB::getInstance()->getName('stock_name', $query_purchase->id_stock_name, 'stock_make', 'id_stock_name')
                                                                                    . ' ' . DB::getInstance()->getName('stock_name', $query_purchase->id_stock_name, 'stock_model', 'id_stock_name');
                                                                                    ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-xs-12">
                                                                                    <label class="text-info">Supplier</label>
                                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client'); ?>" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-xs-12">
                                                                                    <label class="text-info">Purchase Price</label>
                                                                                    <input type="text" class="form-control" disabled="true" value="<?php echo number_format($cost_price, 2); ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <div class="col-xs-12">
                                                                                    <label class="text-info">Sales Price</label>
                                                                                    <input type="number" class="form-control" name="sales_price" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name="save_price" value="save_price" class="btn btn-success btn-md">Save</button>
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
                                                    <h3 class="box-title">Recent Customer Payments</h3>
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
                                                        <th>CLIENT TYPE</th>
                                                        <th>PRODUCT</th>
                                                        <th>TOTOAL COST</th>
                                                        <th>AMOUNT PAID</th>
                                                        <th>BALANCE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $payments_query = DB::getInstance()->query("SELECT * FROM clients c,stock s, stock_prices p WHERE c.id_client = s.id_client AND s.id_stock = p.id_stock AND p.id_stock_price_type = 1 AND c.id_client_type = 1 GROUP BY s.id_stock ");
                                                    $x = 1;
                                                    foreach ($payments_query->results() as $payments_query):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $x; ?></td>
                                                            <td><?php echo $payments_query->name; ?></td>
                                                            <td><?php echo DB::getInstance()->getName("client_types", $payments_query->id_client_type, "type_name", "id_client_type"); ?></td>
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
                                            if (!empty($from) && !empty($to)) {
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
                                            if (!empty($from) && !empty($to)) {
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
                                            if (!empty($from) && !empty($to)) {
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
                                                        <button type="button" class="btn btn-primary">Action</button>
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
