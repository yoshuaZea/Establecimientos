import { listenersInputs, runReplacers, validateForm } from './helpers'

const form = document.querySelector('#form-establecimiento')

document.addEventListener('DOMContentLoaded', () => {
    
    runReplacers()
    listenersInputs('#form-establecimiento')
})

 // Validación de formulario
 if(form){
    form.addEventListener('submit', e => {
        const array = [...form.elements]

        if(!validateForm(array)){
            e.preventDefault()
        }
    })
}