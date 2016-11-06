@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('form/title.owner_management') ::
@parent
@stop

{{-- Page content title --}}
@section('content_title')
<h1>
    @lang('form/title.owner_management')

    <div class="pull-right">
        <a href="{{ route('show/idea',$ideaid) }}" class="btn btn-primary">@lang('button.back')</a>
    </div>
</h1>
@stop

{{-- Page Content --}}
@section('content')
<div class="widget">

    <div class="widget-body innerAll inner-2x">
        <a href="#modal-owners" data-toggle="modal" class="btn btn-success"><i class="fa fa-fw fa-plus"></i>@lang('button.create')</a>

        @if ($idea_owners->count() >= 1)
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
				<th>@lang('form/title.owner')</th>
				<th>@lang('form/title.mobile')</th>
				<th>@lang('form/title.active')</th>
				<th></th>

                </tr>
            </thead>

            <tbody>
                @foreach ($idea_owners as $owner)
                    <tr>
                        <td>{{{ $owner->owner->first_name }}}</td>
                        <td>{{{ $owner->owner->mobile }}}</td>
                        <td>
                            @if ($owner->active)
                            <i class="fa fa-check-square"></i>
                            @else
                            <i class="fa fa-square-o"></i>
                            @endif
                        </td>
					<td>
                        @if ($owner->active)
                        <a class="btn btn-danger btn-xs"  href="{{ route('deactivate/idea_owners', $owner->id) }}"><i class="fa fa-thumbs-down"></i></a>
                        @else
                        <a class="btn btn-success btn-xs"  href="{{ route('activate/idea_owners', $owner->id) }}"><i class="fa fa-thumbs-up"></i></a>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


<!-- Modal -->
@else
@lang('general.noresults')
@endif
@stop

{{-- Body Bottom confirm modal --}}
@section('body_bottom')
<!-- Modal -->
<div class="modal fade" id="modal-owners">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body padding-none">
                <h2>@lang('button.create')</h2>
                <br>
                <form class="form-horizontal" role="form" method="post" action="{{ route('create/idea_owners',$ideaid) }}" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        {{ Form::label('body', Lang::get('form/title.mobile'), array('class'=>'col-sm-2 control-label')) }}
                        <div class="col-sm-8">
                            {{ Form::input('text', 'owner_mobile', Input::old('owner_mobile'), array('class'=>'form-control','id'=>'owner_mobile')) }}
                        </div>
                    </div>
                    <!-- Form actions -->
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-success">@lang('button.send')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

    });
</script>
@stop