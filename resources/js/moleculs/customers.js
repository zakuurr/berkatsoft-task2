import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCustomers() {
    const customers = ref([])
    const customer = ref([])
    const router = useRouter()
    const errors = ref('')

    const getCustomers = async () => {
        let response = await axios.get('/api/customers')
        customers.value = response.data.payload.data;
    }

    const getCustomer = async (id) => {
        let response = await axios.get('/api/customers/' + id)
        customer.value = response.data.payload.data;
    }

    const storeCustomer = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/customers', data)
            await router.push({name: 'customers.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateCustomer = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/customers/' + id, customer.value)
            await router.push({name: 'customers.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyCustomer = async (id) => {
        await axios.delete('/api/customers/' + id)
    }


    return {
        customers,
        customer,
        errors,
        getCustomers,
        getCustomer,
        storeCustomer,
        updateCustomer,
        destroyCustomer
    }
}
