<!DOCTYPE html>
<html lang="en">
<head>
   @include('includes.head')

   
</head>
<body>
  <div class="tm-container">
    <div class="tm-row">
      <!-- Site Header -->
      @include('includes.siteheader')
      @if(session('success'))
        <div id="success-message" class="alert-success">
            {{ session('success') }}
        </div>
        
    @endif
      <div class="tm-right">
        <main class="tm-main">

          @yield('content')
           
        </main>
      </div>    
    </div>
    <footer class="tm-site-footer">
      <p class="tm-black-bg tm-footer-text">Copyright 2020 Wave Cafe
      
      | Design: <a href="https://www.tooplate.com" class="tm-footer-link" rel="sponsored" target="_parent">Tooplate</a></p>
    </footer>
  </div>
    
  <!-- Background video -->
  @include('includes.backgroundvideo')

</body>
</html>