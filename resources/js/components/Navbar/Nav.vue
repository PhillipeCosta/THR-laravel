<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <NavLink :href="route('home')" :active="route().current('home')">
            Home
        </NavLink>
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        type="button"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
                    >
                        Cadastros
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
                        :href="route('empresa.index')"
                        :active="route().current('empresa.index')"
                    >
                        Empresas
                    </DropdownLink>
                    <DropdownLink
                        :href="route('fornecedor.index')"
                        :active="route().current('fornecedor.index')"
                    >
                        Fornecedor
                    </DropdownLink>
                    <DropdownLink
                        :href="route('lotacao.index')"
                        :active="route().current('lotacao.index')"
                    >
                        Lotação
                    </DropdownLink>
                    <DropdownLink
                        :href="route('feriado.index')"
                        :active="route().current('feriado.index')"
                    >
                        Feriados
                    </DropdownLink>
                    <DropdownLink
                        :href="route('grupo-feriado.index')"
                        :active="route().current('grupo-feriado.index')"
                    >
                        Grupo de feriados
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        type="button"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
                    >
                        Funcionário
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
                        :href="route('funcionario.index')"
                        :active="route().current('funcionario.index')"
                    >
                        Cadastro Funcionário
                    </DropdownLink>
                    <DropdownLink
                        :href="route('jornada.index')"
                        :active="route().current('jornada.index')"
                    >
                        Jornadas
                    </DropdownLink>
                    <DropdownLink
                        :href="route('dependente.index')"
                        :active="route().current('dependente.index')"
                    >
                        Dependentes
                    </DropdownLink>

                    <DropdownLink
                        :href="route('funcionario-beneficio.index')"
                        :active="route().current('funcionario-beneficio.index')"
                    >
                        Benefícios
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        type="button"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
                    >
                        Descontos
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
                        :href="route('faixa-etaria.index')"
                        :active="route().current('faixa-etaria.index')"
                    >
                        Faixa Etária
                    </DropdownLink>
                    <DropdownLink
                        :href="route('faixa-salarial.index')"
                        :active="route().current('faixa-salarial.index')"
                    >
                        Faixa Salarial
                    </DropdownLink>
                    <DropdownLink
                        :href="route('empresa-beneficio.index')"
                        :active="route().current('empresa-beneficio.index')"
                    >
                        Empresa Benefícios
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>

        <NavLink
            :href="route('compras-beneficios.index')"
            :active="route().current('compras-beneficios.index')"
        >
            Compra Benefícios
        </NavLink>

        <NavLink
            :href="route('ocorrencia.index')"
            :active="route().current('ocorrencia.index')"
        >
            Ocorrência
        </NavLink>
    </div>
</template>

<script>
import DropdownLink from "@/Components/Global/DropdownLink.vue";
import Dropdown from "@/Components/Global/Dropdown.vue";
import NavLink from "@/Components/Global/NavLink.vue";
export default {
    name: "Nav",
    components: {
        DropdownLink,
        Dropdown,
        NavLink,
    },
};
</script>
