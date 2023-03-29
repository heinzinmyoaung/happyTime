<template>
    <div class="loading-spinner" v-if="loading">
      <div class="spinner"></div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      loading: {
        type: Boolean,
        required: true
      }
    }
  }
  </script>
  
  <style>
  .loading-spinner {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    /* opacity: 0; */
    background-color: rgba(255, 255, 255, 0);
  }
  
  .spinner {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  