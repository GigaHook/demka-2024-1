<template>
  <v-app>
    <Header/>

    <v-main class="main">
      <v-container>
        <slot/>
      </v-container>
    </v-main>

    <v-footer class="footer">
      (c) Нарушениям.Нет 2024
    </v-footer>
  </v-app>
</template>

<script setup>
import Header from '@/Components/Header.vue'
</script>

<style scoped>
.main{
	min-height: calc(100vh - 128px);
}

.footer{
	max-height: 64px !important;
}
</style>