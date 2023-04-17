import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useSales() {
    const sales = ref([])
    const sale = ref([])
    const router = useRouter()
    const errors_sale = ref('')

    const getSales = async () => {
        let response = await axios.get('/api/sales')
        sales.value = response.data.data;
    }

    const getSale = async (id) => {
        let response = await axios.get('/api/sales/' + id)
        sale.value = response.data.data;
    }

    const storeSale = async (data) => {
        errors_sale.value = ''
        try {
            await axios.post('/api/sales', data)
            await router.push({ name: 'sales.index' })
        } catch (e) {
            console.log(e);
            if (e.response.status === 422) {
                errors_sale.value = e.response.data.errors
            }
        }
    }

    const destroySale = async (id) => {
        await axios.delete('/api/sales/' + id)
    }


    return {
        sales,
        sale,
        errors_sale,
        getSales,
        getSale,
        storeSale,
        destroySale
    }
}
