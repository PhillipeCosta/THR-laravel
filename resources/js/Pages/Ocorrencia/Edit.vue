<template>
    <FormLayout title="Editar Ocorrência">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="id_funcionario" value="Funcionário" />
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
                        type="Date"
                        class="mt-1 block w-full"
                        v-model="form.competencia"
                        required
                        autofocus
                    />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="data_inicio" value="Data de Início" />
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
import ThrTextarea from "@/Components/Global/Textarea.vue";

import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        ThrTextarea,
        Select,
        FormLayout,
    },

    setup(props) {
        const form = useForm({
            id_funcionario: props.item.id_funcionario,
            id_ausencia: props.item.id_ausencia,
            data_inicio: props.item.data_inicio,
            data_fim: props.item.data_fim,
            competencia: new Date(props.item.competencia)
                .toISOString()
                .substring(0, 10),
            quantidade_dias: props.item.quantidade_dias,
            observacao: props.item.observacao,
        });
        return { form };
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
    props: {
        item: Object,
        ausencia: Array,
        funcionario: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route("ocorrencia.update", this.item.id_ocorrencia)
            );
        },
    },
};
</script>
