<template>
    <div class="container my-5">
        <h2>Restaurants</h2>

        <div class="row">
            <div :class="totalRestaurants > 2 ? 'col-md-4' : 'col-md-6'" v-for="restaurant in this.restaurants" v-bind:key="restaurant.id">
                <div class="card mb-3">
                    <img class="card-img-top" :src="`storage/${restaurant.imagen_principal}`" alt="card" />
                    <div class="card-body">
                        <h4 class="card-title text-primery font-weight-bold">{{ restaurant.nombre }}</h4>
                        <p class="card-text">{{ restaurant.direccion }}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">{{ restaurant.apertura }} - {{ restaurant.cierre }}</span>
                        </p>
                        <router-link :to="{ name: 'establecimiento', params: { id: restaurant.id } }">
                            <a class="btn btn-primary d-block">Ver lugar</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
           
        }
    },
    mounted() {
        axios.get('/api/categorias/restaurant')
            .then(response => {
                this.$store.commit('AGREGAR_RESTAURANTS', response.data)
            })
            .catch(error => console.log(error))
    },
    computed: {
        restaurants(){
            return this.$store.state.restaurants
        },
        totalRestaurants(){
            return this.$store.state.totalRestaurants
        }
    } 
}
</script>