<script setup>
import CinemaLayout from "@/Layouts/CinemaLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
  assentos: {
    type: Array,
  },
  sala: {
    type: Object,
  },
});

// funcao que agrupa os assentos por fileira
function groupBy(list, keyGetter) {
  const map = new Map();
  list.forEach((item) => {
    const key = keyGetter(item);
    const collection = map.get(key);
    if (!collection) {
      map.set(key, [item]);
    } else {
      collection.push(item);
    }
  });
  return map;
}

// agrupa os assentos por fileira
const assentosGrouped = computed({
  get() {
    return groupBy(props.assentos, (assento) => assento.fileira);
  },
});

// Pega o maior numero do assento de cada fileira
let assentosMax = ref([]);

function loadMax() {
  for (const [key, value] of assentosGrouped.value) {
    assentosMax.value.push([
      key,
      Math.max(...value.map((assento) => assento.numero)),
    ]);
  }
}
loadMax();

// verifica se existe o assento com o número
function hasAssento(numero, assentos) {
  return assentos.some((assento) => assento.numero == numero);
}

async function removeAssento(numero, assentos) {
  // Encontra o assento
  const assento = assentos.find((assento) => assento.numero == numero);
  if (confirm("Tem certeza que deseja remove esse assento?")) {
    await router.delete(
      route("cinema.usuario.salas.assentos.destroy", [
        props.sala.id,
        assento.id,
      ])
    );

    // Limpa o array
    assentosMax.value = [];

    // Carrega o maior assento de cada fileira
    loadMax();
  }
}

async function adicionarAssento() {
  await form.post(route("cinema.usuario.salas.assentos.store", props.sala.id));

  // Limpa o array
  assentosMax.value = [];

  // Carrega o maior assento de cada fileira
  loadMax();
}

const form = useForm({
  fileira: "",
  numero: "",
});
</script>

<template>

  <Head title="Assentos da sala" />

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
          <h1 class="text-lg mb-4 inline">Assentos da sala: {{ sala.nome }}</h1>
          <!-- Formulário -->
          <form @submit.prevent="adicionarAssento" class="w-full mt-6">
            <div class="mb-4">
              <InputLabel for="fileira" value="Fileira" />
              <TextInput id="fileira" class="w-full" type="text" v-model="form.fileira" placeholder="Fileira" :class="{ 'border-red-500': form.errors.fileira }"></TextInput>
              <InputError :message="form.errors.fileira" />
            </div>
            <div class="mb-4">
              <InputLabel for="numero" value="Número" />
              <TextInput id="numero" class="w-full" type="text" v-model="form.numero" placeholder="Número" :class="{ 'border-red-500': form.errors.numero }"></TextInput>
              <InputError :message="form.errors.numero" />
            </div>
            <!-- Botão -->
            <div class="flex items-center justify-end mt-4">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adicionar
              </button>
            </div>
          </form>

          <h3>Assentos</h3>

          <!-- Tela -->
          <div class="bg-gray-600 h-3 w-full flex items-center justify-center mt-3 text-white py-3">
            <p>Tela</p>
          </div>

          <!-- Lista de assentos -->
          <div v-for="(assentos, index) in assentosGrouped" :key="index" class="mt-3 flex">
            <div class="bg-gray-200 rounded-full h-8 w-8 flex items-center justify-center">
              <span class="text-gray-600">{{ assentos[0] }}</span>
            </div>
            <div v-for="i in assentosMax[index][1]" :key="i">
              <div v-if="hasAssento(i, assentos[1])" @click="removeAssento(i, assentos[1])" class="bg-orange-300 rounded-md h-8 w-8 flex items-center justify-center ml-2 hover:bg-red-600 hover:text-white">
                {{i}}
              </div>
              <div v-else class="rounded-md h-8 w-8 flex items-center justify-center ml-2">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </CinemaLayout>
</template>
