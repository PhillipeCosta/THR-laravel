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
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";
import CurrencyInput from "@/Components/Global/CurrencyInput";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Select,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        CurrencyInput,
    },

    setup(props) {
        const form = useForm({
            id_lotacao: props.item.id_lotacao,
            id_fornecedor: props.item.id_fornecedor,
            tipo_beneficio: props.item.tipo_beneficio,
            vigencia: new Date(props.item.vigencia).toISOString().substring(0, 10),
            valor_diario: props.item.valor_diario
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
        }
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
        fornecedores: Array,
        lotacao: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "compras-beneficios.update",
                    this.item.id_compra_beneficio
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
