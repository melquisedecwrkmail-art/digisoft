<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({ bookings: Object });

function cancel(id) {
    if (confirm('Cancel this booking?')) {
        router.post(`/client/bookings/${id}/cancel`);
    }
}

const statusColors = {
    pending:   'bg-yellow-50 text-yellow-700',
    approved:  'bg-green-50 text-[#2D6A4F]',
    rejected:  'bg-red-50 text-red-600',
    cancelled: 'bg-gray-100 text-gray-500',
};
</script>

<template>
    <div class="min-h-screen bg-[#F5F2EE]" style="font-family: 'Georgia', serif;">
        <div class="max-w-4xl mx-auto px-6 py-16">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#1A1A1A]">My Bookings</h1>
                    <p class="text-sm text-[#888] mt-0.5">All your workspace booking requests</p>
                </div>
                <Link href="/workspaces"
                    class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    + New Booking
                </Link>
            </div>

            <!-- Empty state -->
            <div v-if="!bookings.data.length"
                class="bg-white border border-[#E0DBD3] p-16 text-center">
                <p class="text-3xl mb-4">◻</p>
                <p class="font-bold text-[#1A1A1A] mb-2">No bookings yet</p>
                <p class="text-sm text-[#888] mb-6">Browse our workspaces and make your first booking.</p>
                <Link href="/workspaces"
                    class="inline-block bg-[#1A1A1A] text-white text-xs px-6 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    Browse Workspaces
                </Link>
            </div>

            <!-- Bookings list -->
            <div v-else class="flex flex-col gap-4">
                <div v-for="b in bookings.data" :key="b.id"
                    class="bg-white border border-[#E0DBD3] p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <p class="font-bold text-[#1A1A1A]">{{ b.workspace?.name }}</p>
                            <span :class="statusColors[b.booking_status]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ b.booking_status }}
                            </span>
                        </div>
                        <p class="text-xs text-[#888]">
                            {{ b.workspace?.location?.name }} · {{ b.workspace?.location?.city }}
                        </p>
                        <p class="text-xs text-[#888] mt-1">
                            {{ b.start_date }} → {{ b.end_date }}
                        </p>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="font-bold text-[#1A1A1A]">₱{{ Number(b.total_price).toLocaleString() }}</p>
                            <p class="text-xs capitalize mt-0.5"
                                :class="b.payment_status === 'paid' ? 'text-[#2D6A4F]' : 'text-[#AAA]'">
                                {{ b.payment_status }}
                            </p>
                        </div>
                        <button v-if="b.booking_status === 'pending'"
                            @click="cancel(b.id)"
                            class="text-xs border border-red-200 text-red-500 px-4 py-2 hover:bg-red-50 transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="bookings.last_page > 1" class="flex gap-2 mt-6">
                <Link v-for="link in bookings.links" :key="link.label"
                    :href="link.url || '#'" v-html="link.label"
                    :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A]'"
                    class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors bg-white" />
            </div>
        </div>
    </div>
</template>