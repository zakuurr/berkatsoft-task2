<template>
  <div v-if="errors">
    <div
      v-for="(v, k) in errors"
      :key="k"
      class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0"
    >
      <p v-for="error in v" :key="error" class="text-sm">
        {{ error }}
      </p>
    </div>
  </div>

  <form class="space-y-6" v-on:submit.prevent="saveProduct">
    <div class="space-y-4 rounded-md shadow-sm mb-5">
      <div>
        <label for="invoice_no" class="block text-sm font-medium text-gray-700"
          >UUID</label
        >
        <p class="font-bold">{{ sale.uuid }}</p>
      </div>
      <div>
        <label for="invoice_no" class="block text-sm font-medium text-gray-700"
          >Customer</label
        >
        <p class="font-bold">{{ sale.customer?.name }}</p>
      </div>
      <div>
        <label for="invoice_no" class="block text-sm font-medium text-gray-700"
          >Transaction Date</label
        >
        <p class="font-bold">{{ sale.formatted_created_at }}</p>
      </div>
      <div>
        <table class="min-w-full border divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-6 py-3 bg-gray-50">
              <span
                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
                >Product Name</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50">
              <span
                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
                >Description</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50">
              <span
                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
                >Price</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50">
              <span
                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
                >Qty</span
              >
            </th>
            <th class="px-6 py-3 bg-gray-50">
              <span
                class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"
                >Subtotal</span
              >
            </th>
          </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
          <template v-for="item in sale.sales_order_details" :key="item.id">
            <tr class="bg-white">
              <td
                class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
              >
                {{ item.product?.name }}
              </td>
              <td
                class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
              >
                {{ item.product?.desc }}
              </td>
              <td
                class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
              >
                {{ item.product?.formatted_price }}
              </td>
              <td
                class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
              >
                {{ item.qty }}
              </td>
              <td
                class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
              >
                {{ item.qty * item.product?.price }}
              </td>
            </tr>
          </template>
        </tbody>
      </table>
      </div>
    </div>

    <div
      class="px-4 inline py-2 text-white bg-yellow-600 hover:bg-yellow-700 rounded-md cursor-pointer"
    >
      <router-link :to="{ name: 'sales.index' }" class="text-sm font-medium"
        >Back</router-link
      >
    </div>
  </form>
</template>

<script setup>
import useSales from "@/moleculs/sales";
import { onMounted } from "vue";

const { errors, sale, getSale } = useSales();
const props = defineProps({
  id: {
    required: true,
    type: String,
  },
});

onMounted(getSale(props.id));
</script>
