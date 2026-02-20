<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({ requests: Object });

const statusColors = {
    pending:     'bg-yellow-50 text-yellow-700',
    approved:    'bg-blue-50 text-blue-600',
    in_progress: 'bg-purple-50 text-purple-600',
    completed:   'bg-[#2D6A4F]/10 text-[#2D6A4F]',
    rejected:    'bg-red-50 text-red-600',
};

const statusLabels = {
    pending:     'Pending',
    approved:    'Approved',
    in_progress: 'In Progress',
    completed:   'Completed',
    rejected:    'Rejected',
};
</script>

<template>
    <div class="min-h-screen bg-[#F5F2EE]" style="font-family: 'Georgia', serif;">
        <div class="max-w-4xl mx-auto px-6 py-16">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#1A1A1A]">My Service Requests</h1>
                    <p class="text-sm text-[#888] mt-0.5">Track your submitted service requests</p>
                </div>
                <Link href="/client/service-requests/create"
                    class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    + New Request
                </Link>
            </div>

            <!-- Empty state -->
            <div v-if="!requests.data.length"
                class="bg-white border border-[#E0DBD3] p-16 text-center">
                <p class="text-3xl mb-4">◇</p>
                <p class="font-bold text-[#1A1A1A] mb-2">No service requests yet</p>
                <p class="text-sm text-[#888] mb-6">Submit a request for ERP, POS, Accounting, or other business solutions.</p>
                <Link href="/client/service-requests/create"
                    class="inline-block bg-[#1A1A1A] text-white text-xs px-6 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                    Request a Service
                </Link>
            </div>

            <!-- Requests list -->
            <div v-else class="flex flex-col gap-4">
                <div v-for="req in requests.data" :key="req.id"
                    class="bg-white border border-[#E0DBD3] p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <p class="font-bold text-[#1A1A1A]">{{ req.service?.name }}</p>
                                <span :class="statusColors[req.status]"
                                    class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                    {{ statusLabels[req.status] }}
                                </span>
                            </div>
                            <p class="text-xs text-[#888]">{{ req.service?.category }}</p>
                            <p v-if="req.description" class="text-xs text-[#666] mt-2 max-w-lg">
                                {{ req.description }}
                            </p>
                            <p class="text-xs text-[#AAA] mt-3">
                                Submitted {{ new Date(req.created_at).toLocaleDateString() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="requests.last_page > 1" class="flex gap-2 mt-6">
                <Link v-for="link in requests.links" :key="link.label"
                    :href="link.url || '#'" v-html="link.label"
                    :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A]'"
                    class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors bg-white" />
            </div>
        </div>
    </div>
</template>