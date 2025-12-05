<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  clients: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Clients" />

    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Clients
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
          <table class="w-full">
            <thead>
            <tr class="border-b text-left">
              <th class="py-2">ID</th>
              <th class="py-2">Business Name</th>
              <th class="py-2">Registration number</th>
              <th class="py-2">PVN</th>
              <th class="py-2">
                <Link :href="route('clients.create')" class="px-3 py-1.5 bg-gray-800 text-white rounded hover:bg-gray-700">
                  Add
                </Link>

              </th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="client in clients" :key="client.id" class="border-b">
              <td class="py-2">{{ client.id }}</td>
              <td class="py-2">{{ client.business_name }}</td>
              <td class="py-2">{{ client.registration_num }}</td>
              <td class="py-2">{{ client.tax_num }}</td>
              <td class="py-2">
                <Link :href="route('clients.edit', client.id)"
                      class="px-3 py-1.5 bg-gray-800 text-white rounded hover:bg-gray-700">
                  Edit
                </Link>
              </td>
            </tr>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
