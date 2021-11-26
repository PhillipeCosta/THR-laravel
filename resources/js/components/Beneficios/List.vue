<template>
<FlashMessages />
  <div class="mb-4 max-w-xs">
    <input
      type="search"
      v-model="params.beneficio"
      aria-label="Procurar"
      placeholder="Procurar..."
      class="
        block
        w-full
        rounded-md
        border-gray-300
        shadow-sm
        focus:ring-indigo-500 focus:border-indigo-500
        sm:text-sm
      "
    />
  </div>

  <div class="bg-white rounded-md shadow overflow-x-auto">
    <table class="w-full whitespace-nowrap">
      <thead>
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Tipo do plano</th>
          <th class="px-6 pt-6 pb-4">Empresa</th>
          <th class="px-6 pt-6 pb-4">De</th>
          <th class="px-6 pt-6 pb-4">Até</th>
          <th class="px-6 pt-6 pb-4">Colaboração dependente</th>
          <th class="px-6 pt-6 pb-4">Desconto dependente</th>
          <th class="px-6 pt-6 pb-4">Início</th>
          <th class="px-6 pt-6 pb-4">Fim</th>
        </tr>
      </thead>
      <tbody>
        <!-- Product 1 -->
        <tr
          class="bg-white border-b"
          v-for="item in items.data"
          :key="item.id_beneficio"
        >
          <td
            class="
              px-6
              py-4
              whitespace-nowrap
              text-sm
              font-medium
              text-gray-900
            "
          >
            {{ item.tipo_beneficio }}
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            {{ item.beneficio }}
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            {{ item.de }}
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            {{ item.ate }}
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            <MoneyFormat :value="item.colaboracao_empresa" />
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            <MoneyFormat :value="item.desconto_dependente" />
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            <DateFormat :value="item.inicio" />
          </td>
          <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
            <DateFormat :value="item.fim" />
          </td>
          <td
            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
          >
            <Link @click="destroy(item.id_beneficio)" class="text-red-700"
              >Deletar</Link
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <pagination class="mt-6" :links="items.links" />
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DateFormat from "@/Components/DateFormat.vue";
import FlashMessages from "@/Components/FlashMessages";
import MoneyFormat from "@/Components/MoneyFormat.vue";
import Pagination from "@/Components/Pagination";

export default {
  components: {
    Link,
    DateFormat,
    FlashMessages,
    MoneyFormat,
    Pagination,
  },
  props: {
    items: Object,
    filters: Object,
  },
  data() {
    return {
      params: {
        beneficio: this.filters.beneficio,
      },
    };
  },
  methods: {
    destroy(id_beneficio) {
      this.$inertia.delete(route("beneficios.destroy", id_beneficio));
    },
  },

  watch: {
    params: {
      handler: function () {
        console.log(this.params);
        /*

        this.$inertia.get(this.route("beneficios.index"), this.params, {
          replace: true,
          preserveState: true,
        });*/
      },
      deep: true,
    },
  },
};
</script>
