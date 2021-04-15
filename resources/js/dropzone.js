
document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#dropzone')){
        Dropzone.autoDiscover = false
    
        const dropzone = new Dropzone('div#dropzone', {
            url: '/imagenes/store',
            dictDefaultMessage: 'Sube hasta 10 imágenes',
            acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar',
            dictUploadCanceled: 'Cancelado',
            dictCancelUpload: 'Cancelar',
            maxFiles: 10,
            maxFilesize: 1000,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            init: function(){
                // Si hay una imagen cargada y hubo un error al enviar el form
                const galeria = document.querySelectorAll('.galeria')
                
                if(galeria.length > 0){
                    galeria.forEach(imagen => {
                        const imagenPublicada = {}
                        imagenPublicada.size = 1
                        imagenPublicada.name = imagen.value
                        imagenPublicada.fileNameServer = imagen.value

                        // Agregarlo a dropzone
                        this.options.addedfile.call(this, imagenPublicada)
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`)

                        imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
                    })
                }
                
            },
            success: function(file, response){
                // file - lo que se envía
                // response - respuesta del servidor
                // console.log(response)
                
                file.fileNameServer = response.fileNameServer
            },
            sending: function(file, xhr, formData){
                formData.append('uuid', document.querySelector('#uuid').value)
                // console.log('Enviando...')
            },
            error: function(file, response){
                // console.log(file)
                // console.log(response)
                document.querySelector('#error').textContent = 'Formato no válido'
            },
            maxfilesreached: function(file){
                console.log(file)
            },
            maxfilesexceeded: function(file){
                // console.log(file, this.files)
                if(this.files[9] != null){
                    this.removeFile(this.files[0])
                    // console.log(this.files)

                    // Eliminar los que tuvieron error
                    this.files = this.files.filter(fl => fl.status != 'error')
                    // console.log(this.files)

                    this.addFile(file) // Agregar el nuevo archivo
                    // console.log(this.files)

                    // Eliminar del DOM
                    file.previewElement.previousElementSibling.remove()
                }
            },
            removedfile: function(file, response){
                // console.log('El archivo borrado fue: ', file)
                document.querySelector('#error').textContent = ''

               const params = {
                    imageDelete: file.fileNameServer,
                    uuid: document.querySelector('#uuid').value
                }

                axios.post('/imagenes/destroy', params)
                    .then(response => {
                        // console.log(response)

                        // Eliminar imagen previa
                        file.previewElement.parentNode.removeChild(file.previewElement)
                    })
                    .catch(error => console.log(error.response))
            }
        })
    }
})