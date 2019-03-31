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
                        Incomes
                        <!-- <small>Control panel</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Incomes</li>
                        <li class="active">View Incomes</li>
                    </ol>
                </section>
                <?php
                if (Input::exists() && Input::get('save_income_edits') == 'save_income_edits') {
                    $income_id = Input::get('id_income');
                    $arrayIncomeSource = array("id_income_source" => Input::get('income_type'), "id_client" => Input::get('income_source'), "income_amount" => Input::get('income_received'));
                    if (DB::getInstance()->update("incomes", $income_id, $arrayIncomeSource, "id_income")) {
                        $entry_alert = submissionReport("success", "Record updated successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to update record");
                    }
                }elseif (Input::exists() && Input::get('delete_income_record') == 'delete_income_record'){
                    $income_id = Input::get('id_income');
                    if (DB::getInstance()->delete("incomes", $income_id)) {
                        $entry_alert = submissionReport("success", "Record deleted successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to delete record");
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
                                    <h3 class="box-title">Showing Incomes</h3>
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
                                            <li><a data-toggle="modal" href="#new-sale-form" style="color: #72afd2;">Print </a></li>
                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Export As Excel(.xls)</a></li>
                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Export As PDF(.pdf)</a></li>
                                            <li class="divider"></li>
                                            <li><a data-toggle="modal" href="#new-sale-form" style="color: #72afd2;">Sell</a></li>
                                            <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Buy</a></li>
                                            <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                            <li><a data-toggle="modal" href="#new-customer-form" style="color: #72afd2;">Add New Customer</a></li>
                                            <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Add New Supplier</a></li>
                                            <li><a data-toggle="modal" href="#new-income-form" style="color: #72afd2;">Record An Income</a></li>
                                            <li><a data-toggle="modal" href="#new-expense-form" style="color: #72afd2;">Record Stock Expense</a></li> 
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
                                        <th>DATE</th>
                                        <th>INCOME FROM</th>
                                        <th>INCOME TYPE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTION</th>
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

                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="#edit_income-form<?php echo $income_query->id_income; ?>" style="color: #72afd2;">Edit</a></li>
                                                        <li><a data-toggle="modal" href="#delete_income-form<?php echo $income_query->id_income; ?>" style="color: #72afd2;">Delete</a></li>
                                                    </ul>
                                                </div></td>
                                    <div class="modal modal-default fade" id="edit_income-form<?php echo $income_query->id_income; ?>">
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
                                                            <h3 class="box-title text-success">Edit Income</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <input type="hidden" name="id_income" value="<?php echo $income_query->id_income; ?>">
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Income From</label>
                                                                    <select class="form-control select2 " name="income_source" style="width: 100%">
                                                                        <option value="<?php echo $income_query->id_client; ?>"><?php echo $income_query->name . ' ' . $income_query->address . ' ' . $income_query->telephone; ?></option>
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
                                                                        <option value="<?php echo $income_query->id_income_source; ?>"><?php echo $income_query->source_name; ?></option>
                                                                        <?php
                                                                        $income_query2 = "SELECT * FROM income_sources";
                                                                        $income = DB::getInstance()->query($income_query2);
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
                                                                    <input type="number" class="form-control" name="income_received" value="<?php echo $income_query->income_amount; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="save_income_edits" value="save_income_edits" class="btn btn-success btn-md">Record</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal modal-default fade" id="delete_income-form<?php echo $income_query->id_income; ?>">
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
                                                            <input type="hidden" name="id_income" value="<?php echo $income_query->id_income; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                        <button type="submit" name="delete_income_record" value="delete_income_record" class="btn btn-success btn-md">Yes</button>
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
