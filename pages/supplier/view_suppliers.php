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
<?php include'includes/side_nav.php'?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supplier
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Supplier</li>
        <li class="active">View Suppliers</li>
      </ol>
    </section>
    <?php
        if (Input::exists() && Input::get('save_supplier_edits') == 'save_supplier_edits') {
                    $supplier = Input::get('supplier_id');
                    $arrayClient = array("name" => strtoupper(Input::get('supplier_name')), "address" => strtoupper(Input::get('supplier_address')),
                        "telephone" => strtoupper(Input::get('supplier_telephone')), "email" => Input::get('supplier_email'));

                    if (DB::getInstance()->update("clients", $supplier, $arrayClient, "id_client")) {
                        $entry_alert = submissionReport("success", "Supplier information updated successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to update supplier information");
                    }
                } elseif (Input::exists() && Input::get('delete_supplier') == 'delete_supplier') {
                    $supplier = Input::get('supplier_id');
                    if (DB::getInstance()->delete("clients", $supplier)) {
                        $entry_alert = submissionReport("success", "Supplier information deleted successfully");
                    } else {
                        $entry_alert = submissionReport("error", "Failed to delete supplier information");
                    }
                }
        
        $query = "SELECT * FROM clients WHERE id_client_type=2";
        $supplier_query = DB::getInstance()->query($query);
    ?>
    <!-- Main content -->
    <section class="content">
        <?php echo $entry_alert;?>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Showing Suppliers</h3>
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
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <table id="example1" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>SUPPLIER NAME</th>
                                                                <th>ADDRESS/COMPANY</th>
                                                                <th>TELEPHONE</th>
                                                                <th>EMAIL</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $x = 1;
                                                            foreach ($supplier_query->results() as $suppliers){
                     
                                                                ?>
                                                            <tr>
                                                                <td><?php echo $x;?></td>
                                                                <td><?php echo $suppliers->name;?></td>
                                                                <td><?php echo $suppliers->address;?></td>
                                                                <td><?php echo $suppliers->telephone;?></td>
                                                                <td><?php echo $suppliers->email;?></td>
                                                                <td><div class="btn-group">
                                                            <button type="button" class="btn btn-default">Action</button>
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li><a data-toggle="modal" href="#supplier-edit-form<?php echo $suppliers->id_client; ?>" style="color: #72afd2;">Edit</a></li>
                                                                <li><a data-toggle="modal" href="#supplier-delete-form<?php echo $suppliers->id_client; ?>" style="color: #72afd2;">Delete</a></li>
                                                            </ul>
                                                        </div></td>
                                                        <div class="modal modal-default fade" id="supplier-edit-form<?php echo $suppliers->id_client; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center">SUPPLIER ENTRY FORM</h4>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title text-success">Edit Supplier Information</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row form-group">
                                                                <input type="hidden" name="supplier_id" value="<?php echo $suppliers->id_client; ?>">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Full Name</label>
                                                                    <input type="text" class="form-control" name="supplier_name" value="<?php echo $suppliers->name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Address/Company</label>
                                                                    <input type="text" class="form-control" name="supplier_address" value="<?php echo $suppliers->address; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Telephone</label>
                                                                    <input type="text" class="form-control" name="supplier_telephone" value="<?php echo $suppliers->telephone; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-xs-12">
                                                                    <label class="text-info">Email</label>
                                                                    <input type="email" class="form-control" name="supplier_email" value="<?php echo $suppliers->email; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="save_supplier_edits" value="save_supplier_edits" class="btn btn-success btn-md">Record</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal modal-default fade" id="supplier-delete-form<?php echo $suppliers->id_client; ?>">
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
                                                            <input type="hidden" name="supplier_id" value="<?php echo $suppliers->id_client; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-warning btn-md pull-left" data-dismiss="modal">No</button>
                                                        <button type="submit" name="delete_supplier" value="delete_supplier" class="btn btn-success btn-md">Yes</button>
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
                                                                   }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
        </div>
      </section>
    <!-- /.section -->
  </div>

<?php include 'includes/footer.php';?>


  
</body>


</html>
