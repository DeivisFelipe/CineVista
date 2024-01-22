<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  usuarios: {
    type: Array,
  },
  cinema: {
    type: Object,
  },
});

// Usuários search add
const usuarioSearch = ref("");
const usuariosEncontrados = ref([]);
const search = async () => {
  if (usuarioSearch.value.length < 3) {
    usuariosEncontrados.value = [];
    return;
  }
  // Faz a consulta usando axios para route("usuarios.find")
  const response = await axios.get(route("usuarios.find"), {
    params: {
      email: usuarioSearch.value,
    },
  });

  // seta os usuarios encontrados
  usuariosEncontrados.value = response.data.usuarios;
};

function addUsuario(usuario) {
  router.post(route("cinemas.usuarios.add", props.cinema.id), {
    id: usuario.id,
  });

  // limpa o campo de pesquisa
  usuarioSearch.value = "";

  // limpa a lista de usuarios encontrados
  usuariosEncontrados.value = [];
}

function removeUsuario(usuario) {
  if (confirm("Tem certeza que deseja remove esse usuário?")) {
    router.delete(
      route("cinemas.usuarios.remove", [props.cinema.id, usuario.id])
    );
  }
}

function tornarGerente(usuario) {
  if (confirm("Tem certeza que deseja tornar esse usuário gerente?")) {
    router.put(
      route("cinemas.usuarios.gerente", [props.cinema.id, usuario.id])
    );
  }
}
</script>

<template>

  <Head title="Usuários do cinema" />

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
          <h1 class="text-lg mb-4 inline">Usuários do cinema: {{ cinema.nome }}</h1>
          <div class="inline-block w-80 float-end">
            <TextInput class="w-80" type="text" v-model="usuarioSearch" @input="search" placeholder="Pesquisa usuário (email)"></TextInput>
            <!-- lista de usuarios encontrados em menu suspenso -->
            <div v-if="usuariosEncontrados.length > 0" class="absolute bg-white border border-gray-300 rounded-md mt-1 w-80">
              <ul>
                <li v-for="usuario in usuariosEncontrados" :key="usuario.id" class="px-2 py-1 hover:bg-gray-100 cursor-pointer" @click="addUsuario(usuario)">
                  {{ usuario.name }} ({{ usuario.email }})
                </li>
              </ul>
            </div>
          </div>
          <table class="w-full text-left table-auto min-w-max">
            <thead class="">
              <tr>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Gerente</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Nome</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none">Email</th>
                <th class="p-4 border-b font-sans text-sm antialiased font-normal leading-none text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="usuario in usuarios" :key="usuario.id" class="odd:bg-slate-100">
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.pivot.gerente ? "SIM" : "NÃO" }}</td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.name }}</td>
                <td class="p-4 font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">{{ usuario.email }}</td>
                <td class="p-4 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 text-right">
                  <a @click="tornarGerente(usuario)" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">tornar gerente</a>
                  <a @click="removeUsuario(usuario)" class="text-red-600 hover:text-red-900 cursor-pointer ml-3">remove</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
