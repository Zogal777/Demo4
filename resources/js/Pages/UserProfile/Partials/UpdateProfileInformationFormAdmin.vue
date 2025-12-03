<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ user: Object });

const page = usePage();
const isAdmin = page.props.auth.user?.id === 1;

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  date_of_birth: props.user.date_of_birth,
});

const updateProfile = () => {
  form.patch(route('users.update', props.user.id), { preserveScroll: true });
};
</script>

<template>
  <section v-if="isAdmin">
    <header>
      <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
      <p class="mt-1 text-sm text-gray-600">
        Update user's name, email and date of birth.
      </p>
    </header>

    <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required />
        <InputError :message="form.errors.name" class="mt-2" />
      </div>

      <div>
        <InputLabel for="email" value="Email" />
        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
        <InputError :message="form.errors.email" class="mt-2" />
      </div>

      <div>
        <InputLabel for="date_of_birth" value="Date Of Birth" />
        <TextInput id="date_of_birth" v-model="form.date_of_birth" type="date" class="mt-1 block w-full" required />
        <InputError :message="form.errors.date_of_birth" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
      </div>
    </form>
  </section>

  <p v-else class="text-red-600 font-medium">Only admin can edit user profiles.</p>
</template>
