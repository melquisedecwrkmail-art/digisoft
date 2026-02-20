<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    workspace: Object,
    locations: Array,
});

const form = useForm({
    _method: 'PUT',
    location_id: props.workspace.location_id,
    name:        props.workspace.name,
    type:        props.workspace.type,
    description: props.workspace.description ?? '',
    price:       props.workspace.price,
    capacity:    props.workspace.capacity,
    status:      props.workspace.status,
});

function submit() {
    form.transform(data => ({ ...data, _method: 'PUT' })).post('/admin/workspaces/' + props.workspace.id, { forceFormData: true });
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Edit Workspace</h1>
        </template>
        <div class="max-w-2xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-[#1A1A1A]">Edit Workspace</h2>
                    <p class="text-xs text-[#888] mt-0.5">{{ workspace.name }}</p>
                </div>
                <Link href="/admin/workspaces" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors">← Back</Link>
            </div>
            <form @submit.prevent="submit" class="bg-white border border-[#E0DBD3] p-8 flex flex-col gap-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Location</label>
                        <select v-model="form.location_id" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                            <option v-for="loc in locations" :key="loc.id" :value="loc.id">{{ loc.name }}</option>
                        </select>
                        <p v-if="form.errors.location_id" class="text-xs text-red-500 mt-1">{{ form.errors.location_id }}</p>
                    </div>
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Workspace Name</label>
                        <input v-model="form.name" type="text" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                        <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Type</label>
                        <select v-model="form.type" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                            <option value="private">Private Office</option>
                            <option value="desk">Co-Working Desk</option>
                            <option value="meeting">Meeting Room</option>
                            <option value="virtual">Virtual Office</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Status</label>
                        <select v-model="form.status" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Price per Day (₱)</label>
                        <input v-model="form.price" type="number" min="0" step="0.01" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                        <p v-if="form.errors.price" class="text-xs text-red-500 mt-1">{{ form.errors.price }}</p>
                    </div>
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Capacity (persons)</label>
                        <input v-model="form.capacity" type="number" min="1" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                        <p v-if="form.errors.capacity" class="text-xs text-red-500 mt-1">{{ form.errors.capacity }}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Description</label>
                    <textarea v-model="form.description" rows="3" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" :disabled="form.processing" class="bg-[#1A1A1A] text-white text-xs px-8 py-2.5 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Workspace' }}
                    </button>
                    <Link href="/admin/workspaces" class="text-xs border border-[#E0DBD3] px-8 py-2.5 text-[#666] hover:border-[#1A1A1A] transition-colors">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>