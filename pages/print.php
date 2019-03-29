<!DOCTYPE html>
<html>
    <?php include 'includes/header.php'; ?>
    <?php
    $columns = Input::get('columns');
    $type = Input::get('type'); // report,transaction
    $sub_type = Input::get('sub_type');
    /* ========type: report{
     * sub_types: sales,purchases,customers,suppliers,incomes,expenses,income_statement,balance_sheet
     * }
      ========type: transaction{
     * sub_types: sales,sales_payment,income}  
     *          */
    $from = Input::get('from'); //start period
    $to = Input::get('to'); //end period
    
    $header1='';$header2='';$header3='';$header4='';$header5='';$header6=''; //names for table headers
    ?>
    <body onload="window.print();window.close();">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <address class="page-header text-center">
                            <strong class="text-uppercase">langas investments ltd</strong><br>
                            <small>Kakyeka Shopping Center<br>
                                Mbarara, Uganda<br>
                                Phone: (256) 123-5432<br>
                                Email: langasinvestments@gmail.com</small>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <!-- /.col -->
                    <?php
                    $header_information = '';
                    switch ($type) {
                        case $type == 'report':
                            switch ($sub_type) {
                                case $sub_type == 'sales':
                                    $header_information = "Sales report";
                                    break;
                                case $sub_type == 'purchases':
                                    $header_information = "Purchases report";
                                    break;
                                case $sub_type == 'customers':
                                    $header_information = "Customer List";
                                    break;
                                case $sub_type == 'suppliers':
                                    $header_information = "Supplier List";
                                    break;
                                case $sub_type == 'incomes':
                                    $header_information = "Incomes received";
                                    break;
                                case $sub_type == 'expenses':
                                    $header_information = "Expenses paid";
                                    break;
                                case $sub_type == 'income_statement':
                                    $header_information = "Income statement";
                                    break;
                                case $sub_type == 'balance_sheet':
                                    $header_information = "Balance sheet";
                            }
                            ?>
                            <div class="col-sm-12 invoice-col">
                                <h4 class="text-uppercase text-center text-primary"><?php echo $header_information; ?></h4>
                            </div>
                            <?php
                            break;
                        case $type == 'transaction':
                            $header_information = 'Receipt';
                            $header1 = 'Product'; $header2 = 'Unit cost'; $header3 = 'Cash paid'; $header4='Balance';
                            ?>
                            <div class="col-sm-12 invoice-col">
                                <h4 class="text-uppercase text-center text-primary"><?php echo $header_information; ?></h4>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>John Doe</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    Phone: (555) 539-1037<br>
                                    Email: john.doe@example.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col pull-right">
                                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> 4F3S8J<br>
                                <b>Payment Due:</b> 2/22/2014<br>
                                <b>Account:</b> 968-34567
                            </div>
                            <?php
                            break;
                    }
                    ?>

                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <?php
                            
                            switch ($columns) {
                                case $columns == 4:
                                    ?>
                                    <thead>
                                        <tr>
                                            <th><?php echo $header1;?></th>
                                            <th><?php echo $header2;?></th>
                                            <th><?php echo $header3;?></th>
                                            <th><?php echo $header4;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    break;
                                case $columns == 5:
                                    ?>
                                    <thead>
                                        <tr>
                                            <th><?php echo $header1;?></th>
                                            <th><?php echo $header2;?></th>
                                            <th><?php echo $header3;?></th>
                                            <th><?php echo $header4;?></th>
                                            <th><?php echo $header5;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td></td>
                                            <td>$64.50</td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    break;
                                case $columns == 6:
                                    ?>
                                    <thead>
                                        <tr>
                                            <th><?php echo $header1;?></th>
                                            <th><?php echo $header2;?></th>
                                            <th><?php echo $header3;?></th>
                                            <th><?php echo $header4;?></th>
                                            <th><?php echo $header5;?></th>
                                            <th><?php echo $header6;?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td>455-981-221</td>
                                            <td>/td>
                                            <td>$64.50</td>
                                            <td>$64.50</td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    break;
                            }
                            ?>

                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
    </body>
</html>


