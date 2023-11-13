@auth()
    @include('pengajuans.layouts_pengajuan.navbars.navs.auth')
@endauth

@guest()
    @include('pengajuans.layouts_pengajuan.navbars.navs.guest')
@endguest
