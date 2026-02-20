<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ services: Object });

function destroy(id) {
    if (confirm('Delete this service?')) {
        useForm({ _method: 'DELETE' }).post('/admin/services/' + id);
    }
}

const categoryColors = {
    ERP:        'bg-blue-50 text-blue-600',
    POS:        'bg-purple-50 text-purple-600',
    Accounting: 'bg-yellow-50 text-yellow-600',
    Custom:     'bg-orange-50 text-orange-600',
    IT:         'bg-green-50 text-green-700',
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Services</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Manage Services</h2>
                <p class="text-xs text-[#888] mt-0.5">All business services in the catalog</p>
            </div>
            <Link href="/admin/services/create"
                class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                + Add Service
            </Link>
        </div>

        <div class="bg-white border border-[#E0DBD3]">
            <table class="w-full text-sm">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Name</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Category</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Base Price</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="service in services.data" :key="service.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-medium text-[#1A1A1A]">{{ service.name }}</p>
                            <p class="text-xs text-[#888] mt-0.5 max-w-xs truncate">{{ service.description }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <span :class="categoryColors[service.category]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ service.category }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-[#666]">
                            {{ service.base_price ? '₱' + Number(service.base_price).toLocaleString() : 'Custom Quote' }}
                        </td>
                        <td class="px-5 py-4">
                            <span :class="service.status === 'active' ? 'bg-[#2D6A4F]/10 text-[#2D6A4F]' : 'bg-red-50 text-red-600'"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ service.status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <Link :href="'/admin/services/' + service.id + '/edit'"
                                    class="text-xs text-[#1A1A1A] hover:text-[#2D6A4F] transition-colors">
                                    Edit
                                </Link>
                                <button @click="destroy(service.id)"
                                    class="text-xs text-red-400 hover:text-red-600 transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!services.data.length">
                        <td colspan="5" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No services yet. Add your first service.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>