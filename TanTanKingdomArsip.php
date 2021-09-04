<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <title>daijoubuuzas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.css' rel='stylesheet' />
    <style>
      body {
        margin: 0;
        padding: 0;
      }

      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id='map'></div>
    <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoiaGFuc2Vsa2FuZSIsImEiOiJja3E0bTI4bzEwZ2owMndudDgzb3Vlem1jIn0.cIU-KvW54pXSp3RGFMzQXw';
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/satellite-streets-v11',
        center: [107.806442, -7.244289], // starting position
        zoom: 12
      });
      // set the bounds of the map
      ////var bounds = [[-123.069003, 45.395273], [-122.303707, 45.612333]];
      //map.setMaxBounds(bounds);

      // initialize the map canvas to interact with later
      var canvas = map.getCanvasContainer();

      // an arbitrary start will always be the same
      // only the end or destination will change
      var start = [107.806442, -7.244289];
      var visitatas = [107.8099, -7.244116];
      var visitkanan = [107.811834,-7.24457];

      // create a function to make a directions request
      function getRoute(end) {
        var route=[];
        var data2=[];
        var routetrial2=[];
        var data3=[];
        var routetrial3=[];
        var data=[];
        var routetrial=[];
        var routecontainer=[];
        // make a directions request using cycling profile
        // an arbitrary start will always be the same
        // only the end or destination will change
        var start = [107.806442, -7.244289];

        //Cobain pake yg default, kena BRI gak....?
        var url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + start[0] + ',' + start[1] +
                  ';'+ end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;
        var url2 = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + start[0] + ',' + start[1] + ';' 
                  +visitatas[0]+','+visitatas[1]+';' + end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' 
                  + mapboxgl.accessToken;
        var url3 = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + start[0] + ',' + start[1] + ';' 
                  +visitkanan[0]+','+visitkanan[1]+';' + end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' 
                  + mapboxgl.accessToken;
        // make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
        var req2 = new XMLHttpRequest();
        req2.open('GET', url2, true);
        req2.onload = function() {
          var loaded2=0;
          var loaded3=0;
          var json2 = JSON.parse(req2.response);
          data2 = json2.routes[0];
          routetrial2 = data2.geometry.coordinates;
          loaded2=1;
          data3=[];
          routetrial3=[];
          window.alert(("Jarak :"+data2.distance));

          //window.alert(routetrial3.legs.distance);
          // var brix1 = 107.808499;
          // var brix2 = 107.810752;
          // var briy1 = -7.244904;
          // var briy2= -7.247171;
          // for(let i=0;i<routetrial.length;i++){
          //     if((routetrial[i][0]>brix1&&routetrial[i][0]<brix2)&&(routetrial[i][1]>briy2&&routetrial[i][1]<briy1)){
          //         window.alert("Defaultnya lewat BRI");
          //         //Arrays.fill(route, null);
          //         break;
          //     } else {
          //         route=routetrial;
          //     };
          // };
          
          // var req2 = new XMLHttpRequest();
          // req2.open('GET', url2, true);
          // window.alert("sudah sampe 88");
          // req2.onload = function(){
          //   window.alert("sudah sampe 90");
          //   var json2 = JSON.parse(req2.response);
          //   data2 = json2.routes[0];
          //   routetrial2 = data2.geometry.coordinates;
          //   loaded2=1;
          // };
          // req2.send();
              
          var req3 = new XMLHttpRequest();
          req3.open('GET', url3, true);
          req3.onload = function(){
            var json3 = JSON.parse(req3.response);
            data3 = json3.routes[0];
            routetrial3 = data3.geometry.coordinates;
            loaded3 = 1;
            if(loaded2==1&&loaded3==1){
            window.alert("3 and 2 loaded");
            if(data2.distance<data3.distance){
              window.alert("pake routetrial2");
              route=routetrial2;
              } else {
              window.alert("pake routetrial3");
              route=routetrial3;
              window.alert(("Jarak rt 3:"+data3.distance));
              };
            };

            var req = new XMLHttpRequest();
            req.open('GET',url,true);
            req.send();
            req.onload=function(){
              
              var json = JSON.parse(req.response);
              data = json.routes[0];
              routetrial = data.geometry.coordinates;
              window.alert("default loaded!");
              window.alert("bnyk segment line :"+route.length);

              var brix1 = 107.808499;
              var brix2 = 107.810752;
              var briy1 = -7.244904;
              var briy2= -7.247171;
              var bri = 0;
              routecontainer = route;
              for(let i=0;i<routetrial.length;i++){
                  if((routetrial[i][0]>brix1&&routetrial[i][0]<brix2)&&(routetrial[i][1]>briy2&&routetrial[i][1]<briy1)){
                      window.alert("Defaultnya lewat BRI");
                      bri=1;
                      route=routecontainer;
                      //Arrays.fill(route, null);
                      break;
                  } else {
                      route=routetrial;
                  };
              };

              var geojson = {
                type: 'Feature',
                properties: {},
                geometry: {
                  type: 'LineString',
                  coordinates: route
                }
              };
            
              // if the route already exists on the map, reset it using setData
              if (map.getSource('route')) {
                map.getSource('route').setData(geojson);
              } else { // otherwise, make a new request
                map.addLayer({
                  id: 'route',
                  type: 'line',
                  source: {
                    type: 'geojson',
                    data: {
                      type: 'Feature',
                      properties: {},
                      geometry: {
                        type: 'LineString',
                        coordinates: geojson
                      }
                    }
                  },
                  layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                  },
                  paint: {
                    'line-color': '#3887be',
                    'line-width': 5,
                    'line-opacity': 0.75
                  }
                });
                map.addSource('sawah', {
                    'type': 'geojson',
                    'data': {
                      'type': 'Feature',
                      'geometry': {
                        'type': 'Polygon',
                        // These coordinates outline Maine.
                        'coordinates': [
                          [
                          [107.807728, -7.243412],
                          [107.809318, -7.243484],
                          [107.809208, -7.245434],
                          [107.806118, -7.245349],
                          [107.807728, -7.243412]
                          ]
                        ]
                      }
                    }
                });

                map.addLayer({
                  'id':'sawahfill',
                  'type':'fill',
                  'source':'sawah',
                  'layout':{},
                  'paint':{
                    'fill-color':'#0080ff',
                    'fill-opacity':0.3
                  }
                });
                map.addLayer({
                  'id': 'outline',
                  'type': 'line',
                  'source': 'sawah',
                  'layout': {},
                  'paint': {
                    'line-color': '#000',
                    'line-width': 3
                  }
                });
              };
            };
          };
          req3.send();

          // for(let i=0;i<routetrial2.length;i++){
          //     if((routetrial2[i][0]>brix1&&routetrial2[i][0]<brix2)&&(routetrial2[i][1]>briy2&&routetrial2[i][1]<briy1)){
          //         route=routetrial3;
          //         window.alert("routetrial2(atas) lewat BRI, jd pake yg kanan");
          //         break;
          //     } else {
          //         if(data2.distance<data3.distance){
          //           window.alert("pake routetrial2");
          //           route=routetrial2;
          //         } else {
          //           window.alert("pake routetrial3");
          //           route=routetrial3;
          //         }
          //     };
          // };
          //window.alert(route[0][0]);
          // add turn instructions here at the end
        };
        req2.send();
      }


      map.on('load', function() {
        //tambahin titik kucingg
        map.addSource('koceng', {
              'type': 'geojson',
              'data': {
                'type': 'FeatureCollection',
                  'features': [{
                    'type': 'Feature',
                    'properties':{
                      'description':
                        '<strong>Tan tan kingdom</strong><p>seluas 12 hektar</p>'
                    },
                    'geometry': {
                      'type': 'Point',
                      'coordinates': [107.799442, -7.244289]
                    }
                  }]
                }
              });
        map.loadImage(
          'https://upload.wikimedia.org/wikipedia/commons/7/7c/201408_cat.png',
          function (error, image) {
            if (error) throw error;
            // Add the image to the map style.
            map.addImage('cat', image);
            map.addLayer({
              'id': 'koceng',
              'type': 'symbol',
              'source': 'koceng', // reference the data source
              'layout': {
                'icon-image': 'cat', // reference the image
                'icon-size': 0.1
              }
            });
            
          }
        );

        // make an initial directions request that
        // starts and ends at the same location
        getRoute(start);

        // Add starting point to the map
        map.addLayer({
          id: 'point',
          type: 'circle',
          source: {
            type: 'geojson',
            data: {
              type: 'FeatureCollection',
              features: [{
                type: 'Feature',
                properties: {},
                geometry: {
                  type: 'Point',
                  coordinates: start
                }
              }
              ]
            }
          },
          paint: {
            'circle-radius': 10,
            'circle-color': '#3887be'
          }
        });
        // this is where the code from the next step will go
      });

      map.on('click','koceng',function(e){
        var coordinates = e.features[0].geometry.coordinates.slice();
        var description = e.features[0].properties.description;
        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
          coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
        };
        new mapboxgl.Popup()
          .setLngLat(coordinates)
          .setHTML(description)
          .addTo(map);
      });
      map.on('mouseenter', 'koceng', function () {
      map.getCanvas().style.cursor = 'pointer';
      });

      // Change it back to a pointer when it leaves.
      map.on('mouseleave', 'koceng', function () {
      map.getCanvas().style.cursor = '';
      });

      map.on('click',function(e) {
        var coordsObj = e.lngLat;
        canvas.style.cursor = '';
        var coords = Object.keys(coordsObj).map(function(key) {
          return coordsObj[key];
        });
        var end = {
          type: 'FeatureCollection',
          features: [{
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'Point',
              coordinates: coords
            }
          }
          ]
        };
        if (map.getLayer('end')) {
          map.getSource('end').setData(end);
        } else {
          map.addLayer({
            id: 'end',
            type: 'circle',
            source: {
              type: 'geojson',
              data: {
                type: 'FeatureCollection',
                features: [{
                  type: 'Feature',
                  properties: {},
                  geometry: {
                    type: 'Point',
                    coordinates: coords
                  }
                }]
              }
            },
            paint: {
              'circle-radius': 10,
              'circle-color': '#f30'
            }
          });
        }
        getRoute(coords);
      });
    </script>
  </body>
