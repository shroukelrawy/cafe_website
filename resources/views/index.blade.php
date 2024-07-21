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

      <div class="tm-right">
        <main class="tm-main">
          <div id="drink" class="tm-page-content">
            <!-- Drink Menu Page -->
            @include('includes.drinkmenu')
            <!-- end Drink Menu Page -->
          </div>

          <!-- About Us Page -->
          @include('includes.aboutus')
          <!-- end About Us Page -->

          <!-- Special Items Page -->
          @include('includes.specialitems')
          <!-- end Special Items Page -->

          <!-- Contact Page -->
          @include('includes.contact')
          <!-- end Contact Page -->
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