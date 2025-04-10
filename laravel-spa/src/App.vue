<template>
    <div :class="['app-container', theme]">
      <mdb-navbar container class="px-3">
        <mdb-navbar-brand href="#">📚 Book App</mdb-navbar-brand>

        <template #right>
          <mdb-btn color="light" size="sm" @click="toggleTheme">
            <span v-if="theme === 'light'">🌙 Dark</span>
            <span v-else>☀️ Light</span>
          </mdb-btn>
        </template>
      </mdb-navbar>

      <router-view />
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import { MDBNavbar, MDBNavbarBrand, MDBBtn } from 'mdb-vue-ui-kit'
  import { useToast } from 'vue-toastification'
  import api from './api'

  const theme = ref('light')
  const toast = useToast()

  onMounted(() => {
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme) {
      theme.value = savedTheme
      document.documentElement.setAttribute('data-bs-theme', theme.value)
    }
  })

  const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light'
    document.documentElement.setAttribute('data-bs-theme', theme.value)
    localStorage.setItem('theme', theme.value)
    toast.success(`Theme changed to ${theme.value}`)
  }
  </script>

  <style scoped>
  .app-container {
    min-height: 100vh;
    background-color: var(--bs-body-bg);
    color: var(--bs-body-color);
  }
  </style>
