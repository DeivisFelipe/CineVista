<script setup>
import CinemaLayout from "@/Layouts/CinemaLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
  sessoes: {
    type: Array,
  },
});

function deleteSessao(sessao) {
  if (confirm("Tem certeza que deseja excluir esta sessão?")) {
    router.delete(route("cinema.usuario.sessoes.destroy", sessao.id));
  }
}

// Formata a data com as horas
function formatDate(date) {
  const options = {
    year: "numeric",
    month: "numeric",
    day: "numeric",
    hour: "numeric",
    minute: "numeric",
  };
  return new Date(date).toLocaleDateString("pt-BR", options);
}

// Formata o preço
function formatPreco(preco) {
  return preco.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
  });
}
</script>

<template>

  <Head title="Sessões" />

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
          <h1 class="text-lg mb-4 inline">Sessões</h1>
          <a :href="route('cinema.usuario.sessoes.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Nova Sessão
          </a>
          <table class="w-full text-left table-auto min-w-max">
            <thead class="">
              <tr>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Filme</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Preço</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Início</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Fim</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="sessao in sessoes" :key="sessao.id" class="odd:bg-slate-100">
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  <img :src="'/storage/images/filmes/' + sessao.filme.imagem" class="w-24 h-32 rounded-md inline-block mr-5" />{{ sessao.filme.nome }}
                </td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal ">
                  {{ formatPreco(sessao.preco) }}
                </td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal ">
                  {{ formatDate(sessao.inicio) }}
                </td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal ">
                  {{ formatDate(sessao.fim) }}
                </td>
                <td class="p-4 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 text-right">
                  <a @click="deleteSessao(sessao)" class="text-red-600 hover:text-red-900 ml-3">Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </CinemaLayout>
</template>
