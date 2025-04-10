<template>
    <div class="container">
      <div class="header">
        <h2>Books List</h2>
        <div class="theme-toggle">
          <label for="theme-toggle">Dark Mode</label>
          <input
            type="checkbox"
            id="theme-toggle"
            v-model="isDarkMode"
            @change="toggleTheme"
          />
        </div>
      </div>

      <div v-if="books.length" class="books-list">
        <div v-for="book in books" :key="book.id" class="book-item">
          <h3>{{ book.title }}</h3>
          <p>{{ book.author }}</p>
          <p>{{ book.description }}</p>
          <p><strong>Published:</strong> {{ book.published_date }}</p>
          <button @click="deleteBook(book.id)">Delete</button>
        </div>
      </div>
      <div v-else>
        <p>No books available.</p>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue';
  import api from '../api';

  const books = ref([]);
  const isDarkMode = ref(localStorage.getItem('theme') === 'dark');

  const toggleTheme = () => {
    if (isDarkMode.value) {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
    }
  };

  const getBooks = async () => {
    try {
      const { data } = await api.get('/api/books');
      books.value = data;
    } catch (err) {
      console.error(err);
    }
  };

  const deleteBook = async (id) => {
    try {
      await api.delete(`/api/books/${id}`);
      books.value = books.value.filter(book => book.id !== id);
    } catch (err) {
      console.error(err);
    }
  };

  onMounted(() => {
    getBooks();
  });
  </script>

  <style scoped>
  .container {
    width: 100%;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .theme-toggle {
    display: flex;
    align-items: center;
  }

  .theme-toggle label {
    margin-right: 10px;
  }

  .books-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .book-item {
    padding: 15px;
    background-color: #f8f8f8;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .book-item h3 {
    margin: 0;
    font-size: 1.2em;
    font-weight: bold;
  }

  .book-item p {
    margin: 5px 0;
  }

  .book-item button {
    background-color: #e74c3c;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .book-item button:hover {
    background-color: #c0392b;
  }
  </style>
