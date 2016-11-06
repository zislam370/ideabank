@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('form_payment_disbursments/title.edit') ::
@parent
@stop


{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form_payment_disbursments/title.edit')
    <div class="pull-right">
        <a href="{{ route('form_payment_disbursments') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> @lang('button.back')</a>
    </div>
</h1>
@stop


{{-- Page content --}}
@section('content')

<form autocomplete="off" method="post" class="form-horizontal margin-none" novalidate="novalidate">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Widget -->
    <div class="widget">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">@lang('form_payment_disbursments/title.create.sub')</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body innerAll inner-2x">

                    <div class="form-group">
            {{ Form::label('Installment', 'Installment:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('Installment', Input::old('Installment'), array('class'=>'form-control', 'placeholder'=>'Installment')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('disburse_date', 'Disburse_date:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('disburse_date', Input::old('disburse_date'), array('class'=>'form-control', 'placeholder'=>'Disburse_date')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('amount', 'Amount:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('amount', Input::old('amount'), array('class'=>'form-control', 'placeholder'=>'Amount')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('remark', 'Remark:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('remark', Input::old('remark'), array('class'=>'form-control', 'placeholder'=>'Remark')) }}
            </div>
        </div>


            <div class="separator"></div>

            <!-- Form actions -->
            <div class="form-actions">
                <a class="btn btn-link" href="{{ route('form_payment_disbursments') }}">@lang('button.cancel')</a>
                <button type="submit" class="btn btn-primary">@lang('button.publish')</button>
            </div>
        </div>
    </div>
</form>
@stop