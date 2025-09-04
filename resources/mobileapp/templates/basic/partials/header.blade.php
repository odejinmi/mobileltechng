            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
			<div class="header header-transparent dark">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="{{ route('home') }}"><img width="40" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="logo" alt=""></a>
							<div class="nav-toggle"></div>
							<div class="mobile_nav">
								<ul>
                                    @auth
									<li>
										<a href="{{route('user.home')}}" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>@lang('Dashboard')</a>
									</li>
                                    @else
									<li>
										<a href="{{route('user.login')}}" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>@lang('Log In')</a>
									</li>
                                    @endif
								</ul>
							</div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu"> 
								<li><a href="{{ route('home') }}">@lang('Home')</a></li> 
                                <li><a href="JavaScript:Void(0);">@lang('Pages')<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										@php
											$pages = App\Models\Page::where('tempname', $activeTemplate)
												->where('is_default', 0)
												->get();
                                        //$pages = getContent('pages.element', null, false, true);
                                        @endphp
										@foreach ($pages as $k => $data)
										<li>
											<a href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>                                
										</li>
                                        @endforeach 
										<li>
											<a href="{{ route('rates') }}">@lang('Rates')</a>                                
										</li>
									</ul>
								</li>
								<li><a href="{{ route('contact') }}">@lang('Contact')</a></li>
							</ul>
							<ul class="nav-menu nav-menu-social align-to-right">
                                @auth
								<li>
									<a href="{{ route('user.home') }}"><i class="fas fa-sign-in-alt me-2"></i>@lang('Dashboard')</a>
								</li>
								<li class="list-buttons ms-2">
									<a href="{{ route('user.logout') }}" class="bg-primary">@lang("Logout")<i class="fa-regular fa-circle-right ms-2"></i></a>
								</li>
                                @else
								<li>
									<a href="{{ route('user.login') }}"><i class="fas fa-sign-in-alt me-2"></i>@lang('Login')</a>
								</li>
								<li class="list-buttons ms-2">
									<a href="{{ route('user.register') }}" class="bg-primary">@lang("Register")<i class="fa-regular fa-circle-right ms-2"></i></a>
								</li>
                                @endauth
							</ul>
						</div>
					</nav>
				</div>
			</div> 
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
 
