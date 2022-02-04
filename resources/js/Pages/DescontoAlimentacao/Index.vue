<template>
  <Head title="Desconto Alimentação" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Desconto Alimentação
        </h2>

        <LinkButton
          :href="route('desconto-alimentacao.create')"
          class="hover:bg-red-700 active:bg-red-900 bg-red-800"
        >
          Cadastrar Desconto Alimentação
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
import List from "@/Components/DescontoAlimentacao/List.vue";
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
