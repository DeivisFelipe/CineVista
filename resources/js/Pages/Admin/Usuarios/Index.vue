<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
  usuarios: {
    type: Array,
  },
});

function deleteUser(usuario) {
  if (confirm("Tem certeza que deseja excluir este usuário?")) {
    router.delete(route("usuarios.destroy", usuario.id));
  }
}
</script>

<template>

  <Head title="Usuários" />

  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuários</h2>
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
          <h1 class="text-lg mb-4 inline">Usuários</h1>
          <a :href="route('usuarios.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Novo Usuário
          </a>
          <table class="w-full text-left table-auto min-w-max">
            <thead class="">
              <tr>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Admin</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Nome</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Email</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="usuario in usuarios" :key="usuario.id" class="odd:bg-slate-100">
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.admin ? "SIM" : "NÃO" }}</td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.name }}</td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.email }}</td>
                <td class="p-4 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 text-right">
                  <a :href="route('usuarios.edit', usuario.id)" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                  <a @click="deleteUser(usuario)" class="text-red-600 hover:text-red-900 ml-3">Excluir</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
