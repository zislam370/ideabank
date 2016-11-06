@extends('backend/layouts/dashboard_account')

{{-- Page title --}}
@section('title')
@lang('account/title.dashboardtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<div class="content">
<div class="innerTB">
<span style="color:#9962a6"><h2>@lang('account/form.Innovation_Project_formulation_status')</h2></span>
<div class="row">
<div class="col-md-12">

<div class="widget widget-tabs widget-small widget-inverse">
<div class="tab-content">
    <div id="Widget-tab-1-1" class="tab-pane fade in active">
        <div class="innerAll padding-bottom-none">
            <!-- Chart with lines and fill with no points -->
            <div style="height: 196px; padding: 0px; position: relative;" class="flotchart-holder" id="chart_mixed_1">
                <div class="legend">
                    <table style="position:absolute;bottom:42px;right:19px;;font-size:smaller;color:#dedede">
                        <tbody>
                        <tr>
                            <td class="legendColorBox">
                                <div style="border:1px solid #ccc;padding:1px">
                                    <div style="width:4px;height:0;border:5px solid #9962a6;overflow:hidden"></div>
                                </div>
                            </td>
                            <td class="legendLabel">@lang('account/form.Application')</td>
                            <td class="legendColorBox">
                                <div style="border:1px solid #ccc;padding:1px">
                                    <div style="width:4px;height:0;border:5px solid rgb(199,42,37);overflow:hidden"></div>
                                </div>
                            </td>
                            <td class="legendLabel">@lang('account/form.Projects')</td>
                            <td class="legendColorBox">
                                <div style="border:1px solid #ccc;padding:1px">
                                    <div style="width:4px;height:0;border:5px solid #3fb618; overflow:hidden"></div>
                                </div>
                            </td>
                            <td class="legendLabel">@lang('account/form.Implemented')</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    @foreach($capdev_div_ideas as $capdev_div_idea)
                    <?php $total = $capdev_div_idea->application+$capdev_div_idea->running+$capdev_div_idea->completed; ?>
                    <div class="col-md-2 col-sm-6">
                        <div class="widget icon-widget widget-primary">
                            <div class="widget-body innerAll half ">
                                <div style="position: relative; overflow: hidden; height: 100px;" id="graphFieldBar0chart-3" class="graphBarchart-3">
                                    @if($total>0)
                                    <?php $t = round(100*($capdev_div_idea->application/$total)) ?>
                                    <div style="height: {{$t}}px; background-color: #800080; left: 41px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                        {{$capdev_div_idea->application}}
                                        @else
                                        <div style="height: 2px; background-color: #800080; left: 41px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                            0
                                            @endif
                                        </div>
                                        @if($total>0)
                                        <?php $t = round(100*($capdev_div_idea->running/$total)) ?>
                                        <div style="height: {{$t}}px; background-color: #CC0000; left: 82px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                            {{$capdev_div_idea->running}}
                                            @else
                                            <div style="height: 2px; background-color: #CC0000; left: 82px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                0
                                                @endif
                                            </div>
                                            @if($total>0)
                                            <?php $t = round(100*($capdev_div_idea->completed/$total)) ?>
                                            <div style="height: {{$t}}px; background-color: #3fb618; left: 0px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                {{$capdev_div_idea->completed}}
                                                @else
                                                <div style="height: 2px; background-color: #3fb618; left: 0px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                    0
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top innerTB half text-large text-center">
                                            {{$capdev_div_idea->name}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<span class="hidden-xs hidden-sm inline-block"><span style="color:#9962a6"><h2>@lang('account/form.CAP_DEV_Project_Statistics_At_Glance')</h2></span>
<!--        <div class="navbar-brand">-->
<!--            @lang('account/form.Sector'):-->
<!--               <select class="selectpicker">-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--                   <option>@lang('account/form.Sector')</option>-->
<!--               </select>-->
<!--        </div>-->
<!--        <div class="navbar-brand">-->
<!--            @lang('account/form.Division'):-->
<!--            <select class="selectpicker">-->
<!--                <option>@lang('account/form.Division')</option>-->
<!--                <option>@lang('account/form.Dhaka')</option>-->
<!--                <option>@lang('account/form.Chittagong')</option>-->
<!--                <option>@lang('account/form.Rajshahi')</option>-->
<!--                <option>@lang('account/form.Rangpur')</option>-->
<!--                <option>@lang('account/form.Khulna')</option>-->
<!--                <option>@lang('account/form.Sylhet')</option>-->
<!--                <option>@lang('account/form.Borishal')</option>-->
<!--            </select>-->
<!--        </div>-->
        <br>
<form autocomplete="off" method="POST" class=" apply-nolazy form-horizontal margin-none">
<!-- Widget -->
<div class="widget">

<!-- Widget heading -->
<div class="widget-head">
    <h4 class="heading">@lang('form/title.filter')</h4>
</div>
<!-- // Widget heading END -->
<div class="widget-body innerAll inner-2x" style="margin: 0;padding: 10px!important;">
    <!-- Area -->
    <div class="form-group" style="margin: 0;padding: 0;">
        {{ Form::hidden('area_id', '',array('id'=>'area_id')); }}
        <label for="area_id" class="col-sm-4">Location @lang('form/title.location')</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" id="area_id_txt" style="width: 100%;" value="" />
                <div class="input-group-btn btn-group dropup">
                    <a href="javascript:;" class="btn btn-default" onclick="clearDomainSelection_area_id('#area_id'); return false;"><i class="fa fa-fw icon-delete-symbol"></i></a>
                </div>
                <div class="input-group-btn btn-group dropup">
                    <a href="javascript:;" class="btn btn-default" onclick="OpenModalAreaSel('area_id'); return false;"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Office -->
    <div class="form-group" style="margin: 0;padding: 0;">
        {{ Form::hidden('office_id', '',array('id'=>'office_id')); }}
        <label for="office_id" class="col-sm-4">Office @lang('form/title.office')</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input class="form-control" id="office_id_txt" style="width: 100%;" value="" />
                <div class="input-group-btn btn-group dropup">
                    <a href="javascript:;" class="btn btn-default" onclick="clearDomainSelection_office_id('#office_id'); return false;"><i class="fa fa-fw icon-delete-symbol"></i></a>
                </div>
                <div class="input-group-btn btn-group dropup">
                    <a href="javascript:;" class="btn btn-default" onclick="OpenModalOfficeSel('office_id'); return false;"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sectors -->
    <div class="form-group" style="margin: 0;padding: 0;">
        <label for="sectors" class="col-sm-4">Sectors @lang('form/title.sector')</label>
        <div class="col-sm-8">
            <input name="sectors" id="sectors" style="width: 100%;" value="" />
        </div>
    </div>
    <div class="separator"></div>
    <!-- Form actions -->
    <div class="control-group">
        <div class="controls">
            <a href="javascript:;" onclick="filter_capdev_stat();return false;" class="btn btn-default">@lang('button.refresh')</a>
        </div>
    </div>

</div>
</div>

</form>

    <div class="navbar-collapse collapse" id="capdev-stat">
          <table class="table table-bordered">
              <tbody>
              <tr>
                  <th></th>
                  <th colspan="3">@lang('account/form.Cumulative') </th>
                  <th>@lang('account/form.To_be_Completed')</th>
                  <th>@lang('account/form.Completed')</th>
                  <th>@lang('account/form.Not_Completed')</th>
                  <th>@lang('account/form.To_be_Started')</th>
                  <th>@lang('account/form.Started')</th>
                  <th>@lang('account/form.Not_Started')</th>
              </tr>
              <tr>
                  <th></th>
                  <th>@lang('account/form.Application')</th>
                  <th>@lang('account/form.Running')</th>
                  <th>@lang('account/form.Completed')</th>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              @foreach($capdev_div_idea_stat as $capdev_div_idea)
              <tr>
                  <th>
                      <a href="javascript:;" onclick="filter_capdev_stat_by_area({{$capdev_div_idea->id}});return false;">
                            {{$capdev_div_idea->name}}
                      </a>
                  </th>
                  <td bgcolor="#f08080">{{$capdev_div_idea->application?$capdev_div_idea->application:0}}</td>
                  <td bgcolor="#90ee90">{{$capdev_div_idea->running?$capdev_div_idea->running:0}}</td>
                  <td bgcolor="#3fb618">{{$capdev_div_idea->completed?$capdev_div_idea->completed:0}}</td>
                  <td bgcolor="#90ee90">{{$capdev_div_idea->will_complete?$capdev_div_idea->will_complete:0}}</td>
                  <td bgcolor="#3fb618">{{$capdev_div_idea->done?$capdev_div_idea->done:0}}</td>
                  <td bgcolor="#CC0000">{{$capdev_div_idea->not_completed?$capdev_div_idea->not_completed:0}}</td>
                  <td bgcolor="#90ee90">{{$capdev_div_idea->will_start?$capdev_div_idea->will_start:0}}</td>
                  <td bgcolor="#3fb618">{{$capdev_div_idea->started?$capdev_div_idea->started:0}}</td>
                  <td bgcolor="#CC0000">{{$capdev_div_idea->not_started?$capdev_div_idea->not_started:0}}</td>
              </tr>
              @endforeach

              </tbody>
          </table>
      </div>
</div>


<!-- CREATE TASK MODAL -->
<div class="modal fade Modal-Domain-Selector" id="modal-area-select">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">@lang('form/title.area_selector')</h3>
            </div>
            <!-- // Modal heading END -->

            <!-- Modal body -->
            <div class="modal-body">

                <div class="innerAll">
                    <div id="selection_div">
                        <div>
                            <select class="form-control" onchange="Domain_Selector.get_subdomains_by_cat(this)" id="area_select">
                                <option value="">বাছাই করুন</option>
                                <option value="4">বিভাগ</option>
                            </select>
                            <select class="form-control" onchange="Domain_Selector.get_subdomains_by_cat(this)" id="office_select">
                                <option value="">বাছাই করুন</option>
                                <option value="1">মন্ত্রণালয়</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <!-- // Modal body END -->

        </div>
    </div>

</div>
<!-- // Modal END -->
<!--<script>-->
<!--    $('.selectpicker').selectpicker({-->
<!--        style: 'btn btn-success',-->
<!--        size: 4-->
<!--    });-->
<!--</script>-->
@stop
@section('body_bottom')
<script src="{{ asset('public_assets/js/domain_selector.js') }}"></script>
<script>
    function filter_capdev_stat(){
        //get the area
        var area_id = $('#area_id').val();
        //get the office
        var office_id = $('#office_id').val();
        //get the sector
        var sectors = $('#sectors').val();
        refresh_capdev_stat(area_id, office_id, sectors);
    }
    function filter_capdev_stat_by_area(area_id){
        //get the office
        var office_id = $('#office_id').val();
        //get the sector
        var sectors = $('#sectors').val();
        refresh_capdev_stat(area_id, office_id, sectors);
    }
    function refresh_capdev_stat(area_id, office_id, sectors){
        $.ajax({
            type: 'GET',
            url: "/ideabank/public/account/refresh_capdev_stat",
            data: {
                'area_id': area_id,
                'office_id': office_id,
                'sectors': sectors
            },
            success: function(data){
                $('#capdev-stat').html(data);
            }
        });
    }
    $(document).ready(function(){
        $( "#area_id" ).keypress(function( event ) {
            event.preventDefault();
        });
        $( "#office_id" ).keypress(function( event ) {
            event.preventDefault();
        });
        $("#sectors").select2({tags:[<?php  echo $sectors?>]});
    });
    function clearDomainSelection_area_id(t){
        $(t).val('');
        $(t+'_txt').val('');
    }
    function clearDomainSelection_office_id(t){
        $(t).val('');
        $(t+'_txt').val('');
    }
    function OpenModalAreaSel(){
        Domain_Selector.fldName = 'area_id';
        Domain_Selector.removeNextToAll('#area_select');
        $('#modal-area-select').modal('show');
        $('#office_select').hide();
        $('#area_select').show();
        $('#area_select').val('');
    }
    function OpenModalOfficeSel(){
        Domain_Selector.fldName = 'office_id';
        Domain_Selector.removeNextToAll('#office_select');
        $('#modal-area-select').modal('show');
        $('#office_select').show();
        $('#office_select').val('');
        $('#area_select').hide();
    }
</script>
@stop




