<template>
    <FormLayout title="Cadastrar Funcionario">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="col-span-3">
                    <ThrLabel for="nome" value="Nome" />
                    <ThrInput
                        id="nome"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="cpf" value="CPF" />
                    <ThrInput
                        id="cpf"
                        type="text"
                        v-maska="'###.###.###-##'"
                        @maska="form.cpf = $event.target.dataset.maskRawValue"
                        class="mt-1 block w-full"
                        v-model="maskedValues.cpf"
                        required
                        autofocus
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="rg" value="RG" />
                    <ThrInput
                        id="rg"
                        type="Number"
                        class="mt-1 block w-full"
                        v-model="form.rg"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="pis" value="PIS" />
                    <ThrInput
                        id="pis"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.pis"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="cargo" value="Cargo" />
                    <ThrInput
                        id="cargo"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.cargo"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="matricula" value="Matrícula" />
                    <ThrInput
                        id="matricula"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.matricula"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="centro_custo" value="Centro de custo" />
                    <ThrInput
                        id="centro_custo"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.centro_custo"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel
                        for="numero_centro_custo"
                        value="Nº Centro de custo"
                    />
                    <ThrInput
                        id="numero_centro_custo"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.numero_centro_custo"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="data_admissao" value="Admissão" />
                    <ThrInput
                        id="data_admissao"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_admissao"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="data_demissao" value="Demissão" />
                    <ThrInput
                        id="data_demissao"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_demissao"
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="data_adesao_plano" value="Adesão plano" />
                    <ThrInput
                        id="data_adesao_plano"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_adesao_plano"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="id_lotacao" value="Lotação" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_lotacao"
                        required
                        :options="selectLotacao"
                    />
                </div>
                <div>
                    <ThrLabel for="id_faixa_salarial" value="Faixa salarial" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_faixa_salarial"
                        required
                        :options="selectFaixaSalarial"
                    />
                </div>
                <!--<div>
                            <ThrLabel
                                for="id_desconto_faixa_etaria"
                                value="Faixa etária"
                            />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_desconto_faixa_etaria"
                                :options="selectFaixaEtaria"
                            />
                        </div>-->
            </div>

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
                    <ThrLabel for="total_desconto_va" value="Desc. VA" />
                    <ThrInput
                        id="total_desconto_va"
                        type="Number"
                        class="mt-1 block w-full"
                        v-model="form.total_desconto_va"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="total_desconto_vr" value="Desc. VR" />
                    <ThrInput
                        id="total_desconto_vr"
                        type="Number"
                        class="mt-1 block w-full"
                        v-model="form.total_desconto_vr"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-5 gap-4 mb-4">
                <div class="col-span-2">
                    <ThrLabel for="numero_cartao" value="Nº cartão" />
                    <ThrInput
                        id="numero_cartao"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.numero_cartao"
                        required
                        autofocus
                    />
                </div>
                <div class="col-span-2">
                    <ThrLabel for="id_jornada" value="Jornada" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_jornada"
                        required
                        :options="selectJornada"
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
                    :href="route('funcionario.index')"
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
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import Switch from "@/Components/Global/Switch.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";
import CurrencyInput from "@/Components/Global/CurrencyInput";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
        Switch,
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
            maskedValues: {
                cpf: "",
            },
            form: this.$inertia.form({
                matricula: "",
                nome: "",
                ativo: "",
                centro_custo: "",
                cargo: "",
                cpf: "",
                pis: "",
                data_admissao: "",
                data_demissao: "",
                data_adesao_plano: "",
                id_lotacao: "",
                id_faixa_salarial: "",
                rg: "",
                id_jornada: "",
                numero_cartao: "",
                salario: "",
                numero_centro_custo: "",
                total_desconto_va: "",
                total_desconto_vr: "",
                nome_pessoa_registro: "",
            }),
        };
    },
    props: {
        faixa_salarial: Array,
        faixa_etaria: Array,
        lotacao: Array,
        jornada: Array,
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
        selectFaixaSalarial() {
            return this.faixa_salarial.map((item) => {
                const obj = {
                    value: item.id_faixa_salarial,
                    label: item.salario,
                };
                return obj;
            });
        },
        selectFaixaEtaria() {
            return this.faixa_etaria.map((item) => {
                const obj = {
                    value: item.id_desconto_faixa_etaria,
                    label: item.faixa_idade,
                };
                return obj;
            });
        },
        selectJornada() {
            return this.jornada.map((item) => {
                const obj = {
                    value: item.id_jornada,
                    label: item.nome,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("funcionario.store"));
        },
    },
};
</script>
