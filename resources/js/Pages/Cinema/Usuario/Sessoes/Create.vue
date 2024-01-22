<script setup>
import CinemaLayout from "@/Layouts/CinemaLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

defineProps({});

const form = useForm({
  filme_id: "",
  filme: "",
  sala_id: "",
  sala: "",
  preco: "",
  inicio: "",
  inicio_data: "",
  inicio_hora: "",
  fim: "",
  fim_data: "",
  fim_hora: "",
});

function create() {
  // Concatena a data e hora de inicio
  form.inicio = form.inicio_data + " " + form.inicio_hora;
  // Concatena a data e hora de fim
  form.fim = form.fim_data + " " + form.fim_hora;
  form.post(route("cinema.usuario.sessoes.store"));
}

// Search filme
const filmesEncontrados = ref([]);
const searchFilme = async () => {
  if (form.filme.length == 0) {
    filmesEncontrados.value = [];
    return;
  }
  const response = await axios.get(route("cinema.usuario.filmes.search"), {
    params: {
      filme: form.filme,
    },
  });

  // seta os usuarios encontrados
  filmesEncontrados.value = response.data;
};

// Search sala
const salasEncontrados = ref([]);
const searchSala = async () => {
  if (form.sala.length == 0) {
    salasEncontrados.value = [];
    return;
  }
  const response = await axios.get(route("cinema.usuario.salas.search"), {
    params: {
      numero: form.sala,
    },
  });

  // seta os usuarios encontrados
  salasEncontrados.value = response.data;
};

const selecionarFilme = (filme) => {
  form.filme_id = filme.id;
  form.filme = filme.nome;
  filmesEncontrados.value = [];
};

const selecionaSala = (sala) => {
  form.sala_id = sala.id;
  form.sala = sala.numero;
  salasEncontrados.value = [];
};
</script>

<template>

  <Head title="Nova sessão" />

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
          <h1 class="text-lg mb-4 inline">Nova Sessão</h1>
          <!-- Cancelar -->
          <a :href="route('cinema.usuario.sessoes')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded float-end">
            Cancelar
          </a>
          <!-- Formulário -->
          <form @submit.prevent="create()" class="w-full mt-6">
            <!-- Filme -->
            <div class="mb-4 w-full">
              <InputLabel for="filme" value="Filme" />
              <TextInput id="filme" type="text" v-model="form.filme" @input="searchFilme" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.filme_id }" />
              <InputError :message="form.errors.filme_id" />
              <!-- lista de filmes encontrados em menu suspenso -->
              <div v-if="filmesEncontrados.length > 0" class="absolute bg-white border border-gray-300 rounded-md mt-1 w-96">
                <ul>
                  <li v-for="filme in filmesEncontrados" :key="filme.id" class="px-2 py-1 hover:bg-gray-100 cursor-pointer" @click="selecionarFilme(filme)">
                    <img :src="'/storage/images/filmes/' + filme.imagem" class="w-24 h-32 rounded-md inline-block mr-5" />{{ filme.nome }}
                  </li>
                </ul>
              </div>
            </div>
            <!-- Sala -->
            <div class="mb-4">
              <InputLabel for="sala" value="Sala" />
              <TextInput id="sala" type="text" v-model="form.sala" @input="searchSala" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.sala_id }" />
              <InputError :message="form.errors.sala_id" />
              <!-- lista de salas encontradas em menu suspenso -->
              <div v-if="salasEncontrados.length > 0" class="absolute bg-white border border-gray-300 rounded-md mt-1 w-96">
                <ul>
                  <li v-for="sala in salasEncontrados" :key="sala.id" class="px-2 py-1 hover:bg-gray-100 cursor-pointer" @click="selecionaSala(sala)">
                    Sala número: {{ sala.numero }}
                  </li>
                </ul>
              </div>
            </div>
            <!-- Preço -->
            <div class="mb-4">
              <InputLabel for="preco" value="Preço" />
              <TextInput id="preco" type="text" v-model="form.preco" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.preco }" />
              <InputError :message="form.errors.preco" />
            </div>
            <!-- Início -->
            <div class="mb-4 w-1/2 inline-block pe-2">
              <InputLabel for="inicio" value="Início" />
              <TextInput id="inicio" type="date" v-model="form.inicio_data" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.inicio }" />
              <InputError :message="form.errors.inicio" />
            </div>
            <!-- Início hora -->
            <div class="mb-4 w-1/2 inline-block ps-2">
              <InputLabel for="inicio_hora" value="Hora" />
              <TextInput id="inicio_hora" type="time" v-model="form.inicio_hora" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.inicio }" />
              <InputError :message="form.errors.inicio" />
            </div>
            <!-- Fim -->
            <div class="mb-4 w-1/2 inline-block pe-2">
              <InputLabel for="fim" value="Fim" />
              <TextInput id="fim" type="date" v-model="form.fim_data" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.fim }" />
              <InputError :message="form.errors.fim" />
            </div>
            <!-- Fim hora -->
            <div class="mb-4 w-1/2 inline-block ps-2">
              <InputLabel for="fim_hora" value="Hora" />
              <TextInput id="fim_hora" type="time" v-model="form.fim_hora" class="mt-1 block w-full" :class="{ 'border-red-500': form.errors.fim }" />
              <InputError :message="form.errors.fim" />
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
