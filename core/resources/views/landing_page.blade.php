<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Flexible - responsive multi-purpose one page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=9, IE=edge" />
    <meta name='robots' content='noindex,follow' />

    <link rel='stylesheet' id='bootstrap-css'  href="{{ asset('css/bootstrap.min.css?ver=4.4.1') }}" type='text/css' media='screen' />
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700&subset=latin,devanagari,latin-ext' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' id='fontawesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css?ver=4.4.1' type='text/css' media='all' />
    <link rel='stylesheet' id='style-css'  href="{{ asset('css/new-style.css') }}" type='text/css' media='all' />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type='text/css' media='all'>
    <script type='text/javascript' src="{{ asset('js/jquery.js') }}"></script>         
    
    <link type="text/css" rel="stylesheet" id="flexible-switch" href="{{ asset('css/new-style-blue.css') }}" />
    <style>
	
	/* For Demo Purposes Only ( You can delete this anytime :-) */
	#colour-variations {
		padding: 10px;
		-webkit-transition: 0.5s;
	  	-o-transition: 0.5s;
	  	transition: 0.5s;
		width: 140px;
		position: fixed;
		left: 0;
		top: 100px;
		z-index: 999999;
		background: #fff;
		/*border-radius: 4px;*/
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	#colour-variations.sleep {
		margin-left: -140px;
	}
	#colour-variations h3 {
		text-align: center;;
		font-size: 11px;
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #777;
		margin: 0 0 10px 0;
		padding: 0;;
	}

	#colour-variations ul,
	#colour-variations ul li {
		padding: 0;
		margin: 0;
	}
	#colour-variations ul {
		float: left;	
	}
	#colour-variations li {
		list-style: none;
		display: inline;
	}
	#colour-variations li a {
		width: 20px;
		height: 20px;
		position: relative;
		float: left;
		margin: 5px;
	}



	#colour-variations li a[data-theme="../css/new-style-blue"] {
		background: #0785f2;
	}
	#colour-variations li a[data-theme="../css/new-style-green"] {
		background: #6e85c1;
	}
	#colour-variations li a[data-theme="../css/new-style-yellow"] {
		background: #9261d4;
	}
	#colour-variations li a[data-theme="../css/new-style-red"] {
		background: #f25454;
	}
	#colour-variations li a[data-theme="../css/new-style-orange"] {
		background: orange;
	}

	.option-toggle {
		position: absolute;
		right: 0;
		top: 0;
		margin-top: 5px;
		margin-right: -30px;
		width: 30px;
		height: 30px;
		background: #fff;
		text-align: center;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		color: #0785f2;
		cursor: pointer;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	.option-toggle i {
		top: 5px;
		position: relative;
	}
	.option-toggle:hover, .option-toggle:focus, .option-toggle:active {
		color:  #0785f2;
		text-decoration: none;
		outline: none;
	}
    .fa-2x {
    font-size: 1.5em;
}
	</style>
	<!-- End demo purposes only -->     
</head>
    
<body>
    <div class="hero-image">
        <div id="home">
            <div class="hero-overlay">
                <header id="site-header">
                    <div class="row">
                        <nav id="top-nav" class="navbar navbar-default navbar-fixed-top navbar-scroll-changed">
                              
                          <div class="container">

                            <div class="col-md-2 col-sm-1 col-xs-12">
                                    <div class="branding">
                                      <a href="#" title="Home is where the heart is" rel="home"><img id="logo" src="{{ asset('images/flexible-logo.png') }}" alt="Home is where the heart is"></a>
                                    </div><!--end branding-->
                                
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div><!--end navbar-header-->
                            </div><!--end col-md-2 col-sm-2 col-xs-12-->

                            <div class="col-md-10 col-sm-11 col-xs-12">
                                  <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="true" style="height: 1px;" role="navigation">
                                      
                                    <div class="menu-primary-menu-container">
                                        <ul id="menu-main-top-navigation" class="menu nav navbar-nav navbar-right">
                                            <li><a href="#home">Home</a></li>
                                            <li><a href="#services">Blog</a></li>
                                            <li><a href="#features">Features</a></li>
                                            <li><a href="#plan">Pricing</a></li>
                                            <li><a href="#contact">Contact</a></li>
                                            <li><a href="{{ url('/login') }}">Login</a></li>
                                        </ul>
                                    </div><!--end menu-->
                                </div><!--end navbar-collapse--> 

                             </div><!--end col-md-10 col-sm-10 col-xs-12--> 
                              
                            </div><!--end container-->
                        </nav>
                           
                            </div><!--end row-->
                        <div class="main-message">  
                            <div class="container">
                                <h1 class="flex fadeInUp animated">Flexible Landing page</h1>
                                <p class="description-image flex fadeInUp animated">
                                  A simple and modern one page business theme for your company
                                </p>
                                <a class="btn btn-cta-primary btn-cta-blue flex fadeInUp animated" href="#" role="button">Call to action</a>
                            </div><!--end container-->                         
                        </div><!--end main-message--> 
                    </header>
                </div><!--end hero-overlay-->
            </div><!--end acasa-->
         </div><!--end hero-image--> 
              
            

            <section id="services" class="container">
                <div class="row">
                    <div class="title">
                        <h2 class="flex fadeInUp animated">Recent Posts</h2>
                        <p class="description flex fadeInUp animated">We have a lot to work, so we must take care of our employees</p>
                    </div><!--end title-->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6 caption flex fadeInUp animated animated" data-wow-delay="0.1s">
                                <a href="#" title="Recent post"><img src="{{ asset('images/phones.jpg') }}" class="serv" alt="Cursuri" /></a>    
                                <a href="#" title="Your title here"><h4>Best blog post</h4></a>
                                <p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus.</p>
                                <a href="#" title="See more" class="more">See more &nbsp;<i class="fa fa-angle-right"></i></a>
                            </div><!--end col-sm-6-->

                            <div class="col-sm-6 caption flex fadeInUp animated animated" data-wow-delay="0.2s">
                                <a href="#" title="Your title here"><img src="{{ asset('images/chair.jpg') }}" class="serv" alt="Cursuri" /></a>
                                <a href="#" title="Your title here"><h4>Standard blog post</h4></a>
                                <p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus.</p>
                                <a href="#" title="See more" class="more">See more &nbsp;<i class="fa fa-angle-right"></i></a>
                            </div><!--end col-sm-6-->
                        </div><!--end row-->
                    </div><!--end col-md-6-->


                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6 caption flex fadeInUp animated animated" data-wow-delay="0.3s">
                                <a href="#" title=""><img src="{{ asset('images/camera-photos.jpg') }}" class="serv" alt="Cursuri" /></a>
                                <a href="#" title="Your title here"><h4>Simple blog post</h4></a>
                                <p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus.</p>
                                <a href="#" title="See more" class="more">See more &nbsp;<i class="fa fa-angle-right"></i></a>
                            </div><!--end col-sm-6-->

                            <div class="col-sm-6 caption flex fadeInUp animated animated" data-wow-delay="0.4s">
                                <a href="#" title="Your title here"><img src="{{ asset('images/brochure.jpg') }}" class="serv" alt="Cursuri" /></a>
                                <a href="#" title="Your title here"><h4>Another blog post</h4></a>
                                <p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus.</p>
                                <a href="#" title="See more" class="more">See more&nbsp;<i class="fa fa-angle-right"></i></a>
                            </div><!--end col-sm-6-->
                        </div><!--end row-->
                    </div><!--end col-md-6-->
                </div><!--end row-->
            </section><!--end services-->  
            
    <section id="features">
        <div class="container">
            <div class="title">
                <h2 class="flex fadeInUp animated">The best features</h2>
                <p class="description flex fadeInUp animated">With features engineered from best practices used by leading property management companies worldwide.</p>
            </div><!--end title-->
           
                <div class="row">
                    <div class="col-md-4 caption flex fadeInUp animated animated" data-wow-delay="0.1s">
                        <i class="fa fa-paint-brush"></i>
                        <h3>Design wit psd files</h3>
                        <p>Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra eu libero sit amet quam egestas sempe</p>          
                    </div><!--end col-md-4-->    
                
                <div class="col-md-4 caption flex fadeInUp animated animated" data-wow-delay="0.3s">
                        <i class="fa fa-coffee"></i>
                        <h3>Support & coffee</h3>
                        <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat erat volutpat.</p>          
                </div><!--end col-md-4-->    
                
                <div class="col-md-4 caption flex fadeInUp animated animated" data-wow-delay="0.5s">
                    <i class="fa fa-keyboard-o"></i>
                        <h3>Clean coded</h3>
                        <p>Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>         
                </div><!--end col-md-4-->   

            </div><!--end row-->
            </div><!--end container-->
        </section>  
         
    <section id="info">        
            <div class="zig-zag container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('images/akita.jpg') }}" class="serv flex fadeInUp animated animated" alt="Flexible" />
                    </div><!--end col-md-7-->
                    
                    <div class="col-md-5 col-md-push-1">
                        <h2 class="flex fadeInUp animated animated">Responsiveness - you bet</h2>
                        <p class="flex fadeInUp animated animated">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </div><!--end col-md-5--> 
                    
                </div><!--end row-->
            </div><!--end zig-zag-->
            
            <div class="zig-zag container">
                <div class="row">
                    <div class="col-md-5">
                        <h2 class="flex fadeInUp animated animated">Easily changing colors</h2>
                        <p class="flex fadeInUp animated animated">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                        </p>
                    </div><!--end col-md-5--> 
                    
                    <div class="col-md-6 col-md-offset-1">
                        <img src="{{ asset('images/lens.jpg') }}" class="serv flex flipInX animated" alt="Flexible" />
                    </div><!--end col-md-5-->
                    
                </div><!--end row-->
            </div><!--end zig-zag-->
        </section><!--end info-->
               
            
        <section id="plan">
            <div class="container">
                    <div class="title">
                        <h2 class="flex fadeInUp animated animated">Simple Pricing</h2>
                        <p class="description flex fadeInUp animated animated">Choose what fits you best</p>
                    </div><!--end title-->
            
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="row">    
                                <div class="price-table col-sm-6 flex fadeInUp animated" data-wow-delay="0.1s">
                                    <i class="fa fa-user"></i>
                                    <h6>Personal</h6>
                                    <span class="dollar">$</span>
                                    <span class="price">29</span>

                                    <ul class="features">
                                        <li>No minimum or setup fees</li>
                                        <li>24 hours free support</li>
                                        <li>Money back guarantee</li>
                                        <li>7 features installed</li>
                                    </ul>
                                </div><!--price-table-->

                                <div class="price-table col-sm-6 flex fadeInUp animated" data-wow-delay="0.3s">
                                    <i class="fa fa-users"></i>
                                    <h6>Small Team</h6>
                                    <span class="dollar">$</span>
                                    <span class="price">39</span>

                                    <ul class="features">
                                        <li>Corporate</li>
                                        <li>24/7 support</li>
                                        <li>New updates included</li>
                                        <li>Awesome widgets installed</li>
                                    </ul>
                                </div><!--price-table-->
                                
                            </div><!--end row-->    
                        </div><!--end col-sm-6-->        
        


                        <div class="col-md-6">
                            <div class="row">
                                <div class="price-table col-sm-6 flex fadeInUp animated" data-wow-delay="0.5s">
                                    <i class="fa fa-bank"></i>
                                    <h6>Enterprise</h6>
                                    <span class="dollar">$</span>
                                    <span class="price">49</span>

                                    <ul class="features">
                                        <li>No minimum or setup fees</li>
                                        <li>24 hours free support</li>
                                        <li>Money back guarantee</li>
                                        <li>7 features installed</li>
                                    </ul>

                                </div><!--price-table-->

                                <div class="price-table col-sm-6 flex fadeInUp animated" data-wow-delay="0.7s">
                                    <i class="fa fa-briefcase"></i>
                                    <h6>Corporate</h6>
                                    <span class="dollar">$</span>
                                    <span class="price">59</span>

                                    <ul class="features">
                                        <li>No minimum or setup fees</li>
                                        <li>24 hours free support</li>
                                        <li>Money back guarantee</li>
                                        <li>7 features installed</li>
                                    </ul>
                                </div><!--price-table-->
                            </div><!--end row--> 
                        </div><!--end col-sm-6-->        

                    
                </div><!--end row-->
            </div><!--end container-->                                       
        </section><!--end plan-->     
            

    
        <section id="testimonials">
                <div class="container">
                    <div class="caption">   
                    <div class="row">
                        <div class="col-md-12">                            
                            <div id="myCarousel" class="carousel slide" data-interval="4000">

                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href="http://www.teamtreehouse.com" target="_blank" class="company"><img src="{{ asset('images/treehouse-logo.png') }}" alt="#"></a>
                                        <blockquote>
                                            <i class="quote-open"></i>
                                            I am really happy what Flexible is able to offer. This guys are amazing, support 24 hours, realy helpfull.
                                            <i class="quote-close"></i>
                                        </blockquote>

                                        <span class="author"><img src="{{ asset('images/user.png') }}" alt="#">Ferry Corsten, Web Designer</span>
                                    </div><!--end item-->

                                    <div class="item">
                                        <a href="http://www.dribbble.com" target="_blank" class="company"><img src="{{ asset('images/dribbble-logo.png') }}" alt="#"></a>
                                        <blockquote>
                                            <i class="quote-open"></i>
                                            Maybe the best product - and definitely the best support of any module I've used.
                                            <i class="quote-close"></i>
                                        </blockquote>
                                        <span class="author"><img src="{{ asset('images/user-1.png') }}" alt="#">Adriana Lima, model</span>
                                    </div><!--end item-->

                                    <div class="item">
                                        <a href="http://www.behance.net" target="_blank" class="company"><img src="{{ asset('images/behance-logo.png') }}" alt="#"></a>
                                        <blockquote>
                                            <i class="quote-open"></i>
                                            Excellent and stable theme that serves its purpose beautifully. Easy to use and easy to setup.
                                            <i class="quote-close"></i>
                                        </blockquote>
                                        <span class="author"><img src="{{ asset('images/user-2.png') }}" alt="#">Amanda Hemingway, Web developer</span>
                                    </div><!--end item-->

                                </div><!--end carousel-inner-->

                                <!-- Indicators -->
                                  <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                  </ol>

                            </div><!--end myCarousel-->

                        </div><!--end col-md-12-->  

                    </div><!--end row--> 
                    </div><!--end caption-->                            
                </div><!--end container-->
        </section><!--end testimonials-->
                                        
                                                                       

        <section id="contact" class="marketing-action">
            <div class="overlay">
                <div class="text">
                     <h2 class="flex fadeInUp animated  animated">Simple and effective landing page</h2>
                     <p class="description-image flex fadeInUp animated  animated">
                        See how Flexible can become your perfect website.
                     </p>
                     <a href="#" class="btn btn-cta-primary btn-cta-buy" role="button">Call to action</a>      
                </div><!--end text-->   
            </div><!--end overlay-->    
        </section><!--end marketing-action-->
                                           

       <div id="footer">                                      
       <div class="container">
            <div class="row">
                    <div class="footer-section col-md-1">
                        <a href="#" title="Home is where the heart is" rel="home"><img src="{{ asset('images/flexible-logo-footer.png') }}" class="logo-footer flex fadeInUp animated" alt="Home is where the heart is"></a>
                    </div><!--end footer-section-->
                    
                    <div class="footer-section col-md-8 col-sm-9 col-xs-12">
                            <p class="copyright flex fadeInUp animated">&#169; Copyright 2016 <strong>Flexible.</strong>&nbsp;All rights reserved.</p>
                    </div><!--end footer-section-->
                        
                        
                    <div class="footer-section col-md-3 col-xs-12">    
                        <div class="social copyright flex fadeInUp animated">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div><!--end social-->
                    </div><!--end col-md-3-->
            </div><!--end row-->
        </div><!--end container-->
        </div><!--end footer-->
        
        			<!-- For demo purposes Only ( You may delete this anytime :-) -->
	<div id="colour-variations">
		<a class="option-toggle"><i class="fa fa-cog fa-2x" aria-hidden="true""></i></a>
		<h3>Preset Colors</h3>
		<ul>
			<li><a href="javascript: void(0);" data-theme="../css/new-style-blue"></a></li>
			<li><a href="javascript: void(0);" data-theme="../css/new-style-green"></a></li>
			<li><a href="javascript: void(0);" data-theme="../css/new-style-yellow"></a></li>
			<li><a href="javascript: void(0);" data-theme="../css/new-style-red"></a></li>
			<li><a href="javascript: void(0);" data-theme="../css/new-style-orange"></a></li>
		</ul>
	</div>
	<!-- End demo purposes only -->


<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?ver=1.0'></script>
<script type='text/javascript' src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-mobile.js?ver=1.0') }}"></script>
<script type='text/javascript' src="{{ asset('js/wow.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/main.js') }}"></script>
<script>
//jQuery transitions init(wow + animated)
wow = new WOW(
    {
        boxClass: 'flex',
        animateClass: 'animated', // default
        offset: 0,          // default
        mobile: true,       // default
        live: true        // default
    }
    )
wow.init();
</script>
<script type="text/javascript" src="{{ asset('js/jQuery.style.switcher.js') }}"></script>
				<script type="text/javascript">
			$(function(){
			$('#colour-variations ul').styleSwitcher({
				defaultThemeId: 'flexible-switch',
				hasPreview: false,
				cookie: {
		          	expires: 30,
		          	isManagingLoad: true
		      	}
			});	
			$('.option-toggle').click(function() {
				$('#colour-variations').toggleClass('sleep');
			});
		});
		</script>
</body>