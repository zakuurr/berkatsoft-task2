<template>
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content text-center">
    <div class="max-w-md">
      <h1 class="text-5xl font-bold">Hello there</h1>
      <p class="py-6"></p>
      <button class="btn btn-primary">Get Started</button>
    </div>
  </div>
</div>
</template>

<script setup>
import useDashboard from "@/moleculs/dashboard";
import { onMounted } from "vue";

const { sales, products, customers, getSales, getProducts, getCustomers } =
  useDashboard();

onMounted(getSales);
onMounted(getProducts);
onMounted(getCustomers);
</script>
