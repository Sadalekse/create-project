<template>
    <div class="container">
      <div class="form-container">
        <h2 class="text-center">Login</h2>
        <form @submit.prevent="login">
          <div class="input-container">
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

          <button type="submit" class="submit-btn">Login</button>
          <p v-if="error" class="error-message">{{ error }}</p>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import api from '../api';
  import { useToast } from 'vue-toastification';
  import { useRouter } from 'vue-router';
  import { onMounted } from 'vue';

  onMounted(() => {
  toggleTheme()
})


  const toast = useToast();
  const email = ref('');
  const password = ref('');
  const error = ref('');
  const user = ref(null);
  const router = useRouter();

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

  const login = async () => {
  error.value = ''
  try {
    await api.get('/sanctum/csrf-cookie')

    const token = decodeURIComponent(
      document.cookie
        .split('; ')
        .find(row => row.startsWith('XSRF-TOKEN='))
        ?.split('=')[1]
    )

    api.defaults.headers.common['X-XSRF-TOKEN'] = token

    await api.post('/api/login', {
      email: email.value,
      password: password.value
    })

    const { data } = await api.get('/api/user')
    user.value = data

    toast.success('Login successful!')
    router.push('/books')
  } catch (err) {
  error.value = 'Login failed. Check credentials.'
  toast.error(error.value)
  console.error(err)
}
}
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
