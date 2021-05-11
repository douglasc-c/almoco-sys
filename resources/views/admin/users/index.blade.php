@extends('admin.layouts.default')

@section('title')
{{$title}} -
@parent
@stop

@section('content')
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h2 class="text-white font-weight-bold my-2 mr-5">{{$title}}</h2>
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
			<div class="row">
                {{-- <a href="{{URL::action('Admin\UsersController@deleteData')}}" class="btn btn-danger">teste</a> --}}
            	<div class="col-md-12">
            		<div class="card card-custom card-stretch gutter-b">
                        <div class="card-body">

                        	<div class="table-responsive">
                                <table id="users-table" class="table table-hover m-b-0 table-striped table-bordered">
                                    <thead>
								        <tr>
								          <th>#</th>
								          <th>Reffer Code</th>
								          <th>Name</th>
								          <th>E-mail</th>
								          <th>Created at</th>
								          <th>Doc. Validated</th>
								          <th>Actions</th>
								        </tr>
							      	</thead>
                                </table>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

            <div id="modal-history" class="modal fade" role="dialog" style="margin-top: 300px">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">User Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div id="modal-loader" style="display: none; text-align: center;">
                      <img src="/assets/img/icons/loading.gif" style="max-height: 40px;">
                    </div>

                    <div id="dynamic-content"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
@endsection

@section('styles')
<style type="text/css">
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 0;
    width: 100vw;
    height: 100vh;
    background-color: #000;
    margin-top: 500px;
}

modal {
    position: absolute;

}
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{URL::action('Admin\UsersController@dataUsers')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'code', name: 'code' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'validated', name: 'validated' },

                { data: 'action', name: 'action' },
            ]
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click', '#getUserHistory', function(e){

   e.preventDefault();

   var uid = $(this).data('id'); // get id of clicked row

   $('#dynamic-content').html(''); // leave this div blank
   $('#modal-loader').show();      // load ajax loader on button click

   $.ajax({
        url: "{{URL::to('admin/users/data-users/info')}}/"+uid,
        type: 'GET',
        dataType: 'html'
   })
   .done(function(data){
        console.log(data);
        $('#dynamic-content').html(''); // blank before load.
        $('#dynamic-content').html(data); // load here
        $('#modal-loader').hide(); // hide loader
   })
   .fail(function(){
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').hide();
   });

  });
});
</script>
@stop
