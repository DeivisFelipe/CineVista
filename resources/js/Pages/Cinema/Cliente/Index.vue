<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { defineProps } from "vue";

const props = defineProps({
  cliente: Object,
});

const logout = () => {
  router.post(route("cinema.cliente.logout"));
};
</script>

<template>

  <Head title="Cinevista">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Chewy&display=swap" rel="stylesheet">
  </Head>

  <header class="w-full flex items-center text-cinevista-secondary arimo tracking-widest text-xl font bg-cinevista-primary px-14 py-4">
    <img src="/imagens/CineVistaLogoLado.png" class="h-16">
    <nav class="w-full">
      <ul class="flex justify-end items-center">
        <li class="text-white mx-6">Filmes</li>
        <li v-if="cliente" class="text-white mx-6">Compras</li>
        <li v-if="cliente" class="text-white mx-6">Perfil</li>
        <a v-if="!cliente" :href="route('cinema.cliente.login')">
          <li class="bg-white text-cinevista-primary p-2 px-10 rounded-xl hover:bg-stone-300 hover:cursor-pointer">Entrar</li>
        </a>
        <a v-else @click="logout">
          <li class="bg-white text-cinevista-primary p-2 px-10 rounded-xl hover:bg-stone-300 hover:cursor-pointer">Sair</li>
        </a>
      </ul>
    </nav>
  </header>

  <section class="w-full banner">
  </section>

  <section class="w-full py-12 bg-cinevista">
    <h1 class="text-cinevista-secondary text-7xl text-center chewy-regular">Filmes em CARTAZ</h1>
    <div class="flex flex-row justify-center flex-wrap px-16 mt-10 w-full">
      <div v-for="i in 10" :key="'filme' + i" class="w-1/6 rounded-xl overflow-auto m-6">
        <img class="w-full" src="https://p2.trrsf.com/image/fget/cf/1200/1600/middle/images.terra.com/2023/02/13/unnamed-(1)-s18w4bbfikhk.jpg">
        <PrimaryButton>
          <div>
            Compras Ingresso
          </div>
        </PrimaryButton>
      </div>
    </div>
  </section>

  <footer class="w-full">
    <section class="w-full">

    </section>
    <div class="w-full text-center py-3 bg-cinevista-primary text-cinevista-secondary">
      Cinevista &copy; 2024
    </div>
  </footer>
</template>

<style>
.banner {
  background-image: url("https://historiaem35mm.files.wordpress.com/2017/02/john-wick-2-keanu-reeves-the-sequel-to-john-wick.jpg");
  background-size: cover;
  background-position: center;
  height: 500px;
}

.chewy-regular {
  font-family: "Chewy", system-ui;
  font-weight: 400;
  font-style: normal;
}

.arimo {
  font-family: "Arimo", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
}

.bg-cinevista {
  background-image: url("/imagens/CineVistaBG.png");
  background-size: 250px;
}

.bg-cinevista-primary {
  background-color: #2a1a1d;
}

.bg-cinevista-secondary {
  background-color: #fdb94a;
}

.bg-cinevista-info {
  background-color: #e51d25;
}

.btn-cinesta:hover {
  background: #2a1a1d;
}

.text-cinevista-primary {
  color: #2a1a1d;
}

.text-cinevista-secondary {
  color: #fdb94a;
}
</style>
