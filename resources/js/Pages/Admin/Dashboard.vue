<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>

  <Head title="Cinevista">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Chewy&display=swap" rel="stylesheet">
  </Head>

  <AdminLayout>
    <section class="w-full h-screen py-12 bg-cinevista flex items-center justify-center">
      <h1 class="text-cinevista-secondary text-7xl text-center chewy-regular ">Bem-vindo a tela de Administrador</h1>
    </section>
  </AdminLayout>
</template>
