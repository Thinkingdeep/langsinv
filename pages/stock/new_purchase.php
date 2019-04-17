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
          <p>Alexander Pierce</p>
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
                                                <h3 class="box-title text-success">New Purchase</h3>
                                            </div>
                                            <?php
                                            ?>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <form action="" method="post" role="form">
                                                    <!-- text input -->
                                                    <div class="row form-group col-xs-12">
                                                        <label class="text-info">Brand</label>
                                                        <select  class="form-control select2 " name="particulars"  style="width: 100%;">
                                                            <option >--select--</option>
                                                        </select>
                                                    </div>
                                                    <div class="row form-group col-xs-12">
                                                        <div class="input-group col-xs-4 pull-left ">
                                                            <label class="text-info">Chasis Number</label>
                                                            <input type="text" class="form-control" name="chasis_num" required="true" placeholder="Enter">
                                                        </div>
                                                        <div class="input-group col-xs-7 pull-right" >
                                                            <div class="row form-group col-xs-12">
                                                                <div class="input-group col-xs-6 pull-left" >
                                                                    <label class="text-info">Engine Numer</label>
                                                                    <input type="text" class="form-control" name="engine_num" required="true" placeholder="Enter">
                                                                </div>
                                                                <div class="input-group col-xs-5 pull-right ">
                                                                    <label class="text-info">Plate Number</label>
                                                                    <input type="text" class="form-control" name="plate_num" required="true" placeholder="Enter">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <br>

                                                    </div>
                                                    <div class="row form-group col-xs-12">
                                                        <div class="input-group col-xs-5 pull-left">
                                                            <label class="text-info">Color</label>
                                                            <select class="form-control select2 " name="car_color" style="">
                                                                <option>Select</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group col-xs-6 pull-right">
                                                            <label class="text-info">Supplier</label>
                                                            <select class="form-control select2 " name="supply" style="">
                                                                <option>Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group col-xs-12">
                                                        <div class="input-group col-xs-5 pull-left ">
                                                            <label class="text-info">Purchase price</label>
                                                            <input type="number" id="amount" class="form-control" name="price" required="true" placeholder="Price(UGX)">
                                                        </div>
                                                        <div class="input-group col-xs-6 pull-right">
                                                            <label class="text-info">Purchase Date</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" class="form-control pull-right" name="purchase_date" required="true" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group col-xs-12">
                                                        <div class="input-group col-xs-5 pull-left ">
                                                            <label class="text-info">Cash</label>
                                                            <input type="number" id="cash" class="form-control" name="cash_pay" required="true" placeholder="Price(UGX)">
                                                        </div>
                                                        <div class="input-group col-xs-6 pull-right">  
                                                            <label class="text-info">Balance</label>
                                                            <input type="number" id="balance" class="form-control" disabled="true" name="balance" required="true" placeholder="Price(UGX)">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group col-xs-12" id="payment_date">
                                                        <div class="input-group col-xs-5 pull-left ">
                                                            <label class="text-info">Balance payment date</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="date" class="form-control pull-right" name="balance_date" >
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row form-group col-xs-12">
                                                        <button type="submit" name="add" class="btn btn-primary pull-left">Submit</button>
                                                        <span/>
                                                        <button type="reset" name="cancel" class="btn btn-warning pull-right">Cancel</button>
                                                    </div>
                                            </div>
                                            <div class="box-footer">  
                                            </div>
                                            </form>
          </div>

          <div class="col-md-6 col-xs-12">
            <div class="box-header with-border">
                                                    <h3 class="box-title">Recent Purchases</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>DATE</th>
                                                                <th>PRODUCT</th>
                                                                <th>PURCHASE PRICE(UGX)</th>
                                                                <th>STATUS</th>
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
