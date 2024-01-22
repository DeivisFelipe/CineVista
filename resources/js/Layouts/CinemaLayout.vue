<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div>

    <header class="w-full flex items-center text-cinevista-secondary arimo tracking-widest text-xl font bg-cinevista-primary px-14 py-4">
      <Link :href="route('cinema.usuario.dashboard')">
      <img src="/imagens/CineVistaLogoLado.png" class="h-16">
      </Link>
      <nav class="w-full">
        <ul class="flex justify-end items-center">
          <Link :href="route('cinema.usuario.salas')">
          <li class="text-white mx-6">Salas</li>
          </Link>
          <Link :href="route('cinema.usuario.sessoes')">
          <li class="text-white mx-6">Sessões</li>
          </Link>
          <Link :href="route('cinema.usuario.profile.edit')">
          <li class="text-white mx-6">Perfil</li>
          </Link>
          <Link :href="route('cinema.usuario.logout')" method="post">
          <li class="text-white mx-6">Sair</li>
          </Link>
        </ul>
      </nav>
    </header>

    <!-- Page Content -->
    <main class="w-full min-h-screen py-12 bg-cinevista">
      <slot />
    </main>

    <footer class="w-full">
      <section class="w-full">

      </section>
      <div class="w-full text-center py-3 bg-cinevista-primary text-cinevista-secondary">
        Cinevista &copy; 2024
      </div>
    </footer>
  </div>
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
