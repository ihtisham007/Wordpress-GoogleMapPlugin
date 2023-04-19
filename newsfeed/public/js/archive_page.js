const locationMap = (function() {
    let geocodeService;
    return function(){
        if (!geocodeService) {
            geocodeService = L.esri.Geocoding.geocodeService({
                apikey: "AAPKc1ec3a5c40414dbf8354e7ce0405249es-pud9FtMDOooy4lfEf611T7J6ipnTe63tw8fhEEZPT-gnduQ4QMoM85UZLFwEBq"
            });
        }
        return geocodeService;
    } 
})();


document.addEventListener('DOMContentLoaded', init);

        const MapShow = (function () {
        let map =null;
        return function () {
             if(map==null){
                 
                 var maxBounds = [
    [5.499550, -167.276413], //Southwest
    [83.162102, -52.233040]  //Northeast
];
                map = L.map('mapid').setView([1, 1], 5);
                
                var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    'maxBounds': maxBounds,
                maxZoom: 18,
                
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                 tileSize: 512,
                 
                zoomOffset: -1
                }).addTo(map);
               map.setMaxBounds(maxBounds);
                return map;
            }
            return map;
        }
 
    })();
        
function init() {
            
           
           let map=MapShow();
            console.warn('hello')
            map.removeControl(map.zoomControl);
         var zoomControl = L.control.zoom({
             position: 'bottomright'
         }).addTo(map);
           
}
    



/*  Map_function for show marker and on click  */
function map_function() {
        let map = MapShow();
        removeAllMarker();
        let getcontentAll = document.querySelectorAll(".wmnf-single-content");
        getcontentAll.forEach(element => {
             let lat = element.getAttribute("lat");
             let lng = element.getAttribute("lng");
             locationMap().reverse().latlng([lat,lng]).run(function (error, result) {
                 if (error) {
                     return;
                }
                
                element.nextElementSibling.childNodes[3].innerHTML= "<i class='fa fa-map-marker'></i> "+result.address.ShortLabel;//result.address.Match_addr;
            });
             
            element.addEventListener("click", function() {
                map.setView([lat, lng], 8);
                 
                 let title=this.previousSibling.previousElementSibling.innerText;
                let leatMarker= L.marker([lat, lng]).addTo(map).bindPopup(title).openPopup();
                  setTimeout(function() {
                    leatMarker.closePopup();
                }, 2000);
            });
            if (lat != null && lng != null) {
                var marker = L.marker([lat, lng]).addTo(map);
                //get marker country name
                map.setView([lat, lng], 5);
                marker.bindPopup('');
            }
        });
        CarouselSlider();
        //shortest location
    }
    
    
    
    //Get current location Lat and Long
    jQuery('.location-gps').click(function(){
        navigator.geolocation.getCurrentPosition(GetLatLong);

    })
    function GetLatLong(position){
        
        
        const currLat = position.coords.latitude;
        const currLong = position.coords.longitude;
        let result = null;
        let temp = null
        let shortLat = null;
        let shortLng = null;
        jQuery('.wmnf-single-content').each(function(index,value){
            
            
            parseFloat(this.getAttribute('lat'))
            parseFloat(this.getAttribute('lng'))

            temp= distance(currLat,parseFloat(this.getAttribute('lat')),currLong,parseFloat(this.getAttribute('lng')));
             if(index>0){
                 if(result>temp){
                    result = temp
                    shortLat = parseFloat(this.getAttribute('lat'));
                    shortLng = parseFloat(this.getAttribute('lng'))
                 }
             }
             else{
                 result = temp;
                 shortLat = parseFloat(this.getAttribute('lat'));
                 shortLng = parseFloat(this.getAttribute('lng'));
             }
        
            
        })
        if(document.querySelector('.leaflet-top.leaflet-right'))
                document.querySelector('.leaflet-top.leaflet-right').remove()
        // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(MapShow());
        
        L.Routing.control({
            
            waypoints: [
                L.latLng(currLat, currLong),
                L.latLng(shortLat, shortLng)
            ],
            router: L.Routing.mapbox('sk.eyJ1IjoiaWh0aXNoYW0wMDciLCJhIjoiY2wxNjRzdWt1MDNxNDNpbzM3anpzZGRjaCJ9.2U_UDTfh9pzh_TkPVGFNXw')
            //routeWhileDragging: true,
            
            //geocoder: L.Control.Geocoder.nominatim()
        }).addTo(MapShow());
        

    }
    
    
    function removeAllMarker()
    {
        let map = MapShow();
        map.eachLayer(function (layer) {
        if (!layer._container || ('' + jQuery(layer._container).attr('class')).replace(/\s/g, '') != 'leaflet-layer') {
        layer.remove();
        }
        });
    }
    
  
  
    jQuery('#category').change(function(){
        const val= jQuery('#category').val();
             localStorage.setItem("type",'category' );
     localStorage.setItem("value",val );
        jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',

        data: {
          action: 'filter_projects',
          category: val
        },
        beforeSend:function(){
            //jQuery('#loader01').removeClass('hidden')
                    Sethtmlofresponse(0)
         },
        success: function(res) {
            res = res.slice(0,-1);
          jQuery('.post-result').html(res);
            setLink()
        },
         complete: function(){
        jQuery('#loader01').addClass('hidden')
         }
    })
    });
  
  function AjaxCall(key,value){
      //sort on change category
      localStorage.setItem("type",'All' );
        jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',

        data: {
          action: 'filter_projects',
          key: value,
        },
         beforeSend:function(){
            Sethtmlofresponse(0)

         },
        success: function(res) {
            res = res.slice(0,-1);
          jQuery('.post-result').html(res);
          setLink()
        },
        complete: function(){
        jQuery('#loader01').addClass('hidden')
    },
    })
 
  }
  jQuery('#search').click(function(){
     const val= jQuery('[name="search"]').val();
     if(val.length>0){
     localStorage.setItem("type",'search' );
     localStorage.setItem("value",val );
     jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',

        data: {
          action: 'filter_projects',
          search: val
        },
        beforeSend:function(){
                        Sethtmlofresponse(0)
                        setLink();

         },
        success: function(res) {
            res = res.slice(0,-1);
          jQuery('.post-result').html(res);
              setLink()      

        },
         complete: function(){
        jQuery('#loader01').addClass('hidden')
         }
    })
     }
     
  })
      
    
    
