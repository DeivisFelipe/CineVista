<script setup>
import CinemaLayout from "@/Layouts/CinemaLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, router, useForm } from "@inertiajs/vue3";

defineProps({});

const form = useForm({
  numero: "",
});
</script>

<template>

  <Head title="Nova sala" />

  <CinemaLayout>
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
          <h1 class="text-lg mb-4 inline">Nova Sala</h1>
          <!-- Cancelar -->
          <a :href="route('cinema.usuario.salas')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-end">
            Cancelar
          </a>
          <!-- Formulário -->
          <form @submit.prevent="form.post(route('cinema.usuario.salas.store'))" class="w-full mt-6">
            <!-- Número -->
            <div class="mb-4">
              <InputLabel for="numero" value="Número" />
              <TextInput id="numero" type="text" v-model="form.numero" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.numero }" />
              <InputError :message="form.errors.numero" />
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
  </CinemaLayout>
</template>
