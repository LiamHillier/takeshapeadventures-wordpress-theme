<header class="px !bg-white !opacity-100">
    <div>
        <a href='/'><img src="<?php echo get_template_directory_uri(); ?>/resources/assets/logo-new.png.webp" alt="take shape adventures logo" width="300px" height="150px" class="header-logo" />
        </a>
        <nav>
            <ul>
                <li>
                    <a href="/calendar">Calendar</a>
                </li>
                <li class="ta-get_started">
                    Get Started
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
                <li class="ta-adventures">
                    Adventures
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
                <li class="ta-domore">
                    Do More
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
            </ul>
        </nav>
    </div>
    <div class="justify-end">
        <nav>
            <ul>
                <li class="ta-shop">
                    Shop
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
                <li class="ta-help">
                    Help
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
                <li class="ta-about">
                    About
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
                <li class="ta-account">
                    Account
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </li>
            </ul>
        </nav>
        <div class="search">
        <?php echo do_shortcode('[searchandfilter id="29867"]'); ?>
        </div>
        <button type="button" class="mobile-header-btn">
            MENU
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
</header>
<div class="mobile-menu fixed left-0 top-0 z-50 h-screen w-screen hidden">
	<div class="mobile-menu-overlay" ></div>
	<aside class="mobile-menu-container bg-white h-full py-10 w-auto">
		<div class="mb-10 px-10 ">
			<div>
				<!-- Logo -->
				<img src="/wp-content/uploads/2021/11/logo-new.png" alt="logo" width="200px" height="60px" />
			</div>
			<div class="absolute right-10 top-10 cursor-pointer close-menu">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</div>
		</div>
		<ul>
			<li><a href="/calendar">Calendar</a></li>
			<li><a href="/day-hikes">Day Hikes</a></li>
			<li><a href="/adventure-experiences/">Experiences</a></li>
			<li><a href="/overnight-hikes">Overnight Hikes</a></li>
			<li><a href="/weekend-escapes">Weekend Escapes</a></li>
			<li><a href="/micro-adventures">Micro Adventures</a></li>
			<li><a href="/adventure-tours">Adventure Tours</a></li>
			<li><a href="/shop">Shop</a></li>
			<li><a href="/memberhsip">Membership</a></li>
			<li><a href="/faqs">FAQs</a></li>
			<li><a href="/my-account">My Account</a></li>
		</ul>
	</aside>
</div>