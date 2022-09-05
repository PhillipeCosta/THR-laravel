<template>
    <FormLayout title="Cadastrar Faixa Etária">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
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
                    <ThrLabel
                        for="id_tipo_beneficio"
                        value="Tipo do benefício"
                    />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_tipo_beneficio"
                        :options="selectBeneficio"
                        required
                    />
                </div>

                <div>
                    <ThrLabel for="faixa_idade" value="Faixa de idade" />
                    <ThrInput
                        id="faixa_idade"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.faixa_idade"
                        required
                        autofocus
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel
                        for="valor_funcionario"
                        value="Valor funcionário"
                    />
                    <currency-input
                        id="valor_funcionario"
                        class="mt-1 block w-full"
                        v-model="form.valor_funcionario"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel for="valor_dependente" value="Valor dependente" />
                    <currency-input
                        id="valor_dependente"
                        class="mt-1 block w-full"
                        v-model="form.valor_dependente"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel
                        for="valor_empresa_compra"
                        value="Valor empresa compra"
                    />
                    <currency-input
                        id="valor_empresa_compra"
                        class="mt-1 block w-full"
                        v-model="form.valor_empresa_compra"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="data_cadastro" value="Data cadastro" />
                    <ThrInput
                        id="data_cadastro"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_cadastro"
                        @change="setEndContract"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel
                        for="data_fim_contrato"
                        value="Data fim contrato"
                    />
                    <ThrInput
                        id="data_fim_contrato"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_fim_contrato"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('faixa-etaria.index')"
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
                hideCurrencySymbolOnFocus: false,
                hideGroupingSeparatorOnFocus: false,
                hideNegligibleDecimalDigitsOnFocus: false,
                autoDecimalDigits: true,
                exportValueAsInteger: false,
                autoSign: true,
                useGrouping: true,
            },
            form: this.$inertia.form({
                id_tipo_beneficio: "",
                faixa_idade: "",
                id_fornecedor: "",
                valor_dependente: 0,
                valor_funcionario: 0,
                valor_empresa_compra: 0,
                data_cadastro: "",
                data_fim_contrato: "",
            }),
        };
    },
    props: {
        fornecedores: Array,
        beneficio: Array,
    },
    computed: {
        selectFornecedor() {
            return this.fornecedores.map((item) => {
                const obj = {
                    value: item.id_fornecedor,
                    label: item.razao_social,
                };
                return obj;
            });
        },
        selectBeneficio() {
            return this.beneficio.map((item) => {
                const obj = {
                    value: item.id_tipo_beneficio,
                    label: item.tipo,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("faixa-etaria.store"));
        },
        setEndContract(e) {
            const date = new Date(this.form.data_cadastro);
            if (date) {
                date.setFullYear(date.getFullYear() + 1);
                this.form.data_fim_contrato = new Date(date)
                    .toISOString()
                    .substring(0, 10);
            }
        },
    },
};
</script>
