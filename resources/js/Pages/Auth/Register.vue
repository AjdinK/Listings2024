<script setup>
import Container from "../../../componetns/Container.vue";
import Title from "../../../componetns/Title.vue";
import TextLink from "../../../componetns/TextLink.vue";
</script>
<template>
  <Container>

    <div class="mb-8 text-center">
      <Title>Register Here</Title>
      <!--      todo: change to login page-->
      <p>Already Have an account?
        <TextLink label="Log In" routeName="home"/>
      </p>
    </div>

    <form class="space-y-6">

    </form>

  </Container>
</template>