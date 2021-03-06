<template>
    <FormLayout title="Cadastrar Benefícios">
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
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <ThrLabel for="tipo_beneficio" value="Tipo" />
                    <ThrInput
                        id="tipo_beneficio"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.tipo_beneficio"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="valor_diario" value="Valor diário" />
                    <currency-input
                        id="valor_diario"
                        class="mt-1 block w-full"
                        v-model="form.valor_diario"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel for="vigencia" value="Vigência" />
                    <ThrInput
                        id="vigencia"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.vigencia"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('compras-beneficios.index')"
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
import CurrencyInput from "@/Components/Global/CurrencyInput";
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
        CurrencyInput,
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
                id_lotacao: "",
                id_fornecedor: "",
                tipo_beneficio: "",
                vigencia: "",
                valor_diario: "",
            }),
        };
    },
    props: {
        fornecedores: Array,
        lotacao: Array,
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
        selectLotacao() {
            return this.lotacao.map((item) => {
                const obj = {
                    value: item.id_lotacao,
                    label: item.lotacao,
                };
                return obj;
            });
        },
        selectTipo() {
            return [
                {
                    value: "Refeição",
                    label: "Refeição",
                },
                {
                    value: "Alimentaçã",
                    label: "Alimentaçã",
                },
            ];
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("compras-beneficios.store"));
        },
    },
};
</script>
