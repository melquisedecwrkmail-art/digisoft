<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const sidebarOpen = ref(false);

const navItems = [
    { label: 'Dashboard',        href: '/admin/dashboard',         icon: '◎' },
    { label: 'Locations',        href: '/admin/locations',         icon: '◈' },
    { label: 'Workspaces',       href: '/admin/workspaces',        icon: '◻' },
    { label: 'Bookings',         href: '/admin/bookings',          icon: '⬡' },
    { label: 'Services',         href: '/admin/services',          icon: '◇' },
    { label: 'Service Requests', href: '/admin/service-requests',  icon: '◆' },
    { label: 'Users',            href: '/admin/users',             icon: '⊕' },
];

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen bg-[#F5F2EE] flex" style="font-family: 'Georgia', serif;">

        <aside class="w-56 bg-[#1A1A1A] text-white flex flex-col fixed h-full z-40 hidden md:flex">
            <div class="px-6 py-5 border-b border-[#2A2A2A]">
                <Link href="/" class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-white rounded-sm flex items-center justify-center">
                        <span class="text-[#1A1A1A] text-xs font-bold">D</span>
                    </div>
                    <span class="font-bold text-sm">Digisoft</span>
                </Link>
                <p class="text-[10px] text-[#666] mt-1 tracking-wider uppercase">Admin Panel</p>
            </div>

            <nav class="flex-1 py-4 overflow-y-auto">
                <Link
                    v-for="item in navItems"
                    :key="item.href"
                    :href="item.href"
                    class="flex items-center gap-3 px-6 py-3 text-sm text-[#AAA] hover:text-white hover:bg-[#2A2A2A] transition-colors"
                    :class="$page.url.startsWith(item.href) ? 'bg-[#2A2A2A] text-white border-l-2 border-[#2D6A4F]' : ''">
                    <span class="text-[#2D6A4F]">{{ item.icon }}</span>
                    {{ item.label }}
                </Link>
            </nav>

            <div class="px-6 py-4 border-t border-[#2A2A2A]">
                <p class="text-xs text-[#666] mb-1">{{ $page.props.auth?.user?.name }}</p>
                <button @click="logout" class="text-xs text-[#888] hover:text-white transition-colors">
                    Sign out →
                </button>
            </div>
        </aside>

        <div class="flex-1 md:ml-56">
            <header class="bg-white border-b border-[#E0DBD3] h-14 flex items-center justify-between px-6 sticky top-0 z-30">
                <div>
                    <slot name="header" />
                </div>
                <Link href="/" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors">
                    ← View Site
                </Link>
            </header>

            <div v-if="$page.props.flash?.success"
                class="mx-6 mt-4 bg-[#2D6A4F]/10 border border-[#2D6A4F]/30 text-[#2D6A4F] text-sm px-4 py-3">
                ✓ {{ $page.props.flash.success }}
            </div>

            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>