<!DOCTYPE html>
<html>
    <?php include 'includes/header.php'; ?>
    <?php
    $header1 = "Units";
    $header2 = "Product";
    $header3 = "Chasis number";
    $header4 = "Engine number";
    $header5 = "Registration Number";
    $header6 = "Color";
    $type = Input::get('type');
    $idstock = Input::get('idstock');
    $price = Input::get('price');
    $amt_pd = Input::get('amt_pd');
    $bal = Input::get('bal');
    $ticket = Input::get('ticket');
    $idclient = Input::get('idclient');
    $occurred = Input::get('occurred');
    switch ($type) {
        case $type = 'cash_sale':
            $header_information = 'Receipt';
            break;
        case $type = 'credit_sale':
            $header_information = 'Invoice';
            break;
        case $type = 'cash_purchase':
            $header_information = 'Payment Voucher';
            break;
        case $type = 'credit_purchase':
            $header_information = 'Invoice';
            break;
    }
    ?>
    <body onload="window.print();window.close();">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <address class="page-header text-center">
                            <?php $company_query = DB::getInstance()->query("SELECT * FROM company_accounts");
                                    foreach($company_query ->results() as $company_details):
                            ?>
                            <strong class="text-uppercase"><?php echo $company_details->company_name;?></strong><br>
                            <small><?php echo $company_details->company_address;?><br>
                                Phone: <?php echo $company_details->company_telephone;?><br>
                                Email: <?php echo $company_details->company_email;?></small>
                        </address>
                        <?php endforeach;?>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-sm-12  text-center">
                        <h3 class="text-uppercase text-center text-primary"><?php echo $header_information; ?></h3>
                    </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <?php
                            $client_query = DB::getInstance()->query("SELECT * FROM clients WHERE id_client = $idclient");
                            foreach ($client_query->results() as $client):
                                ?>
                                <strong><?php echo $client->name; ?></strong><br>
                                Address: <?php echo $client->address; ?><br>
                                Phone: <?php echo $client->telephone; ?><br>
                                Email: <?php echo $client->email; ?>
                            </address>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col pull-right">
                        Number: <b><?php echo $ticket; ?></b><br>
                        <br>
                        Date & Tme: <b><?php echo $occurred; ?></b><br>
                        <!--                                <b>Payment Due:</b> 2/22/2014<br>
                                                        <b>Account:</b> 968-34567-->
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row" style="padding-bottom: 80px;">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $header1; ?></th>
                                    <th><?php echo $header2; ?></th>
                                    <th><?php echo $header3; ?></th>
                                    <th><?php echo $header4; ?></th>
                                    <th><?php echo $header5; ?></th>
                                    <th><?php echo $header6; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stock_query = DB::getInstance()->query("SELECT * FROM stock s,stock_name n,stock_color c WHERE s.id_stock_name = n.id_stock_name AND s.id_stock_color = c.id_stock_color AND s.id_stock = $idstock");
                                foreach ($stock_query->results() as $stock):
                                    ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?php echo $stock->stock_make . ' ' . $stock->stock_model; ?></td>
                                        <td><?php echo $stock->chasis_number; ?></td>
                                        <td><?php echo $stock->engine_number; ?></td>
                                        <td><?php echo $stock->plate_number; ?></td>
                                        <td><?php echo $stock->color_name; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total cost</th>
                                    <th>Amount paid</th>
                                    <th>Balance</th>
                                </tr>
                                <tr>
                                    <td><?php echo number_format($price, 2); ?></td>
                                    <td><?php echo number_format($amt_pd, 2); ?></td>
                                    <td><?php echo number_format($bal, 2); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row text-muted well well-sm no-shadow">
      <!-- accepted payments column -->
      <div class="col-xs-8">
          <h5 class="">Terms and conditions</h5>
        <p class="" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <!-- /.col -->
    </div>
    <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
    </body>
</html>


