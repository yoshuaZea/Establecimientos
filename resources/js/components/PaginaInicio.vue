<template>
    <div>
        <vue-page-transition name="fade-in-up">
            <router-view></router-view>
        </vue-page-transition>
    </div>
</template>

<script>

// Importar el store
import store from '../store'

export default {
    store,
    mount() {
        console.log('Component mounted.')
    }
}

</script>
