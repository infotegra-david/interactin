		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
					
					<a href="javascript:void(0);" id="show-shortcut" class="hidden-md-down" data-action="toggleShortcut">
						<img src="{{URL::asset('img/avatars/juan.png')}}" alt="me" class="online" /> 
						<span title="{{ Auth::user()->email }}">
							{{{ Auth::user()->name }}}
						</span>
						<i class="fa fa-angle-down"></i>
					</a>

					<ul id="profile-img" class="list hidden-lg-up padding-5">
						<li class="">
							<a href="javascript:void(0);" id="show-shortcut" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
								<img src="{{URL::asset('img/avatars/juan.png')}}" alt="me" class="online" /> 
								<span title="{{ Auth::user()->email }}">
									{{{ Auth::user()->name }}}
								</span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-th-large"></i> Accesos directos</a>
								</li>
								<li>
									<a href="/html/profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> Perfil</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Ajustes</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Pantalla Completa</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="{{ URL('/logout') }}" class="padding-10 padding-top-0 padding-bottom-0" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>C</u>errar sesión</strong></a>
								</li>
							</ul>
						</li>
					</ul>
					
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->
				<?php
					$ui = new SmartUI();
					$ui->create_nav($page_nav)->print_html();
				?>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->