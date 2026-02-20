<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Workspace from './Workspaces.vue';

const menuOpen = ref(false);

const navLinks = [
    { label: 'Login / Register', href: '/login' },
    { label: 'Our Solutions', href: '/services' },
    { label: 'Workspace', href: '/workspaces' },
    { label: 'About Us', href: '/about' },
];

const solutions = [
    {
        title: 'ERP Systems',
        icon: '⬡',
        desc: 'Streamline your entire business operations with our enterprise resource planning solutions tailored for growing businesses.',
    },
    {
        title: 'Accounting Systems',
        icon: '◈',
        desc: 'Manage your finances with precision. Automated bookkeeping, invoicing, and real-time financial reporting.',
    },
    {
        title: 'QuickBooks Systems',
        icon: '◎',
        desc: 'Certified QuickBooks integration and support to keep your accounts organized and tax-ready year-round.',
    },
    {
        title: 'Point of Sale Systems',
        icon: '◻',
        desc: 'Modern POS solutions for retail and food businesses. Fast, reliable, and fully integrated with your inventory.',
    },
];
</script>

<template>
    <div class="min-h-screen bg-[#FAFAF8] text-[#1A1A1A]" style="font-family: 'Georgia', serif;">

        <!-- ===== NAVBAR ===== -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-[#FAFAF8]/95 backdrop-blur-sm border-b border-[#E0DBD3]">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 h-16 flex items-center justify-between">

                <!-- Logo -->
                <Link href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-[#1A1A1A] rounded-sm flex items-center justify-center">
                        <span class="text-white text-xs font-bold">D</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight">Digisoft</span>
                </Link>

                <!-- Desktop Nav Pills -->
                <div class="hidden md:flex items-center gap-3">
                    <Link href="/workspaces"
                        class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Workspace
                        <span class="text-[10px] opacity-60">>></span>
                    </Link>
                    <Link href="/services"
                        class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Transform Business Ideas
                        <span class="text-[10px] opacity-60">>></span>
                    </Link>
                </div>

                <!-- Hamburger -->
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

            <!-- Dropdown Menu -->
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

        <!-- ===== HERO ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-36 pb-16">
            <div class="max-w-2xl">
                <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-5">Business Infrastructure Platform</p>
                <h1 class="text-5xl lg:text-6xl font-bold leading-[1.1] text-[#1A1A1A] mb-6">
                    Software Solutions<br />Built for Real<br />Businesses
                </h1>
                <p class="text-base text-[#666] leading-relaxed max-w-lg mb-8">
                    Digisoft delivers office space and services to help your team thrive. Industry-leading certifications to earn and keep your business trust.
                </p>
                <Link href="/register"
                    class="inline-block bg-[#1A1A1A] text-white text-sm px-8 py-3 hover:bg-[#2D6A4F] transition-colors">
                    Get Started
                </Link>
            </div>
        </section>

        <!-- ===== SPLIT SECTION: Workspace image + CTA ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 border border-[#E0DBD3]">

                <!-- Left: Image placeholder -->
                <div class="bg-[#EDEAE4] min-h-72 lg:min-h-96 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#D9D4CB] to-[#C5BFB5]"></div>
                    <div class="relative z-10 text-center px-8">
                        <div class="w-16 h-16 border-2 border-[#999] rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#999]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-sm text-[#888]">Workspace Image</p>
                    </div>
                </div>

                <!-- Right: Text + CTA -->
                <div class="bg-white p-10 lg:p-14 flex flex-col justify-center">
                    <p class="text-xs tracking-[0.25em] uppercase text-[#2D6A4F] mb-4">Our Workspace</p>
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#1A1A1A] leading-tight mb-5">
                        Workplaces for every<br />business objective
                    </h2>
                    <p class="text-sm text-[#666] leading-relaxed mb-8">
                        Choose your office space and services to help your team thrive every business needs you.
                    </p>
                    <Link href="/workspaces"
                        class="self-start border border-[#1A1A1A] text-[#1A1A1A] text-sm px-7 py-2.5 hover:bg-[#1A1A1A] hover:text-white transition-colors">
                        Browse Workspaces
                    </Link>
                </div>
            </div>
        </section>

        <!-- ===== OUR SOLUTIONS ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-20">

            <!-- Section Header -->
            <div class="text-center mb-14">
                <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-3">What We Offer</p>
                <h2 class="text-3xl lg:text-4xl font-bold text-[#1A1A1A]">Our Solutions</h2>
            </div>

            <!-- Solutions Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-[#E0DBD3]">
                <div v-for="solution in solutions" :key="solution.title"
                    class="bg-[#FAFAF8] p-8 hover:bg-white transition-colors group">
                    <div class="text-2xl text-[#2D6A4F] mb-5">{{ solution.icon }}</div>
                    <h3 class="font-bold text-[#1A1A1A] text-base mb-3 group-hover:text-[#2D6A4F] transition-colors">
                        {{ solution.title }}
                    </h3>
                    <p class="text-sm text-[#777] leading-relaxed">{{ solution.desc }}</p>
                    <div class="mt-6">
                        <Link href="/services"
                            class="text-xs tracking-widest uppercase text-[#1A1A1A] border-b border-[#1A1A1A] pb-0.5 hover:text-[#2D6A4F] hover:border-[#2D6A4F] transition-colors">
                            Learn more
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== CTA BANNER ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-24">
            <div class="bg-[#1A1A1A] text-white px-10 lg:px-16 py-14 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold mb-2">Ready to transform your business?</h2>
                    <p class="text-[#AAA] text-sm">Join hundreds of businesses already running on Digisoft.</p>
                </div>
                <div class="flex gap-4 flex-shrink-0">
                    <Link href="/contact"
                        class="text-sm border border-white px-6 py-3 hover:bg-white hover:text-[#1A1A1A] transition-colors">
                        Talk to Us
                    </Link>
                    <Link href="/register"
                        class="text-sm bg-[#2D6A4F] text-white px-6 py-3 hover:bg-[#245C43] transition-colors">
                        Get Started
                    </Link>
                </div>
            </div>
        </section>

        <!-- ===== FOOTER ===== -->
        <footer class="border-t border-[#E0DBD3] py-10 px-6 lg:px-10">
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