<template>
    <div class="bg-gray-100">
        <div class="flex items-center container mx-auto h-screen">
            <div
                class="
                    rounded
                    overflow-hidden
                    flex-grow
                    shadow-lg
                    p-10
                    bg-white
                "
            >
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <ThrLabel for="inicio" value="Início" />
                            <ThrInput
                                id="inicio"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.inicio"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <ThrLabel for="fim" value="Fim" />
                            <ThrInput
                                id="fim"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.fim"
                                required
                                autofocus
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <ThrLabel value="Cliente" />
                            <Select
                                class="mt-1 block w-full"
                                v-model="form.id_cliente"
                                required
                                :options="selectClientes"
                            />
                        </div>
                        <div>
                            <ThrLabel value="Status" />
                            <Switch v-model:checked="form.ativo" />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <LinkButton
                            class="
                                hover:bg-gray-700
                                active:bg-gray-900
                                bg-gray-800
                                mr-3
                            "
                            :href="route('faixa-salarial.index')"
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
import ThrButton from "@/Components/Button.vue";
import ThrInput from "@/Components/Input.vue";
import Switch from "@/Components/Switch.vue";
import ThrLabel from "@/Components/Label.vue";
import Select from "@/Components/Select.vue";
import LinkButton from "@/Components/LinkButton.vue";
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
            inicio: new Date(props.item.inicio).toISOString().substring(0, 10),
            fim: new Date(props.item.fim).toISOString().substring(0, 10),
            id_cliente: props.item.id_cliente,
            ativo: props.item.ativo == 1 ? true : false,
        });

        return { form };
    },
    computed: {
        selectClientes() {
            return this.clientes.map((item) => {
                const obj = {
                    value: item.id_cliente,
                    label: item.cliente,
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
        clientes: Array,
    },
    methods: {
        submit() {
            this.form.put(
                this.route(
                    "faixa-salarial.update",
                    this.item.id_faixa_salarial
                ),
                {
                    //onFinish: () => this.form.reset("password", "password_confirmation"),
                }
            );
        },
    },
};
</script>
