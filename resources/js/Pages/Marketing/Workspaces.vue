<script setup>
import { ref, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    workspaces: Object,
    filters: Object,
});

const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth?.user);
const userRole = computed(() => page.props.auth?.user?.role);

const activeFilter = ref(props.filters?.type ?? 'all');
const city = ref(props.filters?.city ?? '');

const typeLabels = {
    all:     'All Spaces',
    private: 'Private Office',
    desk:    'Co-Working',
    meeting: 'Meeting Rooms',
    virtual: 'Virtual Office',
};

const typeColors = {
    private: 'bg-blue-50 text-blue-600',
    desk:    'bg-yellow-50 text-yellow-600',
    meeting: 'bg-purple-50 text-purple-600',
    virtual: 'bg-green-50 text-green-700',
};

function applyFilter(type) {
    activeFilter.value = type;
    router.get('/workspaces', {
        type: type === 'all' ? undefined : type,
        city: city.value || undefined,
    }, { preserveState: true, replace: true });
}

function search() {
    router.get('/workspaces', {
        type: activeFilter.value === 'all' ? undefined : activeFilter.value,
        city: city.value || undefined,
    }, { preserveState: true, replace: true });
}

function bookWorkspace(workspaceId) {
    if (!isLoggedIn.value) {
        router.visit('/login');
        return;
    }
    if (userRole.value !== 'client') {
        alert('Only client accounts can make bookings.');
        return;
    }
    router.visit('/client/bookings/create?workspace_id=' + workspaceId);
}
</script>

<template>
    <div class="min-h-screen bg-[#FAFAF8]" style="font-family: 'Georgia', serif;">

        <!-- Navbar -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-[#FAFAF8] border-b border-[#E8E4DE]">
            <div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
                <Link href="/" class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-[#1A1A1A] rounded-sm flex items-center justify-center">
                        <span class="text-white text-xs font-bold">D</span>
                    </div>
                    <span class="font-bold text-sm text-[#1A1A1A]">Digisoft</span>
                </Link>
                <div class="flex items-center gap-4">
                    <Link href="/services" class="text-xs text-[#666] hover:text-[#1A1A1A]">Services</Link>
                    <Link href="/about" class="text-xs text-[#666] hover:text-[#1A1A1A]">About</Link>
                    <Link v-if="!isLoggedIn" href="/login"
                        class="text-xs bg-[#1A1A1A] text-white px-4 py-2 hover:bg-[#2D6A4F] transition-colors">
                        Login
                    </Link>
                    <Link v-else :href="userRole === 'admin' ? '/admin/dashboard' : '/client/dashboard'"
                        class="text-xs bg-[#1A1A1A] text-white px-4 py-2 hover:bg-[#2D6A4F] transition-colors">
                        Dashboard
                    </Link>
                </div>
            </div>
        </nav>

        <div class="pt-14">
            <!-- Hero -->
            <div class="bg-[#1A1A1A] text-white py-16 px-6 text-center">
                <p class="text-xs tracking-[0.3em] uppercase text-[#888] mb-4">Workspaces</p>
                <h1 class="text-3xl font-bold mb-4">Find Your Perfect Workspace</h1>
                <p class="text-sm text-[#AAA] max-w-md mx-auto">
                    Private offices, co-working desks, meeting rooms and virtual offices across the Philippines.
                </p>
            </div>

            <!-- Search Bar -->
            <div class="bg-white border-b border-[#E0DBD3] px-6 py-4">
                <div class="max-w-4xl mx-auto flex gap-3 items-center">
                    <input v-model="city" type="text" placeholder="Search by city..."
                        @keyup.enter="search"
                        class="flex-1 border border-[#E0DBD3] px-4 py-2 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                    <button @click="search"
                        class="bg-[#1A1A1A] text-white text-xs px-6 py-2 hover:bg-[#2D6A4F] transition-colors">
                        Search
                    </button>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white border-b border-[#E0DBD3] px-6">
                <div class="max-w-4xl mx-auto flex gap-0 overflow-x-auto">
                    <button v-for="(label, type) in typeLabels" :key="type"
                        @click="applyFilter(type)"
                        :class="activeFilter === type
                            ? 'border-b-2 border-[#1A1A1A] text-[#1A1A1A]'
                            : 'text-[#888] hover:text-[#1A1A1A]'"
                        class="text-xs px-5 py-3 whitespace-nowrap transition-colors">
                        {{ label }}
                    </button>
                </div>
            </div>

            <!-- Workspaces Grid -->
            <div class="max-w-6xl mx-auto px-6 py-12">

                <!-- Empty state -->
                <div v-if="!workspaces.data.length" class="text-center py-20">
                    <p class="text-3xl mb-4">◻</p>
                    <p class="font-bold text-[#1A1A1A] mb-2">No workspaces found</p>
                    <p class="text-sm text-[#888]">Try a different filter or search term.</p>
                </div>

                <!-- Grid -->
                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="ws in workspaces.data" :key="ws.id"
                        class="bg-white border border-[#E0DBD3] hover:border-[#1A1A1A] transition-colors group">

                        <!-- Image placeholder -->
                        <div class="h-44 bg-[#F5F2EE] flex items-center justify-center">
                            <span class="text-4xl text-[#DDD]">◻</span>
                        </div>

                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <span :class="typeColors[ws.type]"
                                    class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                    {{ ws.type === 'desk' ? 'Co-Working' : ws.type.replace('_', ' ') }}
                                </span>
                            </div>

                            <p class="font-bold text-[#1A1A1A] mb-1">{{ ws.name }}</p>
                            <p class="text-xs text-[#888] mb-1">{{ ws.location?.name }}</p>
                            <p class="text-xs text-[#AAA] mb-3">{{ ws.location?.city }} · {{ ws.capacity }} pax</p>

                            <p v-if="ws.description" class="text-xs text-[#666] mb-4 line-clamp-2">
                                {{ ws.description }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-[#F0EDE8]">
                                <div>
                                    <p class="font-bold text-[#1A1A1A]">₱{{ Number(ws.price).toLocaleString() }}</p>
                                    <p class="text-[10px] text-[#AAA]">per day</p>
                                </div>
                                <button @click="bookWorkspace(ws.id)"
                                    class="bg-[#1A1A1A] text-white text-xs px-5 py-2 hover:bg-[#2D6A4F] transition-colors">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="workspaces.last_page > 1" class="flex justify-center gap-2 mt-10">
                    <Link v-for="link in workspaces.links" :key="link.label"
                        :href="link.url || '#'" v-html="link.label"
                        :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A] bg-white'"
                        class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors" />
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-[#1A1A1A] text-white py-12 px-6 mt-8">
                <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between gap-6">
                    <div>
                        <p class="font-bold mb-1">Digisoft</p>
                        <p class="text-xs text-[#666]">Workspaces & Digital Solutions</p>
                    </div>
                    <div class="flex gap-8 text-xs text-[#888]">
                        <Link href="/workspaces" class="hover:text-white transition-colors">Workspaces</Link>
                        <Link href="/services" class="hover:text-white transition-colors">Services</Link>
                        <Link href="/about" class="hover:text-white transition-colors">About</Link>
                        <Link href="/contact" class="hover:text-white transition-colors">Contact</Link>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>