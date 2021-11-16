@include('layouts.head')
<!-- wrapper -->
<div class="wrapper">
  @include('layouts.side')
  @include('layouts.nav')
<!--page-wrapper-->
	<div class="page-wrapper">
    @yield('content') 
  </div>
  @include('layouts.bottom')
</div>
@include('layouts.foot')