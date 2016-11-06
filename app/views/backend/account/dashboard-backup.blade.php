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
                                                  <div style="height: {{$t}}px; background-color: #CC0000; left: 41px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                      {{$t}}%
                                                  @else
                                                  <div style="height: 0px; background-color: #CC0000; left: 41px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                      0%
                                                  @endif
                                                  </div>
                                                      @if($total>0)
                                                      <?php $t = round(100*($capdev_div_idea->running/$total)) ?>
                                                      <div style="height: {{$t}}px; background-color: #3fb618; left: 82px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                          {{$t}}%
                                                      @else
                                                      <div style="height: 0px; background-color: #3fb618; left: 82px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                      0%
                                                      @endif
                                                  </div>
                                                      @if($total>0)
                                                      <?php $t = round(100*($capdev_div_idea->completed/$total)) ?>
                                                      <div style="height: {{$t}}px; background-color: #800080; left: 0px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                          {{$t}}%
                                                      @else
                                                      <div style="height: 0px; background-color: #800080; left: 0px; color: rgb(255, 255, 255); font-size: 12px; width: 41px; position: absolute; bottom: 0px;" class="subBarschart-3">
                                                      0%
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
        <div class="navbar-brand">
            @lang('account/form.Month'):
              <select class="selectpicker">
                 <option>@lang('account/form.Month')</option>
                 <option>@lang('account/form.January')</option>
                 <option>@lang('account/form.February')</option>
                 <option>@lang('account/form.March')</option>
                 <option>@lang('account/form.April')</option>
                 <option>@lang('account/form.May')</option>
                 <option>@lang('account/form.June')</option>
                 <option>@lang('account/form.July')</option>
                 <option>@lang('account/form.August')</option>
                 <option>@lang('account/form.September')</option>
                 <option>@lang('account/form.October')</option>
                 <option>@lang('account/form.November')</option>
                 <option>@lang('account/form.December')</option>
             </select>
        </div>
        <div class="navbar-brand">
            @lang('account/form.Sector'):
               <select class="selectpicker">
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
                   <option>@lang('account/form.Sector')</option>
               </select>
        </div>
        <div class="navbar-brand">
            @lang('account/form.Division'):
               <select class="selectpicker">
                  <option>@lang('account/form.Division')</option>
                  <option>@lang('account/form.Dhaka')</option>
                  <option>@lang('account/form.Chittagong')</option>
                  <option>@lang('account/form.Rajshahi')</option>
                  <option>@lang('account/form.Rangpur')</option>
                  <option>@lang('account/form.Khulna')</option>
                  <option>@lang('account/form.Sylhet')</option>
                  <option>@lang('account/form.Borishal')</option>
              </select>
        </div>
        <br>
      <div class="navbar-collapse collapse" id="navbar">
         <table class="table table-bordered">
           <tbody>
                <tr>
                    <th>@lang('account/form.District')</th>
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
                <tr>
                    <th>@lang('account/form.Rangpur')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Lalmonirhat')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Kurigram')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Nilphamari')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Gaibandha')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Panchagarh')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Dinajpur')</th>
                <td bgcolor="#f08080">170</td>
                <td bgcolor="#90ee90">76</td>
                <td bgcolor="#3fb618">20</td>
                <td bgcolor="#90ee90">27</td>
                <td bgcolor="#3fb618">7</td>
                <td bgcolor="#CC0000">20</td>
                <td bgcolor="#90ee90">40</td>
                <td bgcolor="#3fb618">22</td>
                <td bgcolor="#CC0000">18</td>
                </tr>
                <tr>
                    <th>@lang('account/form.Thakurgaon')</th>
                    <td bgcolor="#f08080">170</td>
                    <td bgcolor="#90ee90">76</td>
                    <td bgcolor="#3fb618">20</td>
                    <td bgcolor="#90ee90">27</td>
                    <td bgcolor="#3fb618">7</td>
                    <td bgcolor="#CC0000">20</td>
                    <td bgcolor="#90ee90">40</td>
                    <td bgcolor="#3fb618">22</td>
                    <td bgcolor="#CC0000">18</td>
                </tr>
           </tbody>
        </table>
      </div>
</div>
<div class="container-fluid"></div>
    <span class="hidden-xs hidden-sm inline-block"><span style="color:#9962a6"><h2>TCV</h2></span>
    <div class="">
        <div id="navbar" class="navbar-collapse collapse">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>subject</th>
                    <th colspan="3">time</th>
                    <th colspan="3">cost</th>
                    <th colspan="3">transport</th>
                </tr>
                <tr>
                    <th></th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Achievement</th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Achievement</th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Achievement</th>
                </tr>
                <tr>
                    <th>Application System</th>
                    <td bgcolor="#f08080">30 </td>
                    <td bgcolor="#90ee90">7</td>
                    <td bgcolor="#3fb618">23</td>
                    <td bgcolor="#f08080">250 </td>
                    <td bgcolor="#90ee90">50</td>
                    <td bgcolor="#3fb618">200</td>
                    <td bgcolor="#f08080">7</td>
                    <td bgcolor="#90ee90">2</td>
                    <td bgcolor="#3fb618">5</td>
                </tr>
                <tr>
                    <th>Authorization System</th>
                    <td bgcolor="#f08080">30 </td>
                    <td bgcolor="#90ee90">7</td>
                    <td bgcolor="#3fb618">23</td>
                    <td bgcolor="#f08080">250 </td>
                    <td bgcolor="#90ee90">50</td>
                    <td bgcolor="#3fb618">200</td>
                    <td bgcolor="#f08080">7</td>
                    <td bgcolor="#90ee90">2</td>
                    <td bgcolor="#3fb618">5</td>
                </tr>
                <tr>
                    <th>Disbursed System</th>
                    <td bgcolor="#f08080">30</td>
                    <td bgcolor="#90ee90">7</td>
                    <td bgcolor="#3fb618">23</td>
                    <td bgcolor="#f08080">250 </td>
                    <td bgcolor="#90ee90">50</td>
                    <td bgcolor="#3fb618">200</td>
                    <td bgcolor="#f08080">7</td>
                    <td bgcolor="#90ee90">2</td>
                    <td bgcolor="#3fb618">5</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<script>
     $('.selectpicker').selectpicker({
    style: 'btn btn-success',
    size: 4
    });
</script>

@stop

