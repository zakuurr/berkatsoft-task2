<template>
  <div
    class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md"
  >
    <div class="flex place-content-end mb-4">
      <div
        class="px-4 py-2 text-white bg-success hover:bg-success rounded-md cursor-pointer"
      >
        <router-link
          :to="{ name: 'products.create' }"
          class="text-sm font-medium"
          > + </router-link
        >
      </div>
    </div>

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
              >Type</span
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
              >Stok</span
            >
          </th>
          <th class="px-6 py-3 bg-gray-50"></th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <template v-for="item in products" :key="item.id">
          <tr class="bg-white">
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.name }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.desc }}
            </td>

            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.type }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.formatted_price }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              {{ item.stok }}
            </td>
            <td
              class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"
            >
              <router-link
                :to="{ name: 'products.edit', params: { id: item.id } }"
                class="mr-2 inline-flex items-center px-4 py-2 bg-warning border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              >
                Edit
              </router-link>
              <button
                @click="deleteProduct(item.id)"
                class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              >
                Delete
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import useProducts from "../../moleculs/products";
import { onMounted } from "vue";

const { products, getProducts, destroyProduct } = useProducts();
onMounted(getProducts);
const deleteProduct = async (id) => {
  if (!window.confirm("Are you sure?")) {
    return;
  }
  await destroyProduct(id);
  await getProducts();
};
</script>
