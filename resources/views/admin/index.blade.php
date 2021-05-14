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

@endsection
