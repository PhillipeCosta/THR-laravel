<template>
  <Head title="Desconto Transporte" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Desconto Transporte
        </h2>

        <LinkButton
          :href="route('desconto-transporte.create')"
          class="hover:bg-red-700 active:bg-red-900 bg-red-800"
        >
          Cadastrar Desconto transporte
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
import List from "@/Components/DescontoTransporte/List.vue";
import Modal from "@/Components/Modal.vue";
import LinkButton from "@/Components/LinkButton.vue";

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
