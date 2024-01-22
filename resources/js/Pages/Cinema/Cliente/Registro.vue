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
  nome: "",
  cpf: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("cinema.cliente.registering"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Registrar" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="nome" value="Nome" />

        <TextInput id="nome" type="text" class="mt-1 block w-full" v-model="form.nome" required autofocus />

        <InputError class="mt-2" :message="form.errors.nome" />
      </div>

      <div class="mt-4">
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
        <Link :href="route('cinema.cliente.login')">
        <SecondaryButton class="ms-4">
          Entrar
        </SecondaryButton>
        </Link>
        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Cadastrar
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
