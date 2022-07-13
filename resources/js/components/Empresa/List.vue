<template>
    <FlashMessages />

    <div class="bg-white rounded-md shadow">
        <div v-if="!items.data.length">
            <EmptyTable />
        </div>
        <table class="w-full whitespace-nowrap" v-else>
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">
                        Razão social <br />
                        Nome Fantasia
                    </th>
                    <th class="px-6 pt-6 pb-4">CNPJ</th>
                    <th class="px-6 pt-6 pb-4">
                        Inscrição Estadual <br />
                        CNAE
                    </th>
                    <th class="px-6 pt-6 pb-4">
                        Tipo <br />
                        Código Empresa
                    </th>
                    <th class="px-6 pt-6 pb-4">Telefone</th>
                    <th class="px-6 pt-6 pb-4">Endereço</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b"
                    v-for="item in items.data"
                    :key="item.id_pessoa"
                >
                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.razao_social }} <br />
                        {{ item.nome_fantasia }}
                    </td>

                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        <CPFCNPJFormat :value="item.cnpj" />
                    </td>

                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.inscricao_estadual }} <br />
                        {{ item.cnae }}
                    </td>

                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.tipo }}
                        {{ item.codigo_empresa_folha }}
                    </td>

                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        <PhoneFormat :value="item.telefone" />
                    </td>

                    <td
                        class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.cep }} <br />
                        {{ item.endereco }} <br />
                        {{ item.bairro }} - {{ item.cidade }} -
                        {{ item.estado }} <br>
                        {{ item.complemento }}
                    </td>

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
                                        route('empresa.edit', item.id_pessoa)
                                    "
                                >
                                    Editar
                                </DropdownLink>
                                <DropdownLink @click="destroy(item.id_pessoa)">
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
import CPFCNPJFormat from "@/Components/Global/CPFCNPJFormat.vue";
import PhoneFormat from "@/Components/Global/PhoneFormat.vue";
import EmptyTable from "@/Components/Global/EmptyTable.vue";

export default {
    components: {
        Link,
        DateFormat,
        EmptyTable,
        Dropdown,
        DateFormat,
        DropdownLink,
        FlashMessages,
        MoneyFormat,
        Pagination,
        CPFCNPJFormat,
        PhoneFormat,
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
            this.$inertia.delete(route("empresa.destroy", id));
        },
        edit(id) {
            this.$emit("edit", id);
        },
    },

    watch: {},
};
</script>
