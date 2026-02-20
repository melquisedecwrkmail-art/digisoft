<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    bookings: Array,
});
</script>

<template>
    <div class="min-h-screen bg-[#F5F2EE]" style="font-family: 'Georgia', serif;">
        <div class="max-w-4xl mx-auto px-6 py-16">
            <h1 class="text-2xl font-bold text-[#1A1A1A] mb-2">My Dashboard</h1>
            <p class="text-sm text-[#888] mb-8">Welcome back!</p>

            <div class="flex gap-4 mb-10">
                <Link href="/workspaces"
                    class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    Browse Workspaces
                </Link>
                <Link href="/client/bookings"
                    class="border border-[#1A1A1A] text-[#1A1A1A] text-xs px-5 py-2.5 hover:bg-[#1A1A1A] hover:text-white transition-colors">
                    My Bookings
                </Link>
            </div>

            <h2 class="text-sm font-bold text-[#1A1A1A] mb-4 tracking-wider uppercase">Recent Bookings</h2>

            <div v-if="bookings.length" class="flex flex-col gap-3">
                <div v-for="b in bookings" :key="b.id"
                    class="bg-white border border-[#E0DBD3] p-5 flex justify-between items-center">
                    <div>
                        <p class="font-bold text-sm text-[#1A1A1A]">{{ b.workspace?.name }}</p>
                        <p class="text-xs text-[#888] mt-0.5">{{ b.start_date }} → {{ b.end_date }}</p>
                    </div>
                    <span class="text-[10px] tracking-widest uppercase px-3 py-1"
                        :class="{
                            'bg-yellow-50 text-yellow-700': b.booking_status === 'pending',
                            'bg-green-50 text-green-700': b.booking_status === 'approved',
                            'bg-red-50 text-red-600': b.booking_status === 'rejected',
                            'bg-gray-100 text-gray-500': b.booking_status === 'cancelled',
                        }">
                        {{ b.booking_status }}
                    </span>
                </div>
            </div>

            <div v-else class="bg-white border border-[#E0DBD3] p-10 text-center">
                <p class="text-sm text-[#888] mb-4">No bookings yet.</p>
                <Link href="/workspaces"
                    class="inline-block bg-[#1A1A1A] text-white text-xs px-6 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    Book a Workspace
                </Link>
            </div>
        </div>
    </div>
</template>