<script setup>

import Container from "../../../Componetns/Container.vue";
import InputField from "../../../Componetns/InputField.vue";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
import {router, useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../../Componetns/ErrorMessages.vue";
import SessionMessages from "../../../Componetns/SessionMessages.vue";

const props = defineProps({
  user: Object,
  status: String,
})

const form = useForm({
  name: props.user.name,
  email: props.user.email,
});

const submit = () => {
  form.patch(route('profile.update'))
}

const resendEmailVerification = (e) => {
  router.post(route('verification.send'), {}, {
    onStart: () => e.target.disabled = true,
    onFinish: () => e.target.disabled = false
  })
}
</script>

<template>

  <Container class="mb-6">

    <div class="mb-6">

      <Title>Update Information</Title>
      <p>Update your account's profile information and email address.</p>

    </div>

    <ErrorMessages :errors="form.errors"/>

    <form class="space-y-6" @submit.prevent="submit">

      <InputField v-model="form.name" class="w-1/2" icon="id-badge" label="Name"/>
      <InputField v-model="form.email" class="w-1/2" icon="at" label="Email"/>

      <div v-if="user.email_verified_at === null">
        <p>Your Email Address is unverified</p>

        <SessionMessages :status="status"/>

        <button class="text-indigo-500 
           font-medium underline dark:text-indigo-400 
           disabled:text-slate-300 disabled:cursor-wait dark:disabled:text-slate-300"
                @click="resendEmailVerification($event)">
          Click Here To Resend The Verification Email
        </button>
      </div>

      <PrimaryBtn :disabled="form.processing">Save</PrimaryBtn>

    </form>

  </Container>

</template>

<style scoped>

</style>