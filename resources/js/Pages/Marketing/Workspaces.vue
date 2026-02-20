<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const menuOpen = ref(false);
const activeFilter = ref('ALL SPACES');

const navLinks = [
    { label: 'Login / Register', href: '/login' },
    { label: 'Our Solutions', href: '/services' },
    { label: 'Workspace', href: '/workspaces' },
    { label: 'About Us', href: '/about' },
];

const filters = ['ALL SPACES', 'PRIVATE OFFICE', 'CO-WORKING', 'MEETING ROOMS', 'VIRTUAL OFFICE'];

const workspaces = [
    { id: 1, name: 'Makati Business Hub', type: 'Private Office', price: '₱1,200', per: 'day', tag: 'FEATURED' },
    { id: 2, name: 'BGC Co-Working Lounge', type: 'Co-Working', price: '₱450', per: 'day', tag: 'POPULAR' },
    { id: 3, name: 'Ortigas Meeting Suite', type: 'Meeting Room', price: '₱800', per: 'hour', tag: '' },
    { id: 4, name: 'Virtual Office Basic', type: 'Virtual Office', price: '₱1,500', per: 'month', tag: 'BEST VALUE' },
];

const plans = [
    {
        label: 'DAILY',
        price: '₱450',
        per: '/day',
        features: [
            'Access from 8AM – 8PM',
            'Free daily credits',
            'Meeting room access',
            'From ₱450/day',
            'Perfect for drop-ins',
        ],
        cta: 'Book a Day',
        highlight: false,
    },
    {
        label: 'MONTHLY',
        price: '₱8,000',
        per: '/month',
        features: [
            'Unlimited access',
            'Meeting room credits',
            'Free daily credits',
            'Priority booking',
            'Business address',
        ],
        cta: 'Start Monthly',
        highlight: true,
    },
    {
        label: 'ANNUALLY',
        price: '₱80,000',
        per: '/year',
        features: [
            '2 months free included',
            'Dedicated desk option',
            'Up to 10% office savings',
            'Annual report access',
            'Dedicated account manager',
        ],
        cta: 'Go Annual',
        highlight: false,
    },
];

const amenities = [
    { icon: '◎', label: 'Connectivity', desc: 'High-speed fiber internet, dedicated Wi-Fi, LAN ports at every desk.' },
    { icon: '◈', label: 'Refreshments', desc: 'Complimentary coffee, tea, and filtered water throughout the day.' },
    { icon: '◻', label: 'Parking Space', desc: 'Available parking slots for members with advance reservation.' },
    { icon: '⬡', label: 'Wellness', desc: 'Ergonomic furniture, lounge areas, and natural lighting.' },
    { icon: '◇', label: 'Business Support', desc: 'Reception services, mail handling, and printing facilities.' },
    { icon: '⊕', label: 'Security', desc: '24/7 CCTV surveillance, keycard access, and on-site staff.' },
];
</script>

