<template>
    <transition name="fade">
      <div v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
          <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold dark:text-white">{{ isEditMode ? 'Edit Book' : isRestoreMode ? 'Restore Book' : 'New Book' }}</h2>
            <button @click="$emit('close')" class="text-gray-500 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">&times;</button>
          </div>

          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium dark:text-white">Title</label>
              <input v-model="form.title" class="w-full rounded-lg border p-2 dark:bg-gray-900 dark:text-white" required />
            </div>

            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium dark:text-white">Author</label>
              <input v-model="form.author" class="w-full rounded-lg border p-2 dark:bg-gray-900 dark:text-white" required />
            </div>

            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium dark:text-white">Description</label>
              <textarea v-model="form.description" class="w-full rounded-lg border p-2 dark:bg-gray-900 dark:text-white"></textarea>
            </div>

            <div class="mb-4">
              <label class="block mb-1 text-sm font-medium dark:text-white">Published Date</label>
              <input type="date" v-model="form.published_date" class="w-full rounded-lg border p-2 dark:bg-gray-900 dark:text-white" />
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" class="rounded px-4 py-2 text-sm dark:text-white" @click="$emit('close')">Cancel</button>
              <button type="submit" :disabled="loading" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                {{ loading ? 'Saving...' : (isRestoreMode ? 'Restore' : 'Save') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </template>

  <script setup>
  import { ref, watch, onMounted } from 'vue'
  import api from '../api'

  const props = defineProps(['visible', 'book', 'isEditMode', 'isRestoreMode'])
  const emit = defineEmits(['close', 'updated'])

  const form = ref({ title: '', author: '', description: '', published_date: '' })
  const loading = ref(false)

  watch(() => props.book, (book) => {
    if (book) form.value = { ...book }
  })

  const submitForm = async () => {
    loading.value = true
    try {
      if (props.isRestoreMode) {
        await api.post(`/api/books/${props.book.id}/restore`)
      } else if (props.isEditMode) {
        await api.put(`/api/books/${props.book.id}`, form.value)
      } else {
        await api.post('/api/books', form.value)
      }
      emit('updated')
      emit('close')
    } catch (e) {
      console.error(e)
      alert('An error occurred')
    } finally {
      loading.value = false
    }
  }
  </script>

  <style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s ease;
  }
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>
