<template>
    <FormLayout title="Editar Faixa Salarial">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="salario" value="Salario" />
                    <currency-input
                        id="salario"
                        class="mt-1 block w-full"
                        v-model="form.salario"
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

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="valor_desc_vr" value="Valor Desc. VR" />
                    <currency-input
                        id="valor_desc_vr"
                        class="mt-1 block w-full"
                        v-model="form.valor_desc_vr"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel for="valor_desc_vt" value="Valor Desc. VT" />
                    <currency-input
                        id="valor_desc_vt"
                        class="mt-1 block w-full"
                        v-model="form.valor_desc_vt"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
                <div>
                    <ThrLabel for="valor_desc_va" value="Valor Desc. VA" />
                    <currency-input
                        id="valor_desc_va"
                        class="mt-1 block w-full"
                        v-model="form.valor_desc_va"
                        required
                        :options="moneyCurrencyOptions"
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <ThrLabel value="Benefício" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_compra_beneficio"
                        required
                        :options="selectBeneficio"
                    />
                </div>
                <div>
                    <ThrLabel value="Lotação" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_lotacao"
                        required
                        :options="selectLotacao"
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
                    :href="route('faixa-salarial.index')"
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
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        FormLayout,
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
            valor_desc_vr: props.item.valor_desc_vr,
            valor_desc_vt: props.item.valor_desc_vt,
            valor_desc_va: props.item.valor_desc_va,
            id_compra_beneficio: props.item.id_compra_beneficio,
            id_lotacao: props.item.id_lotacao,
            salario: props.item.salario,
            inicio: new Date(props.item.inicio).toISOString().substring(0, 10),
            fim: new Date(props.item.fim).toISOString().substring(0, 10),
            ativo: props.item.ativo == 1 ? true : false,
        });

        return { form };
    },
    computed: {
        selectLotacao() {
            return this.lotacao.map((item) => {
                const obj = {
                    value: item.id_lotacao,
                    label: item.lotacao,
                };
                return obj;
            });
        },
        selectBeneficio() {
            return this.compra_beneficio.map((item) => {
                const obj = {
                    value: item.id_compra_beneficio,
                    label: item.tipo_beneficio,
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
        lotacao: Array,
        compra_beneficio: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "faixa-salarial.update",
                    this.item.id_faixa_salarial
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
