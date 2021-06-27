<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paul - @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <section id="app">
    <x-top-nav></x-top-nav>
    <main class="px-5 md:px-10 pt-5 max-w-screen-2xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-3 overflow-hidden">
      <div class="lg:col-span-3 px-2">
          @section('sidebar')
            <x-side-nav></x-side-nav>     
          @show
      </div>
      <div class="lg:col-span-9">
        @yield('content')
      </div>
    </main>
  </section>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="{{ asset('js/app.js') }}"> </script> 
</body>
</html>