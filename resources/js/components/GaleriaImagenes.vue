<template>
    <div>
        <h2 class="mt-4">Galería de imágenes</h2>
        <ul class="row list-unstyled mt-4">
            <li class="col-md-4 mb-4 rounded" v-for="imagen in imagenes" v-bind:key="imagen.id">
                <a :href='`/storage/${imagen.ruta_img}`' data-lightbox="imagenes" data-title="Imagen establecimiento">
                    <img class="img-fluid" :src='`/storage/${imagen.ruta_img}`' alt="imagen"/>
                </a>
            </li>
        </ul>
    </div>
</template>
<script>

import { LightBox } from 'lightbox2'

export default {
    computed: {
        imagenes(){
            return this.$store.getters.obtenerImagenes
        }
    }
}
</script>

<style scoped>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css')
</style>