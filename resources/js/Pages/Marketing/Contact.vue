<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const menuOpen = ref(false);

const navLinks = [
    { label: 'Login / Register', href: '/login' },
    { label: 'Our Solutions', href: '/services' },
    { label: 'Workspace', href: '/workspaces' },
    { label: 'About Us', href: '/about' },
];

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const submitted = ref(false);

function submit() {
    form.post('/contact', {
        onSuccess: () => { submitted.value = true; },
    });
}

const contactInfo = [
    { icon: '◎', label: 'Address', value: 'J.P Rizal, Quezon City, Metro Manila' },
    { icon: '◈', label: 'Email', value: 'support@digisoftmanila.com' },
    { icon: '◻', label: 'Phone', value: '0977 725 9701' },
    { icon: '⬡', label: 'Hours', value: 'Monday – Friday, 9AM – 5PM' },
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
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pt-36 pb-12">
            <p class="text-xs tracking-[0.3em] uppercase text-[#2D6A4F] mb-5">Get In Touch</p>
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-[#1A1A1A] mb-4">Contact Us</h1>
            <p class="text-base text-[#666] max-w-lg leading-relaxed">
                Have a question, need a quote, or ready to get started? We'd love to hear from you.
            </p>
        </section>

        <!-- ===== CONTACT LAYOUT ===== -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-px bg-[#E0DBD3]">

                <!-- Contact Info -->
                <div class="bg-[#1A1A1A] text-white p-10 flex flex-col justify-between">
                    <div>
                        <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-6">Contact Information</p>
                        <div class="flex flex-col gap-8">
                            <div v-for="info in contactInfo" :key="info.label" class="flex items-start gap-4">
                                <div class="text-[#2D6A4F] text-lg mt-0.5">{{ info.icon }}</div>
                                <div>
                                    <p class="text-xs text-[#888] mb-1 tracking-wider uppercase">{{ info.label }}</p>
                                    <p class="text-sm text-[#DDD]">{{ info.value }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 pt-8 border-t border-[#333]">
                        <p class="text-xs text-[#666] mb-4">Follow us</p>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 border border-[#333] rounded-full flex items-center justify-center text-[#888] hover:border-[#2D6A4F] hover:text-[#2D6A4F] transition-colors cursor-pointer text-xs">f</div>
                            <div class="w-8 h-8 border border-[#333] rounded-full flex items-center justify-center text-[#888] hover:border-[#2D6A4F] hover:text-[#2D6A4F] transition-colors cursor-pointer text-xs">in</div>
                            <div class="w-8 h-8 border border-[#333] rounded-full flex items-center justify-center text-[#888] hover:border-[#2D6A4F] hover:text-[#2D6A4F] transition-colors cursor-pointer text-xs">tw</div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2 bg-white p-10 lg:p-14">

                    <!-- Success Message -->
                    <div v-if="submitted" class="flex flex-col items-center justify-center h-full text-center py-16">
                        <div class="w-16 h-16 border-2 border-[#2D6A4F] rounded-full flex items-center justify-center mb-6">
                            <span class="text-[#2D6A4F] text-2xl">✓</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#1A1A1A] mb-2">Message Sent!</h3>
                        <p class="text-sm text-[#666]">We'll get back to you within 1 business day.</p>
                    </div>

                    <!-- Form -->
                    <form v-else @submit.prevent="submit" class="flex flex-col gap-6">
                        <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-2">Send us a message</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Full Name</label>
                                <input v-model="form.name" type="text" placeholder="Melquisedec Nollora"
                                    class="w-full border border-[#E0DBD3] px-4 py-3 text-sm text-[#1A1A1A] outline-none focus:border-[#1A1A1A] transition-colors placeholder-[#CCC] bg-[#FAFAF8]" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>
                            <div>
                                <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Email Address</label>
                                <input v-model="form.email" type="email" placeholder="melquisedec@company.com"
                                    class="w-full border border-[#E0DBD3] px-4 py-3 text-sm text-[#1A1A1A] outline-none focus:border-[#1A1A1A] transition-colors placeholder-[#CCC] bg-[#FAFAF8]" />
                                <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Phone Number</label>
                                <input v-model="form.phone" type="text" placeholder="+63 9XX XXX XXXX"
                                    class="w-full border border-[#E0DBD3] px-4 py-3 text-sm text-[#1A1A1A] outline-none focus:border-[#1A1A1A] transition-colors placeholder-[#CCC] bg-[#FAFAF8]" />
                            </div>
                            <div>
                                <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Subject</label>
                                <select v-model="form.subject"
                                    class="w-full border border-[#E0DBD3] px-4 py-3 text-sm text-[#555] outline-none focus:border-[#1A1A1A] transition-colors bg-[#FAFAF8] appearance-none cursor-pointer">
                                    <option value="">Select a topic</option>
                                    <option>Workspace Inquiry</option>
                                    <option>ERP / POS Systems</option>
                                    <option>Accounting Services</option>
                                    <option>General Inquiry</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Message</label>
                            <textarea v-model="form.message" rows="5" placeholder="Tell us about your needs..."
                                class="w-full border border-[#E0DBD3] px-4 py-3 text-sm text-[#1A1A1A] outline-none focus:border-[#1A1A1A] transition-colors placeholder-[#CCC] bg-[#FAFAF8] resize-none"></textarea>
                            <p v-if="form.errors.message" class="text-xs text-red-500 mt-1">{{ form.errors.message }}</p>
                        </div>

                        <div>
                            <button type="submit"
                                :disabled="form.processing"
                                class="bg-[#1A1A1A] text-white text-sm px-10 py-3 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                                {{ form.processing ? 'Sending...' : 'Send Message' }}
                            </button>
                        </div>
                    </form>
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