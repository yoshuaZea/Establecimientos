/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Importando el router para Vue
import router from './router'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagina-inicio', require('./components/PaginaInicio.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 // Agregar el router dentro del objeto de Vue
const app = new Vue({
    el: '#app',
    router
});

require('./mapa');
require('./dropzone');
require('./establecimiento');


import { Toast } from './helpers'
const actionMsg = document.querySelector('#actionMsg')

const showNotification = () => {
    let type = actionMsg.dataset.type.trim()
    let msg = actionMsg.dataset.msg.trim()

    if(type == 'success'){
        Toast.fire({
            icon: 'success',
            title: msg
        })
    } else if(type == 'warning'){
        Toast.fire({
            icon: 'warning',
            title: msg
        })
    }
    else if(type == 'error'){
        Toast.fire({
            icon: 'error',
            title: msg,
            timer: 7000,
        })
    } else if(type == 'info'){
        Swal.fire({
            icon: 'info',
            confirmButtonColor: '#374151',
            confirmButtonText: 'Entendido',
            html: `Se capturó con éxito el reporte con número de folio <b>${msg}</b>, recuérdale que próximamente uno de nuestros asesores se pondrá en contacto con él/ella.
                   <br><br>Recuérdale al cliente que estará recibiendo la llamada desde una lada 777/664`
        })
    }

    // Limpiar
    actionMsg.dataset.type = ''
    actionMsg.dataset.msg = ''
}
document.addEventListener('DOMContentLoaded', () => {
    showNotification()
})
