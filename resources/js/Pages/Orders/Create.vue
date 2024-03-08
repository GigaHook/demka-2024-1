<template>
  <Head>
    <title>Оставить заявку</title>
  </Head>
  
  <v-card-title>
    Оставить заявку
  </v-card-title>

  <v-card-text>
    <v-form
      ref="form"
      @submit.prevent="submit"
      validate-on="blur"
      :readonly="formData.processing"
    >
      <v-text-field
        label="Номер автомобиля"
        v-model="formData.number"
        :error-messages="formData.errors.number"
        :rules="[rules.required, rules.max]"
        @update:model-value="formData.clearErrors('number')"
      />

      <v-textarea
        label="Описание"
        v-model="formData.description"
        :error-messages="formData.errors.description"
        :rules="[rules.required, rules.desc]"
        @update:model-value="formData.clearErrors('description')"
      />

      <v-btn
        type="submit"
        color="black"
        text="Добавить"
        :loading="formData.processing"
      />
    </v-form>
  </v-card-text>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FormLayout from '@/Layouts/FormLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref, defineOptions } from 'vue'

defineOptions({ layout: [AppLayout, FormLayout] })

const form = ref()
const formData = useForm({
  number: '',
  description: '',
})

const rules = {
  required: v => !!v || 'Это поле нужно заполнить',
  max: v => v?.length <= 100 || 'Слишком длинное значение',
  desc: v => v?.length <= 4000 || 'Максимум 4000 символов',
}

function submit() {
  form.value.validate().then(() => form.value.isValid && formData.post(route('orders.store')))
}
</script>