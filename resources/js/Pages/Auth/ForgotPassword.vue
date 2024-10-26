<script setup>
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import {Head, useForm} from "@inertiajs/vue3";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

const form = useForm({
  email: "",
});

defineProps({
  status: String,
});

const submit = () => {
  form.post(route("password.email"));
};
</script>
<template>
  <Head title="- Forgot Password"/>
  <Container class="w-1/2">
    <div class="mb-8 text-center">
      <p>
        Forgot Your Password? No Problem. Just let us know your email
        address and we will email you a password reset link that will
        allow you to choose a new one
      </p>
    </div>

    <ErrorMessages :errors="form.errors"/>

    <SessionMessages :status="status"/>

    <form class="space-y-6" @submit.prevent="submit">
      <InputField
          v-model="form.email"
          icon="at"
          label="Email"
          type="email"
      />

      <div class="flex justify-end">
        <PrimaryBtn :disabled="form.processing"
        >Send Password Reset Link
        </PrimaryBtn>
      </div>
    </form>
  </Container>
</template>
