<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
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
                                    <span class="text-gray-500 sm:text-sm">
                                        %
                                    </span>
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
                                    <span class="text-gray-500 sm:text-sm">
                                        %
                                    </span>
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
            id_lotacao: props.item.id_lotacao,
            id_fornecedor: props.item.id_fornecedor,
            percentual_valor_funcionario:
                props.item.percentual_valor_funcionario,
            percentual_valor_dependente: props.item.percentual_valor_dependente,
        });

        return { form };
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
        };
    },
    props: {
        item: Object,
        fornecedores: Array,
        lotacao: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "empresa-beneficio.update",
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
