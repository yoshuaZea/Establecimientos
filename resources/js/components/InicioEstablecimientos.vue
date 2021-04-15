<template>
    <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-gimnasio></categoria-gimnasio>
    </div>
</template>

<script>

// Importar componentes
import ListadoCategorias from './ListadoCategorias'
import CategoriaCafe from './CategoriaCafe'
import MapaEstablecimientos from './MapaEstablecimientos'
import CategoriaRestaurant from './CategoriaRestaurant'
import CategoriaGimnasio from './CategoriaGimnasio'

export default {
    components: {
        ListadoCategorias,
        MapaEstablecimientos,
        CategoriaCafe,
        CategoriaRestaurant,
        CategoriaGimnasio,
    }
}

</script>