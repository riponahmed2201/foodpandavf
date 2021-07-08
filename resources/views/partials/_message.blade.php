@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  @foreach($errors->all() as $error)
	  <strong>{{ $error }}</strong>
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('failed'))
    <div class="alert alert-danger" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('failed') }}
    </div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif