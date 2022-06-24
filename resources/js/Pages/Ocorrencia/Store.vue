<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight mb-3"
                >
                    Cadastrar Ocorrência
                </h2>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <ThrLabel
                                for="id_funcionario"
                                value="Funcionário"
                            />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_funcionario"
                                :options="SelectFuncionario"
                            />
                        </div>
                        <div>
                            <ThrLabel for="id_ausencia" value="Ausência" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_ausencia"
                                required
                                :options="SelectAusencia"
                            />
                        </div>
                        <div>
                            <ThrLabel for="competencia" value="Competência" />
                            <ThrInput
                                id="competencia"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.competencia"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <ThrLabel
                                for="data_inicio"
                                value="Data de Início"
                            />
                            <ThrInput
                                id="data_inicio"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.data_inicio"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="data_fim" value="Data de Fim" />
                            <ThrInput
                                id="data_fim"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.data_fim"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="quantidade_dias" value="Qtd. Dias" />
                            <ThrInput
                                id="quantidade_dias"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.quantidade_dias"
                                required
                                autofocus
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-4">
                        <div>
                            <ThrLabel for="observacao" value="Observação" />
                            <ThrTextarea
                                id="observacao"
                                class="mt-1 block w-full"
                                v-model="form.observacao"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <LinkButton
                            class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                            :href="route('ocorrencia.index')"
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
import ThrTextarea from "@/Components/Global/Textarea.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import Select from "@/Components/Global/Select.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

export default {
    components: {
        LinkButton,
        ThrButton,
        ThrInput,
        ThrTextarea,
        ThrLabel,
        Select,
    },

    data() {
        return {
            form: this.$inertia.form({
                id_funcionario: "",
                id_ausencia: "",
                data_inicio: "",
                data_fim: "",
                competencia: "",
                quantidade_dias: "",
                observacao: "",
            }),
        };
    },
    props: {
        ausencia: Array,
        funcionario: Array,
    },
    computed: {
        SelectFuncionario() {
            return this.funcionario.map((item) => {
                const obj = {
                    value: item.id_funcionario,
                    label: item.nome,
                };
                return obj;
            });
        },
        SelectAusencia() {
            return this.ausencia.map((item) => {
                const obj = {
                    value: item.id_ausencia,
                    label: item.nome,
                };
                return obj;
            });
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("ocorrencia.store"));
        },
    },
};
</script>
