<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ workspace: Object });

const form = useForm({
    workspace_id: props.workspace.id,
    start_date: '',
    end_date: '',
});

const totalDays = computed(() => {
    if (!form.start_date || !form.end_date) return 0;
    const s = new Date(form.start_date);
    const e = new Date(form.end_date);
    const diff = Math.ceil((e - s) / (1000 * 60 * 60 * 24)) + 1;
    return diff > 0 ? diff : 0;
});

const totalPrice = computed(() => totalDays.value * props.workspace.price);

function submit() {
    form.post('/client/bookings');
}
</script>

<script>
import { computed } from 'vue';
export default { setup() {} };
</script>

<template>
    <div class="min-h-screen bg-[#F5F2EE]" style="font-family: 'Georgia', serif;">
        <div class="max-w-2xl mx-auto px-6 py-16">

            <Link href="/workspaces" class="text-xs text-[#888] hover:text-[#1A1A1A] transition-colors mb-8 block">
                ← Back to Workspaces
            </Link>

            <h1 class="text-2xl font-bold text-[#1A1A1A] mb-1">Book Workspace</h1>
            <p class="text-sm text-[#888] mb-8">Complete your booking for {{ workspace.name }}</p>

            <!-- Workspace Summary -->
            <div class="bg-white border border-[#E0DBD3] p-6 mb-6 flex items-start justify-between">
                <div>
                    <p class="text-[10px] tracking-widest uppercase text-[#2D6A4F] mb-1 capitalize">{{ workspace.type }}</p>
                    <p class="font-bold text-[#1A1A1A]">{{ workspace.name }}</p>
                    <p class="text-xs text-[#888] mt-1">{{ workspace.location?.name }} · {{ workspace.location?.city }}</p>
                    <p class="text-xs text-[#888] mt-1">Capacity: {{ workspace.capacity }} person(s)</p>
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold text-[#1A1A1A]">₱{{ Number(workspace.price).toLocaleString() }}</p>
                    <p class="text-xs text-[#888]">per day</p>
                </div>
            </div>

            <!-- Booking Form -->
            <form @submit.prevent="submit" class="bg-white border border-[#E0DBD3] p-8 flex flex-col gap-5">

                <p class="text-xs tracking-[0.25em] uppercase text-[#888]">Select Dates</p>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">Start Date</label>
                        <input v-model="form.start_date" type="date"
                            :min="new Date().toISOString().split('T')[0]"
                            class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                        <p v-if="form.errors.start_date" class="text-xs text-red-500 mt-1">{{ form.errors.start_date }}</p>
                    </div>
                    <div>
                        <label class="block text-xs text-[#888] mb-2 tracking-wider uppercase">End Date</label>
                        <input v-model="form.end_date" type="date"
                            :min="form.start_date || new Date().toISOString().split('T')[0]"
                            class="w-full border border-[#E0DBD3] px-4 py-2.5 text-sm outline-none focus:border-[#1A1A1A] bg-[#FAFAF8]" />
                        <p v-if="form.errors.end_date" class="text-xs text-red-500 mt-1">{{ form.errors.end_date }}</p>
                    </div>
                </div>

                <!-- Price Summary -->
                <div v-if="totalDays > 0" class="bg-[#F5F2EE] border border-[#E0DBD3] p-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-[#666]">{{ totalDays }} day(s) × ₱{{ Number(workspace.price).toLocaleString() }}</span>
                        <span class="font-bold text-[#1A1A1A]">₱{{ Number(totalPrice).toLocaleString() }}</span>
                    </div>
                    <p class="text-xs text-[#AAA]">Payment will be processed after approval.</p>
                </div>

                <button type="submit" :disabled="form.processing || totalDays <= 0"
                    class="bg-[#1A1A1A] text-white text-sm py-3 hover:bg-[#2D6A4F] transition-colors disabled:opacity-50">
                    {{ form.processing ? 'Submitting...' : 'Submit Booking Request' }}
                </button>

                <p class="text-xs text-[#AAA] text-center">
                    Your booking will be reviewed and confirmed by our team.
                </p>
            </form>
        </div>
    </div>
</template>