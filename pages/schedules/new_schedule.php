<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(E_ALL);
    include 'includes/header.php';
    $id_customer = Input::get('id_customer');
                            $id_product = Input::get('id_product');
                            $pay_date = Input::get('pay_date');
                            $balance = Input::get('balance'); 
                            if(empty($balance) && empty($id_product) && empty($pay_date)){
                                $pay_date = '';
                                $balance = '';
                            }
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
                    <?php include'includes/side_nav.php' ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Payment Schedules
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Payment Schedules</li>
                        <li class="active">New Schedule</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <?php //echo $entry_alert; ?>
                    <div class="row">
                        <form action="" method="post">
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">New Payment Schedule</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row form-group">
                                            <div class="col-xs-12">
                                                <label class="text-info">Customer</label>
                                                <select  class="form-control select2 " id="select_customer" name="id_customer"  style="width: 100%;">
                                                    <?php if(empty($id_customer)){
                                                        $id_customer = 0;?>
                                                    <option>--select--</option>
                                                    <?php}else{?>
                                                    <option value="<?php echo $id_customer;?>"><?php echo getSpecificDetails('clients','name','id_client ='.$id_customer).' '.getSpecificDetails('clients','address','id_client ='.$id_customer).' '.getSpecificDetails('clients','telephone','id_client ='.$id_customer);?></option>
                                                    <?php
                                                }
                                                    $query_customer = DB::getInstance()->query("SELECT * FROM clients WHERE id_client_type = 1");
                                                    foreach ($query_customer->results() as $query_customer):
                                                        ?>
                                                        <option value="<?php echo $query_customer->id_client; ?>"><?php echo $query_customer->name . ' ' . $query_customer->address . ' ' . $query_customer->telephone; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-8">
                                                <label class="text-info">Product</label>
                                                <select  class="form-control select2 " id="select_product" name="id_product"  style="width: 100%;">
                                                    <?php if(empty($id_product)){
                                                        $id_product = 0;?>
                                                        <option>--select</option>
                                                        <?php
                                                    }else{
                                                        ?>
                                                    <option value="<?php echo $id_product;?>" ><?php echo getProductName($id_product);?></option>
                                                    <?php
                                                }
                                                    $products_query = DB::getInstance()->query("SELECT * FROM stock s,stock_name n,stock_prices p WHERE p.id_stock = s.id_stock AND s.id_stock_name = n.id_stock_name AND s.stock_status ='SOLD' AND p.id_stock_price_type = 2");
                                                    foreach ($products_query->results() as $products_query):
                                                        ?>
                                                        <option value="<?php echo $products_query->id_stock; ?>" ><?php
                                                            echo $products_query->stock_make . ' ' . $products_query->stock_model . ' '
                                                            . 'CHS: ' . $products_query->chasis_number . ' EGN: ' . $products_query->engine_number . ' PURCHASE PRICE: ' . $products_query->stock_price . ' EXPENSE ' . selectSum('expenditures', 'expense_amount', 'id_stock=' . $products_query->id_stock);
                                                            ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <label class="text-info">Amount to pay</label>
                                                <input type="text" id="schedule_amount_to_pay" class="form-control" name="schedule_amount_to_pay" placeholder="Enter amount to pay" autocomplete="off" required value="<?php echo $balance;?>">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-6">
                                                <label class="text-info">Number of payments</label>
                                                <input type="text" id="number_of_schedules" class="form-control" name="number_of_schedules" placeholder="Enter number of payments in months" autocomplete="off" required>
                                            </div>
                                            <div class="col-xs-6">
                                                <label class="text-info">Payment start date</label>
                                                <input type="date" class="form-control" id="schedule_start_date" name="schedule_start_date" autocomplete="off" required value="<?php echo $pay_date;?>">
                                            </div>
                                        </div>
                                        <div class="row form-group" id="display_schedule">
                                            <div class="box-body">
                                                <table class="table table-hover table-condensed" id="table_display_schedule">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-primary">Date</th>
                                                            <th class="text-primary">Amount</th>
                                                        </tr>  
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12">
                                                <button type="reset" class="btn btn-warning pull-left" name="cancel" value="cancel">Cancel</button>
                                                <button type="submit" class="btn btn-primary pull-right" name="save_schedule" value="save_schedule">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $customer_name = '';
                            $product_name = '';
                            
                            if (Input::exists() && Input::get('save_schedule') == 'save_schedule') {
                                $id_customer = Input::get('id_customer');
                                $id_product = Input::get('id_product');
                                $amount = Input::get('schedule_amount_to_pay');
                                $instalments = Input::get('number_of_schedules');
                                $start_date = Input::get('schedule_start_date');
                                $amount = ($amount / $instalments);
                                // if(DB::getInstance()->checkRows("SELECT * FROM payment_schedules WHERE id_stock= $id_product AND id_client = $id_customer")){

                                for ($x = 1; $x <= $instalments; $x++) {

                                    $arraySchedule = array("id_stock" => $id_product, "id_client" => $id_customer, "payment_date" => $start_date, "payment_amount" => $amount);
                                    DB::getInstance()->insert('payment_schedules', $arraySchedule);

                                    $start_date = date('Y-m-d', strtotime('+1 month', strtotime($start_date)));
                                }

                                $customer_name = "Customer Name " . getSpecificDetails('clients', 'name', 'id_client=' . $id_customer);
                                $product_name = "Payment Schedule for " . getProductName($id_product);
                                //}
                            }elseif(Input::exists() && Input::get('save_edit_schedule') == 'save_edit_schedule'){
                                $id_customer = Input::get('id_client');
                                $id_product = Input::get('id_stock');
                                $id_schedule = Input::get('id_schedule');
                                $schedule_date = Input::get('schedule_date');
                                $schedule_amount = Input::get('schedule_amount');
                                $arrayUpdateSchedule = array("payment_date"=>$schedule_date,"payment_amount"=>$schedule_amount);
                                DB::getInstance()->update('payment_schedules',$id_schedule,$arrayUpdateSchedule,'id_payment_schedule');
                                $customer_name = "Customer Name " . getSpecificDetails('clients', 'name', 'id_client=' . $id_customer);
                                $product_name = "Payment Schedule for " . getProductName($id_product);
                            }
                            ?>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $product_name; ?></h3>
                                        <h3 class="box-title"><?php echo $customer_name; ?></h3>
                                    </div>
                                    <div class="box-body">
                                        <!-- /.box-body -->
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>DATE</th>
                                                    <th>AMOUNT</th>
                                                    <th>OPTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_schedule = DB::getInstance()->query("SELECT * FROM payment_schedules WHERE id_stock = $id_product");
                                                $x = 1;
                                                foreach ($query_schedule->results() as $query_schedule):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $query_schedule->payment_date; ?></td>
                                                        <td><?php echo $query_schedule->payment_amount; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="#expense_edit_form<?php echo $query_schedule->id_payment_schedule; ?>" style="color: #72afd2;">Edit</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                <div class="modal modal-default fade" id="expense_edit_form<?php echo $query_schedule->id_payment_schedule; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-primary text-center text-uppercase">shedule edit form</h4>
                                                            </div>
                                                            <form action="" method="post">
                                                                <div class="modal-body">
                                                                    <input type="hidden" class="form-control" name="id_schedule" value="<?php echo $query_schedule->id_payment_schedule; ?>">
                                                                    <input type="hidden" class="form-control" name="id_client" value="<?php echo $query_schedule->id_client; ?>">
                                                                    <input type="hidden" class="form-control" name="id_stock" value="<?php echo $query_schedule->id_stock; ?>">
                                                                    <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Date</label>
                                                                    <input type="date" class="form-control" name="schedule_date" required="true" autocomplete="
                                                                           off" value="<?php echo $query_schedule->payment_date; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Amount</label>
                                                                    <input type="text" class="form-control" name="schedule_amount" required="true" autocomplete="
                                                                           off" value="<?php echo $query_schedule->payment_amount; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                                    <button type="submit" name="save_edit_schedule" value="save_edit_schedule" class="btn btn-success btn-md">Yes</button>
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
                                <!-- /. box -->
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.section -->
            </div>

<?php include 'includes/footer.php'; ?>



    </body>


</html>
