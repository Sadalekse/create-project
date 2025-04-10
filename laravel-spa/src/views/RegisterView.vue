<template>
    <div class="container">
      <div class="form-container">
        <h2 class="text-center">Register</h2>
        <form @submit.prevent="register">
          <div class="input-container">
            <input
              v-model="name"
              type="text"
              placeholder="Full Name"
              class="input"
              required
            />
            <input
              v-model="email"
              type="email"
              placeholder="Email"
              class="input"
              required
            />
            <input
              v-model="password"
              type="password"
              placeholder="Password"
              class="input"
              required
            />
            <input
              v-model="passwordConfirmation"
              type="password"
              placeholder="Confirm Password"
              class="input"
              required
            />
          </div>

          <div class="theme-toggle">
            <label for="theme-toggle">Dark Mode</label>
            <input
              type="checkbox"
              id="theme-toggle"
              v-model="isDarkMode"
              @change="toggleTheme"
            />
          </div>

          <button type="submit" class="submit-btn">Register</button>
          <p v-if="error" class="error-message">{{ error }}</p>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import api from '../api';

  const name = ref('');
  const email = ref('');
  const password = ref('');
  const passwordConfirmation = ref('');
  const error = ref('');

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

  const register = async () => {
    error.value = '';
    try {
      const response = await api.post('/api/register', {
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
      });
      const loginResponse = await api.post('/api/login', {
        email: email.value,
        password: password.value,
      });
      localStorage.setItem('token', loginResponse.data.access_token);
      alert('Registration successful and logged in!');
    } catch (err) {
      error.value = 'Registration failed. Check your details.';
      console.error(err);
    }
  };
  </script>

  <style scoped>
  .container {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .form-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .input-container {
    display: flex;
    flex-direction: column;
  }

  .input {
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f8f8;
  }

  .submit-btn {
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  .submit-btn:hover {
    background-color: #0056b3;
  }

  .theme-toggle {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
  }

  .error-message {
    color: red;
    text-align: center;
  }

  input[type="checkbox"] {
    margin-right: 10px;
  }
  </style>
