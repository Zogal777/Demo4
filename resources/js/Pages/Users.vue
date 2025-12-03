<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  users: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Users" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Users</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
          <table class="w-full">
            <thead>
            <tr class="border-b text-left">
              <th class="py-2">ID</th>
              <th class="py-2">Name</th>
              <th class="py-2">Email</th>
              <th class="py-2">Date Of Birth</th>
              <th class="py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id" class="border-b">
              <td class="py-2">{{ user.id }}</td>
              <td class="py-2">{{ user.name }}</td>
              <td class="py-2">{{ user.email }}</td>
              <td class="py-2">{{ user.date_of_birth }}</td>
              <td class="py-2">
                <Link
                    :href="route('users.edit', user.id)"
                    class="px-3 py-1.5 bg-gray-800 text-white rounded hover:bg-gray-700"
                >
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
