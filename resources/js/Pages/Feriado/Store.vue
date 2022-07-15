<template>
    <FormLayout title="Cadastrar Feriado">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="id_grupo_feriados" value="Nome do Grupo" />
                    <Select
                        class="mt-1 block w-full"
                        v-model="form.id_grupo_feriados"
                        required
                        :options="selectGrupoFeriados"
                    />
                </div>
                <div>
                    <ThrLabel for="descricao" value="Descrição do Feriado" />
                    <ThrInput
                        id="descricao"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.descricao"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <ThrLabel for="data_feriado" value="Data" />
                    <ThrInput
                        id="data_feriado"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.data_feriado"
                        required
                        autofocus
                    />
                </div>
            </div>

            <div class="text-center mt-4">
                <LinkButton
                    class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                    :href="route('feriado.index')"
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
import LinkButton from "@/Components/Global/LinkButton.vue";
import Select from "@/Components/Global/Select.vue";

export default {
    components: {
        Select,
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                id_grupo_feriados: "",
                descricao: "",
                data_feriado: "",
            }),
        };
    },
    props: {
        grupo_feriados: Array,
    },
    computed: {
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
    methods: {
        submit() {
            this.form.post(this.route("feriado.store"));
        },
    },
};
</script>
