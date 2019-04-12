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
            if (value < 0) {
                $("#product_balance").val(0);
                $("#product_cash_paid").val($('#product_sales_price').val());
                $("#product_cash_paid").disable();
            } else {
                $("#product_balance").val(value);
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

        $('#balance_pay').keyup(function () {
            var x = $('#outstanding_balance').val();
            var y = $('#balance_pay').val();
            if ((x - y) <= 0) {
                $('#balance_pay').val($('#outstanding_balance').val());
                $('#balance_pay').disable();
            }
        })
// function refreshPage(){
//   window.load();
// }

// function update() {
//   // $("#balance").val();
//   var value = $('#amount').val() - $('#cash').val();
//   if (value < 0) {
//     $("#balance").val(0);
//     $("#cash").val($('#amount').val());
//     $("#cash").disable();
//   }else{
//     $("#balance").val(value);
//   }

// }
// function schedulePay(){
//   if ($('#balance').val() <= 0){
//     $("#payment_date").hide();
//   }else{
//     $("#payment_date").show();
//   }}

        // $("#cash").keyup(function(){
        //     $("#balance").hide();
        // })


//        $('#display_selected_products > tbody:last-child').append('<tr><td>'+(data[0])+'</td></tr>');
//    })

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()
//    $('#calendar').fullCalendar({
//      header    : {
//        left  : 'prev,next today',
//        center: 'title',
//        right : 'month,agendaWeek,agendaDay'
//      },
//      buttonText: {
//        today: 'today',
//        month: 'month',
//        week : 'week',
//        day  : 'day'
//      },
//      //Random default events
//      events    : [
//        {
//          title          : 'All Day Event',
//          start          : new Date(y, m, 1),
//          backgroundColor: '#f56954', //red
//          borderColor    : '#f56954' //red
//        },
//        {
//          title          : 'Long Event',
//          start          : new Date(y, m, d - 5),
//          end            : new Date(y, m, d - 2),
//          backgroundColor: '#f39c12', //yellow
//          borderColor    : '#f39c12' //yellow
//        },
//        {
//          title          : 'Meeting',
//          start          : new Date(y, m, d, 10, 30),
//          allDay         : false,
//          backgroundColor: '#0073b7', //Blue
//          borderColor    : '#0073b7' //Blue
//        },
//        {
//          title          : 'Lunch',
//          start          : new Date(y, m, d, 12, 0),
//          end            : new Date(y, m, d, 14, 0),
//          allDay         : false,
//          backgroundColor: '#00c0ef', //Info (aqua)
//          borderColor    : '#00c0ef' //Info (aqua)
//        },
//        {
//          title          : 'Birthday Party',
//          start          : new Date(y, m, d + 1, 19, 0),
//          end            : new Date(y, m, d + 1, 22, 30),
//          allDay         : false,
//          backgroundColor: '#00a65a', //Success (green)
//          borderColor    : '#00a65a' //Success (green)
//        },
//        {
//          title          : 'Click for Google',
//          start          : new Date(y, m, 28),
//          end            : new Date(y, m, 29),
//          url            : 'http://google.com/',
//          backgroundColor: '#3c8dbc', //Primary (light-blue)
//          borderColor    : '#3c8dbc' //Primary (light-blue)
//        }
//      ],
//      editable  : true,
//      droppable : true, // this allows things to be dropped onto the calendar !!!
//      drop      : function (date, allDay) { // this function is called when something is dropped
//
//        // retrieve the dropped element's stored Event Object
//        var originalEventObject = $(this).data('eventObject')
//
//        // we need to copy it, so that multiple events don't have a reference to the same object
//        var copiedEventObject = $.extend({}, originalEventObject)
//
//        // assign it the date that was reported
//        copiedEventObject.start           = date
//        copiedEventObject.allDay          = allDay
//        copiedEventObject.backgroundColor = $(this).css('background-color')
//        copiedEventObject.borderColor     = $(this).css('border-color')
//
//        // render the event on the calendar
//        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
//        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)
//
//        // is the "remove after drop" checkbox checked?
//        if ($('#drop-remove').is(':checked')) {
//          // if so, remove the element from the "Draggable Events" list
//          $(this).remove()
//        }
//
//      }
//    })

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({'background-color': currColor, 'border-color': currColor})
        })

        $('#add-new-event').click(function (e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event)

            //Add draggable funtionality
            init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })
        $(document).ready(function () { //// when page loads, hide fields for new and existing customers
            $('#new_customer').hide();
            $('#existing_customer').hide();
            $('#payment_date').hide();
            $("#display_selected_products").hide();
            $("#new_supplier").hide();
            $("#existing_supplier").hide();
            $("#vehicle_number_plate").hide();
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
    })

</script>