<template>
    <Head title="Log in" />

    <BreezeValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Senha" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Lembra minha conta</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Criar minha conta
            </Link>

            <Link :href="route('password.request')" class="ml-4 underline text-sm text-gray-600 hover:text-gray-900">
                Esqueceu sua senha?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Entrar
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Global/Button.vue'
import BreezeCheckbox from '@/Components/Global/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Global/Input.vue'
import BreezeLabel from '@/Components/Global/Label.vue'
import BreezeValidationErrors from '@/Components/Global/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
