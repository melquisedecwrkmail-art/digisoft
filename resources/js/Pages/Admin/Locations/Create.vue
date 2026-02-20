<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    address: '',
    city: '',
    status: 'active',
});

function submit() {
    form.post('/admin/locations');
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Add Location</h1>
        </template>

        <div class="max-w-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-[#1A1A1A]">Add New Location</h2>
                    <p class="text-xs text-[#888] mt-0.5">Register a new office location</p>
                </div>
                <Link href="/admin/locations" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors">
                    ← Back to Locations
                </Link>
            </div>

            <form @submit.prevent="submit" class="bg-white border border-[#E0DBD3] p-8 flex flex-col gap-5">

                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Location Name</label>
                    <input v-model="form.name" type="text" placeholder="e.g. Makati Business Hub"
                        class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] transition-colors bg-[#FAFAF8]" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Address</label>
                    <input v-model="form.address" type="text" placeholder="e.g. 123 Ayala Ave"
                        class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] transition-colors bg-[#FAFAF8]" />
                    <p v-if="form.errors.address" class="text-xs text-red-500 mt-1">{{ form.errors.address }}</p>
                </div>

                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">City</label>
                    <input v-model="form.city" type="text" placeholder="e.g. Makati City"
                        class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] transition-colors bg-[#FAFAF8]" />
                    <p v-if="form.errors.city" class="text-xs text-red-500 mt-1">{{ form.errors.city }}</p>
                </div>

                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Status</label>
                    <select v-model="form.status"
                        class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] transition-colors bg-[#FAFAF8] appearance-none">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" :disabled="form.processing"
                        class="bg-[#1A1A1A] text-white text-xs px-8 py-2.5 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Save Location' }}
                    </button>
                    <Link href="/admin/locations"
                        class="text-xs border border-[#E0DBD3] px-8 py-2.5 text-[#666] hover:border-[#1A1A1A] transition-colors">
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>