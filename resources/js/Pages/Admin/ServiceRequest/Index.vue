<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({ requests: Object });

function approve(id) {
    router.post('/admin/service-requests/' + id + '/approve');
}

function reject(id) {
    if (confirm('Reject this request?')) {
        router.post('/admin/service-requests/' + id + '/reject');
    }
}

const statusColors = {
    pending:     'bg-yellow-50 text-yellow-700',
    approved:    'bg-blue-50 text-blue-600',
    in_progress: 'bg-purple-50 text-purple-600',
    completed:   'bg-[#2D6A4F]/10 text-[#2D6A4F]',
    rejected:    'bg-red-50 text-red-600',
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Service Requests</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Service Requests</h2>
                <p class="text-xs text-[#888] mt-0.5">Review and manage client service requests</p>
            </div>
        </div>

        <div class="bg-white border border-[#E0DBD3] overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Client</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Service</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Description</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Date</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="req in requests.data" :key="req.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-medium text-[#1A1A1A]">{{ req.user?.name }}</p>
                            <p class="text-xs text-[#888]">{{ req.user?.email }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-[#1A1A1A]">{{ req.service?.name }}</p>
                            <p class="text-xs text-[#888]">{{ req.service?.category }}</p>
                        </td>
                        <td class="px-5 py-4 text-[#666] text-xs max-w-xs">
                            <p class="truncate">{{ req.description ?? '—' }}</p>
                        </td>
                        <td class="px-5 py-4 text-[#666] text-xs">
                            {{ new Date(req.created_at).toLocaleDateString() }}
                        </td>
                        <td class="px-5 py-4">
                            <span :class="statusColors[req.status]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1 capitalize">
                                {{ req.status.replace('_', ' ') }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <button v-if="req.status === 'pending'"
                                    @click="approve(req.id)"
                                    class="text-xs bg-[#2D6A4F] text-white px-3 py-1 hover:bg-[#245C43] transition-colors">
                                    Approve
                                </button>
                                <button v-if="req.status === 'pending'"
                                    @click="reject(req.id)"
                                    class="text-xs border border-red-300 text-red-500 px-3 py-1 hover:bg-red-50 transition-colors">
                                    Reject
                                </button>
                                <span v-if="req.status !== 'pending'" class="text-xs text-[#AAA]">—</span>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!requests.data.length">
                        <td colspan="6" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No service requests yet.
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="requests.last_page > 1" class="px-5 py-4 border-t border-[#E0DBD3] flex gap-2">
                <Link v-for="link in requests.links" :key="link.label"
                    :href="link.url || '#'" v-html="link.label"
                    :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A]'"
                    class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors" />
            </div>
        </div>
    </AdminLayout>
</template>