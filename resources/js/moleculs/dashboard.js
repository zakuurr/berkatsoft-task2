import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useDashboard() {
    const sales = ref([])
    const products = ref([])
    const customers = ref([])
    const errors = ref('')

    const getSales = async () => {
        let response = await axios.get('/api/sales')
        sales.value = response.data.data;
    }

    const getProducts = async () => {
        let response = await axios.get('/api/products')
        products.value = response.data.payload.data;
    }

    const getCustomers = async () => {
        let response = await axios.get('/api/customers')
        customers.value = response.data.payload.data;
    }

    return {
        sales,
        customers,
        products,
        errors,
        getSales,
        getProducts,
        getCustomers,
    }
}
