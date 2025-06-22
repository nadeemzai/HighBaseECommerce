<template>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">🛒 My Shop</h1>

    <!-- Category Filter -->
    <div class="mb-4">
      <label for="category" class="block font-semibold mb-2">Filter by Category:</label>
      <select v-model="selectedCategory" @change="fetchProducts" class="border rounded p-2">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>

    <!-- Product List -->
    <div v-if="products?.length" class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div v-for="product in products" :key="product.id" class="bg-white shadow-md p-4 rounded">
        <h3 class="text-lg font-bold mb-2">{{ product.name }}</h3>
        <p class="text-sm text-gray-600">
          Category: {{ product.category?.name || 'N/A' }}
        </p>
      </div>
    </div>
    <div v-else class="text-gray-500 text-sm">No products found.</div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const selectedCategory = ref('')
const products = ref([])
const categories = ref([])

  const fetchProducts = async () => {
    const token = localStorage.getItem('auth_token') 
    const url = selectedCategory.value
      ? `http://localhost:8000/api/v1/products?category_id=${selectedCategory.value}`
      : `http://localhost:8000/api/v1/products`

    try {
      const res = await $fetch(url, {
        method: 'GET',
        credentials: 'include', 
        headers: {
          'Authorization': `Bearer ip6POcepVb3NZ4W2nv3xhcCMORvqe0oi3qsH5ZRX52d5105d`,
          'Accept': 'application/json',
        }
      })

      products.value = res.data
    } catch (error) {
      console.error('Fetch failed:', error)
      if (error.response?.status === 401) {
        // Optionally handle token expiration
        localStorage.removeItem('auth_token')
        // navigateTo('/login')
      }
    }
  }


  const fetchCategories = async () => {
    const res = await $fetch('http://localhost:8000/api/v1/categories', {
      credentials: 'include',
    })
    categories.value = res.data
  }

  // Fetch on mount
  onMounted(() => {
    fetchCategories()
    fetchProducts()
  })
  </script>
