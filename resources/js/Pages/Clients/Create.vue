<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateClientInfo from './Partials/CreateClientInfo.vue';
import CreateClientContacts from './Partials/CreateClientContacts.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  business_name: '',
  registration_num: '',
  tax_num: '',
  contacts: [{ type: 'email', value: '', comment: '' }],
});

const contactsRef = ref(null);

const submit = () => {
  if (!contactsRef.value.validateContacts()) return; // проверка контактов
  form.post(route('clients.store'));
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add New Client
      </h2>
    </template>

    <div class="py-8">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white shadow sm:rounded-lg p-6">
          <CreateClientInfo :form="form" />
        </div>

        <div class="bg-white shadow sm:rounded-lg p-6">
          <CreateClientContacts :form="form" ref="contactsRef" />
        </div>

        <div class="flex justify-end">
          <button
              @click="submit"
              :disabled="form.processing"
              class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
          >
            Save Client
          </button>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
