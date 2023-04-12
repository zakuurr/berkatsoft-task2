import { createRouter, createWebHistory } from "vue-router";

import DashboardIndex from '@/components/dashboard/DashboardIndex.vue'

// Customers
import CustomersIndex from '@/components/customers/CustomersIndex.vue'
import CustomersCreate from '@/components/customers/CustomersCreate.vue'
import CustomersEdit from '@/components/customers/CustomersEdit.vue'

// Products
import ProductsIndex from '@/components/products/ProductsIndex.vue'
import ProductsCreate from '@/components/products/ProductsCreate.vue'
import ProductsEdit from '@/components/products/ProductsEdit.vue'

// Sales
import SalesIndex from '@/components/sales/SalesIndex.vue'
import SalesCreate from '@/components/sales/SalesCreate.vue'
import SalesDetail from '@/components/sales/SalesDetail.vue'

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardIndex
    },
    
    // Customer
    {
        path: '/customers',
        name: 'customers.index',
        component: CustomersIndex
    },
    {
        path: '/customers/create',
        name: 'customers.create',
        component: CustomersCreate
    },
    {
        path: '/customers/:id/edit',
        name: 'customers.edit',
        component: CustomersEdit,
        props: true
    },

    // Products
    {
        path: '/products',
        name: 'products.index',
        component: ProductsIndex
    },
    {
        path: '/products/create',
        name: 'products.create',
        component: ProductsCreate
    },
    {
        path: '/products/:id/edit',
        name: 'products.edit',
        component: ProductsEdit,
        props: true
    },

    // Sales
    {
        path: '/sales',
        name: 'sales.index',
        component: SalesIndex
    },
    {
        path: '/sales/create',
        name: 'sales.create',
        component: SalesCreate
    },
    {
        path: '/sales/:id/show',
        name: 'sales.show',
        component: SalesDetail,
        props: true
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
