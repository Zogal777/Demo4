<script setup>
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import UpdateClientsForm from './Partials/UpdateClientsForm.vue';

const props = defineProps({
  mustVerifyEmail: Boolean,
  status: String,
  clients: Array,
  userClients: Array,
});
</script>

<template>
  <Head title="Profile" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Profile
      </h2>
    </template>

    <div class="py-8">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

          <!-- Обновление информации профиля -->
          <div class="bg-white shadow sm:rounded-lg p-6">
            <UpdateProfileInformationForm
                :must-verify-email="props.mustVerifyEmail"
                :status="props.status"
            />
          </div>

          <!-- Управление клиентами -->
          <div class="bg-white shadow sm:rounded-lg p-6">
            <UpdateClientsForm
                :clients="props.clients"
                :user-clients="props.userClients"
            />
          </div>

        </div>

        <!-- Изменение пароля -->
        <div class="bg-white shadow sm:rounded-lg p-6">
          <UpdatePasswordForm />
        </div>

        <!-- Удаление пользователя -->
        <div class="bg-white shadow sm:rounded-lg p-6">
          <DeleteUserForm />
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>
