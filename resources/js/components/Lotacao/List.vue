<template>
    <FlashMessages />
    <div class="mb-4 max-w-xs">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Filtros
        </h4>
        <input
            type="search"
            v-model="params.search"
            aria-label="Lotação"
            placeholder="Lotação..."
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        />
    </div>

    <div class="bg-white rounded-md shadow">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Lotacao</th>
                    <th class="px-6 pt-6 pb-4">Empresa</th>
                    <th class="px-6 pt-6 pb-4">Feriado</th>
                    <th class="px-6 pt-6 pb-4">Ativo</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b"
                    v-for="item in items.data"
                    :key="item.id_lotacao"
                >
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        {{ item.lotacao }}
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        <span v-if="item.empresa">{{
                            item.empresa.razao_social
                        }}</span>
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        <span v-if="item.feriado">{{
                            item.feriado.nome_grupo
                        }}</span>
                    </td>
                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                        v-html="booleanFormat(item.ativo)"
                    ></td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                    >
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
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
                                    :href="
                                        route('lotacao.edit', item.id_lotacao)
                                    "
                                >
                                    Editar
                                </DropdownLink>
                                <DropdownLink @click="destroy(item.id_lotacao)">
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
import DateFormat from "@/Components/Global/DateFormat.vue";
import FlashMessages from "@/Components/Global/FlashMessages";
import MoneyFormat from "@/Components/Global/MoneyFormat.vue";
import Pagination from "@/Components/Global/Pagination";
import Dropdown from "@/Components/Global/Dropdown.vue";
import DropdownLink from "@/Components/Global/DropdownLink.vue";

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
        booleanFormat(val) {
            if (val == false || val == 0) {
                return "Não";
            } else {
                return "Sim";
            }
        },
        destroy(id) {
            this.$inertia.delete(route("lotacao.destroy", id));
        },
        edit(id) {
            this.$emit("edit", id);
        },
    },

    watch: {
        params: {
            handler: function () {
                this.$inertia.get(this.route("lotacao.index"), this.params, {
                    replace: true,
                    preserveState: true,
                });
            },
            deep: true,
        },
    },
};
</script>
