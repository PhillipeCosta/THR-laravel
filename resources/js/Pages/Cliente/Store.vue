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
                    <div class="mb-4">
                        <ThrLabel for="cliente" value="Cliente" />
                        <ThrInput
                            id="cliente"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.cliente"
                            required
                            autofocus
                        />
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div>
                            <ThrLabel value="Desconta plano de saúde" />
                            <Switch
                                v-model:checked="form.desconta_plano_saude"
                            />
                        </div>
                        <div>
                            <ThrLabel value="Desconta plano odontológico" />
                            <Switch
                                v-model:checked="
                                    form.desconta_plano_odontologico
                                "
                            />
                        </div>
                        <div>
                            <ThrLabel value="Desconta plano de vida" />
                            <Switch
                                v-model:checked="form.desconta_plano_vida"
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
                            :href="route('cliente.index')"
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
import LinkButton from "@/Components/LinkButton.vue";

export default {
    components: {
        Switch,
        LinkButton,
        ThrButton,
        ThrInput,
        ThrLabel,
    },

    data() {
        return {
            form: this.$inertia.form({
                cliente: "",
                desconta_plano_saude: false,
                desconta_plano_odontologico: false,
                desconta_plano_vida: false,
                ativo: false,
            }),
        };
    },

    methods: {
        submit() {
            //this.form.ativo = this.form.ativo == false ? 0 : 1;
            this.form.post(this.route("cliente.store"));
        },
    },
};
</script>
