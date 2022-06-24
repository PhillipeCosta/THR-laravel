<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight mb-3"
                >
                    Editar Funcionário Benefício
                </h2>
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
                            <ThrLabel
                                for="data_vigencia"
                                value="Data vigência"
                            />
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
            id_funcionario: props.item.id_funcionario,
            id_fornecedor: props.item.id_fornecedor,
            valor_unitario: props.item.valor_unitario,
            quantidade: props.item.quantidade,
            data_vigencia: new Date(props.item.data_vigencia).toISOString().substring(0, 10),
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
        funcionario: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "funcionario-beneficio.update",
                    this.item.id_funcionario_beneficio
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
