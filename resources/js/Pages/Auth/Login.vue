<script setup>
import Container from "../../Components/Container.vue";
import TextLink from "../../Components/TextLink.vue";
import InputField from "../../Components/InputField.vue";
import {Head, useForm} from "@inertiajs/vue3";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import CheckBox from "../../Components/CheckBox.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

defineProps({
  status: String,
});
const form = useForm({
  email: "",
  password: "",
  remember: null,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>
<template>
  <Head title="- Log In"/>
  <Container class="w-1/2">
    <div class="mb-8 text-center">
      <Title>Log In</Title>
      <p>
        Dont Have an account? Register Here
        <TextLink label="Register" routeName="register"/>
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
      <InputField
          v-model="form.password"
          icon="key"
          label="Password"
          type="password"
      />

      <div class="flex justify-between items-center mb-4">
        <CheckBox v-model="form.remember" name="remember"
        >Remember Me
        </CheckBox>

        <TextLink
            label="Forgot Password?"
            routeName="password.request"
        />
      </div>

      <div class="flex justify-end">
        <PrimaryBtn :disabled="form.processing">Log In</PrimaryBtn>
      </div>
    </form>
  </Container>
</template>
