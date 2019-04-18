@include('layouts.header')


    <div class="container">

        @yield('content')
        
    </div>

    {{-- profil create,update,delete --}}
    @yield('profile')

    {{-- svi artikli --}}
    @yield('allArticles')


@include('layouts.footer')