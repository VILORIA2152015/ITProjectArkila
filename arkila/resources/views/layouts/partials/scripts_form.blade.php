    <!-- jQuery 3 -->
    {{ Html::script('adminlte/bower_components/jquery/dist/jquery.min.js') }}
    <!-- jQuery UI 1.11.4 -->
    {{ Html::script('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }} 
    <!-- Bootstrap 3.3.7 -->
    {{ Html::script('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    <!-- Select2 -->
    {{ Html::script('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}
    <!-- InputMask -->
    {{ Html::script('adminlte/plugins/input-mask/jquery.inputmask.js') }}
    {{ Html::script('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}
    {{ Html::script('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}
    <!-- date-range-picker -->
    {{ Html::script('adminlte/bower_components/moment/min/moment.min.js') }}
    {{ Html::script('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}
    <!-- bootstrap datepicker -->
    {{ Html::script('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
    <!-- bootstrap color picker -->
    {{ Html::script('adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}
    <!-- bootstrap time picker -->
    {{ Html::script('adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}
    <!-- SlimScroll -->
    {{ Html::script('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}
    <!-- iCheck 1.0.1 -->
    {{ Html::script('adminlte/plugins/iCheck/icheck.min.js') }}
    <!-- SlimScroll -->
    {{ Html::script('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}
    {{Html::script('adminlte/bower_components/Chart.js/Chart.js')}}
    <!-- FastClick -->
    {{ Html::script('adminlte/bower_components/fastclick/lib/fastclick.js') }}
    <!-- AdminLTE App -->
    {{ Html::script('adminlte/dist/js/adminlte.min.js') }}
    <!-- AdminLTE for demo purposes -->
    {{ Html::script('adminlte/dist/js/demo.js') }}
    <!-- Parsley -->
    {{ Html::script('adminlte/plugins/iCheck/icheck.min.js') }}
    {{ Html::script('js/client-side_validation/parsley.min.js') }}
    {{ Html::script('js/client-side_validation/member-validation.js') }}
    {{ Html::script('js/client-side_validation/van-validation.js') }}
    {{ Html::script('js/client-side_validation/settings-validation.js') }}
    {{ Html::script('js/client-side_validation/booking-form-validation.js') }}
    {{ Html::script('js/client-side_validation/driver-report-validation.js') }}
    {{ Html::script('js/notifications/pnotify.custom.min.js') }}
    {{ Html::script('js/notifications/bootstrap-notify.min.js') }}
    
    <!-- Van Queue Sidebar -->

    <script>    
    $(function () {
        $('.select2').select2();
    })
    </script>
    <script>
        $('#addQueueSideBarButt').on('click', function() {
            var destination = $('#destinationInputSideBar').val();
            var van = $('#vanInputSideBar').val();
            var driver = $('#driverInputSideBar').val();

            if( destination != "" && van != "" && driver != ""){
                $.ajax({
                    method:'POST',
                    url: '/home/trips/'+destination+'/'+van+'/'+driver,
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function(){
                        location.reload();
                    }

                });

            }
        });
    </script>

    <!-- Ticket Management Sidebar -->
    <script>
        $(function(){
            checkTerminalsSideBar();
            listDestinationsSideBar();
            checkDiscountBoxSideBar();

            $('#checkDiscountTicketSideBar').on('click',function(){
                checkDiscountBoxSideBar();
            });

            $('#terminalTicketSideBar').on('change',function(){
                listDestinationsSideBar();
            });

            $(document.body).on('click','#sellButtSideBar',function(){
                var terminalSideBar = $('#terminalTicketSideBar').val();
                var destination = $('#destinationTicketSideBar').val();
                var discount = $('#discountTicketSideBar').val();
                var ticket= $('#ticketSellSideBar').val();

                $.ajax({
                    method:'POST',
                    url: '{{route("transactions.store")}}',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'terminal': terminalSideBar,
                        'destination': destination,
                        'discount': discount,
                        'ticket': ticket
                    },
                    success: function(){
                        location.reload();
                    }

                });

            });

            function checkTerminalsSideBar(){
                if(!$('#terminalTicketSideBar').val()){
                    $('#terminalTicketSideBar').prop('disabled',true);
                    $('#terminalTicketSideBar').append('<option value="">No Available Terminal</option>');
                }
            }

            function checkDiscountBoxSideBar(){
                if($('#checkDiscountTicketSideBar').is(':checked')){
                    $('#discountTicketSideBar').prop('disabled',false);
                    listDiscountedSideBarTickets();
                }else{
                    $('#discountTicketSideBar').prop('disabled',true);
                    $('#discountTicketSideBar').append('<option value="" selected>Check the checkbox to enable discount</option>');
                }
            }

            function listDestinationsSideBar() {
                $('#destinationTicketSideBar').empty();
                if ($('#terminalTicketSideBar').val()) {
                    $.ajax({
                        method: 'GET',
                        url: '/listDestinations/' + $('#terminalTicketSideBar').val(),
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        success: function (destinations) {
                            if (destinations.length === 0) {
                                $('#destinationTicketSideBar').empty();
                                $('#destinationTicketSideBar').prop('disabled', true);
                                $('#destinationTicketSideBar').append('<option value="">No Available Destination</option>');
                            }
                            else {
                                destinations.forEach(function (destination) {
                                    $('#destinationTicketSideBar').append('<option value=' + destination.id + '> ' + destination.description + '</option>');
                                });
                                listTickets();
                            }

                        }
                    });
                }else{
                    $('#destinationTicketSideBar').prop('disabled', true);
                    $('#destinationTicketSideBar').append('<option value="">No Available Destination</option>');
                }
            }

            function listTickets() {
                $('#ticketSellSideBar').empty();
                $.ajax({
                    method: 'GET',
                    url: '/listTickets/' + $('#terminalTicketSideBar').val(),
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (tickets) {

                        if (tickets.length === 0) {
                            $('#ticketSellSideBar').prop('disabled', true);
                            $('#ticketSellSideBar').append('<option value =""> Tickets Not Available</option>');
                        }
                        else {
                            $('#ticketSellSideBar').prop('disabled', false);
                            tickets.forEach(function (ticket) {
                                $('#ticketSellSideBar').append('<option value=' + ticket.id + '> ' + ticket.ticket_number + '</option>');
                            });
                            checkSellButton();
                        }

                    }
                });
            }

            function listDiscountedSideBarTickets(){
                $('#ticketSellSideBar').empty();
                $.ajax({
                    method: 'GET',
                    url: '/listDiscountedTickets/' + $('#terminalTicketSideBar').val(),
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (tickets) {

                        if (tickets.length === 0) {
                            $('#ticketSellSideBar').prop('disabled', true);
                            $('#ticketSellSideBar').append('<option value =""> Tickets Not Available</option>');
                        }
                        else {
                            $('#ticketSellSideBar').prop('disabled', false);
                            tickets.forEach(function (ticket) {
                                $('#ticketSellSideBar').append('<option value=' + ticket.id + '> ' + ticket.ticket_number + '</option>');
                            });
                            checkSellButton();
                        }

                    }
                });
            }

            function checkSellButton(){
                var terminalSideBar = $('#terminalTicketSideBar').val();
                var destination = $('#destinationTicketSideBar').val();
                var ticket = $('#ticketSellSideBar').val();

                if(terminalSideBar && destination && ticket ){
                    $('#sellButtContainerSideBar').empty();
                    $('#sellButtContainerSideBar').append('<button id="sellButtSideBar" type="button" class="btn btn-info btn-flat">Sell</button>');
                }

            }

        });
    </script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
        
    </script>
    <!-- Special Unit Checker -->
  <script>
      $(function(){
          function specialUnitChecker(){
              $.ajax({
                  method:'POST',
                  url: '{{route("trips.specialUnitChecker")}}',
                  data: {
                      '_token': '{{csrf_token()}}'
                  },
                  success: function(response){
                      if(response[0]) {
                          $('#confirmBoxModal').load('/showConfirmationBox/' + response[0]);
                      }else{
                          if(response[1]){
                              $('#confirmBoxModal').load('/showConfirmationBoxOB/'+response[1]);
                          }
                      }
                  }

              });
          }

          specialUnitChecker();
      });
  </script>