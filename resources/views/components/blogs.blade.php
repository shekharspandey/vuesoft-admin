<div class="w-full max-w-6xl mx-auto py-12 md:py-24 lg:py-36 px-4 lg:px-0">
    <div class="text-center mb-8 md:mb-12">
        <span class="text-heading mb-2 block">FROM THE BLOG ———</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold">News & Articles</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 cursor-pointer gap-6 md:gap-8 lg:gap-10">
        <div class="bg-white overflow-hidden group relative flex flex-col h-full">
            <div class="relative h-48 md:h-56 lg:h-64 overflow-hidden">
                <img src="{{ asset('assets/site/blog-img1.webp') }}" loading="lazy" alt="Blog Img"
                    class="w-full h-full object-cover">
                <div class="absolute top-4 right-4 bg-primary text-white px-3 md:px-4 py-1.5 md:py-2 text-center">
                    <span class="block text-lg md:text-xl font-bold">3</span>
                    <span class="text-xs md:text-sm">JAN</span>
                </div>
            </div>
            <div class="p-4 md:p-6 flex-grow">
                <div class="flex items-center gap-2 md:gap-3 mb-2 md:mb-3">
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-at text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Ethan Miller</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-globe text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Software Industry</span>
                    </div>
                </div>
                <h3 class="text-lg md:text-xl text-black font-bold mb-2 md:mb-3">Industry Trends & Future of Web & App
                    Development</h3>
                <p class="text-sm md:text-base text-gray-500 mb-2 md:mb-3">
                    {{ limitWords('Stay ahead of the curve with insights into cutting-edge technologies like AI, machine learning, AR/VR, and Web3. Explore how emerging trends in development frameworks and design philosophies are shaping the future of digital experiences. Learn how businesses can leverage these innovations to stay competitive and optimize their development processes.', 13) }}
                </p>
            </div>
            <div
                class="flex items-center justify-between px-4 md:px-6 pb-4 md:pb-6 text-xs md:text-sm text-gray-600 group-hover:text-primary transition-colors duration-300 mt-auto">
                <a href="#" class="inline-flex items-center">
                    READ MORE
                    <i class="bi bi-chevron-right ml-1 md:ml-2"></i>
                </a>
                {{-- <span class="flex items-center">
                    <i class="bi bi-heart-fill animate-pulse group-hover:animate-pulse mr-1"></i>
                    11k+
                </span> --}}
            </div>
        </div>

        <div class="bg-white overflow-hidden group relative flex flex-col h-full">
            <div class="relative h-48 md:h-56 lg:h-64 overflow-hidden">
                <img src="{{ asset('assets/site/blog-img2.webp') }}" loading="lazy" alt="Blog Img"
                    class="w-full h-full object-cover">
                <div class="absolute top-4 right-4 bg-primary text-white px-3 md:px-4 py-1.5 md:py-2 text-center">
                    <span class="block text-lg md:text-xl font-bold">11</span>
                    <span class="text-xs md:text-sm">MAY</span>
                </div>
            </div>
            <div class="p-4 md:p-6">
                <div class="flex items-center gap-2 md:gap-3 mb-2 md:mb-3">
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-at text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Kavya Iyer</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-globe text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Software Development</span>
                    </div>
                </div>
                <h3 class="text-lg md:text-xl text-black font-bold mb-2 md:mb-3">Web & App Development Best Practices
                </h3>
                <p class="text-sm md:text-base text-gray-500 mb-2 md:mb-3">
                    {{ limitWords('Discover essential best practices for frontend, backend, and mobile development that ensure efficiency, scalability, and security. From building high-performing applications to creating seamless user experiences, get expert insights and actionable tips. Learn from real-world case studies that showcase how following these principles leads to success.', 13) }}
                </p>
            </div>
            <div
                class="flex items-center justify-between px-4 md:px-6 pb-4 md:pb-6 text-xs md:text-sm text-gray-600 group-hover:text-primary transition-colors duration-300 mt-auto">
                <a href="#" class="inline-flex items-center">
                    READ MORE
                    <i class="bi bi-chevron-right ml-1 md:ml-2"></i>
                </a>
                {{-- <span class="flex items-center">
                    <i class="bi bi-heart-fill animate-pulse group-hover:animate-pulse mr-1"></i>
                    7k+
                </span> --}}
            </div>
        </div>

        <div class="bg-white overflow-hidden group relative flex flex-col h-full">
            <div class="relative h-48 md:h-56 lg:h-64 overflow-hidden">
                <img src="{{ asset('assets/site/blog-img3.webp') }}" loading="lazy" alt="Blog Img"
                    class="w-full h-full object-cover">
                <div class="absolute top-4 right-4 bg-primary text-white px-3 md:px-4 py-1.5 md:py-2 text-center">
                    <span class="block text-lg md:text-xl font-bold">26</span>
                    <span class="text-xs md:text-sm">NOV</span>
                </div>
            </div>
            <div class="p-4 md:p-6">
                <div class="flex items-center gap-2 md:gap-3 mb-2 md:mb-3">
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-at text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Mason Clark</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="bi bi-globe text-xs md:text-sm mr-1 text-primary"></i>
                        <span class="text-xs md:text-sm">Client Experience</span>
                    </div>
                </div>
                <h3 class="text-lg md:text-xl text-black font-bold mb-2 md:mb-3">Client Success Stories & Project
                    Showcases</h3>
                <p class="text-sm md:text-base text-gray-500 mb-2 md:mb-3">
                    {{ limitWords('See how our web and app development solutions have helped businesses achieve their goals. Explore in-depth case studies highlighting project challenges, the technologies we used, and the impact we delivered. Gain inspiration from real success stories, complete with testimonials and visual showcases of transformative digital experiences.', 13) }}
                </p>
            </div>
            <div
                class="flex items-center justify-between px-4 md:px-6 pb-4 md:pb-6 text-xs md:text-sm text-gray-600 group-hover:text-primary transition-colors duration-300 mt-auto">
                <a href="#" class="inline-flex items-center">
                    READ MORE
                    <i class="bi bi-chevron-right ml-1 md:ml-2"></i>
                </a>
                {{-- <span class="flex items-center">
                    <i class="bi bi-heart-fill animate-pulse group-hover:animate-pulse mr-1"></i>
                    10k+
                </span> --}}
            </div>
        </div>
    </div>
</div>
