<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  clients: {
    type: Array,
    required: true,
  },
  userClients: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  clients: [...props.userClients],
});

const saveClients = () => {
  form.patch(route('profile.updateClients'), { preserveScroll: true });
};
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900">
        Clients
      </h2>
      <p class="mt-1 text-sm text-gray-600">
        Choose your clients.
      </p>
    </header>

    <form @submit.prevent="saveClients" class="mt-6">
      <table class="min-w-full border border-gray-200">
        <thead>
        <tr class="bg-gray-100">
          <th class="py-2 px-4 text-left">Select</th>
          <th class="py-2 px-4 text-left">Business Name</th>
          <th class="py-2 px-4 text-left">Registration Number</th>
          <th class="py-2 px-4 text-left">PVN</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="client in props.clients" :key="client.id" class="border-t">
          <td class="py-2 px-4">
            <input
                type="checkbox"
                :value="client.id"
                v-model="form.clients"
                class="rounded border-gray-300"
            />
          </td>
          <td class="py-2 px-4">{{ client.business_name }}</td>
          <td class="py-2 px-4">{{ client.registration_num }}</td>
          <td class="py-2 px-4">{{ client.tax_num }}</td>
        </tr>
        </tbody>
      </table>

      <div class="flex items-center gap-4 mt-6">
        <PrimaryButton :disabled="form.processing">Save Clients</PrimaryButton>
        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
      </div>
    </form>
  </section>
</template>
