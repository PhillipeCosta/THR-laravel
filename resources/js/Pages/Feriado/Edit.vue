<template>
    <FormLayout title="Editar Feriado">
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <ThrLabel for="nome_grupo" value="Nome do Grupo" />
                    <ThrInput
                        id="nome_grupo"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nome_grupo"
                        required
                        autofocus
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
import LinkButton from "@/Components/Global/LinkButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        FormLayout,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },

    setup(props) {
        console.log(props.item);
        const form = useForm({
            nome_grupo: props.item.nome_grupo,
            descricao: props.item.descricao,
            data_feriado: new Date(props.item.data_feriado)
                .toISOString()
                .substring(0, 10),
        });

        return { form };
    },
    props: {
        item: Object,
    },
    methods: {
        submit() {
            this.form.put(this.route("feriado.update", this.item.id_feriado));
        },
    },
};
</script>
