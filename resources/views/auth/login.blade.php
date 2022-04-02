@extends('layouts.master2')
@section('title')
تسجيل دخول - برنامج الفواتير
@stop

@section('css')
   <!-- Main CSS-->
   <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
@endsection
@section('content')
<section class="material-half-bg"><div class="cover"></div></section>
<section class="login-content">
	<div class="logo">
		<h1>إدارة الفواتير</h1>
	</div>
	<div class="login-box">
	<form role="form" class="login-form" method="POST" action="{{ route('login') }}">
      @csrf
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>تسجيل الدخول</h3>
          <div class="form-group">
            <label class="control-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email"
			 value="{{ old('email') }}" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">كلمة المرور</label>
			<input type="password" class="form-control" id="password" name="password" required autocomplete="off">
          </div>
		  <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="form-check-label" for="remember">{{ __('تذكرني') }}</label>
                    </div>
                </div>
           </div>
          <div class="form-group btn-container">
            <button class="btn btn-secondary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>تسجيل الدخول</button>
          </div>
        </form>
		
	</div>
		
</section>
                     

@endsection
@section('js')
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
@endsection