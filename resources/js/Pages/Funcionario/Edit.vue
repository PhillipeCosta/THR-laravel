<template>
    <FormLayout title="Editar Funcionário">
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
                        required
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
                    Alterar
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
import LinkButton from "@/Components/Global/LinkButton.vue";
import CurrencyInput from "@/Components/Global/CurrencyInput";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        CurrencyInput,
        ThrLabel,
        Select,
    },

    data() {
        return {
            maskedValues: {
                cpf: "",
            },
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

    setup(props) {
        const form = useForm({
            matricula: props.item.matricula,
            nome: props.item.nome,
            ativo: props.item.ativo,
            centro_custo: props.item.centro_custo,
            cargo: props.item.cargo,
            cpf: props.item.cpf,
            pis: props.item.pis,
            data_admissao: props.item.data_admissao,
            data_demissao: props.item.data_demissao,
            data_adesao_plano: props.item.data_adesao_plano,
            id_lotacao: props.item.id_lotacao,
            id_faixa_salarial: props.item.id_faixa_salarial,
            rg: props.item.rg,
            id_jornada: props.item.id_jornada,
            numero_cartao: props.item.numero_cartao,
            salario: props.item.salario,
            numero_centro_custo: props.item.numero_centro_custo,
            total_desconto_va: props.item.total_desconto_va,
            total_desconto_vr: props.item.total_desconto_vr,
            nome_pessoa_registro: props.item.nome_pessoa_registro,
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
        maskedValues() {
            return {
                cpf: this.item.cpf,
            };
        },
    },
    props: {
        item: Object,
        faixa_salarial: Array,
        faixa_etaria: Array,
        lotacao: Array,
        jornada: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route("funcionario.update", this.item.id_funcionario)
            );
        },
    },
};
</script>
