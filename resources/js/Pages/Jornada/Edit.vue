<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
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
                            <ThrLabel for="dia_semana" value="Dia da Semana" />
                            <ThrInput
                                id="dia_semana"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.dia_semana"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="nome_horario" value="Horário" />
                            <ThrInput
                                id="nome_horario"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.nome_horario"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <LinkButton
                            class="hover:bg-gray-700 active:bg-gray-900 bg-gray-800 mr-3"
                            :href="route('jornada.index')"
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
            </div>
        </div>
    </div>
</template>

<script>
import ThrButton from "@/Components/Global/Button.vue";
import ThrInput from "@/Components/Global/Input.vue";
import ThrLabel from "@/Components/Global/Label.vue";
import LinkButton from "@/Components/Global/LinkButton.vue";

import ufs from "@/enums/ufs";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },

    setup(props) {
        console.log(props.item);
        const form = useForm({
            nome: props.item.nome,
            dia_semana: props.item.dia_semana,
            nome_horario: props.item.nome_horario,
        });

        return { form };
    },
    props: {
        item: Object,
    },
    methods: {
        submit() {
            this.form.put(this.route("jornada.update", this.item.id_jornada));
        },
    },
};
</script>
