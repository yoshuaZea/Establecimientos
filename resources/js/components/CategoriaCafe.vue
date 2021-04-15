<template>
    <div class="container my-5">
        <h2>Cafés</h2>

        <div class="row">
            <div :class="totalCafes > 2 ? 'col-md-4' : 'col-md-6'" v-for="cafe in this.cafes" v-bind:key="cafe.id">
                <div class="card mb-3">
                    <img class="card-img-top" :src="`storage/${cafe.imagen_principal}`" alt="card" />
                    <div class="card-body">
                        <h4 class="card-title text-primery font-weight-bold">{{ cafe.nombre }}</h4>
                        <p class="card-text">{{ cafe.direccion }}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">{{ cafe.apertura }} - {{ cafe.cierre }}</span>
                        </p>
                        <router-link :to="{ name: 'establecimiento', params: { id: cafe.id } }">
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
        axios.get('/api/categorias/cafe')
            .then(response => {
                this.$store.commit('AGREGAR_CAFES', response.data)
            })
            .catch(error => console.log(error))
    },
    computed: {
        cafes(){
            return this.$store.state.cafes
        },
        totalCafes(){
            return this.$store.state.totalCafes
        }
    }
}
</script>