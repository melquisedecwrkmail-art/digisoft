<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const menuOpen = ref(false);

const navLinks = [
    { label: 'Login / Register', href: '/login' },
    { label: 'Our Solutions', href: '/services' },
    { label: 'Workspace', href: '/workspaces' },
    { label: 'About Us', href: '/about' },
];

const certifications = [
    { icon: '⬡', label: 'ERP Accredited' },
    { icon: '◈', label: 'ISO Certified' },
    { icon: '◎', label: 'SEC Registered' },
    { icon: '◻', label: 'QuickBooks Certified' },
    { icon: '⊕', label: 'Fast Delivery' },
    { icon: '◇', label: 'BIR Compliant' },
];

const whyUs = [
    { label: 'Expert Team', desc: 'Seasoned professionals dedicated to your success and growth.' },
    { label: 'Scalable PH', desc: 'Solutions that grow as your business expands.' },
    { label: 'Rapid Deployment', desc: 'Fast setup so you can focus on what matters.' },
    { label: 'Ongoing Support', desc: '24/7 assistance from our dedicated support team.' },
];

const leadership = [
    { name: 'Theresa', role: 'Chief Executive Officer', initial: '' },
    { name: 'Lloyd', role: 'Full Stack Developer', initial: '' },
    { name: 'Peter', role: 'Full Stack Developer', initial: '' },
];

const team = [
    { name: 'Janine', role: 'Human Resources', initial: '' },
    { name: 'Claude', role: 'IT Support', initial: '' },
    { name: 'Melquisedec', role: 'Intern', initial: '' },
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
                    <Link href="/workspaces" class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Workspace <span class="text-[10px] opacity-60">>></span>
                    </Link>
                    <Link href="/services" class="flex items-center gap-1 text-sm border border-[#D0CCC5] px-4 py-1.5 rounded-full hover:bg-[#1A1A1A] hover:text-white hover:border-[#1A1A1A] transition-all">
                        Transform Business Ideas <span class="text-[10px] opacity-60">>></span>
                    </Link>
                </div>
                <button @click="menuOpen = !menuOpen"
                    class="w-10 h-10 border border-[#D0CCC5] rounded-full flex flex-col items-center justify-center gap-1.5">
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300" :class="menuOpen ? 'rotate-45 translate-y-[7px]' : ''"></span>
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300" :class="menuOpen ? 'opacity-0' : ''"></span>
                    <span class="block w-4 h-px bg-[#1A1A1A] transition-all duration-300" :class="menuOpen ? '-rotate-45 -translate-y-[7px]' : ''"></span>
                </button>
            </div>
            <div v-if="menuOpen" class="absolute top-16 right-6 w-56 bg-white border border-[#E0DBD3] shadow-lg rounded-sm z-50">
                <div class="py-2">
                    <Link v-for="link in navLinks" :key="link.href" :href="link.href" @click="menuOpen = false"
                        class="block px-5 py-3 text-sm text-[#444] hover:bg-[#F5F2EE] transition-colors border-b border-[#F0EDE8] last:border-0">
                        {{ link.label }}
                    </Link>
                </div>
            </div>
        </nav>

        <!-- ===== HERO ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-36 pb-16">
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-5">Who We Are</p>
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-[#1A1A1A] mb-6">
                Trusted & Certified
            </h1>
            <p class="text-base text-[#666] max-w-xl leading-relaxed">
                Industry-leading certifications you can rely on. We bring expertise, integrity, and innovation to every business we serve.
            </p>
        </section>

        <!-- ===== TRUSTED & CERTIFIED ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-16">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-px bg-[#E0DBD3]">
                <div v-for="cert in certifications" :key="cert.label"
                    class="bg-[#FAFAF8] hover:bg-white transition-colors p-6 flex flex-col items-center text-center gap-3">
                    <div class="w-12 h-12 border border-[#D0CCC5] rounded-full flex items-center justify-center text-xl text-[#2D6A4F]">
                        {{ cert.icon }}
                    </div>
                    <p class="text-xs font-semibold text-[#444]">{{ cert.label }}</p>
                </div>
            </div>
        </section>

        <!-- ===== WHY DIGISOFT ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16 border-t border-[#E0DBD3]">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <div>
                    <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-3">Our Edge</p>
                    <h2 class="text-3xl font-bold text-[#1A1A1A] mb-4">Why Choose Digisoft?</h2>
                    <p class="text-sm text-[#666] leading-relaxed mb-8">
                        Trusted by businesses for our quality, speed, and dedication. We don't just deliver software — we build lasting partnerships.
                    </p>
                    <Link href="/contact" class="inline-block bg-[#1A1A1A] text-white text-sm px-8 py-3 hover:bg-[#2D6A4F] transition-colors">
                        Get in Touch
                    </Link>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-px bg-[#E0DBD3]">
                    <div v-for="w in whyUs" :key="w.label" class="bg-[#FAFAF8] hover:bg-white transition-colors p-7">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[#2D6A4F]">✓</span>
                            <p class="font-bold text-sm text-[#1A1A1A]">{{ w.label }}</p>
                        </div>
                        <p class="text-xs text-[#777] leading-relaxed">{{ w.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== MEET THE TEAM ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-16 border-t border-[#E0DBD3]">
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-3">The People</p>
            <h2 class="text-3xl font-bold text-[#1A1A1A] mb-12">Meet Our Team</h2>

            <!-- Leadership -->
            <p class="text-xs tracking-widest uppercase text-[#AAA] mb-6">Leadership</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-[#E0DBD3] mb-px">
                <div v-for="person in leadership" :key="person.name"
                    class="bg-[#FAFAF8] hover:bg-white transition-colors p-8 flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-[#E0DBD3] rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl font-bold text-[#888]">{{ person.initial }}</span>
                    </div>
                    <p class="font-bold text-sm text-[#1A1A1A] mb-1">{{ person.name }}</p>
                    <p class="text-xs text-[#888]">{{ person.role }}</p>
                </div>
            </div>

            <!-- Team -->
            <p class="text-xs tracking-widest uppercase text-[#AAA] mb-6 mt-10">Core Team</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-[#E0DBD3]">
                <div v-for="person in team" :key="person.name"
                    class="bg-[#FAFAF8] hover:bg-white transition-colors p-8 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-[#EDEAE4] rounded-full flex items-center justify-center mb-4">
                        <span class="text-xl font-bold text-[#AAA]">{{ person.initial }}</span>
                    </div>
                    <p class="font-bold text-sm text-[#1A1A1A] mb-1">{{ person.name }}</p>
                    <p class="text-xs text-[#888]">{{ person.role }}</p>
                </div>
            </div>
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
                    <p class="text-sm text-[#888] max-w-xs">Workspace + Systems + Operational Support — all in one platform.</p>
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