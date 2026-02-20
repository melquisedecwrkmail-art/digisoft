<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ user: Object });

const form = useForm({
    name:  props.user.name,
    email: props.user.email,
    phone: props.user.phone ?? '',
    role:  props.user.role,
});

function submit() {
    form.post('/admin/users/' + props.user.id);
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Edit User</h1>
        </template>
        <div class="max-w-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-[#1A1A1A]">Edit User</h2>
                    <p class="text-xs text-[#888] mt-0.5">{{ user.email }}</p>
                </div>
                <Link href="/admin/users" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors">← Back</Link>
            </div>
            <form @submit.prevent="submit" class="bg-white border border-[#E0DBD3] p-8 flex flex-col gap-5">
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Full Name</label>
                    <input v-model="form.name" type="text" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Email</label>
                    <input v-model="form.email" type="email" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                    <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Phone</label>
                    <input v-model="form.phone" type="text" placeholder="+63 9XX XXX XXXX" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Role</label>
                    <select v-model="form.role" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                        <option value="client">Client</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                    <p v-if="form.errors.role" class="text-xs text-red-500 mt-1">{{ form.errors.role }}</p>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 px-4 py-3 text-xs text-yellow-700">
                    ⚠ Changing a user's role will affect their access immediately on next login.
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" :disabled="form.processing" class="bg-[#1A1A1A] text-white text-xs px-8 py-2.5 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update User' }}
                    </button>
                    <Link href="/admin/users" class="text-xs border border-[#E0DBD3] px-8 py-2.5 text-[#666] hover:border-[#1A1A1A] transition-colors">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>