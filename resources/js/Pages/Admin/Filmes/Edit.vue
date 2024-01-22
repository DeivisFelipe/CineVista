<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, router, useForm } from "@inertiajs/vue3";

const props = defineProps({
  filme: {
    type: Object,
  },
});

const form = useForm({
  nome: props.filme.nome,
  imagem: props.filme.imagem,
});

console.log(form);
</script>

<template>

  <Head title="Editar filme" />

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
          <h1 class="text-lg mb-4 inline">Editar Filme</h1>
          <!-- Cancelar -->
          <a :href="route('filmes.index')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-end">
            Cancelar
          </a>
          <!-- Formulário -->
          <form @submit.prevent="form.post(route('filmes.update', filme.id))" class="w-full  mt-6">
            <!-- Nome -->
            <div class="mb-4">
              <InputLabel for="nome" value="Nome" />
              <TextInput id="nome" type="text" v-model="form.nome" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.nome }" />
              <InputError :message="form.errors.nome" />
            </div>
            <!-- Imagem -->
            <div class="mb-4">
              <InputLabel for="imagem" value="Imagem" />
              <ImageInput id="imagem" v-model="form.imagem" class="mt-1 block w-full" :error="form.errors.imagem" />
              <InputError :message="form.errors.imagem" />
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
