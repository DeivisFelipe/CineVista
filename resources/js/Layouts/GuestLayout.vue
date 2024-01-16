<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cinevista-primary">
    <div>
      <Link href="/">
      <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
      </Link>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-cinevista-secondary shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>
  </div>
</template>

<style>
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
</style>