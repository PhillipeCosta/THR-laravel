<template>
    <FormLayout title="Cadastrar Empresa">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="col-span-2">
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
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel
                        for="inscricao_estadual"
                        value="Inscrição Estadual"
                    />
                    <ThrInput
                        id="inscricao_estadual"
                        type="text"
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
                <div>
                    <ThrLabel for="contato" value="Contato" />
                    <ThrInput
                        id="contato"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.contato"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="tipo" value="Tipo" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.tipo"
                        required
                        :options="tipos"
                    />
                </div>
                <div>
                    <ThrLabel for="cnae" value="CNAE" />
                    <ThrInput
                        id="cnae"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.cnae"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="codigo_empresa_folha" value="Código Folha" />
                    <ThrInput
                        id="codigo_empresa_folha"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.codigo_empresa_folha"
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
                        v-model="form.numero_endereco"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-4">
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
                <div>
                    <ThrLabel for="complemento" value="Complemento" />
                    <ThrInput
                        id="complemento"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.complemento"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('empresa.index')"
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
                numero_endereco: "",
                cep: "",
                bairro: "",
                cidade: "",
                estado: "",
                complemento: "",
                tipo: "",
                codigo_empresa_folha: "",
                telefone: "",
                inscricao_estadual: "",
                tipo_beneficio: "",
                cnae: "",
                contato: "",
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
        tipos() {
            return [
                {
                    value: 1,
                    label: "Cliente",
                },
                {
                    value: 2,
                    label: "Empresa",
                },
            ];
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("empresa.store"));
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
