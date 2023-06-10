<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">

        @if(isset($messLogo))
        <img src="{{ asset('storage/establishmentlogo/'.$messLogo) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        @else
        <img src="{{asset('/flat-icon/cutlery.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        @endif

        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        @if(isset(Auth::user()->establishments->abbr))
            <span> - {{ Auth::user()->establishments->abbr }}</span><br>
            <p style="font-size: 12px;text-align: center">{{
            str_replace(['[',']','"',],'',Auth::user()->roles->pluck('module'))



            }}</p>
        @endif

    </a>
    <div class="sidebar pb-5">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
