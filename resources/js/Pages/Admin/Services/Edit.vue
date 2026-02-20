<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ service: Object });

const form = useForm({
    _method:     'PUT',
    name:        props.service.name,
    category:    props.service.category,
    description: props.service.description ?? '',
    base_price:  props.service.base_price ?? '',
    status:      props.service.status,
});

function submit() {
    form.transform(data => ({ ...data, _method: 'PUT' })).post('/admin/services/' + props.service.id, { forceFormData: true });
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h1 class="text-sm font-bold text-[#1A1A1A]">Edit Service</h1>
        </template>
        <div class="max-w-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-[#1A1A1A]">Edit Service</h2>
                    <p class="text-xs text-[#888] mt-0.5">{{ service.name }}</p>
                </div>
                <Link href="/admin/services" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors">← Back</Link>
            </div>
            <form @submit.prevent="submit" class="bg-white border border-[#E0DBD3] p-8 flex flex-col gap-5">
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Service Name</label>
                    <input v-model="form.name" type="text" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Category</label>
                        <select v-model="form.category" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                            <option>ERP</option>
                            <option>POS</option>
                            <option>Accounting</option>
                            <option>Custom</option>
                            <option>IT</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Status</label>
                        <select v-model="form.status" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] appearance-none">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Base Price (₱)</label>
                    <input v-model="form.base_price" type="number" min="0" step="0.01" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                </div>
                <div>
                    <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Description</label>
                    <textarea v-model="form.description" rows="4" class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" :disabled="form.processing" class="bg-[#1A1A1A] text-white text-xs px-8 py-2.5 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Service' }}
                    </button>
                    <Link href="/admin/services" class="text-xs border border-[#E0DBD3] px-8 py-2.5 text-[#666] hover:border-[#1A1A1A] transition-colors">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>