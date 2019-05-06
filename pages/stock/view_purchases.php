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
                                                    $query_purchase = DB::getInstance()->query("SELECT * FROM stock WHERE id_stock_price_type = 1 ORDER BY id_stock DESC");
                                                    foreach ($query_purchase->results() as $query_purchase):
                                                    $product = getProductName($query_purchase->id_stock);
                                                    $supplier = DB::getInstance()->getName('clients', $query_purchase->id_client, 'name', 'id_client');
                                                    $idstock = $query_purchase->id_stock;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo date("Y-m-d",$query_purchase->purchase_date); ?></td>
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
                                                                                <input type="text" class="form-control" name="amount_to_pay" required autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-xs-12">
                                                                                <label class="text-info">Amount Paid On</label>
                                                                                <input type="date" class="form-control" name="amount_paid_on" required autocomplete="off">
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
                    </div>
                </section>
                <!-- /.section -->
            </div>

            <?php include 'includes/footer.php'; ?>



    </body>

</html>
