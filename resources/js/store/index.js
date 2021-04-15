// EL STORE ES EL STATE CENTRALIZADO COMO REDUX/CONTEXT DE REACT

import Vue from 'vue'
import Vuex from 'vuex'

// Integrar Vuex pa Vue para administrar el store
Vue.use(Vuex)

export default new Vuex.Store({
    // STATE GLOBAL
    state: {
        cafes: [],
        totalCafes: 0,
        restaurants: [],
        totalRestaurants: 0,
        gimnasios: [],
        totalGimnasios: 0,
        establecimiento: {},
        establecimientos: {},
        categorias: [],
        categoria: ''
    }, 
    // SON LOS TYPES COMO EN REDUX/CONTEXT DE REACT
    mutations: {
        AGREGAR_CAFES(state, cafes){
            state.cafes = cafes
            state.totalCafes = cafes.length
        },
        AGREGAR_RESTAURANTS(state, restaurants){
            state.restaurants = restaurants
            state.totalRestaurants = restaurants.length
        },
        AGREGAR_GIMNASIOS(state, gimnasios){
            state.gimnasios = gimnasios
            state.totalGimnasios = gimnasios.length
        },
        CONSULTAR_ESTABLECIMIENTO(state, establecimiento){
            state.establecimiento = establecimiento
        },
        CONSULTAR_ESTABLECIMIENTOS(state, establecimientos){
            state.establecimientos = establecimientos
        },
        CONSULTAR_CATEGORIAS(state, categorias){
            state.categorias = categorias
        },
        SELECCIONAR_CATEGORIA(state, categoria){
            state.categoria = categoria
        },
        AGREGAR_ESTABLECIMIENTOS(state, establecimientos){
            state.establecimientos = establecimientos
        },
    },
    getters: {
        obtenerEstablecimiento: state => {
            return state.establecimiento
        },
        obtenerEstablecimientos: state => {
            return state.establecimientos
        },
        obtenerImagenes: state => {
            return state.establecimiento.imagenes
        },
        obtenerCategorias: state => {
            return state.categorias
        },
        obtenerCategoria: state => {
            return state.categoria
        }
    }
})