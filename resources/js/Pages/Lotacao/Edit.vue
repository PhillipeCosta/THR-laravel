<template>
    <FormLayout title="Editar Lotação">
        <form @submit.prevent="submit">
            <div class="mb-4">
                <ThrLabel for="lotacao" value="Lotação" />
                <ThrInput
                    id="lotacao"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lotacao"
                    required
                    autofocus
                />
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <ThrLabel value="Empresa" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_pessoa"
                        required
                        :options="selectEmpresa"
                    />
                </div>
                <div>
                    <ThrLabel value="Feriado" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_feriado"
                        required
                        :options="selectGrupoFeriados"
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
                    :href="route('lotacao.index')"
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
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Switch,
        Select,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        FormLayout,
    },

    setup(props) {
        const form = useForm({
            lotacao: props.item.lotacao,
            id_feriado: props.item.id_feriado,
            id_pessoa: props.item.id_pessoa,
            ativo: props.item.ativo == 1 ? true : false,
        });

        return { form };
    },
    computed: {
        selectEmpresa() {
            return this.empresas.map((item) => {
                const obj = {
                    value: item.id_pessoa,
                    label: item.razao_social,
                };
                return obj;
            });
        },
        selectGrupoFeriados() {
            return this.grupo_feriados.map((item) => {
                const obj = {
                    value: item.id_grupo_feriados,
                    label: item.nome,
                };
                return obj;
            });
        },
    },
    data() {
        return {};
    },
    props: {
        item: Object,
        empresas: Array,
        grupo_feriados: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route("lotacao.update", this.item.id_lotacao),
                {}
            );
        },
    },
};
</script>
