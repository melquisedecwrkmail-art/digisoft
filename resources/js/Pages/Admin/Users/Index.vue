<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ users: Object });

function destroy(id) {
    if (confirm('Delete this user? This cannot be undone.')) {
        useForm({ _method: 'DELETE' }).post('/admin/users/' + id);
    }
}

const roleColors = {
    admin:  'bg-red-50 text-red-600',
    staff:  'bg-blue-50 text-blue-600',
    client: 'bg-[#2D6A4F]/10 text-[#2D6A4F]',
};
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Users</h1>
        </template>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-[#1A1A1A]">Manage Users</h2>
                <p class="text-xs text-[#888] mt-0.5">All registered users and their roles</p>
            </div>
        </div>

        <div class="bg-white border border-[#E0DBD3]">
            <table class="w-full text-sm">
                <thead class="bg-[#F5F2EE] border-b border-[#E0DBD3]">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Name</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Email</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Phone</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Role</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Joined</th>
                        <th class="text-left px-5 py-3 text-xs text-[#888] tracking-wider uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id"
                        class="border-b border-[#F0EDE8] hover:bg-[#FAFAF8] transition-colors">
                        <td class="px-5 py-4 font-medium text-[#1A1A1A]">{{ user.name }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ user.email }}</td>
                        <td class="px-5 py-4 text-[#666]">{{ user.phone ?? '—' }}</td>
                        <td class="px-5 py-4">
                            <span :class="roleColors[user.role]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1 capitalize">
                                {{ user.role }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-[#666] text-xs">
                            {{ new Date(user.created_at).toLocaleDateString() }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <Link :href="'/admin/users/' + user.id + '/edit'"
                                    class="text-xs text-[#1A1A1A] hover:text-[#2D6A4F] transition-colors">
                                    Edit
                                </Link>
                                <button @click="destroy(user.id)"
                                    class="text-xs text-red-400 hover:text-red-600 transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!users.data.length">
                        <td colspan="6" class="px-5 py-10 text-center text-sm text-[#AAA]">
                            No users found.
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="users.last_page > 1" class="px-5 py-4 border-t border-[#E0DBD3] flex gap-2">
                <Link v-for="link in users.links" :key="link.label"
                    :href="link.url || '#'" v-html="link.label"
                    :class="link.active ? 'bg-[#1A1A1A] text-white' : 'text-[#666] hover:text-[#1A1A1A]'"
                    class="text-xs px-3 py-1.5 border border-[#E0DBD3] transition-colors bg-white" />
            </div>
        </div>
    </AdminLayout>
</template>