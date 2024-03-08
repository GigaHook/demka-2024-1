<template>
  <Head>
    <title>
      Регистрация
    </title>
  </Head>

  <v-card-title>
    Регистрация
  </v-card-title>

  <v-card-text>
    <v-form
      ref="form"
      @submit.prevent="submit"
      validate-on="blur"
      :readonly="formData.processing"
    >
      <v-text-field
        label="ФИО"
        v-model="formData.fio"
        :error-messages="formData.errors.fio"
        :rules="[rules.required, rules.max, rules.rus]"
        @update:model-value="formData.clearErrors('fio')"
      />

      <v-text-field
        label="Логин"
        v-model="formData.login"
        :error-messages="formData.errors.login"
        :rules="[rules.required, rules.max]"
        @update:model-value="formData.clearErrors('login')"
      />

      <v-text-field
        label="Телефон"
        v-model="formData.tel"
        :error-messages="formData.errors.tel"
        :rules="[rules.required, rules.max, rules.tel]"
        @update:model-value="formData.clearErrors('tel')"
        v-mask="'+7(###)-###-##-##'"
        type="tel"
      />

      <v-text-field
        label="Почта"
        v-model="formData.email"
        :error-messages="formData.errors.email"
        :rules="[rules.required, rules.max, rules.email]"
        @update:model-value="formData.clearErrors('email')"
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
        text="Зарегистрироваться"
        :loading="formData.processing"
      />
      
      <v-btn
        variant="text"
        text="Уже есть аккаунт?"
        @click="$inertia.get(route('auth.loginpage'))"
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
  fio: '',
  login: '',
  tel: '',
  email: '',
  password: '',
})

const rules = {
  required: v => !!v || 'Это поле нужно заполнить',
  max: v => v?.length <= 100 || 'Слишком длинное значение',
  rus: v => (!!v && /[а-яА-ЯёЁ\s]/g.test(v)) || 'Только кириллица',
  email: v => (!!v && /([\w]+@[\w]+\.[\w])/g.test(v)) || 'Введите почту правильно',
  tel: v => v?.length == 17 || 'Введите телефон полностью'
}

function submit() {
  form.value.validate().then(() => form.value.isValid && formData.post(route('auth.register')))
}
</script>