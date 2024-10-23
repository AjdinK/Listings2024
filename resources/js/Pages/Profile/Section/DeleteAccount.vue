<script setup>

import Container from "../../../Componetns/Container.vue";
import InputField from "../../../Componetns/InputField.vue";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../../Componetns/ErrorMessages.vue";
import Title from "../../../Componetns/Title.vue";
import {ref} from "vue";

const form = useForm({
  password: '',
});

const submit = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onError: () => form.reset(),
  })
}

const show = ref(false)

</script>

<template>

  <Container class="mb-6">

    <div class="mb-6">

      <Title>Delete Account</Title>

      <p>Once your account is deleted, all of its
        resources and data will be permanently deleted.
      </p>

    </div>

    <ErrorMessages :errors="form.errors"/>

    <div v-if="show">
      <form class="space-y-6" @submit.prevent="submit">

        <InputField v-model="form.password" class="w-1/2" icon="key" label="Confirm Password"/>

        <div class="flex items-center gap-x-6">
          <button class="hover:text-slate-800 dark:hover:text-slate-200" @click="show = false">Cancel</button>
          <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </div>


      </form>
    </div>


    <button
        v-if="!show"
        class="px-6 py-2 font-bold rounded-lg bg-red-500 text-white"
        @click="show = !show">
      <i class="fa-solid fa-triangle-exclamation mr-2"></i>
      Delete Account
    </button>

  </Container>

</template>

<style scoped>

</style>