@extends('layouts.master')

@section('title','Van Queue')

@section('links')
  @parent
  <link rel="stylesheet" href="{{ URL::asset('/jquery/bootstrap3-editable/css/bootstrap-editable.css') }}">

    <style>
    
    body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.vertical{
  margin: 0 0 9px 0;
  min-height: 10px;
}
  ol.vertical li{
    display: block;
    color: $linkColor;
    background: $grayLighter;
  }


  ol.vertical li.placeholder{
    position: relative;
    margin: 0;
    padding: 0;
    border: none;
  }
  ol.vertical li.placeholder:before{
      position: absolute;
      content: "";
      width: 0;
      height: 0;
      margin-top: -5px;
      right: -8px;
      top: -4px;
      border: 8px solid transparent;
      border-right-color: black;
      border-left: none;
    }



    ol {
     /* Initiate a counter */
    list-style: none; /* Remove default numbering */
    *list-style: decimal; /* Keep using default numbering for IE6/7 */
    font: 15px 'trebuchet MS', 'lucida sans';
    padding: 0;
    margin-bottom: 4em;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    }

    ol ol {
        margin: 0 0 0 2em; /* Add some left margin for inner lists */
    }


   .rectangle-list span{
    position: relative;
    display: block;
    padding: .4em .4em .4em .8em;
    *padding: .4em;
    margin: .5em 0 .5em 2.5em;
    background: #ddd;
    color: #444;
    text-decoration: none;
    transition: all .3s ease-out;   
}

.rectangle-list span:hover{
    background: #eee;
}   

.queuenum a{
    counter-increment: li;
    position: absolute; 
    left: -2.5em;
    top: 50%;
    margin-top: -1em;
    background: #fa8072;
    height: 2em;
    width: 2em;
    line-height: 2em;
    text-align: center;
    font-weight: bold;
    color: black;
}

.queuenum a:before{
    position: absolute; 
    content: '';
    border: .5em solid transparent;
    left: -1em;
    top: 50%;
    margin-top: -.5em;
    transition: all .3s ease-out;               
}

#queue-list:first-child{
  background: yellow;
}

.dropped{
  background: #a3feb6;
}
/* SEARCH LIST; */


#myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#myUL li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
}

#myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  </style>
@endsection

@section('content-header','WOW')

