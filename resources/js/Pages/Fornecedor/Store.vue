<template>
    <FormLayout title="Cadastrar Fornecedor">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <ThrLabel for="razao_social" value="Razão Social" />
                    <ThrInput
                        id="razao_social"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.razao_social"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="nome_fantasia" value="Nome Fantasia" />
                    <ThrInput
                        id="nome_fantasia"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome_fantasia"
                        required
                        autofocus
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="cnpj" value="CNPJ" />
                    <ThrInput
                        id="cnpj"
                        type="text"
                        v-maska="'##.###.###/####-##'"
                        @maska="form.cnpj = $event.target.dataset.maskRawValue"
                        class="mt-1 block w-full"
                        v-model="maskedValues.cnpj"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel
                        for="inscricao_estadual"
                        value="Inscrição Estadual"
                    />
                    <ThrInput
                        id="inscricao_estadual"
                        type="Number"
                        class="mt-1 block w-full"
                        v-model="form.inscricao_estadual"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="telefone" value="Telefone" />
                    <ThrInput
                        id="telefone"
                        type="text"
                        v-maska="['(##) #####-####', '(##) ####-####']"
                        @maska="
                            form.telefone = $event.target.dataset.maskRawValue
                        "
                        class="mt-1 block w-full"
                        v-model="maskedValues.telefone"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="tipos_beneficio" value="Tipo Benefício" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.tipos_beneficio"
                        required
                        multiple
                        :options="selectBeneficio"
                        @change="changeBeneficio"
                    />
                </div>
                <div v-if="isTrans" class="col-span-2">
                    <ThrLabel
                        for="pat"
                        value="Programa de alimentação do trabalhador"
                    />
                    <ThrInput
                        id="pat"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.pat"
                        required
                        autofocus
                    />
                </div>
                <div v-if="isSaude" class="col-span-2">
                    <ThrLabel for="ans" value="ANS" />
                    <ThrInput
                        id="ans"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ans"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-5 gap-4 mb-4">
                <div>
                    <ThrLabel for="cep" value="CEP" />
                    <ThrInput
                        v-maska="'##.###-###'"
                        @maska="form.cep = $event.target.dataset.maskRawValue"
                        id="cep"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="maskedValues.cep"
                        required
                        autofocus
                        @blur="searchCEP($event.target.dataset.maskRawValue)"
                    />
                </div>
                <div class="col-span-3">
                    <ThrLabel for="endereco" value="Endereço" />
                    <ThrInput
                        id="endereco"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.endereco"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="numero" value="Número" />
                    <ThrInput
                        id="numero"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.numero"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="bairro" value="Bairro" />
                    <ThrInput
                        id="bairro"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bairro"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="cidade" value="Cidade" />
                    <ThrInput
                        id="cidade"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.cidade"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="estado" value="Estado" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.estado"
                        required
                        :options="ufs"
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('fornecedor.index')"
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

import ufs from "@/enums/ufs";

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
            isSaude: false,
            isTrans: false,
            maskedValues: {
                cep: "",
                telefone: "",
                cnpj: "",
            },
            form: this.$inertia.form({
                razao_social: "",
                nome_fantasia: "",
                cnpj: "",
                endereco: "",
                numero: "",
                cep: "",
                bairro: "",
                cidade: "",
                estado: "",
                ans: "",
                telefone: "",
                inscricao_estadual: "",
                tipos_beneficio: [],
                pat: "",
            }),
        };
    },
    props: {
        beneficio: Array,
    },
    computed: {
        ufs() {
            return ufs.map((item) => {
                const obj = {
                    value: item,
                    label: item,
                };
                return obj;
            });
        },
        selectBeneficio() {
            return this.beneficio.map((item) => {
                const obj = {
                    value: item.id_tipo_beneficio,
                    label: item.tipo,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("fornecedor.store"));
        },
        changeBeneficio(event) {
            this.beneficioRules(event.target.value);
        },
        beneficioRules(value) {
            if (value) {
                const type = this.beneficio.find(
                    ({ id_tipo_beneficio }) => id_tipo_beneficio === value
                );
                if (type.tipo === "Plano de Saúde") {
                    this.isSaude = true;
                    this.isTrans = false;
                } else if (type.tipo === "Transporte") {
                    this.isSaude = false;
                    this.isTrans = true;
                } else {
                    this.isSaude = false;
                    this.isTrans = false;
                }
            }
        },
        searchCEP(cep) {
            if (cep.length == 8) {
                fetch("https://viacep.com.br/ws/" + cep + "/json/", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        this.form = {
                            ...this.form,
                            endereco: data.logradouro,
                            bairro: data.bairro,
                            estado: data.uf,
                            cidade: data.localidade,
                        };
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }
        },
    },
};
</script>
