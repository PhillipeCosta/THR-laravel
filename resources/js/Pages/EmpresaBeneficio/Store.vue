<template>
    <FormLayout title="Cadastrar Empresa Benefício">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <ThrLabel value="Fornecedor" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_fornecedor"
                        required
                        :options="selectFornecedor"
                    />
                </div>
                <div>
                    <ThrLabel value="Lotacao" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_lotacao"
                        required
                        :options="selectLotacao"
                    />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <ThrLabel value="Porcentagem funcionário" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <span class="text-gray-500 sm:text-sm"> % </span>
                        </div>
                        <currency-input
                            id="percentual_valor_dependente"
                            class="mt-1 block w-full pl-7 pr-12"
                            v-model="form.percentual_valor_funcionario"
                            required
                            :options="moneyCurrencyOptions"
                        />
                    </div>
                </div>
                <div>
                    <ThrLabel value="Porcentagem dependente" />
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <span class="text-gray-500 sm:text-sm"> % </span>
                        </div>
                        <currency-input
                            id="percentual_valor_dependente"
                            class="mt-1 block w-full pl-7 pr-12"
                            v-model="form.percentual_valor_dependente"
                            required
                            :options="moneyCurrencyOptions"
                        />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <ThrLabel value="Cliente" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_cliente"
                        required
                        :options="selectCliente"
                    />
                </div>
                <div>
                    <ThrLabel value="Tipo Benefício" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_tipo_beneficio"
                        required
                        :options="selectTipoBeneficio"
                    />
                </div>
            </div>
            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('empresa-beneficio.index')"
                >
                    Voltar
                </LinkButton>
                <ThrButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Cadastrar
                </ThrButton>
            </div>
        </form>
    </FormLayout>
</template>

<script>
import FormLayout from "@/Layouts/Form.vue";

import ThrButton from "@/Components/Global/Button.vue";
import ThrInput from "@/Components/Global/Input.vue";
import Switch from "@/Components/Global/Switch.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";
import CurrencyInput from "@/Components/Global/CurrencyInput";

export default {
    components: {
        FormLayout,
        Switch,
        LinkButton,
        CurrencyInput,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
    },

    data() {
        return {
            moneyCurrencyOptions: {
                locale: "pt-BR",
                currency: "BRL",
                currencyDisplay: "hidden",
                valueRange: undefined,
                precision: 2,
                valueRange: {
                    min: 0,
                    max: 100,
                },
                hideCurrencySymbolOnFocus: false,
                hideGroupingSeparatorOnFocus: false,
                hideNegligibleDecimalDigitsOnFocus: false,
                autoDecimalDigits: true,
                exportValueAsInteger: false,
                autoSign: true,
                useGrouping: true,
            },
            form: this.$inertia.form({
                id_lotacao: "",
                id_fornecedor: "",
                percentual_valor_funcionario: "",
                percentual_valor_dependente: "",
                id_cliente: "",
                id_tipo_beneficio: ""
            }),
        };
    },
    props: {
        fornecedores: Array,
        lotacao: Array,
        empresa: Array,
        tipo_beneficio: Array,
    },
    computed: {
        selectTipoBeneficio() {
            return this.tipo_beneficio.map((item) => {
                const obj = {
                    value: item.id_tipo_beneficio,
                    label: item.tipo,
                };
                return obj;
            });
        },
        selectCliente() {
            return this.empresa.map((item) => {
                const obj = {
                    value: item.id_pessoa,
                    label: item.razao_social,
                };
                return obj;
            });
        },
        selectFornecedor() {
            return this.fornecedores.map((item) => {
                const obj = {
                    value: item.id_fornecedor,
                    label: item.razao_social,
                };
                return obj;
            });
        },
        selectLotacao() {
            return this.lotacao.map((item) => {
                const obj = {
                    value: item.id_lotacao,
                    label: item.lotacao,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("empresa-beneficio.store"));
        },
    },
};
</script>
