<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.2.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://thinkinnovation.tech">Think Innovation</a>.</strong> All rights
    reserved.
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        $('#example1').DataTable()
        $('#example3').DataTable()
        $('#example4').DataTable()
        $('#example5').DataTable()
        $('#example6').DataTable()
        $('#example7').DataTable()
        $('#example8').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
        /*
         * Custom functions by Gift
         * --------------------------------------------------------------
         */
        // var product = null;
        var data = null;
        $('#select_product').change(function () {
            // var row_ids = Math.round(Math.random() * 300000000);
            product = $(this).children("option:selected").val();
            var text_value = $(this).children("option:selected").text();
            var data = text_value.split(" ", 11);
            window.y = data[7];
            $("#display_selected_products").show();

            $("#display_selected_products").find('tbody tr')

                    .append($('<td>')
                            .text(data[0] + ' ' + data[1] + ' ' + data[2] + ' ' + data[3] + ' ' + data[4] + ' ' + data[5])
                            )
                    .append($('<td>')
                            .text(data[8])
                            )
                    .append($('<td>')
                            .text(data[10])
                            )
                    .append($('<td>')
                            .append($('<input type="button" class="btn btn-danger pull-right" id="product_in_list" value="Remove">'))
                            )
                    var price = data[8].split(".",2);
                    var formated_price = price[0].split(",",price[0].length);
                    $('#selectedProductPrice').val(formated_price);
                    var expense = data[10].split(".",2);
                    var formated_expense = expense[0].split(",",expense[0].length);
                    $('#selectedProductExpense').val(formated_expense);
                    // console.log(formated_price);
            $('#stock_purchase_price').val(data[8]);
            $('#stock_expense_cost').val(data[10]);
            // )
            $('#product_in_list').click(function () {
                $(this).parent().parent().remove()
                $("#display_selected_products").hide();
                $('#stock_purchase_price').val(0);
                $('#stock_expense_cost').val(0);
                $("#display_selected_products").find('tbody')
                        .append($('<tr>'))
            })
        })

/////////////////////////////////////////////////////////////////////////////////////////////

        $('#product_sales_price').keyup(function () {
            var price = Number($("#selectedProductPrice").val());
            var expenses = Number($("#selectedProductExpense").val());
            var total_product_cost = (price + expenses);
            var sales_price = Number($("#product_sales_price").val());
            $("#product_profit").val(sales_price - total_product_cost);
        })

////////////////////////////////////////////////////////////////////////////////////////////

        $("#product_cash_paid").keyup(function () {
            $("#product_balance").val();
            var value = $('#product_sales_price').val() - $('#product_cash_paid').val();
            var instant_profit = $('#product_cash_paid').val() - $('#selectedProductPrice').val();
            if (value < 0) {
                $("#product_balance").val(0);
                $("#capital_recovered").val(0);
                $("#profit_recovered").val(0);
                $("#product_cash_paid").val($('#product_sales_price').val());
                $("#product_cash_paid").disable();
            } else {
                $("#product_balance").val(value);
                if(instant_profit > 0){
                 $("#capital_recovered").val($('#selectedProductPrice').val());
                 $("#profit_recovered").val(instant_profit);    
                }else{
                  $("#capital_recovered").val($('#product_cash_paid').val());
                  $("#profit_recovered").val(0);  
                }
            }
        })

////////////////////////////////////////////////////////////////////////////////////////////

        $("#purchase_cash").keyup(function () {
            $("#purchase_balance").val();
            var value = $('#purchase_amount').val() - $('#purchase_cash').val();
            if (value < 0) {
                $("#purchase_balance").val(0);
                $("#purchase_cash").val($('#purchase_amount').val());
                $("#purchase_cash").disable();
            } else {
                $("#purchase_balance").val(value);
            }
        })

///////////////////////////////////////////////////////////////////////////////////////////
        
        // $('#balance_pay').keyup(function () {
        //     var x = $('#outstanding_balance').val();
        //     var y = $('#balance_pay').val();
        //     if ((y-x) >= 0) {
        //         $('#balance_pay').val($('#outstanding_balance').val());
        //         $('#balance_pay').disable();
        //     }
        // })

        // $('#balance_pay_2').keyup(function () {
        //     var x = $('#outstanding_balance_2').val();
        //     var y = $('#balance_pay_2').val();
        //     if ((y-x) >= 0) {
        //         $('#balance_pay_2').val($('#outstanding_balance_2').val());
        //         $('#balance_pay_2').disable();
        //     }
        // })
        
        $(document).ready(function () { //// when page loads, hide fields for new and existing customers
            $('#new_customer').hide();
            $('#existing_customer').hide();
            $('#payment_date').hide();
            $("#display_selected_products").hide();
            $("#new_supplier").hide();
            // $("#existing_supplier").hide();
            $("#vehicle_number_plate").hide();
            // $("#existing_brand").hide();
            $("#new_brand").hide();
            $("#new_car_color").hide();
        })
        $('#optionsRadios2').click(function () { // when new customer selected, show new customer fields.
            $('#new_customer').hide();
            $('#existing_customer').show();
            $('#new_supplier').hide();
            $('#existing_supplier').show();
        })
        $('#optionsRadios1').click(function () { // when existing customer selected, show existing customer field
            $('#existing_customer').hide();
            $('#new_customer').show();
            $('#existing_supplier').hide();
            $('#new_supplier').show();
        })
        $('#optionsRadios4').click(function () { // when new supplier selected, show new supplier fields.
            $('#new_supplier').hide();
            $('#existing_supplier').show();
        })
        $('#optionsRadios3').click(function () { // when existing supplier selected, show existing supplier field
            $('#existing_supplier').hide();
            $('#new_supplier').show();
        })
        $('#optionsRadios5').click(function () {
            $('#vehicle_number_plate').hide();
        })
        $('#optionsRadios6').click(function () { 
            $('#vehicle_number_plate').show();
        })
        $('#optionsRadios7').click(function () { 
            $('#new_brand').show();
            $('#existing_brand').hide();
        })
        $('#optionsRadios8').click(function () { 
            $('#existing_brand').show();
            $('#new_brand').hide();
        })
        $('#optionsRadios9').click(function () { 
            $('#existing_car_color').show();
            $('#new_car_color').hide();
        })
        $('#optionsRadios10').click(function () { 
            $('#new_car_color').show();
            $('#existing_car_color').hide();
        })
        $('#new_password_again').keyup(function (){
            var password_again = $('#new_password_again').val();
            var password = $('#new_password').val();
            if(password != password_again){
                $('#password_notification').text('Password mismatch');
                $('#password_notification').show();
            }else{
                $('#password_notification').hide();
            }
        })
    });
// function controlPaymentInput(){
//     var x = $('#outstanding_balance').val();
//             var y = $('#balance_pay').val();
//             if ((y-x) >= 0) {
//                 $('#balance_pay').val($('#outstanding_balance').val());
//                 $('#balance_pay').disable();
//             }
// }

</script>