jQuery('#sort').change(function(){
    const val= jQuery('#sort').val();
         localStorage.setItem("type",'sort' );
     localStorage.setItem("value",val );
    jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',

        data: {
          action: 'filter_projects',
          sort: val
        },
        beforeSend:function(){
            //jQuery('#loader01').removeClass('hidden')
            Sethtmlofresponse(0)
         },
        success: function(res) {
            res = res.slice(0,-1);
          jQuery('.post-result').html(res);
          setLink();

        },
         complete: function(){
        jQuery('#loader01').addClass('hidden')
         }
    })
})

    function Sethtmlofresponse(status)
    {
        if(status==0){
            jQuery('.post-result').html("");
            jQuery('#loader01').removeClass('hidden')
        }
    }
    
    function setLink()
    {
        document.querySelectorAll("a.page-numbers").forEach(function(value){
            value.addEventListener('click',function(){
                 event.preventDefault();
                 const getParam = new URL(this.href);
                const getPaged = getParam.searchParams.get("paged");
                let gettype = localStorage.getItem("type");
                let getvalue = localStorage.getItem("value");
                let param 
                if(gettype=="search")
                {
                    param = {
                        action:'filter_projects',
                        search: getvalue,
                        page: getPaged
                    }
                }
                else if(gettype=="category"){
                    param = {
                        action:'filter_projects',
                        category: getvalue,
                        page: getPaged
                    }
                }
                else if(gettype=="sort"){
                    param = {
                        action:'filter_projects',
                        sort: getvalue,
                        page: getPaged
                    }
                }
                else{
                    param = {
                        action:'filter_projects',
                        showall: 'all',
                        page: getPaged
                    }
                }
                 jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',

        data: param,
        beforeSend:function(){
            Sethtmlofresponse(0)
         },
        success: function(res) {
            res = res.slice(0,-1);
          jQuery('.post-result').html(res);
          setLink()

        },
         complete: function(){
        jQuery('#loader01').addClass('hidden')
         }
    })
    
            })
    
        })
    }
  
jQuery(document).ready(function(){
      AjaxCall('show','All')
      
      
});


function CarouselSlider(){
    jQuery('.owl-carousel').owlCarousel({
            items:3,
            loop: true,
            autoWidth:true,
            margin:10,
            dots: false,
            nav: true,
           
            autoHeight : true,
    transitionStyle:"fade",
            navigation: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,


  

            
        })
//         document.querySelectorAll('.owl-next').forEach(function(value){

//             value.click();
    
// })
jQuery('.owl-next').click();
}


function getImg(element){
    const lastDot=element.src.lastIndexOf('.');
    const ext=element.src.substr(lastDot);
    const fileName = element.src.substr(0,(lastDot-8))
    const FinalFileName  = fileName+ext;
    element.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.nextSibling.nextSibling.childNodes[1].childNodes[1].src = FinalFileName;
}

function distance(lat1,
                     lat2, lon1, lon2)
    {
   
        // The math module contains a function
        // named toRadians which converts from
        // degrees to radians.
        lon1 =  lon1 * Math.PI / 180;
        lon2 = lon2 * Math.PI / 180;
        lat1 = lat1 * Math.PI / 180;
        lat2 = lat2 * Math.PI / 180;
   
        // Haversine formula
        let dlon = lon2 - lon1;
        let dlat = lat2 - lat1;
        let a = Math.pow(Math.sin(dlat / 2), 2)
                 + Math.cos(lat1) * Math.cos(lat2)
                 * Math.pow(Math.sin(dlon / 2),2);
               
        let c = 2 * Math.asin(Math.sqrt(a));
   
        // Radius of earth in kilometers. Use 3956
        // for miles
        let r = 6371;
   
        // calculate the result
        return(c * r);
    }


// var owl = jQuery('.owl-carousel');
// owl.on('translated.owl.carousel', function(event) {

//     var now_src = jQuery('.owl-carousel').find('.owl-item.active img').attr('src');
//      const lastDot=now_src.lastIndexOf('.');
//     const ext=now_src.substr(lastDot);
//     const fileName = now_src.substr(0,(lastDot-8))
//     const FinalFileName  = fileName+ext;
//     event.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.nextSibling.nextSibling.childNodes[1].childNodes[1].src = FinalFileName;
//   // $('#you_img_id').attr('src', now_src);
// })