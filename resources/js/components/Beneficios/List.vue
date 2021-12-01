<template>
  <FlashMessages />
  <div class="mb-4 max-w-xs">
    <h4 class="font-semibold text-xl text-gray-800 leading-tight mb-4"> Filtros </h4>
    <input
      type="search"
      v-model="params.search"
      aria-label="Empresa"
      placeholder="Empresa..."
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

  <div class="bg-white rounded-md shadow">
    <table class="w-full whitespace-nowrap">
      <thead>
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Tipo do plano</th>
          <th class="px-6 pt-6 pb-4">Empresa</th>
          <th class="px-6 pt-6 pb-4">De</th>
          <th class="px-6 pt-6 pb-4">Até</th>
          <th class="px-6 pt-6 pb-4">
            Colaboração <br />
            dependente
          </th>
          <th class="px-6 pt-6 pb-4">
            Desconto <br />
            dependente
          </th>
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
            <Dropdown align="right" width="48">
              <template #trigger>
                <button
                  type="button"
                  class="
                    inline-flex
                    items-center
                    px-3
                    py-2
                    border border-transparent
                    text-sm
                    leading-4
                    font-medium
                    rounded-md
                    text-gray-500
                    bg-white
                    hover:text-gray-700
                    focus:outline-none
                    transition
                    ease-in-out
                    duration-150
                  "
                >
                  Opções

                  <svg
                    class="ml-2 -mr-0.5 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              </template>

              <template #content>
                <DropdownLink
                  :href="route('beneficios.edit', item.id_beneficio)"
                >
                  Editar
                </DropdownLink>
                <DropdownLink @click="destroy(item.id_beneficio)">
                  Deletar
                </DropdownLink>
              </template>
            </Dropdown>
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
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

export default {
  components: {
    Link,
    DateFormat,
    Dropdown,
    DropdownLink,
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
        search: this.filters.search,
      },
    };
  },
  methods: {
    destroy(id_beneficio) {
      this.$inertia.delete(route("beneficios.destroy", id_beneficio));
    },
    edit(id_beneficio) {
      this.$emit("edit", id_beneficio);
    },
  },

  watch: {
    params: {
      handler: function () {
        this.$inertia.get(this.route("beneficios.index"), this.params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },
};
</script>
