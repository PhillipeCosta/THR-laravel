<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="
                    rounded
                    overflow-hidden
                    flex-grow
                    shadow-lg
                    p-10
                    bg-white
                "
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div>
                            <ThrLabel for="tipo" value="Tipo" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.tipo"
                                required
                                :options="selectTipo"
                            />
                        </div>
                        <div>
                            <ThrLabel for="valor" value="Valor" />
                            <currency-input
                                id="valor"
                                class="mt-1 block w-full"
                                v-model="form.valor"
                                required
                                :options="moneyCurrencyOptions"
                            />
                        </div>
                        <div>
                            <ThrLabel for="inicio" value="Início" />
                            <ThrInput
                                id="inicio"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.inicio"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="fim" value="Fim" />
                            <ThrInput
                                id="fim"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.fim"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <ThrLabel value="Lotacao" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_lotacao"
                                required
                                :options="selectLotacao"
                            />
                        </div>
                        <div>
                            <ThrLabel value="Cliente" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_cliente"
                                required
                                :options="selectClientes"
                            />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <LinkButton
                            class="
                                hover:bg-gray-700
                                active:bg-gray-900
                                bg-gray-800
                                mr-3
                            "
                            :href="route('compras-refeicao.index')"
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
            inicio: new Date(props.item.inicio).toISOString().substring(0, 10),
            fim: new Date(props.item.fim).toISOString().substring(0, 10),
            id_cliente: props.item.id_cliente,
            valor: props.item.valor,
            tipo: props.item.tipo,
            id_lotacao: props.item.id_lotacao
        });

        return { form };
    },
    computed: {
        selectClientes() {
            return this.clientes.map((item) => {
                const obj = {
                    value: item.id_cliente,
                    label: item.cliente,
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
        clientes: Array,
        lotacao: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "compras-refeicao.update",
                    this.item.id_compras_refeicao
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
