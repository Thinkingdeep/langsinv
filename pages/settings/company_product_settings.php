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
                    <?php include 'includes/side_nav.php'; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Product Settings
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="active">Product Settings</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <?php echo $entry_alert; ?>
                    <div class="row">
                        <div class="col-md-7">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Product Brands</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Registered Brands</h3>
                                        <div class="btn-group pull-right">
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
                                                <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>MAKE</th>
                                                    <th>MODEL</th>
                                                    <th>MANUFACTURER</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $brand_query = "SELECT * FROM stock_name";
                                                $brand_names = DB::getInstance()->query($brand_query);
                                                $x = 1;
                                                foreach ($brand_names->results() as $brand) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $brand->stock_make; ?></td>
                                                        <td><?php echo $brand->stock_model; ?></td>
                                                        <td><?php echo $brand->stock_manufacturer; ?></td>
                                                        <td><div class="btn-group">
                                                                <button type="button" class="btn btn-default">Action</button>
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                                                    <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Edit</a></li>
                                                                    <li><a data-toggle="modal" href="#delete-form" style="color: #72afd2;">Delete if not sold</a></li>
                                                                </ul>
                                                            </div></td>
                                                    </tr>
                                                    <?php
                                                    $x++;
                                                }
                                                ?>

                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                                    the plugin.
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>

                        <div class="col-md-5">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Product Colors</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Product Colors Available</h3>
                                        <div class="btn-group pull-right">
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
                                                <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                                <li><a data-toggle="modal" href="#new-stock-color-form" style="color: #72afd2;">Add New Color</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example3" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>COLOR</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $color_query = "SELECT * FROM stock_color";
                                                $stock_colors = DB::getInstance()->query($color_query);
                                                $y = 1;
                                                foreach ($stock_colors->results() as $colors) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $y; ?></td>
                                                        <td><?php echo $colors->color_name; ?></td>
                                                        <td><div class="btn-group">
                                                                <button type="button" class="btn btn-default">Action</button>
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <span class="caret"></span>
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu" style="">
                                                                    <li><a data-toggle="modal" href="#new-brand-form" style="color: #72afd2;">Add New Brand</a></li>
                                                                    <li><a data-toggle="modal" href="#new-purchase-form" style="color: #72afd2;">Edit</a></li>
                                                                    <li><a data-toggle="modal" href="#delete-form" style="color: #72afd2;">Delete if not sold</a></li>
                                                                </ul>
                                                            </div></td>
                                                    </tr>
                                                    <?php
                                                    $y++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                                    the plugin.
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <?php include 'includes/footer.php'; ?>
    </body>
</html>
