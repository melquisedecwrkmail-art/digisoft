<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ services: Array });

const selected = ref(null);

const form = useForm({
    service_id:  '',
    description: '',
});

function selectService(service) {
    selected.value = service;
    form.service_id = service.id;
}

function submit() {
    form.post('/client/service-requests');
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
    <div class="min-h-screen bg-[#F5F2EE]" style="font-family: 'Georgia', serif;">
        <div class="max-w-4xl mx-auto px-6 py-16">

            <Link href="/client/service-requests" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors mb-8 block">
                ← My Service Requests
            </Link>

            <h1 class="text-2xl font-bold text-[#1A1A1A] mb-1">Request a Service</h1>
            <p class="text-sm text-[#888] mb-8">Select a service and tell us what you need.</p>

            <!-- Service Selection -->
            <div class="mb-8">
                <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-4">Available Services</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div v-for="service in services" :key="service.id"
                        @click="selectService(service)"
                        :class="selected?.id === service.id
                            ? 'border-[#1A1A1A] bg-white'
                            : 'border-[#E0DBD3] bg-white hover:border-[#AAA]'"
                        class="border p-5 cursor-pointer transition-all">
                        <div class="flex items-start justify-between mb-2">
                            <span :class="categoryColors[service.category]"
                                class="text-[10px] tracking-widest uppercase px-2.5 py-1">
                                {{ service.category }}
                            </span>
                            <div v-if="selected?.id === service.id"
                                class="w-4 h-4 bg-[#1A1A1A] rounded-full flex items-center justify-center">
                                <span class="text-white text-[8px]">✓</span>
                            </div>
                        </div>
                        <p class="font-bold text-sm text-[#1A1A1A] mt-2">{{ service.name }}</p>
                        <p class="text-xs text-[#888] mt-1 line-clamp-2">{{ service.description }}</p>
                        <p class="text-xs font-medium text-[#1A1A1A] mt-3">
                            {{ service.base_price ? '₱' + Number(service.base_price).toLocaleString() : 'Custom Quote' }}
                        </p>
                    </div>
                </div>
                <p v-if="form.errors.service_id" class="text-xs text-red-500 mt-2">{{ form.errors.service_id }}</p>
            </div>

            <!-- Details Form -->
            <div v-if="selected" class="bg-white border border-[#E0DBD3] p-8">
                <p class="text-xs tracking-[0.25em] uppercase text-[#888] mb-5">
                    Request Details for: <span class="text-[#1A1A1A] font-bold">{{ selected.name }}</span>
                </p>

                <form @submit.prevent="submit" class="flex flex-col gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">
                            Describe your needs (optional)
                        </label>
                        <textarea v-model="form.description" rows="5"
                            placeholder="Tell us more about what you need, your business size, timeline, or any specific requirements..."
                            class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8] resize-none"></textarea>
                    </div>

                    <div class="bg-[#F5F2EE] border border-[#E0DBD3] p-4 text-xs text-[#666]">
                        Our team will review your request and get back to you within 1-2 business days.
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" :disabled="form.processing"
                            class="bg-[#1A1A1A] text-white text-xs px-8 py-2.5 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                            {{ form.processing ? 'Submitting...' : 'Submit Request' }}
                        </button>
                        <Link href="/client/service-requests"
                            class="text-xs border border-[#E0DBD3] px-8 py-2.5 text-[#666] hover:border-[#1A1A1A] transition-colors">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>

            <div v-if="!services.length" class="bg-white border border-[#E0DBD3] p-16 text-center">
                <p class="text-sm text-[#888]">No services available at the moment.</p>
            </div>
        </div>
    </div>
</template>