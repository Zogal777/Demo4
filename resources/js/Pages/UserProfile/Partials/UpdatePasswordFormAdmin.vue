<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

// Получаем props и страницу
const props = defineProps({ user: Object });
const page = usePage();
const isAdmin = page.props.auth.user?.id === 1;

// Форма для обновления пароля
const form = useForm({
  password: '',
  password_confirmation: '',
});

// Метод обновления пароля
const updatePassword = async () => {
  if (!form.password) return;

  await form.patch(route('users.updatePassword', props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset('password', 'password_confirmation');
    },
  });
};
</script>

<template>
  <section v-if="isAdmin">
    <header>
      <h2 class="text-lg font-medium text-gray-900">Update Password</h2>
      <p class="mt-1 text-sm text-gray-600">Set a new password for this user.</p>
    </header>

    <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
      <div>
        <InputLabel for="password" value="New Password" />
        <TextInput
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            autocomplete="new-password"
            required
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div>
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            autocomplete="new-password"
            required
        />
        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
      </div>
    </form>
  </section>

  <p v-else class="text-red-600 font-medium">Only admin can change passwords.</p>
</template>
