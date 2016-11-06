@extends('backend/layouts/dashboard_account')

{{-- Page title --}}
@section('title')
@lang('account/title.dashboardtitle') ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')
<div class="content">
<div class="innerLR">
    <span style="color:#9962a6"><h2>@lang('account/form.Innovation_Project_formulation_status')</h2></span>
    <!-- Ordered bars chart -->
    <div class="widget widget-heading-simple widget-body-gray">

        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">Ordered bars chart</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body">
            <!-- Ordered bars Chart -->
            <div id="chart_ordered_bars" class="flotchart-holder"></div>





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
<!--<div class="container-fluid"></div>-->
<!--    <span class="hidden-xs hidden-sm inline-block"><span style="color:#9962a6"><h2>TCV</h2></span>-->
<!--    <div class="">-->
<!--        <div id="navbar" class="navbar-collapse collapse">-->
<!--            <table class="table table-bordered">-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <th>subject</th>-->
<!--                    <th colspan="3">time</th>-->
<!--                    <th colspan="3">cost</th>-->
<!--                    <th colspan="3">transport</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th></th>-->
<!--                    <th>Before</th>-->
<!--                    <th>After</th>-->
<!--                    <th>Achievement</th>-->
<!--                    <th>Before</th>-->
<!--                    <th>After</th>-->
<!--                    <th>Achievement</th>-->
<!--                    <th>Before</th>-->
<!--                    <th>After</th>-->
<!--                    <th>Achievement</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>Application System</th>-->
<!--                    <td bgcolor="#f08080">30 </td>-->
<!--                    <td bgcolor="#90ee90">7</td>-->
<!--                    <td bgcolor="#3fb618">23</td>-->
<!--                    <td bgcolor="#f08080">250 </td>-->
<!--                    <td bgcolor="#90ee90">50</td>-->
<!--                    <td bgcolor="#3fb618">200</td>-->
<!--                    <td bgcolor="#f08080">7</td>-->
<!--                    <td bgcolor="#90ee90">2</td>-->
<!--                    <td bgcolor="#3fb618">5</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>Authorization System</th>-->
<!--                    <td bgcolor="#f08080">30 </td>-->
<!--                    <td bgcolor="#90ee90">7</td>-->
<!--                    <td bgcolor="#3fb618">23</td>-->
<!--                    <td bgcolor="#f08080">250 </td>-->
<!--                    <td bgcolor="#90ee90">50</td>-->
<!--                    <td bgcolor="#3fb618">200</td>-->
<!--                    <td bgcolor="#f08080">7</td>-->
<!--                    <td bgcolor="#90ee90">2</td>-->
<!--                    <td bgcolor="#3fb618">5</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>Disbursed System</th>-->
<!--                    <td bgcolor="#f08080">30</td>-->
<!--                    <td bgcolor="#90ee90">7</td>-->
<!--                    <td bgcolor="#3fb618">23</td>-->
<!--                    <td bgcolor="#f08080">250 </td>-->
<!--                    <td bgcolor="#90ee90">50</td>-->
<!--                    <td bgcolor="#3fb618">200</td>-->
<!--                    <td bgcolor="#f08080">7</td>-->
<!--                    <td bgcolor="#90ee90">2</td>-->
<!--                    <td bgcolor="#3fb618">5</td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->

@stop
@section('body_bottom')
<script src="{{ asset('backend_assets_new/plugins/charts_flot/jquery.flot.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/charts_flot/jquery.flot.resize.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/charts_flot/plugins/jquery.flot.tooltip.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/plugins/charts_flot/plugins/jquery.flot.orderBars.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script src="{{ asset('backend_assets_new/components/charts_flot/flotcharts.common.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2') }}"></script>
<script>
//    $('.selectpicker').selectpicker({
//        style: 'btn btn-success',
//        size: 4
//    });
(function($)
{
//    if (typeof charts == 'undefined')
//        return;

    charts.chart_ordered_bars =
    {
        // chart data
        data: null,

        // will hold the chart object
        plot: null,

        // chart options
        options:
        {
            bars: {
                show:true,
                barWidth: 0.2,
                fill:1
            },
            grid: {
                show: true,
                aboveData: false,
                color: "#3f3f3f" ,
                labelMargin: 5,
                axisMargin: 0,
                borderWidth: 0,
                borderColor:null,
                minBorderMargin: 5 ,
                clickable: true,
                hoverable: true,
                autoHighlight: false,
                mouseActiveRadius: 20,
                backgroundColor : { }
            },
            series: {
                grow: {active:false}
            },
            legend: { position: "ne", backgroundColor: null, backgroundOpacity: 0 },
            colors: [],
            tooltip: true,
            tooltipOpts: {
                content: "%s : %y.0",
                shifts: {
                    x: -30,
                    y: -50
                },
                defaultTheme: false
            }
        },

        placeholder: "#chart_ordered_bars",

        // initialize
        init: function()
        {
            // apply styling
            charts.utility.applyStyle(this);

            $.ajax({
                url: "{{route('dashboard_innovation_status')}}",
                success: function(data){
                    charts.chart_ordered_bars.data = data;
                    console.debug(charts.chart_ordered_bars.data);
                    charts.chart_ordered_bars.plot = $.plot($(charts.chart_ordered_bars.placeholder),
                                                                charts.chart_ordered_bars.data,
                                                                    charts.chart_ordered_bars.options);
                }
            });

//some data
//            var d1 = [];
//            for (var i = 0; i <= 10; i += 1)
//                d1.push([i, parseInt(Math.random() * 30)]);
//
//            var d2 = [];
//            for (var i = 0; i <= 10; i += 1)
//                d2.push([i, parseInt(Math.random() * 30)]);
//
//            var d3 = [];
//            for (var i = 0; i <= 10; i += 1)
//                d3.push([i, parseInt(Math.random() * 30)]);
//
//            var ds = new Array();
//
//            ds.push({
//                label: "Data One",
//                data:d1,
//                bars: {order: 1}
//            });
//            ds.push({
//                label: "Data Two",
//                data:d2,
//                bars: {order: 2}
//            });
//            ds.push({
//                label: "Data Three",
//                data:d3,
//                bars: {order: 3}
//            });
//            this.data = ds;
//            console.debug(this.data);
//            this.plot = $.plot($(this.placeholder), this.data, this.options);
        }
    };

    charts.chart_ordered_bars.init();
})(jQuery);
</script>

@stop

