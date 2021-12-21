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
                            Cadastrar
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

export default {
    components: {
        Switch,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
        Select,
    },

    data() {
        return {
            form: this.$inertia.form({
                inicio: "",
                fim: "",
                id_cliente: "",
                ativo: false,
            }),
        };
    },
    props: {
        clientes: Array,
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
    methods: {
        submit() {
            //this.form.ativo = this.form.ativo == false ? 0 : 1;
            this.form.post(this.route("faixa-salarial.store"));
        },
    },
};
</script>
