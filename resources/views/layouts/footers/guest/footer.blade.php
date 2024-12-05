  <footer class="footer py-5">
    <div class="container">
     
      @if (!auth()->user() || \Request::is('static-sign-up')) 
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Sistem Informasi Gereja - PSI 21 
             
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>
