<div class="w-full max-w-6xl mx-auto py-12 md:py-24 lg:py-36 px-4 lg:px-0">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div class="rounded-2xl md:rounded-3xl bg-primary p-6 md:p-8 text-white">
            <h2 class="mb-3 md:mb-4 text-2xl md:text-3xl lg:text-4xl font-bold">Have Any Questions</h2>
            <p class="mb-6 md:mb-8 text-base md:text-lg opacity-90">Feel free to contact us through anywhere.</p>

            <form class="space-y-4 md:space-y-6">
                <div class="grid grid-cols-1 gap-4 md:gap-6 md:grid-cols-2">
                    <input type="text" name="name" placeholder="Your Name*" required
                        class="w-full rounded-lg bg-white px-3 py-2.5 md:px-4 md:py-3 text-gray-800 placeholder-gray-500 text-sm md:text-base">
                    <input type="email" name="email" placeholder="Your Email*" required
                        class="w-full rounded-lg bg-white px-3 py-2.5 md:px-4 md:py-3 text-gray-800 placeholder-gray-500 text-sm md:text-base">
                </div>
                <input type="text" name="address" placeholder="Your Address"
                    class="w-full rounded-lg bg-white px-3 py-2.5 md:px-4 md:py-3 text-gray-800 placeholder-gray-500 text-sm md:text-base">
                <textarea name="message" placeholder="Write your Message" rows="3" md:rows="4"
                    class="w-full rounded-lg bg-white px-3 py-2.5 md:px-4 md:py-3 text-gray-800 placeholder-gray-500 text-sm md:text-base"></textarea>
                <button type="submit"
                    class="w-full rounded-lg bg-black px-4 py-3 md:px-6 md:py-4 text-center text-white transition-all hover:bg-white hover:text-black text-sm md:text-base font-medium md:font-semibold">
                    SUBMIT NOW
                </button>
            </form>
        </div>

        <div class="flex flex-col justify-center p-4 md:p-8">
            <div class="mb-2 md:mb-4 text-heading text-sm md:text-base">CONTACT US ———</div>
            <h1 class="mb-4 md:mb-6 text-2xl md:text-3xl lg:text-5xl font-bold leading-tight">Contact Us Let's Talk Your
                Any Query.
            </h1>
            <p class="mb-6 md:mb-8 text-base md:text-lg text-gray-500">
                With VueSoft, we've decided to change course, embarking on a journey to design our own aluminium
                systems.
                Leveraging cutting-edge CNC manufacturing techniques, we aim to create systems that push boundaries.
            </p>

            <div class="mb-6 md:mb-8">
                <p class="mb-2 text-base md:text-lg text-gray-500">Or You may <span class="font-semibold">Call Us</span>
                    For
                    Appointment</p>
                <a href="tel:+918860202974" class="flex items-center text-lg md:text-xl font-bold">
                    <span
                        class="mr-2 md:mr-3 flex h-8 w-8 md:h-10 md:w-10 items-center justify-center rounded-full bg-primary text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4 md:h-5 md:w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </span>
                    (+91) 8860202974
                </a>
            </div>

            <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-0">
                <div class="flex -space-x-3 md:-space-x-4">
                    <img src="{{ asset('assets/site/client1.jpg') }}" alt="Team member 1" loading="lazy"
                        class="h-10 w-10 md:h-12 md:w-12 rounded-full border-2 border-white">
                    <img src="{{ asset('assets/site/client2.jpg') }}" alt="Team member 2" loading="lazy"
                        class="h-10 w-10 md:h-12 md:w-12 rounded-full border-2 border-white">
                    <img src="{{ asset('assets/site/client3.jpg') }}" alt="Team member 3" loading="lazy"
                        class="h-10 w-10 md:h-12 md:w-12 rounded-full border-2 border-white">
                    <div
                        class="flex h-10 w-10 md:h-12 md:w-12 items-center justify-center rounded-full border-2 border-white bg-primary text-xs md:text-sm font-medium text-white">
                        +15
                    </div>
                </div>
                <p class="md:ml-4 text-sm md:text-base text-gray-500">We collaborated with 15+ new start-up</p>
            </div>
        </div>
    </div>
</div>
