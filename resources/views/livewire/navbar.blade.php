<div id="navbar-wrapper"
    class="sticky top-0 z-30 lg:bg-opacity-90 lg:fixed lg:backdrop-blur-lg w-full lg:h-40 flex items-center shadow-2xl"
    x-data="{ atTop: false }" :class="{ 'border-base-content/10': atTop, 'border-transparent': !atTop }"
    @scroll.window="atTop = (window.pageYOffset < 30) ? false: true"
    style="background-image: radial-gradient(at top left, #FACB01 0%, #FAD961 50%, #FACB01 100%);">
    <div class="container">
        <nav class="navbar px-0">
            <div class="navbar-start gap-2">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <i class="icon-menu inline-block text-xl"></i>
                    </label>
                </div>

                <!-- Navbar Brand logo -->
                <img class="w-50 md:w-40 lg:w-60 h-auto text-center tracking-tighter" src="/images/logo-removebg.webp"
                    alt="FitFoodCo" />
                    <div class="lg:hidden ml-auto relative">
                        <div class="font-medium pt-1 text-black">
                            <a onclick="toggleSidebarEvent()">
                                <i class="fas fa-shopping-cart"></i>
                                @if ($cartItemCount > 0)
                                    <span class="absolute right-0 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center left-2 bottom-2">
                                        {{ $cartItemCount }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
            </div>

            <div class="navbar-center hidden lg:flex ">
                <ul class="menu menu-horizontal menu-sm gap-2 px-1 lg:pl-80 text-black">
                    <li class="font-medium"><a href="/">Home</a></li>
                    <li class="font-medium"><a href="/#services">Menu</a></li>
                    <li class="font-medium"><a href="/#visitUs">Visit Us</a></li>
                    <li class="font-medium pt-1 relative">
                        <a onclick="toggleSidebarEvent()">
                            <i class="fas fa-shopping-cart"></i>
                            @if ($cartItemCount > 0)
                                <span
                                    class="absolute right-0 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center"
                                    style="top: -6px;">
                                    {{ $cartItemCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- sm screen menu (drawer) -->
        <div class="drawer">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"
                    style="background-color: transparent"></label>
                <ul class="menu min-h-full w-80 gap-2 p-4 text-neutral flex flex-col items-center z-50"
                    style="background-image: radial-gradient(at top left, #FACB01 0%, #FAD961 50%, #FACB01 100%);">
                    <li class="font-medium">
                        <img class="w-50 md:w-32 lg:w-48 h-auto tracking-tighter" src="/images/logo-removebg.png"
                            alt="FitFoodCo" />
                    </li>
                    <li class="font-medium"><a href="/">Home</a></li>
                    <li class="font-medium"><a href="/#services">Menu</a></li>
                    <li class="font-medium"><a href="/#visitUs">Visit Us</a></li>
                </ul>
            </div>
        </div>

    </div>
    <script>
        document.querySelector('a[href="/#visitUs"]').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: document.querySelector('#visitUs').offsetTop - 100, // 100 is the offset from the top
                behavior: 'smooth'
            });
        });

        function toggleSidebarEvent() {
            window.dispatchEvent(new CustomEvent('toggleSidebar'));
        }
    </script>
</div>
