<script setup>
import Container from "../../../Componetns/Container.vue";
import Title from "../../../Componetns/Title.vue";
import TextLink from "../../../Componetns/TextLink.vue";
import InputField from "../../../Componetns/InputField.vue";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
</script>
<template>
  <Container class="w-1/2">

    <div class="mb-8 text-center">
      <Title>Register Here</Title>
      <!--      todo: change to login page-->
      <p>Already Have an account?
        <TextLink label="Log In" routeName="home"/>
      </p>
    </div>

    <form class="space-y-6">

      <InputField icon="user" label="Username"/>
      <InputField icon="at" label="Email" type="email"/>
      <InputField icon="key" label="Password" type="password"/>
      <InputField icon="key" label="Confirm Password" type="password"/>

      <div class="flex justify-end">
        <PrimaryBtn>Register</PrimaryBtn>
      </div>

    </form>

  </Container>
</template>