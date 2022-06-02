<template>
  <Head title="Lotacao" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Lotacao
        </h2>

        <LinkButton
          :href="route('lotacao.create')"
          class="hover:bg-red-700 active:bg-red-900 bg-red-800"
        >
          Cadastrar Lotacao
        </LinkButton>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <List :filters="filters" :items="items"></List>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import List from "@/Components/Lotacao/List.vue";
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
    filters: Object,
  },
};
</script>
