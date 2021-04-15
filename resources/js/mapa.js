import { OpenStreetMapProvider } from 'leaflet-geosearch';

const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')){
        const lat = document.querySelector('#lat').value == '' ? 18.9481814 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value == '' ? -99.1980451 : document.querySelector('#lng').value;

        const mapa = L.map('mapa').setView([lat, lng], 16)

        // Eliminar pines previos
        let markers = new L.FeatureGroup().addTo(mapa)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa)
        
        // agregar el pin
        let marker = new L.marker([lat, lng],{
            draggable: true, // Mover pin
            autoPan: true, // Mover mapa automáticamente al mover pin
        }).addTo(mapa)

        // Agregar el pin al cargar la página
        markers.addLayer(marker)

        // Geocode Service (para mostrar más información del a ubicación)
        const geocodeService = L.esri.Geocoding.geocodeService()

        // BUscador de direcciones
        const buscadorDireccion = document.querySelector('#formbuscador')

        buscadorDireccion.addEventListener('blur', buscarDireccion)
        
        // Detectar movimiendo del marker
        reubicarPin(marker)

        function llenarInputs(resultado){
            document.querySelector('#direccion').value = resultado.address.Address || ''
            document.querySelector('#colonia').value = resultado.address.Neighborhood || ''
            document.querySelector('#lat').value = resultado.latlng.lat || ''
            document.querySelector('#lng').value = resultado.latlng.lng || ''
        }
        
        function buscarDireccion(e){
            if(e.target.value.length > 8){
                provider.search({query: e.target.value + ' MX ' })
                    .then(result => {
                        if(result[0]){
                            // Limpiar pines previos
                            markers.clearLayers()

                            // Reverse Geocoding, cuando el usuario reubica el marker
                            geocodeService.reverse().latlng(result[0].bounds[0], 16).run(function(error, result){
                                // Si hay ereror
                                if(error){
                                    console.error(error)
                                    return
                                }
        
                                // Llenar campos
                                llenarInputs(result)
        
                                // Centar mapa
                                mapa.setView(result.latlng)

                                /// Agregar pin
                                marker = new L.marker(result.latlng,{
                                    draggable: true, // Mover pin
                                    autoPan: true, // Mover mapa automáticamente al mover pin
                                }).addTo(mapa)


                                // Asignar el contendor de markers el nuevo pin
                                markers.addLayer(marker)
                                
                                // Colocar un globo con la información y abrirlo
                                reubicarPin(marker)
        
                            })
                        }
                    })
                    .catch(error => {
                        console.error(error)
                    })
            }
        }

        function reubicarPin(marker){
            marker.on('moveend', function(e){
                // console.log(e.target)
    
                marker = e.target
    
                // Obtener latitud y longitud
                const position = marker.getLatLng()
    
                // Centrar automáticamente
                mapa.panTo(new L.LatLng(position.lat, position.lng))
    
                // Reverse Geocoding, cuando el usuario reubica el marker
                geocodeService.reverse().latlng(position, 16).run(function(error, result){
                    // Si hay ereror
                    if(error){
                        console.error(error)
                        return
                    }
    
                    // console.log(result)
    
                    // Colocar un globo con la información y abrirlo
                    marker.bindPopup(result.address.LongLabel)
                    marker.openPopup()
    
                    // Llenar campos
                    llenarInputs(result)
                })
            })
        }
    }
})
