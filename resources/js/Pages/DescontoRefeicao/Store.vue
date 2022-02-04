<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4 mb-4">
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
                            <ThrLabel value="Faixa Salarial" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_faixa_salarial"
                                required
                                :options="selectFaixaSalarial"
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
                        <div>
                            <ThrLabel value="Status" />
                            <Switch v-model:checked="form.ativo" />
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <LinkButton
                            class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                            :href="route('desconto-refeicao.index')"
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
            </div>
        </div>
    </div>
</template>

<script>
import ThrButton from "@/Components/Button.vue";
import ThrInput from "@/Components/Input.vue";
import CurrencyInput from "@/Components/CurrencyInput";
import ThrLabel from "@/Components/Label.vue";
import Select from "@/Components/Select.vue";
import LinkButton from "@/Components/LinkButton.vue";
import Switch from "@/Components/Switch.vue";

export default {
    components: {
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
        CurrencyInput,
        Switch,
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
                ativo: false,
                valor: "",
                id_cliente: "",
                id_faixa_salarial: "",
            }),
        };
    },
    props: {
        clientes: Array,
        faixa: Array,
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
        selectFaixaSalarial() {
            return this.faixa.map((item) => {
                const obj = {
                    value: item.id_faixa_salarial,
                    label: item.salario,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("desconto-refeicao.store"));
        },
    },
};
</script>
