<script setup>
import Container from "../../../Componetns/Container.vue";
import Title from "../../../Componetns/Title.vue";
import TextLink from "../../../Componetns/TextLink.vue";
import InputField from "../../../Componetns/InputField.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
import ErrorMessages from "../../../Componetns/ErrorMessages.vue";

const form = useForm({
  name: '',
  email: "",
  password: "",
  password_confirmation: ""
})

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};

</script>
<template>
  <Head title="- Register"/>

  <Container class="w-1/2">

    <div class="mb-8 text-center">
      <Title>Register Here</Title>
      <p>Already Have an account?
        <TextLink label="Log In" routeName="login"/>
      </p>
    </div>

    <ErrorMessages :errors="form.errors"/>

    <form class="space-y-6" @submit.prevent="submit">

      <InputField v-model="form.name" icon="user" label="Name"/>
      <InputField v-model="form.email" icon="at" label="Email" type="email"/>
      <InputField v-model="form.password" icon="key" label="Password" type="password"/>
      <InputField v-model="form.password_confirmation" icon="key" label="Confirm Password" type="password"/>

      <p>By signing up, you agree to our
        <TextLink label="Terms of Service and Privacy Policy" routeName="home"/>
        .
      </p>

      <div class="flex justify-end">
        <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
      </div>

    </form>

  </Container>
</template>