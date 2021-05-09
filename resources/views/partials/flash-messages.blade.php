@if(Session::has('success'))
<script type="text/javascript">
   window.onload = function() {
     showAlertToast('success', "{{ Session::get('success') }}");
   };
</script>
<div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" id="toastSuccess">
   <div class="d-flex alinha">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   <div class="d-flex info-toast">
      <div class="toast-body">
         {!! Session::get('success') !!}
      </div>
   </div>
</div>
<script>
   setTimeout(function(){
   $('#toastSuccess').remove();
   }, 5000);
</script>
@endif
@if(Session::has('info'))
<script type="text/javascript">
   window.onload = function() {
     showAlertToast('info', "{{Session::get('info')}}");
   };
</script>
<div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" id="toastAlert">
   <div class="d-flex alinha">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   <div class="d-flex info-toast">
      <div class="toast-body">
         {!! Session::get('info') !!}
      </div>
   </div>
</div>
<script>
   setTimeout(function(){
   $('#toastAlert').remove();
   }, 5000);
</script>
@endif
@if(Session::has('danger'))
<script type="text/javascript">
   window.onload = function() {
     showAlertToast('danger', "{{Session::get('danger')}}");
   };
</script>
<div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" id="toastError">
   <div class="d-flex alinha">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   <div class="d-flex info-toast">
      <div class="toast-body">
         {!! Session::get('danger') !!}
      </div>
   </div>
</div>
<script>
   setTimeout(function(){
   $('#toastError').remove();
   }, 5000);
</script>
@endif