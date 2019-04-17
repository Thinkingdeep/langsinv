<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(E_ALL);
    include 'includes/header.php';
    ?>
    <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'includes/header_top.php';?>

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
<?php include'includes/side_nav.php'?>
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
        <li class="active">New Purchase</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="row">
            <div class="col-md-6 col-xs-12">
               <div class="box-header with-border">
                                                <h3 class="box-title">New Sale</h3>
                                            </div>
                                            <!-- form start -->
                                            <form role="form">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inputText">Product</label>

                                                        <select class="form-control select2" style="width: 100%;">
                                                            <option>--select--</option>
                                                            <option>Alaska</option>
                                                            <option>California</option>
                                                            <option>Delaware</option>
                                                            <option>Tennessee</option>
                                                            <option>Texas</option>
                                                            <option>Washington</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputText">Selected Products</label>
                                                        <table class="table table-stripped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Product</th>
                                                                    <th>Details</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Total</th>
                                                                    <th>Cash</th>
                                                                    <th>Balance</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>Schedule</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputText">Customer</label>

                                                        <select class="form-control select2" style="width: 100%;">
                                                            <option>--select--</option>
                                                            <option>Alaska</option>
                                                            <option>California</option>
                                                            <option>Delaware</option>
                                                            <option>Tennessee</option>
                                                            <option>Texas</option>
                                                            <option>Washington</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary pull-left" name="submit" value="submit">Submit</button>
                                                        <button type="reset" class="btn btn-warning pull-right" name="submit" value="submit">Cancel</button>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->

                                                <div class="box-footer">

                                                </div>
                                            </form>                             
          </div>

          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
                                                    <h3 class="box-title">Recent Sales</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>DATE</th>
                                                                <th>PRODUCT</th>
                                                                <th>SALES PRICE(UGX)</th>
                                                                <th>RECEIPT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Gecko</td>
                                                                <td>1.8</td>
                                                                <td>A</td>
                                                                <td>1.8</td>
                                                                <td>A</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
          </div>
        </div>
            </div>
      </section>
    <!-- /.section -->
  </div>

<?php include 'includes/footer.php';?>


  
</body>


</html>
