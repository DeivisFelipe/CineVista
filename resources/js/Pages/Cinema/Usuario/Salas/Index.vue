<script setup>
import CinemaLayout from "@/Layouts/CinemaLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
  salas: {
    type: Array,
  },
});

function deleteSala(sala) {
  if (confirm("Tem certeza que deseja excluir esta sala?")) {
    router.delete(route("cinema.usuario.salas.destroy", sala.id));
  }
}
</script>

<template>

  <Head title="Salas" />

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
          <h1 class="text-lg mb-4 inline">Sala</h1>
          <a :href="route('cinema.usuario.salas.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Nova Sala
          </a>
          <table class="w-full text-left table-auto min-w-max">
            <thead class="">
              <tr>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Número</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="sala in salas" :key="sala.id" class="odd:bg-slate-100">
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                  {{ sala.numero }}
                </td>
                <td class="p-4 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 text-right">
                  <a :href="route('cinema.usuario.salas.assentos.index', sala.id)" class="text-indigo-600 hover:text-indigo-900">Assentos</a>
                  <a :href="route('cinema.usuario.salas.edit', sala.id)" class="text-indigo-600 hover:text-indigo-900 ml-3">Editar</a>
                  <a @click="deleteSala(cinema)" class="text-red-600 hover:text-red-900 ml-3">Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </CinemaLayout>
</template>
