
<header class="main-header">
    <!-- Logo -->
    <a href="index.php?page=dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
<!--        <span class="logo-mini">Langas<b>Investments</b></span>
         logo for regular state and mobile devices 
        <span class="logo-lg">Langas<b>Investments</b></span>-->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="btn-group" style="padding-top:10px;">
            <button type="button" class="btn btn-primary">Want to..</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a data-toggle="modal" href="#new-sale-form" style="color: #72afd2;">Sell</a></li>
                <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Buy</a></li>
                <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                <li><a data-toggle="modal" href="#new-customer-form" style="color: #72afd2;">Add New Customer</a></li>
                <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Add New Supplier</a></li>
                <li><a data-toggle="modal" href="#new-income-form" style="color: #72afd2;">Record An Income</a></li>
                <li><a data-toggle="modal" href="#new-expense-form" style="color: #72afd2;">Record Stock Expense</a></li>
            </ul>
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span>Notifiations</span>
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                         
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                        page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="index.php?page=login">
                        <span>Sign out</span>
                        <i class="fa fa-power-off"></i> 
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
<!--                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?php // echo Session::get('session/session_name');?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                         User image 
                                        <li class="user-header">
                                            <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            <p><?php // echo Session::get('session/session_name');?></p>
                                        </li>
                                         Menu Footer
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="index.php?page=profile" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </div>
    </nav>
