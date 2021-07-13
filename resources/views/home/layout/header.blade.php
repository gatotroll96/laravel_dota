





<header class="tech-header header">
<div class="container-fluid">
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('dota.home')}}"><img src="{{asset('fontend/images/version/2eweq2221.jpg')}}" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dota.home')}}">Home</a>
                </li>
                <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News</a>
                    <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                        <li>
                            <div class="container">
                                <div class="mega-menu-content clearfix">                                  
                                    <div class="tab">
                                        @php
                                        $i = 1;
                                        @endphp 
                                        @foreach($category as $ctgr)
                                        <button class="tablinks" onclick="openCategory(event, 'cat0{{$i}}', {{$ctgr->id}})">{{$ctgr->name}}</button>
                                        
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach
                                    </div>
                                    

                                    <div class="tab-details clearfix">
                                        @php
                                        $i1 = 1;
                                        @endphp 
                                        @foreach($category as $ctgr)

                                        <div id="cat0{{$i1}}" class="tabcontent">
                                            <div class="row getAjaxCate">                            
                                            
                                                  
                                            </div>
                                        </div>
                                        @php
                                        $i1++;
                                        @endphp
                                        @endforeach
                                    </div><!-- end tab-details -->
                                </div><!-- end mega-menu-content -->
                                
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tech-category-01.html">Gadgets</a>
                </li>                   
                <li class="nav-item">
                    <a class="nav-link" href="tech-category-02.html">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tech-category-03.html">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tech-contact.html">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-2">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-rss"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-android"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-apple"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</div><!-- end container-fluid -->
</header><!-- end market-header -->

