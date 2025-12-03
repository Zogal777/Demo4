<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue';

const props = defineProps({ user: Object });
const page = usePage();
const isAdmin = ref(page.props.auth.user?.id === 1);

const confirmingUserDeletion = ref(false);
const form = useForm({});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;
  nextTick(() => {});
};

const deleteUser = () => {
  form.delete(route('users.destroy', props.user.id), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;
  form.clearErrors();
  form.reset();
};
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-lg font-medium text-gray-900">Delete User</h2>
      <p class="mt-1 text-sm text-gray-600">
        Once deleted, all data will be permanently removed.
      </p>
    </header>

    <div v-if="isAdmin">
      <DangerButton @click="confirmUserDeletion">Delete User</DangerButton>

      <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">Are you sure?</h2>
          <p class="mt-1 text-sm text-gray-600">This action cannot be undone.</p>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <DangerButton
                class="ml-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="deleteUser"
            >
              Delete
            </DangerButton>
          </div>
        </div>
      </Modal>
    </div>

    <p v-else class="text-red-600 font-medium">Only admin can delete users.</p>
  </section>
</template>
