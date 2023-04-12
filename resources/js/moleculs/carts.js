import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCarts() {
    const carts = ref([])
    const cart = ref([])
    const router = useRouter()
    const errors = ref('')


    const getCarts = async () => {
        let response = await axios.get('/get_cart_user')
        carts.value = response.data.data;
    }

    const storeCart = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/carts', data)
            await router.push({name: 'sales.create'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyCart = async (id) => {
        await axios.delete('/api/carts/' + id)
    }


    return {
        carts,
        cart,
        errors,
        getCarts,
        storeCart,
        destroyCart
    }
}
