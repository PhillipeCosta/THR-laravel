<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="rounded overflow-hidden flex-grow shadow-lg p-10 bg-white"
            >
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight mb-3"
                >
                    Editar Lotação
                </h2>
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
                                :options="selectFeriado"
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
            </div>
        </div>
    </div>
</template>

<script>
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
        selectFeriado() {
            return this.feriados.map((item) => {
                const obj = {
                    value: item.id_feriado,
                    label: item.nome_grupo,
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
        feriados: Array,
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
