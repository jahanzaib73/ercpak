<body class="horizontal-layout horizontal-menu {{$configData['contentLayout']}} {{$configData['horizontalMenuType']}} {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }} {{ $configData['footerType'] }}"
data-open="hover"
data-menu="horizontal-menu"
data-col="{{$configData['showMenu'] ? $configData['contentLayout'] : '1-column' }}"
data-framework="laravel"
data-asset-path="{{ asset('/')}}">

  <!-- BEGIN: Header-->
  @include('new-admin.panels.navbar')

  {{-- Include Sidebar --}}
  @include('new-admin.panels.horizontalMenu')

  <!-- BEGIN: Content-->
  <div class="app-content content {{ $configData['pageClass'] }}">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
      {{-- Include Breadcrumb --}}
      @if($configData['pageHeader'] == true && isset($configData['pageHeader']))
      @include('new-admin.panels.breadcrumb')
      @endif
      <div class="{{ $configData['sidebarPositionClass'] }}">
        <div class="sidebar">
          {{-- Include Sidebar Content --}}
          @yield('content-sidebar')
        </div>
      </div>
      <div class="{{ $configData['contentsidebarClass'] }}">
        <div class="content-body">
          {{-- Include Page Content --}}
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <!-- End: Content-->

  @if($configData['blankPage'] == false)
  @include('new-admin/content/pages/customizer')

  @include('content/pages/buy-now')
  @endif

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('new-admin/panels/footer')

  {{-- include default scripts --}}
  @include('new-admin/panels/scripts')

  <script type="text/javascript">
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14, height: 14
        });
      }
    })
  </script>
</body>

</html>