<template>
    <div class="min-h-screen bg-[#FAFAF8] text-[#1A1A1A]" style="font-family: 'Georgia', serif;">

        <!-- ===== NAVBAR ===== -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-[#FAFAF8]/95 backdrop-blur-sm border-b border-[#E0DBD3]">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 h-16 flex items-center justify-between">
                <Link href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-[#1A1A1A] rounded-sm flex items-center justify-center">
                        <span class="text-white text-xs font-bold">D</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight">Digisoft</span>
                </Link>

                <div class="hidden md:flex items-center gap-3">
                    <Link href="/workspaces"
                        class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Workspace <span class="text-[10px] opacity-60">>></span>
                    </Link>
                    <Link href="/services"
                        class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Transform Business Ideas <span class="text-[10px] opacity-60">>></span>
                    </Link>
                </div>

                <button @click="menuOpen = !menuOpen"
                    class="w-10 h-10 border border-[#D0CCC5] rounded-full flex flex-col items-center justify-center gap-1.5"
                    aria-label="Toggle menu">
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300"
                        :class="menuOpen ? 'rotate-45 translate-y-[7px]' : ''"></span>
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300"
                        :class="menuOpen ? 'opacity-0' : ''"></span>
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300"
                        :class="menuOpen ? '-rotate-45 -translate-y-[7px]' : ''"></span>
                </button>
            </div>

            <!-- Dropdown -->
            <div v-if="menuOpen"
                class="absolute top-16 right-6 w-56 bg-white border border-[#E0DBD3] shadow-lg rounded-sm z-50">
                <div class="py-2">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href"
                        @click="menuOpen = false"
                        class="block px-5 py-3 text-sm text-[#444] hover:bg-[#F5F2EE] hover:text-[#1A1A1A] transition-colors border-b border-[#F0EDE8] last:border-0">
                        {{ link.label }}
                    </Link>
                </div>
            </div>
        </nav>

        <!-- ===== HERO + SEARCH ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-32 pb-10">
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-4">Find Your Space</p>
            <h1 class="text-4xl lg:text-6xl font-bold leading-tight text-[#1A1A1A] mb-4">
                Flexible Workspace for<br />Every Business Need
            </h1>
            <p class="text-[#666] text-sm mb-10 max-w-xl">
                Discover professional workspaces across prime locations. Book instantly, operate smarter.
            </p>

            <!-- Search Bar -->
            <div class="flex flex-col md:flex-row gap-0 border border-[#D0CCC5] bg-white">
                <input type="text" placeholder="Search City"
                    class="flex-1 px-5 py-3.5 text-sm text-[#1A1A1A] outline-none border-r border-[#E0DBD3] bg-transparent placeholder-[#AAA]" />
                <input type="text" placeholder="Date / Day"
                    class="flex-1 px-5 py-3.5 text-sm text-[#1A1A1A] outline-none border-r border-[#E0DBD3] bg-transparent placeholder-[#AAA]" />
                <select class="flex-1 px-5 py-3.5 text-sm text-[#555] outline-none border-r border-[#E0DBD3] bg-transparent appearance-none cursor-pointer">
                    <option value="">Team Size</option>
                    <option>1 Person</option>
                    <option>2 – 5 Person</option>
                    <option>6 – 10 Person</option>
                    <option>10 – 20 Person</option>
                    <option>20+ Person</option>
                </select>
                <button class="bg-[#1A1A1A] text-white text-sm px-8 py-3.5 hover:bg-[#2D6A4F] transition-colors font-medium">
                    Find
                </button>
            </div>
        </section>

        <!-- ===== FILTER TABS ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-4">
            <div class="flex flex-wrap gap-2">
                <button
                    v-for="filter in filters"
                    :key="filter"
                    @click="activeFilter = filter"
                    :class="activeFilter === filter
                        ? 'bg-[#1A1A1A] text-white border-[#1A1A1A]'
                        : 'bg-white text-[#555] border-[#D0CCC5] hover:border-[#1A1A1A] hover:text-[#1A1A1A]'"
                    class="text-xs tracking-wider border px-5 py-2 transition-all">
                    {{ filter }}
                </button>
            </div>
        </section>

        <!-- ===== FEATURED WORKSPACES ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-10">
            <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-6">Featured Workspaces</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div v-for="ws in workspaces" :key="ws.id"
                    class="bg-white border border-[#E0DBD3] group hover:shadow-md transition-shadow">

                    <!-- Image -->
                    <div class="bg-[#EDEAE4] h-44 flex items-center justify-center relative">
                        <svg class="w-10 h-10 text-[#BBB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span v-if="ws.tag"
                            class="absolute top-3 left-3 text-[10px] tracking-widest bg-[#2D6A4F] text-white px-2 py-0.5">
                            {{ ws.tag }}
                        </span>
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <p class="text-[10px] tracking-widest uppercase text-[#2D6A4F] mb-1">{{ ws.type }}</p>
                        <p class="font-bold text-[#1A1A1A] text-sm mb-3">{{ ws.name }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-base font-bold text-[#1A1A1A]">{{ ws.price }}</span>
                                <span class="text-xs text-[#888]"> / {{ ws.per }}</span>
                            </div>
                            <button class="text-xs bg-[#1A1A1A] text-white px-4 py-1.5 hover:bg-[#2D6A4F] transition-colors">
                                Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== FLEXIBLE LEASING + ENTERPRISE ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-14">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Leasing Plans (left 2/3) -->
                <div class="lg:col-span-2">
                    <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-2">Pricing</p>
                    <h2 class="text-2xl font-bold text-[#1A1A1A] mb-8">Flexible Leasing Options</h2>
                    <p class="text-sm text-[#666] mb-8 -mt-4">Choose the lease that fits your business. From daily rentals to long-term leases.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-[#E0DBD3]">
                        <div v-for="plan in plans" :key="plan.label"
                            :class="plan.highlight ? 'bg-[#1A1A1A] text-white' : 'bg-white text-[#1A1A1A]'"
                            class="p-7 flex flex-col">
                            <p class="text-xs tracking-[0.25em] mb-3"
                                :class="plan.highlight ? 'text-[#AAA]' : 'text-[#888]'">
                                {{ plan.label }}
                            </p>
                            <p class="text-3xl font-bold mb-0.5">{{ plan.price }}</p>
                            <p class="text-xs mb-6" :class="plan.highlight ? 'text-[#AAA]' : 'text-[#888]'">{{ plan.per }}</p>
                            <ul class="flex flex-col gap-2 mb-8 flex-1">
                                <li v-for="f in plan.features" :key="f"
                                    class="text-xs flex items-start gap-2"
                                    :class="plan.highlight ? 'text-[#CCC]' : 'text-[#666]'">
                                    <span class="mt-0.5" :class="plan.highlight ? 'text-[#2D6A4F]' : 'text-[#2D6A4F]'">✓</span>
                                    {{ f }}
                                </li>
                            </ul>
                            <button
                                :class="plan.highlight
                                    ? 'border border-white text-white hover:bg-white hover:text-[#1A1A1A]'
                                    : 'border border-[#1A1A1A] text-[#1A1A1A] hover:bg-[#1A1A1A] hover:text-white'"
                                class="text-xs py-2.5 transition-colors">
                                {{ plan.cta }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Solutions (right 1/3) -->
                <div class="bg-[#1A1A1A] text-white p-8 flex flex-col justify-between">
                    <div>
                        <p class="text-xs tracking-[0.25em] uppercase text-[#AAA] mb-3">For Large Teams</p>
                        <h3 class="text-xl font-bold mb-5">Enterprise Solutions</h3>
                        <ul class="flex flex-col gap-4 text-sm text-[#CCC]">
                            <li class="flex items-start gap-3">
                                <span class="text-[#2D6A4F] mt-0.5">◈</span>
                                <div>
                                    <p class="text-white font-medium text-xs mb-1">Custom Office Setup</p>
                                    <p class="text-xs">Tailored layouts to suit your brand and workflow.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#2D6A4F] mt-0.5">◈</span>
                                <div>
                                    <p class="text-white font-medium text-xs mb-1">Dedicated Account Manager</p>
                                    <p class="text-xs">Single point of contact for all your workspace needs.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#2D6A4F] mt-0.5">◈</span>
                                <div>
                                    <p class="text-white font-medium text-xs mb-1">Global Network Access</p>
                                    <p class="text-xs">Workspaces in 100+ cities worldwide.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#2D6A4F] mt-0.5">◈</span>
                                <div>
                                    <p class="text-white font-medium text-xs mb-1">Flexible Solutions</p>
                                    <p class="text-xs">Add or reduce space as your team changes.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-10 pt-8 border-t border-[#333]">
                        <div class="flex gap-6 mb-6 text-center">
                            <div>
                                <p class="text-xl font-bold">10+</p>
                                <p class="text-[10px] text-[#888] tracking-wider">LOCATIONS</p>
                            </div>
                            <div>
                                <p class="text-xl font-bold">100+</p>
                                <p class="text-[10px] text-[#888] tracking-wider">HAPPY CLIENTS</p>
                            </div>
                            <div>
                                <p class="text-xl font-bold">24/7</p>
                                <p class="text-[10px] text-[#888] tracking-wider">SUPPORT</p>
                            </div>
                        </div>
                        <button class="w-full border border-[#2D6A4F] text-[#2D6A4F] text-xs py-3 hover:bg-[#2D6A4F] hover:text-white transition-colors">
                            Talk to our Enterprise Team
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PREMIUM AMENITIES ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-14 border-t border-[#E0DBD3]">
            <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-2">Included in Every Space</p>
            <h2 class="text-2xl font-bold text-[#1A1A1A] mb-10">Premium Amenities</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-px bg-[#E0DBD3]">
                <div v-for="amenity in amenities" :key="amenity.label"
                    class="bg-[#FAFAF8] p-6 hover:bg-white transition-colors group">
                    <div class="text-xl text-[#2D6A4F] mb-3">{{ amenity.icon }}</div>
                    <p class="font-bold text-xs text-[#1A1A1A] mb-2 group-hover:text-[#2D6A4F] transition-colors">
                        {{ amenity.label }}
                    </p>
                    <p class="text-xs text-[#777] leading-relaxed">{{ amenity.desc }}</p>
                </div>
            </div>

            <!-- Footer note -->
            <p class="text-xs text-[#999] text-center mt-8 italic">
                ✦ All workspaces include access to common areas and business lounge.
            </p>
        </section>

        <!-- ===== FOOTER ===== -->
        <footer class="border-t border-[#E0DBD3] py-10 px-6 lg:px-10 mt-10">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 bg-[#1A1A1A] rounded-sm flex items-center justify-center">
                            <span class="text-white text-xs font-bold">D</span>
                        </div>
                        <span class="font-bold text-lg">Digisoft</span>
                    </div>
                    <p class="text-sm text-[#888] max-w-xs">
                        Workspace + Systems + Operational Support — all in one platform.
                    </p>
                </div>
                <div class="flex gap-12 text-sm text-[#888]">
                    <div class="flex flex-col gap-2">
                        <p class="text-[#1A1A1A] font-semibold mb-1">Platform</p>
                        <Link href="/workspaces" class="hover:text-[#1A1A1A] transition-colors">Workspaces</Link>
                        <Link href="/services" class="hover:text-[#1A1A1A] transition-colors">Our Solutions</Link>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-[#1A1A1A] font-semibold mb-1">Company</p>
                        <Link href="/about" class="hover:text-[#1A1A1A] transition-colors">About Us</Link>
                        <Link href="/contact" class="hover:text-[#1A1A1A] transition-colors">Contact</Link>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-[#1A1A1A] font-semibold mb-1">Account</p>
                        <Link href="/login" class="hover:text-[#1A1A1A] transition-colors">Sign In</Link>
                        <Link href="/register" class="hover:text-[#1A1A1A] transition-colors">Register</Link>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-[#E0DBD3] text-xs text-[#BBB]">
                © {{ new Date().getFullYear() }} Digisoft. All rights reserved.
            </div>
        </footer>

    </div>
</template>