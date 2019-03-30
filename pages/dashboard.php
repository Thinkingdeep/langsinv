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
                            <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>Alexander Pierce</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
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
                                    <h4><?php echo number_format(selectSum("payments","payment_amount", "id_stock_price_type = 2"),2);?></h4>

                                    <p>Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h4><?php echo number_format(selectSum("payments","payment_amount", "id_stock_price_type = 1"),2);?></h4>

                                    <p>Purchases</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-arrow-up"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h4><?php echo countEntries("stock","id_stock","stock_status='NOT SOLD'");?></h4>

                                    <p>Stock count</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h4>23</h4>

                                    <p>New Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-user-plus"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                                    <li><a href="#balance-sheet-report" data-toggle="tab">Balance Sheet</a></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="sales-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Sales</h3>
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
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Print</a></li>
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
                                                        <th>NO</th>
                                                        <th>DATE & TIME</th>
                                                        <th>PRODUCT</th>
                                                        <th>CASH PAID</th>
                                                        <th>BALANCE</th>
                                                        <th>CUSTOMER</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.id_client =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 ");
                                                    $x = 1;
                                                    foreach ($sales_query->results() as $sales_query):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $x; ?></td>
                                                            <td><?php echo $sales_query->payment_date; ?></td>
                                                            <td><?php echo $sales_query->stock_make . ' ' . $sales_query->stock_model; ?></td>
                                                            <td><?php
                                                                $sales_price = $sales_query->stock_price;
                                                                $total_pay = selectSum('payments', 'payment_amount', 'id_stock ="' . $sales_query->id_stock . '" AND id_stock_price_type = 2');
                                                                echo number_format(($total_pay), 2);
                                                                $balance = $sales_price -$total_pay;
                                                                ?>
                                                            </td>
                                                            <td><?php echo number_format($balance,2);?></td>
                                                            <td><a href="index.php?page=view_sales_single&id=<?php echo $sales_query->id_client;?>"><?php echo $sales_query->name; ?></a></td>
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
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Purchases</h3>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=5&type=report&sub_type=purchases&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
                                                </div>
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
                                                        <th>PURCHASE PRICE</th>
                                                        <th>STATUS</th>
                                                        <th>SUPPLIER</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query_purchase = DB::getInstance()->query("SELECT * FROM stock ORDER BY id_stock DESC");
                                                    $x = 1;
                                                    foreach ($query_purchase->results() as $query_purchase):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $x; ?></td>
                                                            <td><?php echo $query_purchase->purchase_date; ?></td>
                                                            <td><?php
                                                                echo DB::getInstance()->getName('stock_name', $query_purchase->id_stock_name, 'stock_make', 'id_stock_name')
                                                                . ' ' . DB::getInstance()->getName('stock_name', $query_purchase->id_stock_name, 'stock_model', 'id_stock_name');
                                                                ?></td>
                                                            <td><?php
                                                                try {
                                                                    echo number_format(DB::getInstance()->getName('stock_prices', $query_purchase->id_stock, 'stock_price', 'id_stock'), 2);
                                                                } catch (Exception $e) {
                                                                    echo $e->getMessage();
                                                                }
                                                                ?></td>
                                                            <td><?php echo $query_purchase->stock_status; ?></td>
                                                            <td><a href="index.php?page=view_purchases_single&id=<?php echo $query_purchase->id_client;?>"><?php echo DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client'); ?></a></td>
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
                                    <div class="chart tab-pane" id="customer-payment-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Customer Payments</h3>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=6&type=report&sub_type=customers&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=6&type=report&sub_type=suppliers&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
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
                                                        <th>CLIENT TYPE</th>
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
                                    <div class="chart tab-pane" id="income-report" style="position: relative; height: auto;">
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Incomes Received</h3>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=4&type=report&sub_type=incomes&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
                                                </div>
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
                                                    $income_query = DB::getInstance()->query("SELECT * FROM incomes i, income_sources s, clients c WHERE c.id_client = i.id_client AND s.id_income_source = i.id_income_source");
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
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Recent Expenses</h3>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=4&type=report&sub_type=expenses&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
                                                        </ul>
                                                    </div>
                                                </div>
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
                                                    $expense_query = DB::getInstance()->query("SELECT * FROM expenditures e, expenditure_sources sr, stock s WHERE s.id_stock = e.id_stock AND sr.id_expenditure_source = e.id_expenditure_source ORDER BY e.expense_date DESC");
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
                                        <!-- <div class="box box-danger"> -->
                                        <div class="box-header with-border">
                                            <div class="row form-group">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <h3 class="box-title">Income Statement</h3>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=4&type=report&sub_type=income_statement&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
<!--                                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>-->
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
                                                        <td></td>
                                                        <td></td>
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
                                                            <li><a data-toggle="modal" href="index.php?page=print&columns=4&type=report&sub_type=balance_sheet&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
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
                                                        <td>Gecko</td>
                                                        <td>1.8</td>
                                                        <td>A</td>
                                                        <td>Gecko</td>
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