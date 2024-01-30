<section class="py-8 lg:py-40 bg-[#FACB01] shadow-2xl" id="home">
    <div class="container">
        <div class="grid gap-12 lg:grid-cols-2">
            <div class="lg:mt-40 text-center lg:text-left">
                <div>
                    <h1 class="text-4xl font-black tracking-tighter lg:text-6xl lg:leading-none">
                        Fuel your potential with <span class="text-black">FitFoodCo</span>
                    </h1>
                    <p class="mt-4 text-lg text-black">
                        Fuel your <b class="text-purple-600">fitness</b> journey with our expertly <b class="text-blue-600">crafted</b>, <b class="text-indigo-600">nutritious</b> meals <br>
                        where <b class="text-green-700">health</b> meets <b class="text-red-600">taste</b>!
                    </p>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary text-lg px-4 lg:py-2" id="services"
                        onclick="location.href='/#menu'">Browse Full Menu</button>
                </div>
            </div>
            <div class="lg:mt-20">
                <img alt="Package" class="rounded-lg" src="/images/pack.webp" />
            </div>
        </div>
    </div>
    <script>
        document.querySelector('a[href="/#menu"]').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: document.querySelector('#menu').offsetTop - 100, // 100 is the offset from the top
                behavior: 'smooth'
            });
        });
    </script>
</section>
