@extends('admin.layouts.default')

@section('title')
Withdrawals -
@parent
@stop

@section('content')

   <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
      <form id="frm" action="/admin/approve/all" method="POST">
        {{ csrf_field() }}
      <input type="hidden" name="ids" id="ids">
      <input type="hidden" name="password_finance" id="password_finance">
      <input type="hidden" name="type" id="type">
     <div class="section-wrapper mg-t-20">
          <div class="table-wrapper table-responsive">
           <table id="withdrawals-table" class="table v-middle p-0 m-0 box" data-plugin="dataTable">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>#</th>
                          <th>User</th>
                          <th>Created at</th>
                          <th>Amount</th>
                          <th>Address</th>
                          <th>Status</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                </table>
          </div>
        	<button type="submit" class="btn btn-success" onclick="makeAction('approve')">Check Selecteds</button>
        </div>
    </form>
  </div>
  </div>
  </div>

</div>

<div class="modal" id="modal-action" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content"  style="margin-top: 50%!important">
            <div class="modal-header" >
                <h5 class="modal-title">Approve </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-5">
                <div id="loading_approve">
                </div>
                <div id="show_approve_deposists" style="display: none">
                    <div style="text-align: center">
                      <h3 class="mt-35">Total to approve </h3>
                      <span id="approve_total_depositos">0</span>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="submitForm('queue')">Add to queue</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('styles')

<style type="text/css">
  .modal-backdrop.show {
    opacity: 0!important;
}
.modal-backdrop {
     position: relative;
}
</style>
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

@stop
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="//js.pusher.com/4.3/pusher.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

<script>
  // tell the embed parent frame the height of the content
  if (window.parent && window.parent.parent){
    window.parent.parent.postMessage(["resultsFrame", {
      height: document.body.getBoundingClientRect().height,
      slug: "snqw56dw"
    }], "*")
  }
</script>

<script type="text/javascript">

  function makeAction(type){
    $('#type').val(type);
  }


$(document).ready(function() {
   var table =  $('#withdrawals-table').DataTable({
            processing: true,
            serverSide: true,

              'columnDefs': [
                 {
                    'targets': 0,
                    'checkboxes': {
                       'selectRow': true
                    }
                 }
              ],
              'select': {
                 'style': 'multi'
              },
              'order': [[1, 'asc']]
              ,
            dom: 'Bfrtip',
            lengthChange: false,
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1,
            // buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            ajax: {
                url: '{{URL::action('Admin\WithdrawalsController@dataWithdrawalsAll',[$type_name,$status])}}',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          },


          columns: [

                { data: 'id', name: 'id' },
                { data: 'id', name: 'id' },
                { data: 'user', name: 'user' },
                { data: 'created_at', name: 'created_at' },

                { data: 'value', name: 'value' },
                { data: 'address', name: 'address' },
                { data: 'status', name: 'status' },
                { data: 'status_quueu', name: 'status_quueu' },
          ],

        });

   // Handle form submission event
   $('#frm').on('submit', function(e){

      var form = this;

      var rows_selected = table.column(0).checkboxes.selected();
      var ids = [];

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
          ids.push(rowId);


      });
      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production

      // Output form data to a console
      $('#example-console-rows').text(rows_selected.join(","));

      // Output form data to a console
      $('#example-console-form').text($(form).serialize());

      // Remove added elements
      $('input[name="id\[\]"]', form).remove();

      // Prevent actual form submission
      e.preventDefault();
      if( $('#type').val() == 'approve'){
        $('#modal-action').modal('toggle');
        $('#modal-action').modal('show');

        $('#ids').val(JSON.stringify(ids));
        var serverUrl = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;
        $.ajax({

         url: serverUrl + "/admin/get-approves/"+JSON.stringify(ids) , success: function(result){
          console.log(result);
          $('#approve_count_depositos').html(result.count);
          $('#approve_total_depositos').html(' '+result.total);

            $('#show_approve_deposists').show();
            $('#loading_approve').hide();
            }
          });
      }

   });
});

</script>
<script type="text/javascript">
  function submitForm(type){
    $('#type').val(type);

      document.getElementById("frm").submit();


  }

</script>
@stop
