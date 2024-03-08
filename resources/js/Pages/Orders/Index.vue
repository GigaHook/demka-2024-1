<template>
  <Head>
    <title>{{ $page.props.user?.admin ? 'Заявки' : 'Мои заявки' }}</title>
  </Head>

  <v-data-table-virtual :items="orders.data">
    <template #item.Статус="{ value, item }">
      <v-select
        v-if="$page.props.user?.admin"
        :items="['Новое', 'Подтверждено', 'Отклонено']"
        :model-value="value"
        variant="plain"
        style="width: 150px !important;"
        chips
        @update:model-value="value => $inertia.patch(route('orders.update', item.ID), {
          'status': value,
        })"
      />

      <v-chip v-else>
        {{ value }}
      </v-chip>
    </template>

    <template #no-data>
      У вас ещё нет заявок <br>
      <v-btn 
        text="Добавить"
        class="ma-2"
        @click="$inertia.get(route('orders.create'))"
      />
    </template>
  </v-data-table-virtual>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { defineOptions } from 'vue'
import { Head } from '@inertiajs/vue3'

defineOptions({ layout: AppLayout })
defineProps({ orders: Object })
</script>