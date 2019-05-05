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
                        Stock
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock</li>
                        <li class="active">View Purchases Single</li>
                    </ol>
                </section>
                <?php
                $id = Input::get('id');
                $user = Input::get('user');
                $product = Input::get('product');
                $idstock = Input::get('idstock');
                $purchase_price = getProuctPrice('stock_prices', $idstock, 1);
                $product_expenses = selectSum('expenditures','expense_amount', 'id_stock ='.$idstock);
                $product_costs = $purchase_price + $product_expenses;
                ?>

                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="row form-group">
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="box-title">Showing Payments for <?php echo $product; ?><br><br>
                                        Supplier name <?php echo $user; ?></h3>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="">
                                            <li><a data-toggle="modal" href="index.php?page=print&columns=5&type=report&sub_type=purchases&from=00-00-0000&to=00-00-0000" style="color: #72afd2;">Print </a></li>
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
                            <div class="col-xs-9">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>DATE</th>
                                        <th>PURCHASE_PRICE</th>
                                        <th>AMOUNT_PAID</th>
                                        <th>PURCHASE_BALANCE</th>
                                        <th style="width: 100px;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    $purchase_price = 0;
                                    $amount_paid = 0;
                                    $purchase_balance = 0;
                                    $purchase_query = DB::getInstance()->query("SELECT * FROM payments p, stock s WHERE p.id_stock = s.id_stock AND p.id_stock = $idstock AND s.id_client =$id AND p.id_stock_price_type = 1");
                                    foreach($purchase_query ->results() as $purchase_query):?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $purchase_query->payment_date;?></td>
                                            <?php
                                            $purchase_price = getProuctPrice('stock_prices', $idstock,1);
                                            $amount_paid += $purchase_query->payment_amount;
                                            $purchase_balance = $purchase_price - $amount_paid; ?>
                                            <td><?php echo number_format($purchase_price,2); ?></td>
                                            <td><?php echo number_format($purchase_query->payment_amount,2);?></td>
                                            <td><?php echo number_format($purchase_balance,2);?></td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="index.php?page=print_receipt&type=cash_purchase&idstock=<?php echo $purchase_query->id_stock;?>&price=<?php echo $purchase_price;?>&amt_pd=<?php echo $purchase_query->payment_amount;?>&bal=<?php echo $purchase_balance;?>&ticket=<?php echo $purchase_query->payment_receipt;?>&idclient=<?php echo $purchase_query->id_client;?>&occurred=<?php echo $purchase_query->payment_date;?>" style="color: #72afd2;">Print Receipt</a></li>
                                                        <li><a data-toggle="modal" href="#sales-edit-form" style="color: #72afd2;">Edit</a></li>
                                                        <li><a data-toggle="modal" href="#delete-form" style="color: #72afd2;">Delete</a></li>
                                                    </ul>
                                                </div></td>
                                        </tr>
                                    <?php 
                                    $i++;
                                endforeach;?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th><?php echo number_format($purchase_price,2);?></th>
                                        <th><?php echo number_format($amount_paid,2);?></th>
                                        <th><?php echo number_format($purchase_balance,2);?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-xs-3">
                            <div class="box">
            <div class="box-header">
              <h3 class="box-title text-primary">Transaction Summary</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th>Details</th>
                  <th>Amount</th>
                </tr>
                <tr>
                  <td>Purchase price</td>
                  <td><?php echo number_format($purchase_price,2); ?></td>
                </tr>
                <tr>
                  <td>Amount paid</td>
                  <td><?php echo number_format($amount_paid,2);?></td>
                </tr>
                <tr>
                  <td>Balance</td>
                  <td><?php echo number_format($purchase_balance,2);?></td>
                </tr>
                <tr>
                  <td>Expenses</td>
                  <td><?php echo number_format($product_expenses,2); ?></td>
                </tr>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
                        </div>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

            <?php include 'includes/footer.php'; ?>



    </body>


</html>
