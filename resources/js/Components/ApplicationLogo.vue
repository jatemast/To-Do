<template>

    <div>
        <img :src="imagePath" alt="Logo" />
      </div>
    </template>
    
    <script>
    export default {
      data() {
        return {
          imagePath: '/images/logo.webp'  
        };
      }
    };
    </script>
 
