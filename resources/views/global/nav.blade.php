<head><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous"></head>
<nav class="navbar navbar-default navbar-static-top sticky-menu">
    <div class="container">
        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/assets/img/catchndealz.svg" title="{{get_option('site_name')}}" alt="{{get_option('site_name')}}" />
                <span class="a-us-company">A USA Made Company</span>
            </a>

            <!-- Search -->
            <div class="navbar-search-wrap more mobile-search">
                <form
                    action="{{route('search')}}"
                    class="form-inline"
                    method="get"
                    enctype="multipart/form-data"
                >
                    <div class="input-group focusable" data-component="focusable-input-group">
                        <input
                            type="text"
                            class="form-control searchKeyword"
                            name="search"
                            placeholder="@lang('app.what_are_u_looking_short')"
                            data-element="input"
                        >
                        <span class="input-group-btn">
                            <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                        </span>
                    </div>

                </form>
            </div>

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            


        </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <div class="navbar-left">
                <div class="navbar-search-wrap more desktop-search ">
                    <form action="{{route('search')}}" class="form-inline" method="get" enctype="multipart/form-data">
                        <div class="input-group focusable" data-component="focusable-input-group">
                            <input
                                type="text"
                                class="form-control"
                                id="searchKeyword"
                                name="search"
                                placeholder="@lang('app.what_are_u_looking_short')"
                                data-element="input"
                            >
                            <span class="input-group-btn">
                                    <button class="btn btn-link" type="submit">@svg(magnifying-glass)</button>
                                </span>
                        </div>
                    </form>
                </div>

                @render(App\ViewComponents\TaxonomiesComponent::class)
            </div>



            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-cart__container" data-component="nav-cart" >
                    @render(App\ViewComponents\NavCartComponent::class)
                </li>

                <!-- Authentication Links -->
                <li>
                    <a href="{{ Auth::guest() ? route('login') : route('profile') }}" class="btn btn-link profile">
                        @svg(profile)
                        <span>{{ Auth::guest() ? trans('app.login') : 'My Profile' }}</span>
                    </a>
                </li>
                <li>
                    <button class="button" onclick="togglePopup()"><i class="far fa-newspaper"></i> <br> Newsletter</button>
                </li>
                
            </ul>
            <div>
    <style type="text/css">
    
.far {
    font-size: 40px;
    margin-top: 20px;
    margin-left: 0px;
    color: rgb(230, 198, 154);

}
.contents {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 100px;
    margin: 100px;
    box-sizing: border-box;
    /* padding: 10px; */
    z-index: 100;
    display: none;
    /*to hide popup initially*/
}
#discount{
    margin: 75px;
}
.button{
    color: rgb(141, 116, 96);
    background:transparent;
    width: auto;
    font-size: 20px;
    border: none;
    margin-left: 15px;
    padding: 0px;
    margin-top: -7px;
    padding-bottom: 11px;
}
.button:hover{
    background: rgb(255, 123, 0);
    border-radius: 25px;
    margin-bottom: 0px;
    color: rgb(247, 244, 242);
}
.button:active{
    background: rgb(33, 190, 196);
}
.far:hover{
    color: rgb(247, 244, 242);
    padding: 0;
}
        @media (max-width: 240px) {
            .button{
                font-size: 15px;
            }
            .contents{
                width: 100px;
                height: 50px;
                font-size: 15px;
                position: center;
                margin: 0px;
            }
            
        }
        @media (min-width: 241px) and (max-width: 319px) {
   
            .button{
                font-size: 15px;
            }
            .contents{
                width: 100px;
                height: 50px;
                font-size: 15px;
                position: left;
            }
            .button:active{
                background: rgb(33, 190, 196);
            }
        }
        @media (min-width: 320px) and (max-width: 767px) {
            .far {
                font-size: 25px;
                margin-right: 5px;
                margin-left: 20px;
            }
            .button{
                font-size: 20px;
                margin: -5px;
                padding: 0px;
                margin-top: -5px;
            }
            .button:active{
                background: rgb(33, 190, 196);
            }
            .contents{
                font-size: 15px;
                position: absolute;
                left: 43px;
                top: 253px;
            }
            br{
                content: ' ';
            }
            br:after{
                content: ' ';
            }
            .button:hover{
                background:rgb(33,190,196);
                border-radius: 0px;
                margin-bottom: 0px;
                color: rgb(3, 3, 3);
            }
        }
        @media (min-width: 768px) and (max-width: 1025px) {
            .button{
                font-size: 20px;
                margin-left: 40px;

            }
            .contents{
                width: 100px;
                height: 50px;
                font-size: 15px;
                position: absolute;
                left: 300px;
                top: 100px;
            }
        }      
    
        
</style>



  

   
    
  
    <!-- div containing the popup -->
    <div class="contents">
        <div onclick="togglePopup()" class="close-btn" >
            
        
            
            <iframe
                src="https://cdn.forms-content.sg-form.com/27c09a98-a38c-11eb-9e9c-c2e3eeb7328e" frameborder="0"
                width="385" height="400"></iframe>
        </div>
    </div>
  
    <script type="text/javascript">
      
        // Function to show and hide the popup
        function togglePopup() {
            $(".contents").toggle();
        }
    </script>
            </div>
            <div>
                <div>
                 
                </div>
            </div>
            <div class="a-us-company">A USA Made Company</div>
        </div>
    </div>
</nav>