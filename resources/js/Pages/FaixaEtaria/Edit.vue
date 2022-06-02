<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <ThrLabel for="tipo_plano" value="Tipo do plano" />
                            <ThrInput
                                id="tipo_plano"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.tipo_plano"
                                required
                                autofocus
                            />
                        </div>

                        <div>
                            <ThrLabel
                                for="faixa_idade"
                                value="Faixa de idade"
                            />
                            <ThrInput
                                id="faixa_idade"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.faixa_idade"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel value="Fornecedor" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_fornecedor"
                                required
                                :options="selectFornecedor"
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
                            <ThrLabel
                                for="valor_dependente"
                                value="Valor dependente"
                            />
                            <currency-input
                                id="valor_dependente"
                                class="mt-1 block w-full"
                                v-model="form.valor_dependente"
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
                            :href="route('faixa-etaria.index')"
                        >
                            Voltar
                        </LinkButton>
                        <ThrButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Atualizar
                        </ThrButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ThrButton from "@/Components/Global/Button.vue";
import ThrInput from "@/Components/Global/Input.vue";
import Switch from "@/Components/Global/Switch.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";
import CurrencyInput from "@/Components/Global/CurrencyInput";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Switch,
        Select,
        LinkButton,
        CurrencyInput,
        ThrButton,
        ThrInput,
        ThrLabel,
    },

    setup(props) {
        const form = useForm({
            tipo_plano: props.item.tipo_plano,
            faixa_idade: props.item.faixa_idade,
            id_fornecedor: props.item.id_fornecedor,
            valor_dependente: props.item.valor_dependente,
            valor_funcionario: props.item.valor_funcionario,
            vigencia: props.item.vigencia,
        });

        return { form };
    },
    computed: {
        selectFornecedor() {
            /*return this.fornecedores.map((item) => {
                const obj = {
                    value: item.id_fornecedor,
                    label: item.razao_social,
                };
                return obj;
            });*/
        },
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
        };
    },
    props: {
        item: Object,
        //fornecedores: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "faixa-etaria.update",
                    this.item.id_desconto_faixa_etaria
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
