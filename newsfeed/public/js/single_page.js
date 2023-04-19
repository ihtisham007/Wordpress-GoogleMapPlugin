document.addEventListener('DOMContentLoaded', init);

        const MapShow = (function () {
        let map;
        return function () {
             if(!map){
                map = L.map('mapid').setView([1, 1], 5);
                var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                 tileSize: 512,
                zoomOffset: -1
                }).addTo(map);
                return map;
            }
            return map;
        }
 
    })();
    
function init()
{
    
    MapShow();
    map_function();
}

function map_function() {
   let map = MapShow();
   debugger;
   let lat  = jQuery(".post-content").attr("lat");
   let lng  = jQuery('.post-content').attr("lng");
   L.marker([lat, lng]).addTo(map);
   map.setView([lat, lng], 5);
   
   
}



jQuery(document).ready(function($) {
        // $('.owl-carousel').owlCarousel({
        //     item:4,
        //     loop: true,
        //     margin: 10,
        //     navigation: true,
        //     autoplay: true,
        //     autoplayTimeout: 3000,
        //     autoplayHoverPause: true,
        //     responsive: {
        //         0: {
        //             items: 1
        //         },
        //         600: {
        //             items: 3
        //         },
        //         1000: {
        //             items: 5
        //         }
        //     }
        // })
    });
    
       