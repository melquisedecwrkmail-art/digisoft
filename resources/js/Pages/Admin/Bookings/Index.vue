<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({ bookings: Object });

function approve(id) {
    router.post(`/admin/bookings/${id}/approve`);
}

function reject(id) {
    if (confirm('Reject this booking?')) {
        router.post(`/admin/bookings/${id}/reject`);
    }
}

const statusColors = {
    pending:   'bg-yellow-50 text-yellow-600',
    approved:  'bg-green-50 text-green-700',
    rejected:  'bg-red-50 text-red-600',
    cancelled: 'bg-gray-100 text-gray-500',
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Bookings</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Manage Bookings</h2>
                <p class="text-xs text-[#888] mt-0.5">Review and approve workspace bookings</p>
            </div>
        </div>

        <div class="bg-white border border-[#E0DBD3] overflow-x-auto">
            <table class="w-full text-sm min-w-[800px]">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Client</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Workspace</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Dates</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Total</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Payment</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="b in bookings.data" :key="b.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-medium text-[#1A1A1A]">{{ b.user?.name }}</p>
                            <p class="text-xs text-[#888]">{{ b.user?.email }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-[#1A1A1A]">{{ b.workspace?.name }}</p>
                            <p class="text-xs text-[#888]">{{ b.workspace?.location?.name }}</p>
                        </td>
                        <td class="px-5 py-4 text-[#666] text-xs">
                            {{ b.start_date }} → {{ b.end_date }}
                        </td>
                        <td class="px-5 py-4 font-medium text-[#1A1A1A]">
                            ₱{{ Number(b.total_price).toLocaleString() }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs capitalize font-medium"
                                :class="b.payment_status === 'paid' ? 'text-green-600' : 'text-[#AAA]'">
                                {{ b.payment_status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span :class="statusColors[b.booking_status]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ b.booking_status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <button v-if="b.booking_status === 'pending'" @click="approve(b.id)"
                                    class="text-xs bg-[#2D6A4F] text-white px-3 py-1 hover:bg-[#245C43] transition-colors">
                                    Approve
                                </button>
                                <button v-if="b.booking_status === 'pending'" @click="reject(b.id)"
                                    class="text-xs border border-red-300 text-red-500 px-3 py-1 hover:bg-red-50 transition-colors">
                                    Reject
                                </button>
                                <span v-if="b.booking_status !== 'pending'" class="text-xs text-[#AAA]">—</span>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!bookings.data.length">
                        <td colspan="7" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No bookings yet.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
