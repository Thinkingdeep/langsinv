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
                if (Input::exists() && Input::get('save_expense_edits') == 'save_expense_edits') {
                    $expense_id = Input::get('id_expense');
                    $arrayExpenseSource = array("id_expenditure_source" => Input::get('expense_type'), "id_stock" => Input::get('expense_source'), "expense_amount" => Input::get('expense_amount'));
                    if (DB::getInstance()->update("expenditures", $expense_id, $arrayExpenseSource, "id_expenditure")) {
                        $entry_alert = submissionReport("success", "Record updated successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to update record");
                    }
                } 
//                elseif (Input::exists() && Input::get('delete_income_record') == 'delete_income_record') {
//                    $income_id = Input::get('id_income');
//                    if (DB::getInstance()->delete("incomes", $income_id)) {
//                        $entry_alert = submissionReport("success", "Record deleted successfully");
//                    } else {
//                        $entry_alert = submissionReport("error", "Failed to delete record");
//                    }
//                }
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
                                        <th>EXPENDITURE ON</th>
                                        <th>EXPENSE TYPE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $edit_msg = "";
                                    $del_msg = "";
                                    $expense_query = DB::getInstance()->query("SELECT * FROM expenditures e, expenditure_sources sr, stock s WHERE s.id_stock = e.id_stock AND sr.id_expenditure_source = e.id_expenditure_source");
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
                                            <?php
                                            if ($expense_query->stock_status == 'SOLD') {
                                                $edit_msg = "";
                                                $del_msg = "";
                                            } else {
                                                $edit_msg = 'Edit';
                                                $del_msg = 'Delete';
                                            }
                                            ?>
                                            <td><div class="btn-group">
                                                    <button type="button" class="btn btn-default">Action</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="">
                                                        <li><a data-toggle="modal" href="#edit_expense-form<?php echo $expense_query->id_expenditure; ?>" style="color: #72afd2;"><?php echo $edit_msg; ?></a></li>
                                                        <li><a data-toggle="modal" href="#delete_expense-form<?php echo $expense_query->id_expenditure; ?>" style="color: #72afd2;"><?php echo $del_msg; ?></a></li>
                                                    </ul>
                                                </div></td>

                                    <div class="modal modal-default fade" id="edit_expense-form<?php echo $expense_query->id_expenditure; ?>">
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
                                                            <h3 class="box-title text-success">Edit Stock Expense</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row form-group">
                                                                <input type="hidden" name="id_expense" value="<?php echo $expense_query->id_expenditure; ?>">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Expense On</label>
                                                                    <select class="form-control select2 " name="expense_source" style="width: 100%">
                                                                        <option value="<?php echo $expense_query->id_stock_name; ?>"><?php echo $product; ?></option>
                                                                        <?php
                                                                        $products_query = DB::getInstance()->query("SELECT * FROM stock s,stock_name n WHERE s.id_stock_name = n.id_stock_name AND s.stock_status ='NOT SOLD'");
                                                                        foreach ($products_query->results() as $stock) {
                                                                            ?>
                                                                            <option value="<?php echo $stock->id_stock; ?>"><?php echo $stock->stock_manufacturer . ' ' . $stock->stock_make . ' ' . $stock->stock_model . ' CHS: ' . $stock->chasis_number . ' EGN: ' . $stock->engine_number . ' PLT: ' . $stock->plate_number; ?></option>

                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Expense Type</label>
                                                                    <select class="form-control select2 " name="expense_type" style="width: 100%">
                                                                        <option value="<?php echo $expense_query->id_expenditure_source; ?>"><?php echo $expense_query->expenditure_name; ?></option>
                                                                        <?php
                                                                        $expense_query2 = DB::getInstance()->query("SELECT * FROM expenditure_sources");
                                                                        foreach ($expense_query2->results() as $expense_query2) {
                                                                            ?>
                                                                            <option value="<?php echo $expense_query2->id_expenditure_source; ?>"><?php echo $expense_query2->expenditure_name; ?></option>

                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Amount</label>
                                                                    <input type="number" class="form-control" name="expense_amount" required="true"  value="<?php echo $expense_query->expense_amount;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="save_expense_edits" value="save_expense_edits" class="btn btn-success btn-md">Record</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal modal-default fade" id="delete_expense-form<?php echo $expense_query->id_expenditure; ?>">
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
                                                            <input type="hidden" name="id_income" value="<?php echo $expense_query->id_expenditure; ?>">
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
