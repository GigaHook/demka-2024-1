<template>
  <v-app-bar>
    <v-app-bar-title class="mt-n3">
      Нарушениям<span class="text-h4">.</span>
      <v-chip
        color="black"
        variant="flat"
        class="rounded text-h5 px-2"
      >
        НЕТ
      </v-chip>
    </v-app-bar-title>

    <template v-if="!$page.props.user">
      <v-btn
        @click="$inertia.get(route('auth.loginpage'))"
        :active="$page.url == '/login'"
        text="Войти"
      />
      
      <v-btn
        @click="$inertia.get(route('auth.registerpage'))"
        :active="$page.url == '/register'"
        text="Регистрация"
      />
    </template>

    <template v-else>  
      <v-btn
        @click="$inertia.get(route('orders.index'))"
        :active="$page.url == '/orders'"
        :text="$page.props.user.admin ? 'Все заявки' : 'Мои заявки'"
      />

      <v-btn
        @click="$inertia.get(route('orders.create'))"
        :active="$page.url == 'orders/create'"
        text="Оставить заявку"
      />

      <v-btn
        @click="$inertia.get(route('auth.logout'))"
        text="Выйти"
      />
    </template>
  </v-app-bar>
</template>

<script setup>

</script>