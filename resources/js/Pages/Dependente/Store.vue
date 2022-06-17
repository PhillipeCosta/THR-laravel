<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <form @submit.prevent="submit">
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
                                @maska="
                                    form.cpf =
                                        $event.target.dataset.maskRawValue
                                "
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
                    <div class="grid grid-cols-3 gap-4 mb-4">
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
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <ThrLabel
                                for="id_desconto_faixa_etaria"
                                value="Faixa Etária"
                            />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_desconto_faixa_etaria"
                                required
                                :options="faixaEtaria"
                            />
                        </div>
                        <div>
                            <ThrLabel
                                for="matricula_funcionario"
                                value="Matrícula Funcionário"
                            />
                            <ThrInput
                                id="matricula_funcionario"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.matricula_funcionario"
                                required
                                autofocus
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

export default {
    components: {
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
                tipo: "",
                matricula_funcionario: "",
                nome: "",
                cpf: "",
                rg: "",
                data_nascimento: "",
                id_parentesco: "",
                nome_mae: "",
                id_desconto_faixa_etaria: "",
                nome_pessoa_registro: "",
            }),
        };
    },
    props: {
        faixa_etaria: Array,
        grau_parentesco: Array,
    },
    computed: {
        faixaEtaria() {
            return this.faixa_etaria.map((item) => {
                const obj = {
                    value: item.id_desconto_faixa_etaria,
                    label: item.tipo_plano,
                };
                return obj;
            });
        },
        grauParentesco() {
            return this.grau_parentesco.map((item) => {
                const obj = {
                    value: item.id_desconto_faixa_etaria,
                    label: item.tipo_plano,
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
