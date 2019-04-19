@include('layouts.header')


    <div class="container">

        @yield('content')
        <ul id="articles" class="list-group">

        </ul>
    </div>

  
    <script
    src="https://code.jquery.com/jquery-1.12.4.js"
    integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
    crossorigin="anonymous"></script>

    {{-- profil create,update,delete --}}
    @yield('profile')

    {{-- svi artikli bez mogucnosti editovanja i brisanja--}}
     @yield('allArticles')

   
@include('layouts.footer')