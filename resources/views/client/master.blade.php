<!doctype html>
<html class="no-js" lang="">
<head>
    @include('client.share.css')
</head>
<body>
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
        @include('client.share.header')
    <main>
        {{-- @include('client.share.slide') --}}
        @yield('content')
    </main>
        @include('client.share.footer')
        @include('client.share.js')
    @yield('js')
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63b6e9fcc2f1ac1e202be2e4/1gm1841gk';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
</body>

</html>
