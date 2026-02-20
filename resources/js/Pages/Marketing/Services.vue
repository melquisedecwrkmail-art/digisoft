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

const solutions = [
    {
        icon: '⬡',
        title: 'ERP Systems',
        tag: 'Enterprise',
        desc: 'End-to-end enterprise resource planning tailored for growing businesses. Manage inventory, HR, finance, and operations from a single platform.',
        features: ['Inventory Management', 'HR & Payroll Module', 'Financial Reporting', 'Multi-branch Support'],
    },
    {
        icon: '◈',
        title: 'Accounting Systems',
        tag: 'Finance',
        desc: 'Automated bookkeeping, invoicing, and real-time financial reporting. Stay tax-ready and audit-proof year-round with minimal manual effort.',
        features: ['Automated Bookkeeping', 'Invoice Generation', 'Tax Compliance', 'Real-time Dashboards'],
    },
    {
        icon: '◎',
        title: 'QuickBooks Systems',
        tag: 'Certified',
        desc: 'Certified QuickBooks integration and full setup support. We configure, train, and maintain your QuickBooks environment so you never miss a beat.',
        features: ['QuickBooks Setup', 'Data Migration', 'Staff Training', 'Ongoing Support'],
    },
    {
        icon: '◻',
        title: 'Point of Sale Systems',
        tag: 'Retail',
        desc: 'Modern POS solutions for retail and food service. Fast transactions, inventory sync, and sales analytics — all in one reliable system.',
        features: ['Sales Tracking', 'Inventory Sync', 'Receipt Printing', 'Analytics Dashboard'],
    },
];

const process = [
    { step: '01', label: 'Consultation', desc: 'We assess your business needs and recommend the right solution.' },
    { step: '02', label: 'Proposal', desc: 'You receive a clear, itemized quotation with no hidden fees.' },
    { step: '03', label: 'Implementation', desc: 'Our team sets up, configures, and tests your system.' },
    { step: '04', label: 'Support', desc: 'Ongoing maintenance, updates, and dedicated support.' },
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
                    <Link href="/services" class="flex items-center gap-1 text-sm border border-[#1A1A1A] bg-[#1A1A1A] text-white px-4 py-1.5 rounded-full">
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
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-5">Digital Solutions</p>
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-[#1A1A1A] mb-6">
                Our Solutions
            </h1>
            <p class="text-base text-[#666] max-w-xl leading-relaxed">
                Industry-leading software solutions for businesses that demand reliability, precision, and scalability.
            </p>
        </section>

        <!-- ===== SOLUTIONS GRID ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-[#E0DBD3]">
                <div v-for="solution in solutions" :key="solution.title"
                    class="bg-[#FAFAF8] p-10 hover:bg-white transition-colors group">
                    <div class="flex items-start justify-between mb-6">
                        <div class="text-3xl text-[#2D6A4F]">{{ solution.icon }}</div>
                        <span class="text-[10px] tracking-widest uppercase border border-[#D0CCC5] px-3 py-1 text-[#888]">
                            {{ solution.tag }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-[#1A1A1A] mb-3 group-hover:text-[#2D6A4F] transition-colors">
                        {{ solution.title }}
                    </h3>
                    <p class="text-sm text-[#666] leading-relaxed mb-6">{{ solution.desc }}</p>
                    <ul class="flex flex-col gap-2 mb-8">
                        <li v-for="f in solution.features" :key="f" class="flex items-center gap-2 text-xs text-[#555]">
                            <span class="text-[#2D6A4F]">✓</span> {{ f }}
                        </li>
                    </ul>
                    <Link href="/contact"
                        class="text-xs tracking-widest uppercase border-b border-[#1A1A1A] pb-0.5 hover:text-[#2D6A4F] hover:border-[#2D6A4F] transition-colors">
                        Request a Quote
                    </Link>
                </div>
            </div>
        </section>

        <!-- ===== HOW IT WORKS ===== -->
        <section class="bg-[#1A1A1A] text-white py-20 px-6 lg:px-10">
            <div class="max-w-7xl mx-auto">
                <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-3">The Process</p>
                <h2 class="text-2xl font-bold mb-12">How It Works</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-[#333]">
                    <div v-for="p in process" :key="p.step" class="bg-[#1A1A1A] p-8 hover:bg-[#222] transition-colors">
                        <p class="text-4xl font-bold text-[#333] mb-4">{{ p.step }}</p>
                        <p class="font-bold text-white mb-2">{{ p.label }}</p>
                        <p class="text-sm text-[#888] leading-relaxed">{{ p.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== CTA ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-20 text-center">
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-4">Get Started</p>
            <h2 class="text-3xl font-bold text-[#1A1A1A] mb-4">Ready to digitize your business?</h2>
            <p class="text-sm text-[#666] mb-8">Talk to our team and get a free consultation today.</p>
            <div class="flex justify-center gap-4">
                <Link href="/contact" class="bg-[#1A1A1A] text-white text-sm px-8 py-3 hover:bg-[#2D6A4F] transition-colors">
                    Talk to Us
                </Link>
                <Link href="/workspaces" class="border border-[#1A1A1A] text-[#1A1A1A] text-sm px-8 py-3 hover:bg-[#1A1A1A] hover:text-white transition-colors">
                    View Workspaces
                </Link>
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