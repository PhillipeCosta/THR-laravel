<template>
    <FlashMessages />

    <div class="bg-white rounded-md shadow">
        <div v-if="!items.data.length">
            <EmptyTable />
        </div>
        <table class="w-full whitespace-nowrap" v-else>
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Início</th>
                    <th class="px-6 pt-6 pb-4">Fim</th>
                    <th class="px-6 pt-6 pb-4">Cliente</th>
                    <th class="px-6 pt-6 pb-4">Salario</th>
                    <th class="px-6 pt-6 pb-4">Ativo</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b"
                    v-for="item in items.data"
                    :key="item.id_faixa_salarial"
                >
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        <DateFormat :value="item.inicio" />
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        <DateFormat :value="item.fim" />
                    </td>
                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.cliente.cliente }}
                    </td>
                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        <MoneyFormat :value="item.salario" />
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
                                        route(
                                            'faixa-salarial.edit',
                                            item.id_faixa_salarial
                                        )
                                    "
                                >
                                    Editar
                                </DropdownLink>
                                <DropdownLink
                                    @click="destroy(item.id_faixa_salarial)"
                                >
                                    Deletar
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <Pagination class="mt-6" :links="items.links" />
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DateFormat from "@/Components/Global/DateFormat.vue";
import FlashMessages from "@/Components/Global/FlashMessages";
import MoneyFormat from "@/Components/Global/MoneyFormat.vue";
import Pagination from "@/Components/Global/Pagination";
import Dropdown from "@/Components/Global/Dropdown.vue";
import DropdownLink from "@/Components/Global/DropdownLink.vue";
import EmptyTable from "@/Components/Global/EmptyTable.vue";

export default {
    components: {
        Link,
        DateFormat,
        Dropdown,
        DateFormat,
        DropdownLink,
        FlashMessages,
        MoneyFormat,
        Pagination,
        EmptyTable
    },
    props: {
        items: Object,
    },
    data() {
        return {};
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
            this.$inertia.delete(route("faixa-salarial.destroy", id));
        },
        edit(id) {
            this.$emit("edit", id);
        },
    },

    watch: {},
};
</script>
