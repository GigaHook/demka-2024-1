<template>
  <Head>
    <title>
      Авторизация
    </title>
  </Head>

  <v-card-title>
    Авторизация
  </v-card-title>

  <v-card-text>
    <v-form
      ref="form"
      @submit.prevent="submit"
      validate-on="blur"
      :readonly="formData.processing"
    >
      <v-text-field
        label="Логин"
        v-model="formData.login"
        :error-messages="formData.errors.login"
        :rules="[rules.required, rules.max]"
        @update:model-value="formData.clearErrors('login')"
      />

      <v-text-field
        label="Пароль"
        v-model="formData.password"
        :error-messages="formData.errors.password"
        :rules="[rules.required, rules.max]"
        @update:model-value="formData.clearErrors('password')"
        type="password"
      />

      <v-btn
        variant="flat"
        color="black"
        type="submit"
        text="Войти"
        :loading="formData.processing"
      />

      <v-btn
        variant="text"
        text="Ещё нет аккаунта?"
        @click="$inertia.get(route('auth.registerpage'))"
      />
    </v-form>
  </v-card-text>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormLayout from '@/Layouts/FormLayout.vue'
import { ref, defineOptions } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'

defineOptions({ layout: [AppLayout, FormLayout] })

const form = ref()
const formData = useForm({
  login: '',
  password: '',
})

const rules = {
  required: v => !!v || 'Это поле нужно заполнить',
  max: v => v?.length <= 100 || 'Слишком длинное значение',
}

function submit() {
  form.value.validate().then(() => form.value.isValid && formData.post(route('auth.login')))
}
</script>