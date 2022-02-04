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
                    <div class="grid grid-cols-3 gap-4 mb-4">
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
                    <div class="grid grid-cols-2 gap-4">
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

export default {
    components: {
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
                inicio: "",
                fim: "",
                valor: "",
                id_cliente: "",
                id_lotacao: "",
            }),
        };
    },
    props: {
        clientes: Array,
        lotacao: Array,
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
    },
    methods: {
        submit() {
            this.form.post(this.route("desconto-alimentacao.store"));
        },
    },
};
</script>
