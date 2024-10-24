<script setup>
import Container from "../../Componetns/Container.vue";
import InputField from "../../Componetns/InputField.vue";
import { Head, useForm } from "@inertiajs/vue3";
import PrimaryBtn from "../../Componetns/PrimaryBtn.vue";
import ErrorMessages from "../../Componetns/ErrorMessages.vue";

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
    <Head title="- Password Confirmation" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                This is the Secure Area. Please confirm your password before
                continuing.
            </p>
        </div>

        <ErrorMessages :errors="form.errors" />

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
