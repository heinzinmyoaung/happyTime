<template>
    <div class="relative">
      <input
        class="block w-full p-4 text-lg border-b-2 border-gray-200 focus:outline-none focus:border-blue-500"
        type="text"
        placeholder="Search"
        @focus="onSearchBarFocus"
        @blur="onSearchBarBlur"
      />
      <div class="fixed bottom-0 w-full" v-show="isSearchBarFocused">
        <button
          class="w-full p-4 text-white bg-blue-500 hover:bg-blue-600 focus:outline-none"
        >
          Confirm
        </button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isSearchBarFocused: false
      };
    },
    computed: {
      showConfirmButton() {
        return this.isSearchBarFocused;
      }
    },
    methods: {
      onSearchBarFocus() {
        this.isSearchBarFocused = true;
      },
      onSearchBarBlur() {
        this.isSearchBarFocused = false;
      }
    }
  };
  </script>
  