@section('content')
      <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">

              <div class="box-header with-border">
                  <h3 class="box-title">Add Driver to Queue</h3>
              </div>
              <div class="box-body">
                      <label for="">Van Unit</label>
                      <select @if($vans->first() == null) {{'disabled'}} @endif name="van" id="van" class="form-control select2">
                          @if($vans->first() != null)
                              @foreach ($vans as $van)
                                <option value="{{$van->plate_number}}">{{ $van->plate_number }}</option>
                              @endforeach
                          @else
                              <option> No Available Data</option>
                          @endif
                       </select>

                       <label for="">Destination</label>
                      <select @if($destinations->first() == null) {{'disabled'}} @endif name="destination" id="destination" class="form-control">
                          @if($destinations->first() != null)
                            @foreach ($destinations as $destination)
                                <option value="{{$destination->destination_id}}">{{ $destination->description }}</option>
                            @endforeach
                          @else
                              <option> No Available Data</option>
                          @endif

                      </select>


                       <label for="">Driver</label>
                      <select @if($drivers->first() == null) {{'disabled'}} @endif name="driver" id="driver" class="form-control">
                          @if($drivers->first() != null)
                              @foreach ($drivers as $driver)
                                  <option value="{{$driver->member_id}}">{{ $driver->full_name }}</option>
                              @endforeach
                          @else
                              <option> No Available Data</option>
                          @endif
                      </select>
              </div>
                @if($vans->first() != null && $destinations->first() !=null && $drivers ->first() !=null)

                      <div class="box-footer">
                          <div class="pull-right">
                              <button id="addQueueButt" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add to Queue</button>
                          </div>
                      </div>
                @endif

            </div>
        </div>

        <div class="col-md-6">
          <!-- Van Queue Box -->
          <div class="box box-solid">
            <div class="box-header">
              <h3 class="box-title">Van Queue</h3>
            </div>
            <div class="box-body">

              <div class="nav-tabs-custom ">
                <ul class="nav nav-tabs ">
                  <li class="tab-menu active" id="vanQueueTab-menu"><a href="#cabanatuanQueueTab" data-toggle="tab">Cabanatuan City</a></li>
                  <li class="tab-menu" id="privilegeTab-menu"><a href="#sanjoseQueueTab" data-toggle="tab">San Jose City</a></li>
                </ul>
                <div class="tab-content">
                <!-- Cabanatuan Queue Tab -->
                  <div class="tab-pane active" id="cabanatuanQueueTab">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-search"></i></span>
                      <input type="email" id="queueSearch" class="form-control" placeholder="Search in queue" onkeyup="myFunction()">
                    </div>
                    <ol id ="queue-list" class="vertical rectangle-list serialization">
                        @foreach ($trips as $trip)
                          <li class="" data-plate="{{ $trip->van->plate_number}}" data-remark="{{ $trip->remarks }}">
                            <span class="dropped">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="queuenum">
                                  <a href="" id="queue{{ $trip->trip_id}}" name="{{$trip->van->plate_number}}" data-type="select" data-title="Queue number" class="queue-editable">{{ $trip->queue_number }}</a>
                                </div>
                                
                                <p>
                                  <a href="" ><i class="fa fa-map-marker inline"></i></a>
                                {{ $trip->van->plate_number }}
                                </p>
                              </div>
                              <div class="col-md-6">
                                <div class="pull-right">
                                  <a href="" id="remark{{ $trip->trip_id}}" name="{{$trip->van->plate_number}}"  data-type="select" data-title="Update Remark" class="remark-editable btn btn-outline-secondary btn-sm editable" data-original-title="" title="">{{ $trip->remarks }}</a>

                                  
                                  
                                  <a href="" class="" data-toggle="modal" data-target="#modal-default{{$trip->trip_id}}"><i class="fa fa-remove text-red"></i></a>
                                </div>
                              </div>
                            </div>
                          </span>

                              <div class="modal fade" id="modal-default{{$trip->trip_id}}">
                                  <div class="modal-dialog modal-sm">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title"><i class="fa fa-info"></i> Alert</h4>
                                          </div>
                                          <div class="modal-body">
                                              <p>Will be deleted</p>
                                          </div>
                                          <div class="modal-footer">
                                              <form method="POST" action="{{route('trips.destroy',[$trip->trip_id])}}">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  {{csrf_field()}}
                                                  {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                              </form>
                                          </div>
                                      </div>
                                      <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->

                          </li>
                        @endforeach
                    </ol>
                  </div>
                  <div class="tab-pane" id="sanjoseQueueTab">
                    
                  </div>
                </div>
              </div>

              
            </div>
          </div>
        </div>
               
         <div class="col-md-3">
          <!-- Special Unit -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Special Units</h3>
            </div>
            <div class="box-body">

                <ol class="rectrangle-list">
                  <li class="" data-plate="{{ $trip->van->plate_number ?? null}}" data-remark="{{ $trip->remarks ?? null}}">
                            <div class="row">
                              <div class="col-md-6">
                                
                                <p>
                                
                                {{ $trip->van->plate_number ?? null }}
                                </p>
                              </div>
                              <div class="col-md-6">
                                <div class="pull-right">
                                  <a href="" id="remark{{ $trip->trip_id ?? null}}" name="{{$trip->van->plate_number ?? null}}"  data-type="select" data-title="Update Remark" class="remark-editable btn btn-outline-secondary btn-sm editable" data-original-title="" title=""><i class="fa fa-info"></i></a>

                                  
                                  
                                  <a href="" class="" data-toggle="modal" data-target="#modal-default"><i class="fa fa-remove text-red"></i></a>
                                </div>
                              </div>
                            </div>
                          </li>
                  
                </ol>
              </div>
             </div>
        </div>
      </div>
        <pre id="serialize_output2"></pre>


@endsection

@section('scripts')
  @parent

  
  <script src="{{ URL::asset('/jquery/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
  <script src="{{ URL::asset('/jquery/jquery-sortable.js') }}"></script>
  <script>
    $('.select2').select2();
  </script>
    <!-- List sortable -->
    <script>
        $(document).ready(function() {
            $('#addQueueButt').on('click', function() {
                var destination = $('#destination').val();
                var van = $('#van').val();
                var driver = $('#driver').val();

                if( destination != "" && van != "" && driver != ""){
                    $.ajax({
                        method:'POST',
                        url: '/home/trips/'+destination+'/'+van+'/'+driver,
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        success: function(vanInfo){
                            location.reload();
                        }

                    });

                }
            });




        var group = $("ol.serialization").sortable({
        group: 'serialization',
        delay: 500,
        onDrop: function ($item, container, _super) {
          var queue = group.sortable("serialize").get();

          var jsonString = JSON.stringify(queue, null, ' ');

          $('#serialize_output2').text(jsonString);
          _super($item, container);

          $.ajax({
            method:'POST',
            url: '{{route("trips.updateVanQueue")}}',
            data: {
                '_token': '{{csrf_token()}}',
                'vanQueue': queue
            },
            success: function(vanInfo){
               console.log(vanInfo);
            }

        });

        }
      });

    @foreach($trips as $trip)

      $('#remark'+{{$trip->trip_id}}).editable({
         value: "@if(is_null($trip->remarks)){{'NULL'}}@else{{$trip->remarks}}@endif",
          source: [
                {value: 'NULL', text: 'Give Remarks'},
                {value: 'CC', text: 'CC'},
                {value: 'ER', text: 'ER'},
                {value: 'OB', text: 'OB'}
             ]
      });


    @endforeach

     @foreach($trips as $trip)
      $('#queue'+{{$trip->trip_id}}).editable({
          value: {{ $trip->queue_number }},
          source: [
          @foreach($trips as $trip)
                  {value: '{{ $trip->queue_number }}', text: '{{ $trip->queue_number }}' },
          @endforeach
          ]
      });
     @endforeach

        });
</script>

<script>

          function myFunction() {
                // Declare variables
                var input, filter, ol, li, span, i;
                input = document.getElementById('queueSearch');
                filter = input.value.toUpperCase();
                ol = document.getElementById('queue-list');
                li = ol.getElementsByTagName('li');

                // Loop through all list items, and hide those who don't match the search query
                for (i = 0; i < li.length; i++) {
                    span = li[i].getElementsByTagName("span")[0];
                    if (span.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
    </script>

@endsection
