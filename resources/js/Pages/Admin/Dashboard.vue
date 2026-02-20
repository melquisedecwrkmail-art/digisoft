<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    stats: Object,
});
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Dashboard</h1>
        </template>

        <div class="mb-6">
            <h2 class="text-xl font-bold text-[#1A1A1A]">Welcome back 👋</h2>
            <p class="text-xs text-[#888] mt-0.5">Here's what's happening in Digisoft today.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white border border-[#E0DBD3] p-6">
                <p class="text-xs text-[#888] tracking-wider uppercase mb-2">Total Users</p>
                <p class="text-3xl font-bold text-[#1A1A1A]">{{ stats.total_users }}</p>
            </div>
            <div class="bg-white border border-[#E0DBD3] p-6">
                <p class="text-xs text-[#888] tracking-wider uppercase mb-2">Total Bookings</p>
                <p class="text-3xl font-bold text-[#1A1A1A]">{{ stats.total_bookings }}</p>
            </div>
            <div class="bg-white border border-[#E0DBD3] p-6">
                <p class="text-xs text-[#888] tracking-wider uppercase mb-2">Pending Bookings</p>
                <p class="text-3xl font-bold text-orange-500">{{ stats.pending_bookings }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="/admin/locations"
                class="bg-white border border-[#E0DBD3] p-6 hover:border-[#1A1A1A] transition-colors group">
                <p class="text-[#2D6A4F] text-lg mb-2">◈</p>
                <p class="font-bold text-sm text-[#1A1A1A] group-hover:text-[#2D6A4F] transition-colors">Manage Locations</p>
                <p class="text-xs text-[#888] mt-1">Add and manage office locations</p>
            </a>
            <a href="/admin/workspaces"
                class="bg-white border border-[#E0DBD3] p-6 hover:border-[#1A1A1A] transition-colors group">
                <p class="text-[#2D6A4F] text-lg mb-2">◻</p>
                <p class="font-bold text-sm text-[#1A1A1A] group-hover:text-[#2D6A4F] transition-colors">Manage Workspaces</p>
                <p class="text-xs text-[#888] mt-1">Add and manage bookable workspaces</p>
            </a>
            <a href="/admin/bookings"
                class="bg-white border border-[#E0DBD3] p-6 hover:border-[#1A1A1A] transition-colors group">
                <p class="text-[#2D6A4F] text-lg mb-2">⬡</p>
                <p class="font-bold text-sm text-[#1A1A1A] group-hover:text-[#2D6A4F] transition-colors">Manage Bookings</p>
                <p class="text-xs text-[#888] mt-1">Approve or reject booking requests</p>
            </a>
            <a href="/admin/services"
                class="bg-white border border-[#E0DBD3] p-6 hover:border-[#1A1A1A] transition-colors group">
                <p class="text-[#2D6A4F] text-lg mb-2">◇</p>
                <p class="font-bold text-sm text-[#1A1A1A] group-hover:text-[#2D6A4F] transition-colors">Manage Services</p>
                <p class="text-xs text-[#888] mt-1">Manage business service catalog</p>
            </a>
        </div>
    </AdminLayout>
</template>