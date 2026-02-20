<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ locations: Object });

function destroy(id) {
    if (confirm('Delete this location?')) {
        useForm({ _method: 'DELETE' }).post('/admin/locations/' + id);
    }
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Locations</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Manage Locations</h2>
                <p class="text-xs text-[#888] mt-0.5">All registered office locations</p>
            </div>
            <Link href="/admin/locations/create"
                class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                + Add Location
            </Link>
        </div>

        <div class="bg-white border border-[#E0DBD3]">
            <table class="w-full text-sm">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Name</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Address</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">City</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="loc in locations.data" :key="loc.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4 font-medium text-[#1A1A1A]">{{ loc.name }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ loc.address }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ loc.city }}</td>
                        <td class="px-5 py-4">
                            <span :class="loc.status === 'active' ? 'bg-[#2D6A4F]/10 text-[#2D6A4F]' : 'bg-red-50 text-red-600'"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ loc.status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <Link :href="'/admin/locations/' + loc.id + '/edit'"
                                    class="text-xs text-[#1A1A1A] hover:text-[#2D6A4F] transition-colors">
                                    Edit
                                </Link>
                                <button @click="destroy(loc.id)"
                                    class="text-xs text-red-400 hover:text-red-600 transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!locations.data.length">
                        <td colspan="5" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No locations yet. Add your first location.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>