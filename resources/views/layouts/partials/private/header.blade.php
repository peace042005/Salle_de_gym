<div class="nav-header">
    @if( auth()->user()->role == 'admin' )
    <a href="{{ route('admin.dashboad') }}" target="_blank" type="button" class="brand-logo">
        <img src="{{ asset('template/logo.png') }}" alt="" width="200">
    </a>
    @elseif( auth()->user()->role == 'manager' )
    <a href="{{ route('manager.dashboad') }}" target="_blank" type="button" class="brand-logo">
        <img src="{{ asset('template/logo.png') }}" alt="" width="200">
    </a>
    @else
    <a href="{{ route('user.dashboad') }}" target="_blank" type="button" class="brand-logo">
        <img src="{{ asset('template/logo.png') }}" alt="" width="200">
    </a>
    @endif

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="header border-bottom">
    <div class="header-content">
        <h2>@yield('headerTitle')</h2>
    </div>
</div>