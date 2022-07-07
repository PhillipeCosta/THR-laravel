<template>
    <FormLayout title="Cadastrar Funcionário Benefício">
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
                    <ThrLabel value="Funcionário" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_funcionario"
                        :options="selectiFuncionario"
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel value="Valor unitário" />
                    <currency-input
                        id="valor_unitario"
                        class="mt-1 block w-full"
                        v-model="form.valor_unitario"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel for="quantidade" value="Quantidade" />
                    <ThrInput
                        id="quantidade"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.quantidade"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="data_vigencia" value="Data vigência" />
                    <ThrInput
                        id="data_vigencia"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_vigencia"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('funcionario-beneficio.index')"
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
                id_funcionario: "",
                id_fornecedor: "",
                valor_unitario: "",
                quantidade: "",
                data_vigencia: "",
            }),
        };
    },
    props: {
        fornecedores: Array,
        funcionario: Array,
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
        selectFuncionario() {
            return this.funcionario.map((item) => {
                const obj = {
                    value: item.id_funcionario,
                    label: item.nome,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("funcionario-beneficio.store"));
        },
    },
};
</script>
