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
                        Stock
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock</li>
                        <li class="active">View Purchases</li>
                    </ol>
                </section>
                <?php
                if (Input::exists() && Input::get('save_edit') == 'save_edit') {
                    $stock_id = Input::get('id_stock');
                    $supplier_id = Input::get('id_supplier');
                    $cash_paid = Input::get('cash_to_pay');
                    $receipt_number = Input::get('purchases_receipt');

                    $arrayPayment = array("payment_amount" => $cash_paid, "id_stock_price_type" => 1, "payment_date" => date("Y-m-d h:i:s"), "payment_receipt" => $receipt_number, "id_stock" => $stock_id);

                    if (DB::getInstance()->insert("payments", $arrayPayment)) {

                        $entry_alert = submissionReport("success", "Payment recorded successfully");
                        Redirect::to();
                    } else {
                        $entry_alert = submissionReport("error", "Failed to submit payment");
                    }
                } elseif (Input::exists() && Input::get('delete_purchase') == 'delete_purchase') {

                    $stock_id = Input::get('id_stock');

                    if (DB::getInstance()->delete("stock", $stock_id)) {

                        $entry_alert = submissionReport("success", "Record deleted successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to delete record");
                    }
                } elseif (Input::exists() && Input::get('save_price') == 'save_price') {
                    $stock_id = Input::get('id_stock');
                    $sales_price = Input::get('sales_price');
                    $arraySalesPrice = array("stock_price" => $sales_price, "id_stock_price_type" => 2, "id_stock" => $stock_id);

                    if (DB::getInstance()->insert("stock_prices", $arraySalesPrice)) {
                        $entry_alert = submissionReport("success", "Price set successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to set product price");
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
                                        <th>PURCHASE PRICE</th>
                                        <th>PURCHASE BALANCE</th>
                                        <th>SUPPLIER</th>
                                        <th>SALES PRICE</th>
                                        <th>STATUS</th>
                                        <th style="width:70px;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $del_msg = "";
                                    $edit_msg = "";
                                    $bal_msg = "";
                                    $price_msg = "";
                                    $query_purchase = DB::getInstance()->query("SELECT * FROM stock WHERE id_stock_price_type = 1 ORDER BY id_stock DESC");
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
                                            <td><a href="index.php?page=view_purchases_single&id=<?php echo $query_purchase->id_client;?>"><?php echo $supplier; ?></a></td>
                                            <?php
                                            $sales_price = getProuctPrice('stock_prices', $query_purchase->id_stock, 2);
                                            if ($sales_price <= 0) {
                                                echo '<td><button class="btn btn-primary">NOT SET</button></td>';
                                            } else {
                                                ?>
                                                <td><?php echo number_format($sales_price, 2);
                                    }
                                            ?></td>

                                            <td><?php
                                                echo $query_purchase->stock_status;
                                                $status = $query_purchase->stock_status;
                                                if (($balance > 0) && ($status == 'NOT SOLD') && ($sales_price <= 0)) {
                                                    $bal_msg = 'Pay Balance';
                                                    $del_msg = 'Delete';
                                                    $price_msg = 'Set Price';
                                                    $edit_msg = 'Edit';
                                                } elseif (($balance > 0) && ($sales_price > 0)) {
                                                    $bal_msg = 'Pay Balance';
                                                    $edit_msg = 'Edit';
                                                } elseif ($balance <= 0 && $sales_price <= 0) {
                                                    $price_msg = 'Set Price';
                                                    $edit_msg = 'Edit';
                                                }
                                                ?></td>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="#set-sales_price-form<?php echo $idstock; ?>" style="color: #72afd2;"><?php echo $price_msg; ?></a></li>
                                                        <li><a data-toggle="modal" href="#pay-supp-balance-form<?php echo $idstock; ?>" style="color: #72afd2;"><?php echo $bal_msg; ?></a></li>
                                                         <li><a data-toggle="modal" id="delete_record" href="#delete-stock-form<?php echo $idstock; ?>" style="color: #72afd2;"><?php echo $edit_msg; ?></a></li>
                                                        <li><a data-toggle="modal" id="delete_record" href="#delete-stock-form<?php echo $idstock; ?>" style="color: #72afd2;"><?php echo $del_msg; ?></a></li>
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

                                    <div class="modal modal-default fade" id="pay-supp-balance-form<?php echo $idstock; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-primary text-center">PURCHASES PAYMENT FORM</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title text-success">Product</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <input type="hidden" name="id_stock" value="<?php echo $idstock; ?>">
                                                            <input type="hidden" name="id_supplier" value="<?php echo $query_purchase->id_client; ?>">
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
                                                                    <label class="text-info">Balance</label>
                                                                    <input type="text" class="form-control" value="<?php echo number_format($balance, 2); ?>">
                                                                    <input type="hidden" class="form-control" id="outstanding_balance" value="<?php echo $balance; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-6">
                                                                    <label class="text-info">Amount</label>
                                                                    <input type="text" class="form-control" id="balance_pay" name="cash_to_pay" value="">
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <label class="text-info">Transaction ID</label>
                                                                    <p><strong  class="text-danger"  style="font-size: 25px;"><?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?></strong></p>
                                                                    <input type="hidden" name="purchases_receipt" value="<?php echo generateAutoIncrementNumber('payments', 'id_payment'); ?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="save_edit" value="save_edit" class="btn btn-success btn-md">Record</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal modal-default fade" id="delete-stock-form<?php echo $idstock; ?>">
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
                                                            <input type="hidden" name="id_stock" value="<?php echo $idstock; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                        <button type="submit" name="delete_purchase" value="delete_purchase" class="btn btn-success btn-md">Yes</button>
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
