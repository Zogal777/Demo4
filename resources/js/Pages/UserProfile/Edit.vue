<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateProfileInformationFormAdmin from './Partials/UpdateProfileInformationFormAdmin.vue';
import UpdatePasswordFormAdmin from './Partials/UpdatePasswordFormAdmin.vue';
import DeleteUserFormAdmin from './Partials/DeleteUserFormAdmin.vue';
import { Head, usePage } from '@inertiajs/vue3';

const props = defineProps({ user: Object });
const page = usePage();
const isAdmin = page.props.auth.user?.id === 1;
</script>

<template>
  <Head title="Edit User" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit User</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
          <UpdateProfileInformationFormAdmin v-if="isAdmin" :user="props.user" />
          <p v-else class="text-red-600 font-medium">Only admin can edit this user.</p>
        </div>

        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
          <UpdatePasswordFormAdmin v-if="isAdmin" :user="props.user" />
          <p v-else class="text-red-600 font-medium">Only admin can change password.</p>
        </div>

        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
          <DeleteUserFormAdmin v-if="isAdmin" :user="props.user" />
          <p v-else class="text-red-600 font-medium">Only admin can delete users.</p>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
