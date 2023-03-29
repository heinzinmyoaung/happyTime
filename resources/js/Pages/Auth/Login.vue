<template>
    <form @submit.prevent="login">
      <div class="w-1/2 xl:w-1/3 mx-auto">
        <div v-if="form.errors.incorrectEmailOrPass" class="bg-red-100 border border-red-400 text-center m-auto py-1 text-gray-800">
            {{ form.errors.incorrectEmailOrPass }}
        </div>
        <div>
          <label for="email" class="label">E-mail (username)</label>
          <input id="email" v-model="form.email" type="text" class="input" />
          <div  v-if="form.errors.email" class="error">{{ form.errors.email }} </div>
        </div>
        <div class="mt-4">
          <label for="password" class="label">Password</label>
          <input id="password" v-model="form.password" type="password" class="input" />
          <div  v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
        </div>
        <div class="mt-4">
          <button class="button w-full" type="submit">Login</button>
        </div>
        
        <div class="mt-2 text-center">
          <Link :href="`/user-account/create`" class="text-sm text-gray-500">
            Need an account? Click here
          </Link>
        </div>
       

      </div>
    </form>
  </template>
  
  <script setup>

  import { useForm, Link } from '@inertiajs/vue3';

  const form = useForm({
    email: null,
    password: null,
  })
  const login = () => form.post(route('login.store'))
  </script>