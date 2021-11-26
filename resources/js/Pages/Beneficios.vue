<template>
  <Head title="Benefícios" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Benefícios
        </h2>

        <BreezeButton
          @click="showModal = !showModal"
          data-modal-toggle="default-modal"
          type="button"
        >
          Cadastrar Benefício
        </BreezeButton>
      </div>
    </template>

    <Modal v-model="showModal">
      <Store></Store>
    </Modal>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <List :filters="filters" :items="items"></List>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Store from "@/Components/Beneficios/Store.vue";
import List from "@/Components/Beneficios/List.vue";
import Modal from "@/Components/Modal.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeButton,
    Store,
    List,
    Modal,
    Head,
  },
  props: {
    items: Object,
    filters: Object
  },
  data() {
    return {
      showModal: false,
      table: [],
    };
  },
};
</script>
