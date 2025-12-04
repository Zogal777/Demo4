<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  business_name: '',
  registration_num: '',
  tax_num: '',
});

const submit = () => {
  form.post(route('clients.store'));
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Create Client" />

    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Add New Client
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

          <form @submit.prevent="submit">

            <div class="mb-4">
              <label class="block">Business Name</label>
              <input v-model="form.business_name" class="w-full border p-2 rounded" />
            </div>

            <div class="mb-4">
              <label class="block">Registration number</label>
              <input v-model="form.registration_num" class="w-full border p-2 rounded" />
            </div>

            <div class="mb-4">
              <label class="block">PVN</label>
              <input v-model="form.tax_num" class="w-full border p-2 rounded" />
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
            >
              Save
            </button>

          </form>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
