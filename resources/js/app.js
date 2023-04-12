import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from "vue";
import router from '@/router/index.js'
import DashboardIndex from '@/components/dashboard/DashboardIndex.vue'
import CustomersIndex from '@/components/customers/CustomersIndex.vue'
import ProductsIndex from '@/components/products/ProductsIndex.vue'
import SalesIndex from '@/components/sales/SalesIndex.vue'

createApp({
    components: {
        DashboardIndex,
        CustomersIndex,
        ProductsIndex,
        SalesIndex,
    }
}).use(router).mount('#app')
