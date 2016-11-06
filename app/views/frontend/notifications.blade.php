@if ($errors->any())
<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-warning"></i> ত্রুটির জন্য নীচের ফর্মটি দয়া করে চেক করুন
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-check-square"></i> {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-error alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-times-circle"></i> {{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-warning"></i> {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="fa fa-info"></i> {{ $message }}
</div>
@endif