</header>
<div class="modal modal-default fade" id="new-sale-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">SALES ENTRY FORM</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Sale</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Product</label>
                                <select  class="form-control select2 " id="select_product" name="select_product"  style="width: 100%;">
                                    <option >--select--</option>
                                    <?php
                                    $products_query = DB::getInstance()->query("SELECT * FROM stock s,stock_name n,stock_prices p WHERE p.id_stock = s.id_stock AND s.id_stock_name = n.id_stock_name AND s.stock_status ='NOT SOLD' AND p.id_stock_price_type = 2");
                                    foreach ($products_query->results() as $products_query):
                                        ?>
                                        <option value="<?php echo $products_query->id_stock; ?>" ><?php
                                            echo $products_query->stock_make . ' ' . $products_query->stock_model . ' '
                                            . 'CHS: ' . $products_query->chasis_number . ' EGN: ' . $products_query->engine_number . ' PRICE: ' . number_format($products_query->stock_price, 2);
                                            ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                <input type="hidden" id="amount">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Selected Product</label>
                                <!--<textarea class="form-control" name="display_selected_products" disabled="true"></textarea>-->
                                <table class="table table-stripped table-hover" id="display_selected_products">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Customer</label>
                                <select  class="form-control select2 " name="customer_name"  style="width: 100%;">
                                    <option >--select--</option>
                                    <?php
                                    $query_customer = DB::getInstance()->query("SELECT * FROM clients WHERE id_client_type = 1");
                                    foreach ($query_customer->results() as $query_customer):
                                        ?>
                                        <option value="<?php echo $query_customer->id_client; ?>"><?php echo $query_customer->name . ' ' . $query_customer->address . ' ' . $query_customer->telephone; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-6">
                                <label class="text-info">Cash</label>
                                <input type="number" id="cash" class="form-control" name="product_cash_paid" placeholder="Price(UGX)">
                            </div>
                            <div class="col-xs-6">
                                <label class="text-info">Balance</label>
                                <input type="number" id="balance" class="form-control" disabled="true" name="product_balance" required="true" placeholder="Price(UGX)">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-6">
                                <div id="payment_date">
                                <label class="text-info">Balance payment date</label>
                                <div class="input-group ">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" name="balance_pay_date" >
                                </div>
                            </div>
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
                    <button type="reset" class="btn btn-warning btn-md pull-left" name="cancel_new_sale" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_new_sale" value="save_new_sale" id="print" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="new-purchase-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary text-center">PURCHASES ENTRY FORM</h4>
            </div>
            <?php
            $brand_names = DB::getInstance()->query("SELECT * FROM stock_name");
            ?>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Purchase</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Brand</label>
                                <select  class="form-control select2 " name="stock_name"  style="width: 100%;" required>
                                    <option >--select--</option>
                                    <?php foreach ($brand_names->results() as $brand) { ?>
                                        <option  value="<?php echo $brand->id_stock_name; ?>"><?php echo $brand->stock_manufacturer . ': ' . $brand->stock_make . ' ' . $brand->stock_model; ?></option>    
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-4">
                                <label class="text-info">Chasis Number</label>
                                <input type="text" class="form-control" name="chasis_number" placeholder="Enter" required="true" autocomplete="
                                       off">
                            </div>
                            <div class="col-xs-4">
                                <label class="text-info">Engine Number</label>
                                <input type="text" class="form-control" name="engine_number" placeholder="Enter" required="true" autocomplete="
                                       off">
                            </div>
                            <div class="col-xs-4">
                                <label class="text-info">Plate Number</label>
                                <input type="text" class="form-control" name="plate_number" placeholder="Enter" required="true" autocomplete="
                                       off">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-6">
                                <label class="text-info">Color</label>
                                <select class="form-control select2 " name="car_color" style="width: 100%" required="true">
                                    <option>--select--</option>
                                    <?php
                                    $color_query = "SELECT * FROM stock_color";
                                    $stock_colors = DB::getInstance()->query($color_query);
                                    foreach ($stock_colors->results() as $colors) {
                                        ?>
                                        <option value="<?php echo $colors->id_stock_color; ?>"><?php echo $colors->color_name; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xs-6">
                                <label class="text-info">Supplier</label>
                                <select class="form-control select2 " name="supplier" style="width: 100%">
                                    <option>--select--</option>
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
                            <div class="col-xs-6">
                                <label class="text-info">Purchase price</label>
                                <input type="number" id="purchase_amount" class="form-control" name="buy_price" required="true" placeholder="Price(UGX)">
                            </div>
                            <div class="col-xs-6">
                                <label class="text-info">Purchase Date</label>
                                <div class="input-group ">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control pull-right" name="buy_date" required="true" >
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-6">
                                <label class="text-info">Cash</label>
                                <input type="number" id="purchase_cash" class="form-control" name="cash_paid" required="true" placeholder="Price(UGX)">
                            </div>
                            <div class="col-xs-6">
                                <label class="text-info">Balance</label>
                                <input type="number" id="purchase_balance" class="form-control" disabled="true" name="buy_balance" required="true" placeholder="Price(UGX)">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-xs-6" >
                                <div id="purchase_payment_date">
                                <label class="text-info">Balance payment date</label>
                                <div class="input-group ">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date"  class="form-control pull-right" name="buy_balance_pay_date" >
                                </div>
                            </div>
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
                    <button type="submit" name="save_purchase" value="save_purchase" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="new-brand-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">BRAND ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Brand</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Make</label>
                                <input type="text" class="form-control" name="make" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Model</label>
                                <input type="text" class="form-control" name="model" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Manufacturer</label>
                                <input type="text" class="form-control" name="manufacturer" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_brand" value="save_brand" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal modal-default fade" id="new-customer-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">CUSTOMER ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Customer</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Full Name</label>
                                <input type="text" class="form-control" name="customer_name" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Address/Company</label>
                                <input type="text" class="form-control" name="customer_address" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Telephone</label>
                                <input type="text" class="form-control" name="customer_telephone" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Email</label>
                                <input type="email" class="form-control" name="customer_email" autocomplete="
                                       off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_customer" value="save_customer" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal modal-default fade" id="new-supplier-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">SUPPLIER ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Supplier</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Full Name</label>
                                <input type="text" class="form-control" name="supplier_name" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Address/Company</label>
                                <input type="text" class="form-control" name="supplier_address" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Telephone</label>
                                <input type="text" class="form-control" name="supplier_telephone" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Email</label>
                                <input type="email" class="form-control" name="supplier_email" autocomplete="
                                       off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_supplier" value="save_supplier" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="new-income-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary text-center">INCOME ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Income</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Income From</label>
                                <select class="form-control select2 " name="income_source" style="width: 100%">
                                    <option>--select--</option>
                                    <?php
                                    $clients_query = "SELECT * FROM clients";
                                    $clients = DB::getInstance()->query($clients_query);
                                    foreach ($clients->results() as $clients) {
                                        ?>
                                        <option value="<?php echo $clients->id_client; ?>"><?php echo $clients->name . ' ' . $clients->address . ' ' . $clients->telephone; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Income Type</label>
                                <select class="form-control select2 " name="income_type" style="width: 100%">
                                    <option>--select--</option>
                                    <?php
                                    $income_query = "SELECT * FROM income_sources";
                                    $income = DB::getInstance()->query($income_query);
                                    foreach ($income->results() as $income) {
                                        ?>
                                        <option value="<?php echo $income->id_income_source; ?>"><?php echo $income->source_name; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Amount</label>
                                <input type="number" class="form-control" name="income_received" required="true" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_income" value="save_income" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="new-expense-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary text-center">EXPENSE ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Stock Expense</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Expense On</label>
                                <select class="form-control select2 " name="expense_source" style="width: 100%">
                                    <option>--select--</option>
                                    <?php
                                    $products_query = DB::getInstance()->query("SELECT * FROM stock s,stock_name n WHERE s.id_stock_name = n.id_stock_name AND s.stock_status ='NOT SOLD'");
                                    foreach ($products_query->results() as $stock) {
                                        ?>
                                        <option value="<?php echo $stock->id_stock; ?>"><?php echo $stock->stock_manufacturer . ' ' . $stock->stock_make . ' ' . $stock->stock_model; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Expense Type</label>
                                <select class="form-control select2 " name="expense_type" style="width: 100%">
                                    <option>--select--</option>
                                    <?php
                                    $expense_query = DB::getInstance()->query("SELECT * FROM expenditure_sources");
                                    foreach ($expense_query->results() as $expense_query) {
                                        ?>
                                        <option value="<?php echo $expense_query->id_expenditure_source; ?>"><?php echo $expense_query->expenditure_name; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Amount</label>
                                <input type="number" class="form-control" name="expense_amount" required="true" placeholder="Enter Amount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_expense" value="save_expense" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="new-stock-color-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center text-primary">STOCK COLOR ENTRY FORM</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box-header with-border">
                        <h3 class="box-title text-success">New Color</h3>
                    </div>
                    <div class="box-body">
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label class="text-info">Color Name</label>
                                <input type="text" class="form-control" name="color_name" required="true" autocomplete="
                                       off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="save_color" value="save_color" class="btn btn-success btn-md">Record</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal modal-default fade" id="delete-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center text-danger">DELETE ALERT<br><i class="fa fa-warning"></i></h3>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <p class="text-danger text text-center" style="font-size: 18px;"> You are deleting a record permanently</p>
                    <p class="text-danger text text-center" style="font-size: 18px;"> Click <strong class="text-success">OK</strong> to delete or <strong class="text-yellow">Cancel</strong> to save the record</p>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-md">OK</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
$entry_alert = '';
if (Input::exists()) {
    if (Input::get('save_customer') == 'save_customer') {
        $name = strtoupper(Input::get('customer_name'));
        $address = strtoupper(Input::get('customer_address'));
        $telephone = Input::get('customer_telephone');
        $email = strtolower(Input::get('customer_email'));
        if (strlen($telephone) != 10) {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Phone number ' . $telephone . ' is incorrect, correct and try again </p>
              </div>';
        } else {


            if (DB::getInstance()->checkRows("SELECT * FROM clients WHERE name='$name' AND address = '$address' AND telephone = '$telephone'"
                            . " AND email = '$email' AND id_client_type = 1")) {
                $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">User ' . $name . ' exists in the database</p>
              </div>';
            } else {
                $arrayClient = array("name" => $name, "address" => $address, "telephone" => $telephone, "email" => $email, "id_client_type" => 1);
                DB::getInstance()->insert('clients', $arrayClient);
                $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
            }
        }
    } elseif (Input::get('save_supplier') == 'save_supplier') {
        $name = strtoupper(Input::get('supplier_name'));
        $address = strtoupper(Input::get('supplier_address'));
        $telephone = Input::get('supplier_telephone');
        $email = strtolower(Input::get('supplier_email'));
        if (strlen($telephone) != 10) {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Phone number ' . $telephone . ' is incorrect, correct and try again </p>
              </div>';
        } else {
            if (DB::getInstance()->checkRows("SELECT * FROM clients WHERE name='$name' AND address = '$address' AND telephone = '$telephone'"
                            . " AND email = '$email' AND id_client_type = 2")) {
                $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;"> User ' . $name . ' exists in the database</p>
              </div>';
            } else {
                $arrayClient = array("name" => $name, "address" => $address, "telephone" => $telephone, "email" => $email, "id_client_type" => 2);
                DB::getInstance()->insert('clients', $arrayClient);
                $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
            }
        }
    } elseif (Input::get('save_brand') == 'save_brand') {
        $make = strtoupper(Input::get('make'));
        $model = strtoupper(Input::get('model'));
        $manufacturer = strtoupper(Input::get('manufacturer'));
        if (DB::getInstance()->checkRows("SELECT * FROM stock_name WHERE stock_make='$make' AND stock_model = '$model' AND "
                        . "stock_manufacturer = '$manufacturer'")) {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <p class="text-center" style="font-size: 16px;"> A product of ' . $manufacturer . ' with make ' . $make . ' and model ' . $model . ' exists in the database</p>
              </div>';
        } else {
            $arrayBrand = array("stock_make" => $make, "stock_model" => $model, "stock_manufacturer" => $manufacturer);
            DB::getInstance()->insert('stock_name', $arrayBrand);
            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
        }
    } elseif (Input::get('save_color') == 'save_color') {
        $stock_color = strtoupper(Input::get('color_name'));
        if (DB::getInstance()->checkRows("SELECT * FROM stock_color WHERE color_name = '$stock_color'")) {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;"> Color ' . $stock_color . ' exists in the database, enter a different color</p>
              </div>';
        } else {
            $arrayColor = array("color_name" => $stock_color);
            DB::getInstance()->insert('stock_color', $arrayColor);
            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
        }
    } elseif (Input::get('save_purchase') == 'save_purchase') {
        $brand = Input::get('stock_name');
        $chasis = strtoupper(Input::get('chasis_number'));
        $engine = strtoupper(Input::get('engine_number'));
        $plate = strtoupper(Input::get('plate_number'));
        $car_color = Input::get('car_color');
        $receipt_number = Input::get('purchases_receipt');
        $supplier = Input::get('supplier');
        $cost_price = Input::get('buy_price');
        $purchase_date = Input::get('buy_date');
        $cash_paid = Input::get('cash_paid');

        if (DB::getInstance()->checkRows("SELECT * FROM stock WHERE chasis_number ='$chasis' AND engine_number = '$engine' AND plate_number = '$plate'")) {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;"> Vehicle ' . DB::getInstance()->getName('stock_name', $brand, 'stock_make', 'id_stock_name') . ' with chasis number ' . $chasis . ' and 
                    engine number ' . $engine . ' was bought. Do you really want to buy this vehicle again?</p>
              </div>';
        } else {
            $arrayStock = array("chasis_number" => $chasis, "id_client" => $supplier, "engine_number" => $engine, "plate_number" => $plate, "purchase_date" => $purchase_date
                , "id_stock_color" => $car_color, "id_stock_name" => $brand, "id_stock_type" => 2, "stock_status" => 'NOT SOLD');
            DB::getInstance()->insert("stock", $arrayStock);

            $arrayStockPrice = array("stock_price" => $cost_price, "occurred_on" => date("Y-m-d h:i:s"), "id_stock_price_type" => 1,
                "id_stock" => getLastInsertId('stock', 'id_stock'));
            DB::getInstance()->insert("stock_prices", $arrayStockPrice);

            $arrayPayment = array("payment_amount" => $cash_paid, "id_stock_price_type" => 1, "payment_date" => date("Y-m-d h:i:s"), "payment_receipt" => $receipt_number, "id_stock" => getLastInsertId('stock', 'id_stock'));
            DB::getInstance()->insert("payments", $arrayPayment);

            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
        }
    } elseif (Input::get('save_new_sale') == 'save_new_sale') {
        $product_sold = Input::get('select_product');
        $customer = Input::get('customer_name');
        $cash_paid = Input::get('product_cash_paid');
        $balance = Input::get('product_balance');
        $pay_date = Input::get('balance_pay_date');
        $cash_receipt = Input::get('sales_receipt');
//        if(DB::getInstance()->checkRows("SELECT * FROM client_orders WHERE id_client = $customer AND id_stock = $product_sold")){
//            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
//                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//                <p class="text-center" style="font-size: 16px;">You had ordered for this product, do you wish to pay for it?</p>
//              </div>';
//        }else{
//            
//        }
        //=======================================INSERT INTO CLIENT ORDER TABLE==============================
        $arrayCustomerOrder = array("order_status" => 'NOT PAID', "id_client" => $customer, "id_stock" => $product_sold);
        DB::getInstance()->insert("client_orders", $arrayCustomerOrder);
        $arrayCustomerPayment = array("id_stock" => $product_sold, "id_stock_price_type" => 2, "payment_amount" => $cash_paid, "payment_receipt" => $cash_receipt);

        //=======================INSERT INTO PAYMENTS TABLE, UPDATE STOCK & CLIENT ORDER TABLES===============
        if (DB::getInstance()->insert("payments", $arrayCustomerPayment)) {
            $arrayProductSale = array("id_client" => $customer, "id_stock_type" => 1, "stock_status" => 'SOLD');
            DB::getInstance()->update("stock", $product_sold, $arrayProductSale, "id_stock");

            //==========GET ID OF ORDER PLACED
            $order_query = DB::getInstance()->query("SELECT * FROM client_orders WHERE id_client = $customer AND id_stock = $product_sold");
            foreach ($order_query->results() as $order_query) {
                $order_id = $order_query->id_client_order;
            }
            $arrayUpdateCustomerOrder = array("order_status" => 'PAID');
            DB::getInstance()->update("client_orders", $order_id, $arrayUpdateCustomerOrder, 'id_client_order');
            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
            Redirect::to('index.php?page=print&columns=4&type=transaction&sub_type=sales&from=00-00-0000&to=00-00-0000');
        } else {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Error in submitting payment</p>
              </div>';
        }
    } elseif (Input::get('save_income') == 'save_income') {
        $income_source = Input::get('income_source');
        $income_type = Input::get('income_type');
        $amount_received = Input::get('income_received');
        $arrayNewIncome = array("id_income_source" => $income_type, "id_client" => $income_source, "income_amount" => $amount_received);
        if (DB::getInstance()->insert("incomes", $arrayNewIncome)) {
            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
        } else {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Error in submitting payment</p>
              </div>';
        }
    } elseif (Input::get('save_expense') == 'save_expense') {
        $stock_spent_on = Input::get('expense_source');
        $expense_type = Input::get('expense_type');
        $amount_spent = Input::get('expense_amount');
        $arrayNewExpense = array("id_expenditure_source" => $expense_type, "id_stock" => $stock_spent_on, "expense_amount" => $amount_spent);
        if (DB::getInstance()->insert("expenditures", $arrayNewExpense)) {
            $entry_alert = '<div class="alert alert-success alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Data saved successfully</p>
              </div>';
        } else {
            $entry_alert = '<div class="alert alert-danger alert-dismissible" style="height: 40px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="text-center" style="font-size: 16px;">Error in submitting payment</p>
              </div>';
        }
    }
}
?>