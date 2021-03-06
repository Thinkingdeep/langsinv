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
                        <li class="active">View Sales Single</li>
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
                if (Input::exists() && Input::get('save_payment_edits') == 'save_payment_edits') {
                    $id_payment = Input::get('id_payment');
                    $arrayPayment = array("payment_amount" => Input::get('amount_paid'));
                    if (DB::getInstance()->update('payments', $id_payment, $arrayPayment, 'id_payment')) {
                        $entry_alert = submissionReport('success', 'Payment updated successfully');
                    } else {
                        $entry_alert = submissionReport('error', 'Failure in updating payment');
                    }
                }elseif (Input::exists() && Input::get('delete_payment') == 'delete_payment') {
                    $id_payment = Input::get('id_payment');
                    if (DB::getInstance()->query("DELETE FROM payments WHERE id_payment = $id_payment")) {
                        $entry_alert = submissionReport('success', 'Payment deleted successfully');
                    } else {
                        $entry_alert = submissionReport('error', 'Failure in deleting payment');
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
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="box-title">Showing Payments for <?php echo $product; ?><br><br>
                                        Customer name <?php echo $user; ?></h3>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action
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
                            <div class="col-xs-9">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>DATE</th>
                                        <!-- <th>PRODUCT</th> -->
                                        <th>SALES_PRICE</th>
                                        <th>AMOUNT_PAID</th>
                                        <th>SALES_BALANCE</th>
                                        <th style="width: 100px;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
// $bal_msg = "";
// $edit_msg = "Edit";
// $del_msg = "Delete";
                                    $total_pay = 0;
                                    $sales_query = DB::getInstance()->query("SELECT * FROM stock s,clients c, stock_name n, stock_prices sk,payments p WHERE s.stock_sold_to =c.id_client AND s.id_stock = sk.id_stock AND s.id_stock_name = n.id_stock_name AND s.id_stock = p.id_stock AND s.stock_status = 'SOLD' AND p.id_stock_price_type =2 AND sk.id_stock_price_type =2 AND c.id_client = $id AND s.id_stock=$idstock");
                                    $x = 1;
                                    foreach ($sales_query->results() as $sales_query):
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo date("Y-m-d",$sales_query->payment_date); ?></td>
                                            <td><?php
                                                $sales_price = $sales_query->stock_price;
                                                echo number_format($sales_query->stock_price, 2);
                                                ?></td>
                                            <td> <?php echo number_format($sales_query->payment_amount, 2); ?></td>
                                            <td><?php
                                                $total_pay += $sales_query->payment_amount;
                                                $balance = $sales_price - $total_pay;
                                                if ($balance > 0) {
                                                    $bal_msg = "Pay Balance";
                                                } else {
                                                    $bal_msg = "";
                                                }
                                                echo number_format($balance, 2);
                                                ?></td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="index.php?page=print_receipt&type=cash_sale&idstock=<?php echo $sales_query->id_stock;?>&price=<?php echo $sales_price;?>&amt_pd=<?php echo $total_pay;?>&bal=<?php echo $balance;?>&ticket=<?php echo $sales_query->payment_receipt;?>&idclient=<?php echo $sales_query->id_client;?>&occurred=<?php echo $sales_query->payment_date;?>" style="color: #72afd2;">Print Receipt</a></li>
                                                         <li><a data-toggle="modal" href="#sales_edit_form<?php echo $sales_query->id_payment; ?>" style="color: #72afd2;">Edit</a></li> 
                                                        <li><a data-toggle="modal" href="#sales_delete_form<?php echo $sales_query->id_payment; ?>" style="color: #72afd2;">Delete</a></li>
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
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Customer Name</label>
                                                                    <input type="text" class="form-control" name="make" required="true" autocomplete="
                                                                           off" value="<?php echo $sales_query->name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Product</label>
                                                                    <input type="text" class="form-control" name="model" required="true" autocomplete="
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
                                                                <div class="col-xs-6">
                                                                    <label class="text-info">Amount To Pay</label>
                                                                    <input type="number" class="form-control" name="balance_pay" id="balance_pay" required="true" autocomplete="
                                                                           off">
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="text-info">Receipt</label>
                                                                    <p><strong  class="text-danger"  style="font-size: 25px;"><?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?></strong></p>
                                                                    <input type="hidden" name="sales_receipt" value="<?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?>">

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
                                <div class="modal modal-default fade" id="sales_delete_form<?php echo $sales_query->id_payment; ?>">
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
                                                                <input type="hidden" name="id_payment" value="<?php echo $sales_query->id_payment; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                            <button type="submit" name="delete_payment" value="delete_payment" class="btn btn-success btn-md">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    <div class="modal modal-default fade" id="sales_edit_form<?php echo $sales_query->id_payment; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title text-primary text-center">CASH ENTRY EDIT FORM</h4>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title text-success">Sales Transaction Edit</h3>
                                                            </div>
                                                            <div class="box-body">

                                                                <div class="row form-group">
                                                                    <input type="hidden" name="id_payment" value="<?php echo $sales_query->id_payment; ?>">
                                                                           <div class="col-xs-12">
                                                                        <label class="text-info">Product</label>
                                                                        <input type="text" class="form-control" disabled="true" value="<?php echo $product; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <div class="col-xs-12">
                                                                        <label class="text-info">Sales Price</label>
                                                                        <input type="text" class="form-control" disabled="true" value="<?php echo number_format($sales_price, 2); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <div class="col-xs-12">
                                                                        <label class="text-info">Amount Paid</label>
                                                                        <input type="text" class="form-control" name="amount_paid" value="<?php echo $sales_query->payment_amount; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" name="save_payment_edits" value="save_payment_edits" class="btn btn-success btn-md">Record</button>
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
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th><?php echo number_format($sales_price,2);?></th>
                                        <th><?php echo number_format($total_pay,2);?></th>
                                        <th><?php echo number_format($balance,2);?></th>
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
                  <td>Expenses</td>
                  <td><?php echo number_format($product_expenses,2); ?></td>
                </tr>
                <tr>
                  <td><strong>Total cost</strong></td>
                  <td><?php echo number_format($product_costs,2);?></td>
                </tr>
                <tr>
                  <td>Sales price</td>
                  <td><?php echo number_format($sales_price,2);?></td>
                </tr>
                <tr>
                  <td><strong>Profit expected</strong></td>
                  <td><?php echo number_format(($sales_price - $purchase_price),2) ?></td>
                </tr>
                <tr>
                  <td>Amount paid</td>
                  <td><?php echo number_format($total_pay,2);?></td>
                </tr>
                <tr>
                  <td>Balance</td>
                  <td><?php echo number_format($balance,2);?></td>
                </tr>
                <?php 
                    $capital_recovered = 0;
                    $profit_recovered = 0;
                    if($total_pay > $purchase_price){
                        $capital_recovered = $purchase_price;
                        $profit_recovered = $total_pay - $purchase_price;
                    }else{
                        $capital_recovered = $total_pay;
                        $profit_recovered = 0;
                    }
                ?>
                <tr>
                  <td><strong>Capital recovered</strong></td>
                  <td><?php echo number_format($capital_recovered,2); ?></td>
                </tr>
                <tr>
                  <td><strong>Profit recovered</strong></td>
                  <td><?php echo number_format($profit_recovered,2); ?></td>
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