</html>

{"routes":[
  {"geometry":
    {"coordinates":[[-84.519161,39.134209],[
    -84.519612,39.134068],[-84.519631,39.13438],[-84.52,39.134409],[-84
    .519824,39.135164],[-84.520051,39.135226],[-84.520733,39.128594],[-8
    4.521212,39.127956],[-84.521548,39.124838],[-84.520706,39.124792],[-84.520
    94,39.122783],[-84.52022,39.122713],[-84.520768,39.120841],[-84.519639,39
    120268],[-84.513743,39.115317],[-84.514554,39.114744],[-84.514307,39.11453
    1],[-84.514551,39.114249],[-84.511692,39.102682],[-84.511987,39.102638]],"
    type":"LineString"},"legs":[
      {"summary":"","weight":1505.4,"duration":1247.
      6,"steps":[],"distance":4360.3}
    ],"weight_name":"cyclability","weight":1505
    .4,"duration":1247.6,"distance":4360.3}
  ],"waypoints":[{"distance":45.474
  58000027311,"name":"","location":[-84.519161,39.134209]}
,{"distance":15.
959786826422654,"name":"East 6th Street","location":[-84.511987,39.10263
8]}],"code":"Ok","uuid":"DES0ZLyyOGbvPtPyyzN7mvo23Uyr3qILUM4_I_9PALm1v2Drh8-CBA=="}