<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({ workspaces: Object });

function destroy(id) {
    if (confirm('Delete this workspace?')) {
        router.delete('/admin/workspaces/' + id, { preserveScroll: true });
    }
}

const typeColors = {
    private: 'bg-blue-50 text-blue-600',
    desk:    'bg-yellow-50 text-yellow-600',
    meeting: 'bg-purple-50 text-purple-600',
    virtual: 'bg-green-50 text-green-700',
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Workspaces</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Manage Workspaces</h2>
                <p class="text-xs text-[#888] mt-0.5">All workspace inventory across locations</p>
            </div>
            <Link href="/admin/workspaces/create"
                class="bg-[#1A1A1A] text-white text-xs px-5 py-2.5 hover:bg-[#2D6A4F] transition-colors">
                + Add Workspace
            </Link>
        </div>

        <div class="bg-white border border-[#E0DBD3] overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Name</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Location</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Type</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Price/Day</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Capacity</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ws in workspaces.data" :key="ws.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4 font-medium text-[#1A1A1A]">{{ ws.name }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ ws.location?.name }}</td>
                        <td class="px-5 py-4">
                            <span :class="typeColors[ws.type]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1 capitalize">
                                {{ ws.type }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-[#666]">₱{{ Number(ws.price).toLocaleString() }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ ws.capacity }} pax</td>
                        <td class="px-5 py-4">
                            <span :class="ws.status === 'available' ? 'bg-[#2D6A4F]/10 text-[#2D6A4F]' : 'bg-red-50 text-red-600'"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ ws.status }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <Link :href="'/admin/workspaces/' + ws.id + '/edit'"
                                    class="text-xs text-[#1A1A1A] hover:text-[#2D6A4F] transition-colors">
                                    Edit
                                </Link>
                                <button @click="destroy(ws.id)"
                                    class="text-xs text-red-400 hover:text-red-600 transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!workspaces.data.length">
                        <td colspan="7" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No workspaces yet. Add your first workspace.
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="workspaces.last_page > 1" class="px-5 py-4 border-t border-[#E0DBD3] flex gap-2">
                <Link v-for="link in workspaces.links" :key="link.label"
                    :href="link.url || '#'" v-html="link.label"
                    :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A]'"
                    class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors" />
            </div>
        </div>
    </AdminLayout>
</template>