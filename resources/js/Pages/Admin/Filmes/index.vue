<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
  filmes: {
    type: Array,
  },
});

function deleteFilme(filme) {
  if (confirm("Tem certeza que deseja excluir este filme?")) {
    router.delete(route("filmes.destroy", filme.id));
  }
}
</script>

<template>

  <Head title="Usuários" />

  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Filmes</h2>
    </template>

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
          <h1 class="text-lg mb-4 inline">Filmes</h1>
          <a :href="route('filmes.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Novo Filme
          </a>
          <table class="w-full text-left table-auto min-w-max">
            <thead class="">
              <tr>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Imagem</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Nome</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="filme in filmes" :key="filme.id" class="odd:bg-slate-100">
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <img :src="'/storage/images/filmes/' + filme.imagem" class="w-24 h-32 rounded-md" />
                </td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ filme.nome }}</td>
                <td class="p-4 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 text-right">
                  <a :href="route('filmes.edit', filme.id)" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                  <a @click="deleteFilme(filme)" class="text-red-600 hover:text-red-900 ml-3">Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
