<template>
  <Head title="Empresas" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Empresas
        </h2>

        <LinkButton
          :href="route('empresa.create')"
          class="hover:bg-red-700 active:bg-red-900 bg-red-800"
        >
          Cadastrar Empresa
        </LinkButton>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <List :items="items"></List>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import List from "@/Components/Empresa/List.vue";
import Modal from "@/Components/Global/Modal.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

import { Head } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    LinkButton,
    List,
    Modal,
    Head,
  },
  props: {
    items: Object,
  },
};
</script>
