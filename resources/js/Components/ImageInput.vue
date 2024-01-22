<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
  modelValue: {
    type: [File, String],
    required: true,
  },
  error: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(["update:modelValue"]);

const image = ref();

// Verifica se o valor é uma string
onMounted(() => {
  if (typeof props.modelValue === "string" && props.modelValue !== "") {
    image.value = "/storage/images/filmes/" + props.modelValue;
  }
});

const onFileChange = (e) => {
  const file = e.target.files[0];
  const reader = new FileReader();

  reader.onloadend = () => {
    image.value = reader.result;
  };

  reader.readAsDataURL(file);

  // Atualiza o valor do campo
  emit("update:modelValue", file);
};
</script>

<template>
  <!-- Input de imagem -->
  <div class="flex flex-col">
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" :class="{ 'border-red-500': error }">
      <div class=" space-y-1 text-center">
        <div class="flex text-sm text-gray-600">
          <label for="file-upload" class="relative cursor-pointer bg-white rounded-md text-center font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
            <span>Envie a imagem</span>
            <input id="file-upload" name="file-upload" type="file" class="sr-only" @change="onFileChange" />
          </label>
        </div>
        <p class="text-xs text-gray-500">
          PNG, JPG, GIF com no máximo 10MB
        </p>
      </div>
    </div>
    <div class="mt-2">
      <img v-if="image" :src="image" class="h-40 w-40 m-auto rounded-md" />
    </div>
  </div>
</template>
