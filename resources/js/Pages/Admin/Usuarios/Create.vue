<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, router, useForm } from "@inertiajs/vue3";

defineProps({});

const form = useForm({
  name: "",
  email: "",
  password: "",
  admin: false,
});
</script>

<template>

  <Head title="Novo usuário" />

  <AdminLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Mensagens de resposta -->
        <div v-if="$page.props.errors.error">
          <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Erro
          </div>
          <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>{{ $page.props.errors.error }}</p>
          </div>
        </div>
        <div class="sm:p-5 bg-white shadow sm:rounded-lg">
          <h1 class="text-lg mb-4 inline">Novo Usuário</h1>
          <!-- Cancelar -->
          <a :href="route('usuarios.index')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-end">
            Cancelar
          </a>
          <!-- Formulário -->
          <form @submit.prevent="form.post(route('usuarios.store'))" class="w-full  mt-6">
            <!-- Nome -->
            <div class="mb-4">
              <InputLabel for="name" value="Nome" />
              <TextInput id="name" type="text" v-model="form.name" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.name }" />
              <InputError :message="form.errors.name" />
            </div>
            <!-- Email -->
            <div class="mb-4">
              <InputLabel for="email" value="Email" />
              <TextInput id="email" type="email" v-model="form.email" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.email }" />
              <InputError :message="form.errors.email" />
            </div>
            <!-- Senha -->
            <div class="mb-4">
              <InputLabel for="password" value="Senha" />
              <TextInput id="password" type="password" v-model="form.password" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.password }" />
              <InputError :message="form.errors.password" />
            </div>
            <!-- Admin -->
            <div class="mb-4">
              <Checkbox id="admin" v-model="form.admin" />
              <label for="admin" class="ml-3">Administrador</label>
            </div>
            <!-- Botão -->
            <div class="flex items-center justify-end mt-4">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Salvar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
