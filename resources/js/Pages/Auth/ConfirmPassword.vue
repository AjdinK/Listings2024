<script setup>
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import {Head, useForm} from "@inertiajs/vue3";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => form.reset(),
  });
};
</script>
<template>
  <Head title="- Password Confirmation"/>
  <Container class="w-1/2">
    <div class="mb-8 text-center">
      <p>
        This is the Secure Area. Please confirm your password before
        continuing.
      </p>
    </div>

    <ErrorMessages :errors="form.errors"/>

    <form class="space-y-6" @submit.prevent="submit">
      <InputField
          v-model="form.password"
          icon="key"
          label="Password"
          type="password"
      />

      <div class="flex justify-end">
        <PrimaryBtn :disabled="form.processing"
        >Confirm Password
        </PrimaryBtn>
      </div>
    </form>
  </Container>
</template>
