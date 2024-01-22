<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  cpf: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("cinema.cliente.logging"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Log in" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="cpf" value="CPF" />

        <TextInput id="cpf" type="text" class="mt-1 block w-full" v-model="form.cpf" required autofocus />

        <InputError class="mt-2" :message="form.errors.cpf" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Senha" />

        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <div>
          <Link :href="route('cinema.usuario.login')">Sou funcionário</Link>
        </div>
        <Link :href="route('cinema.cliente.register')">
        <SecondaryButton class="ms-4">
          Cadastrar
        </SecondaryButton>
        </Link>
        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Entrar
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
