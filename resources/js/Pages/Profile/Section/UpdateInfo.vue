<script setup>

import Container from "../../../Componetns/Container.vue";
import InputField from "../../../Componetns/InputField.vue";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
</script>

<template>

  <Container class="mb-6">

    <div class="mb-6<">

      <Title>Update Information</Title>
      <p>Update your account's profile information and email address.</p>

    </div>

    <form class="space-y-6">

      <InputField class="w-1/2" icon="id-badge" label="Name"/>
      <InputField class="w-1/2" icon="at" label="Email"/>

      <div>
        <p>Your Email Address is unverified</p>
      </div>

      <PrimaryBtn>Save</PrimaryBtn>

    </form>

  </Container>

</template>

<style scoped>

</style>