<template>
    <FormLayout title="Cadastrar Dependente">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div>
                    <ThrLabel
                        for="id_funcionario"
                        value="Funcionário"
                        class="mb-2"
                    />
                    <v-select
                        :reduce="(sel) => sel.value"
                        :options="selectFuncionario"
                        v-model="form.id_funcionario"
                        required
                    ></v-select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="col-span-2">
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
                <div>
                    <ThrLabel for="rg" value="RG" />
                    <ThrInput
                        id="rg"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.rg"
                        required
                        autofocus
                    />
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div>
                    <ThrLabel
                        for="data_nascimento"
                        value="Data de Nascimento"
                    />
                    <ThrInput
                        id="data_nascimento"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_nascimento"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="nome_mae" value="Nome da Mãe" />
                    <ThrInput
                        id="nome_mae"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome_mae"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="id_parentesco" value="Parentesco" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_parentesco"
                        required
                        :options="grauParentesco"
                    />
                </div>
                <div>
                    <ThrLabel
                        for="id_desconto_faixa_etaria"
                        value="Faixa Etária"
                    />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_desconto_faixa_etaria"
                        :options="selectfaixaEtaria"
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('dependente.index')"
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
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
    },

    data() {
        return {
            maskedValues: {
                rg: "",
                cpf: "",
            },
            form: this.$inertia.form({
                matricula_funcionario: "",
                nome: "",
                cpf: "",
                rg: "",
                data_nascimento: "",
                id_parentesco: "",
                nome_mae: "",
                id_desconto_faixa_etaria: "",
                id_parentesco: "",
                nome_funcionario: "",
                id_funcionario: "",
            }),
        };
    },
    props: {
        faixa_etaria: Array,
        grau_parentesco: Array,
        funcionario: Array,
    },
    computed: {
        selectFuncionario() {
            return this.funcionario.map((item) => {
                const obj = {
                    value: item.id_funcionario,
                    label: item.nome,
                };
                return obj;
            });
        },
        selectfaixaEtaria() {
            return this.faixa_etaria.map((item) => {
                const obj = {
                    value: item.id_desconto_faixa_etaria,
                    label: item.faixa_idade,
                };
                return obj;
            });
        },
        grauParentesco() {
            return this.grau_parentesco.map((item) => {
                const obj = {
                    value: item.id_grau_parentesco,
                    label: item.nome,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("dependente.store"));
        },
    },
};
</script>
