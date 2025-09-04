@php
    $footerContent = getContent('footer.content', true);
    $footerElements = getContent('footer.element', null, false, true);
    $addressContent = getContent('address.content', true);
@endphp
	
			
			<!-- ============================ Footer Start ================================== -->
			<footer class="footer skin-light-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="40" class="img-footer" alt="">
									<div class="footer-add">
										<p>@lang('Premium Bills Payment System For Global Bilss Payment')</p>
									</div>
									<div class="foot-socials">
										<ul>
                                            @forelse($footerElements as $item)
											<li><a href="{{ @$item->data_values->social_url }}">@php echo @$item->data_values->social_icon @endphp</a></li>
                                            @empty
                                                {{ __($emptyMessage) }}
                                            @endforelse 
										</ul>
									</div>
								</div>
							</div>		
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">@lang('Sitemap')</h4>
									<ul class="footer-menu">
										<li><a href="{{ route('home') }}">@lang('Home')</a></li>
										<li><a href="{{ route('contact') }}">@lang('Contact')</a></li>
										<li><a href="{{ route('blog') }}">@lang('Blog')</a></li> 
									</ul>
								</div>
							</div>
									
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">@lang("Privacy Policy")</h4>
									<ul class="footer-menu">
                                @php
                                $policyPages = getContent('privacy_policy.element', null, false, true);
                                @endphp
                                @forelse($policyPages as $policy)
                                <li><a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a></li>
                                @empty
                                    {{ __($emptyMessage) }}
                                @endforelse  
									</ul>
								</div>
							</div>
							
							<div class="col-lg-2 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">The Company</h4>
									<ul class="footer-menu">
										<li><a href="{{ route('pages', 'about') }}">@lang('About')</a></li>
										<li><a href="{{ route('contact') }}">@lang('Contact')</a></li> 
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>	
									<div class="app-wrap">
										<p><a href="JavaScript:Void(0);"><img width="40" src="{{ asset($activeTemplateTrue . 'img/google-app.png')}}" class="img-fluid" alt=""></a></p>
										<p><a href="JavaScript:Void(0);"><img width="40" src="{{ asset($activeTemplateTrue . 'img/ios-app.png')}}" class="img-fluid" alt=""></a></p>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center justify-content-between">
							
							<div class="col-xl-4 col-lg-5 col-md-5">
								<p class="mb-0"><script>document.write(new Date().getFullYear())</script>© {{ $general->site_name }}® Design by @lang('KHAYTECH DIGITALZ').</p>
							</div>
							
							<div class="col-xl-8 col-lg-7 col-md-7">
								<div class="job-info-count-group">
                                    @php
                                        $counterContent = getContent('counter.content', true);
                                        $counterElements = getContent('counter.element', null, false, true);
                                    @endphp
                                    @forelse($counterElements as $item)
									<div class="single-jb-info-count">
										<div class="jbs-y7"><h5 class="ctr">{{ @$item->data_values->number }}</h5><span class="theme-2-cl">K</span></div>
										<div class="jbs-y5"><p>{{ @$item->data_values->title }}</p></div>
									</div> 
                                    @empty
                                    {!!emptyData!!}
                                    @endforelse 
									 
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->

 
 
 