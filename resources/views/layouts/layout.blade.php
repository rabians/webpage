<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Motorcart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="/css/stylesheet.css">

</head>
<body>
<div class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-4">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="/logo.png" alt="Motorcart" class="main_logo mr-4">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav" >
                    <li>
                      <a href="/" class="nav-item nav-link m-2"><b>Home</b></a>
                    </li>
                    
                    <li class="dropdown ">
                      <div class="dropdown-toggle m-2" data-toggle="dropdown">Interior<span class="caret"></span></div>
                      <ul class="dropdown-menu  w-100 pl-2">
                      <div class="row">
                        @foreach($menuItems as $items)
                        @if($items -> catagory =='1')
                        <div class="col-sm-6 ml-2">
                      <li>
                        <a href="/details/{{ $items -> id }}" class="nav-item nav-link ml-2">{{$items -> name}}</a>
                      </li>
                    </div>
                      @endif
                    @endforeach
                      </div>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <div class="dropdown-toggle  m-2" data-toggle="dropdown">Exterior<span class="caret"></span></div>
                      <ul class="dropdown-menu">
                        <div class="row">
                        @foreach($menuItems as $items)
                        @if($items -> catagory =='2')
                          <div class="col-sm-6">
                             <li>
                                <a href="/details/{{ $items -> id }}"  class="nav-item nav-link">{{$items -> name}}</a>
                              </li>
                          </div>
                      @endif
                    @endforeach
                  </div>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <div class="dropdown-toggle m-2" data-toggle="dropdown">Accessories<span class="caret"></span></div>
                      <ul class="dropdown-menu">
                        <div class="row">
                          @foreach($menuItems as $items)
                        @if($items -> catagory =='3')
                        <div class="col-sm-6">
                          <li>
                            <a href="/details/{{ $items -> id }}"  class="nav-item nav-link">{{$items -> name}}</a>
                          </li>
                        </div>
                      @endif
                    @endforeach
                        </div>
                        
                      </ul>
                    </li>
                  </ul>
                <div class="navbar-nav ms-auto">
                    <form class="form-inline" action="/search">
                        <input class="form-control mr-sm-2" name="query" type="text" placeholder="Search" aria-label="Search">
                      <button class="btn btn-dark btn-md my-2 my-sm-0 ml-3" type="submit">Search</button>
                    </form>
                    <a href="/shopping_cart" class="nav-item nav-link "><i class="fa-solid fa-cart-shopping"></i> Cart
                      @if(Session::has('cart'))
                        <span class="badge badge-pill bg-dark">
                        {{ Session::has('cart') ? Session::get('cart')->totalQty : ''}}
                      </span>
                      @endif
                      </a>
                     <a href="/home" class="nav-item nav-link ">Admin Portal</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="container">
  <a href="https://wa.me/923224203022" class="float">
<i class="fa-brands fa-whatsapp my-float"></i>
</a>  
</div>
           @yield('content')

<footer class="footer bg-dark text-center text-white ">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-github"></i
      ></a>
    </section>
  </div>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    Copyrights © motorcart 2022 -  All rights reserved by 
    <a class="text-white" href="https://mdbootstrap.com/">motorcard.com</a>
  </div>
  <!-- Copyright -->
</footer>

<script type="text/javascript">
  $('.dropdown').hover(function(){ 
  $('.dropdown-toggle', this).trigger('click'); 
});
</script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            var docHeight = $(window).height();
            var footerHeight = $('.footer').height();
            var footerTop = $('.footer').position().top + footerHeight;
            var marginTop = (docHeight - footerTop + 10);

            if (footerTop < docHeight)
                $('.footer').css('margin-top', marginTop + 'px'); // padding of 30 on footer
            else
                $('.footer').css('margin-top', '0px');
            // console.log("docheight: " + docHeight + "\n" + "footerheight: " + footerHeight + "\n" + "footertop: " + footerTop + "\n" + "new docheight: " + $(window).height() + "\n" + "margintop: " + marginTop);
        }, 250);
    });
</script>