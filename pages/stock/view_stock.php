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
                        <li class="active">Stock Count</li>
                    </ol>
                </section>
                <?php
                $query_stock = DB::getInstance()->query("SELECT * FROM stock s,stock_name n, clients c WHERE s.id_stock_name = n.id_stock_name AND s.id_client = c.id_client GROUP BY s.id_stock_name DESC");
                ?>

                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="row form-group">
                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <h3 class="box-title">Stock Count Today</h3>
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
                                            <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Record An Income</a></li>
                                            <li><a data-toggle="modal" href="#new-supplier-form" style="color: #72afd2;">Record An Expense</a></li>
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
                                        <th>BRAND</th>
                                        <th>MANUFACTURER</th>
                                        <th>CURRENT STOCK</th>
                                        <th>STOCK RECEIVED</th>
                                        <th>STOCK SOLD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    $stock_now = 0;
                                    $stock_received = 0;
                                    $stock_sold = 0;
                                    foreach ($query_stock->results() as $query):
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $query->stock_make . ' ' . $query->stock_model; ?></td>
                                            <td><?php echo $query->stock_manufacturer; ?></td>
                                            <td><?php 
                                            $stock_now  += countEntries('stock', 'id_stock', 'stock_status="NOT SOLD" AND id_stock_name ="' . $query->id_stock_name . '"');
                                            echo countEntries('stock', 'id_stock', 'stock_status="NOT SOLD" AND id_stock_name ="' . $query->id_stock_name . '"'); ?></td>
                                            <td><?php 
                                            $stock_received += countEntries('stock', 'id_stock', 'id_stock_name ="' . $query->id_stock_name . '"');
                                            echo countEntries('stock', 'id_stock', 'id_stock_name ="' . $query->id_stock_name . '"'); ?></td>
                                            <td><?php
                                            $stock_sold += countEntries('stock', 'id_stock', 'stock_status="SOLD" AND id_stock_name ="' . $query->id_stock_name . '"'); 
                                            echo countEntries('stock', 'id_stock', 'stock_status="SOLD" AND id_stock_name ="' . $query->id_stock_name . '"');  ?></td>
                                        </tr>
                                        <?php
                                        $x++;
                                    endforeach;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong><?php echo $stock_now; ?></strong></td>
                                        <td><strong><?php echo $stock_received; ?></strong></td>
                                        <td><strong><?php echo $stock_sold; ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.section -->
            </div>

<?php include 'includes/footer.php'; ?>



    </body>


</html>
