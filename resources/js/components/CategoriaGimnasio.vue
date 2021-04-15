<template>
    <div class="container my-5">
        <h2>Gimnasios</h2>

        <div class="row">
            <div :class="totalGimnasios > 2 ? 'col-md-4' : 'col-md-6'" v-for="gimnasio in this.gimnasios" v-bind:key="gimnasio.id">
                <div class="card mb-3">
                    <img class="card-img-top" :src="`storage/${gimnasio.imagen_principal}`" alt="card" />
                    <div class="card-body">
                        <h4 class="card-title text-primery font-weight-bold">{{ gimnasio.nombre }}</h4>
                        <p class="card-text">{{ gimnasio.direccion }}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">{{ gimnasio.apertura }} - {{ gimnasio.cierre }}</span>
                        </p>
                        <router-link :to="{ name: 'establecimiento', params: { id: gimnasio.id } }">
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
        axios.get('/api/categorias/gimnasios')
            .then(response => {
                this.$store.commit('AGREGAR_GIMNASIOS', response.data)
            })
            .catch(error => console.log(error))
    },
    computed: {
        gimnasios(){
            return this.$store.state.gimnasios
        },
        totalGimnasios(){
            return this.$store.state.totalGimnasios
        }
    }
}
</script>