import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useCarts() {
    var carts = ref([])
    const cart = ref([])
    const router = useRouter()
    const errors = ref('')


    const getCarts = async () => {

    }

    const storeCart = async (qty, product) => {
    
        if (carts.value.find((cart) => cart.id === product.id)) {
            carts.value.map((cart) => {
                if (cart.id === product.id) {
                    cart.qty = parseInt(cart.qty) + parseInt(qty);
                }
            });
            return;
        }
        
        carts.value.push({
            qty: qty,
            id: product.id,
            name: product.name,
            desc: product.desc,
            price: product.price,
        });
    }

    const confirmUpdate = async (qty, product) => {
        if (carts.value.find((cart) => cart.id === product.id)) {
            carts.value.map((cart) => {
                if (cart.id === product.id) {
                    cart.qty = qty;
                }
            });
            return;
        }

        storeCart(qty, product);
    }

    const getCartData = async (index) => {
        return carts.value[index];
    }

    const destroyCart = async (index) => {
        carts.value.splice(index, 1);
    }

    return {
        carts,
        cart,
        errors,
        getCarts,
        storeCart,
        getCartData,
        destroyCart,
        confirmUpdate,
    }
}