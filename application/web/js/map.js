window.onload = function () {

    var lastMarker = null;

    var barInfo = new Vue({
        el: '#bar_info',
        data: {
            barInfo: [
                barName = '',
                barDescription = ''
            ],
            barId: null,
            comments: [],
        },

        methods: {
            getBarId: function () {
                var el = document.getElementById('bar_info');

                this.barId = el.dataset.barId;

                document.getElementById('bar_info_id').value = this.barId;
            },

            getComments: function () {
                this.getBarId();

                var self = this;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/main/getComments?bar_id=' + self.barId);

                xhr.onload = function () {
                    self.comments = JSON.parse(xhr.response);
                };
                xhr.send();
            },

            getBarInfo: function () {
                this.getBarId();

                var self = this;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/main/getBarInfo?bar_id=' + self.barId);

                xhr.onload = function () {
                    self.barInfo = JSON.parse(xhr.response);
                };
                xhr.send();
                
                this.getComments();
            }
        }
    });

    var barRedactor = new Vue({
        el: '#bar_redactor_form',
        data: {
            newBeer: '',
            beers: null,
            barInfo: [
                barName = '',
                barDescription = ''
            ],
            barId: null
        },
        created: function () {
            this.fetchData();
        },

        methods: {
            getBarId: function () {
                var el = document.getElementById('bar_redactor_form');
                this.barId = el.dataset.barId;
            },

            getBarInfo: function () {
                this.getBarId();

                var self = this;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/main/getBarInfo?bar_id=' + self.barId);

                xhr.onload = function () {
                    self.barInfo = JSON.parse(xhr.response);
                };
                xhr.send();
            },

            addNewBeer: function () {
                var beerIsNew = true;
                for (var i = 0; i < this.beers.length; i++) {
                    if (this.beers[i].NAME == this.newBeer) {
                        alert('Beer with name ' + this.newBeer + 'exist in beer list');
                        this.newBeer = '';
                        return false;
                    }
                }
                this.beers.push({ID: this.newBeer, NAME: this.newBeer});
                this.newBeer = '';
            },

            fetchData: function () {
                var self = this;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'main/getBeers');
                xhr.onload = function () {
                    var response = xhr.response;
                    self.beers = JSON.parse(response);
                }
                xhr.send()
            },
        }
    });

    //------------------------------------------------------------------------------------------------------------------------//
    // change class add_bar element (if element have class active allowed redaction map)
    document.getElementsByClassName('add_bar')[0].onclick = function () {
        changeCondition(this, true);

        hideActiveBlock(document.getElementById('bar_info'));
        hideActiveBlock(document.getElementById('new_bar_form'));
        hideActiveBlock(document.getElementById('bar_redactor_form'));
        if (lastMarker != null) {
            beerMap.removeLayer(lastMarker);
        }
    };

    var beerMap = L.map('map').setView([49.98891, 36.23072], 15);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        id: 'mapbox.streets'

    }).addTo(beerMap);

    beerMap.zoomControl.remove();


    //------------------------------------------------------------------------------------------------------------------------//
    // Add new pointer on map
    beerMap.on('click', onMapClick);
    function onMapClick(e) {
        if (checkElementOnClass(document.getElementById('bar_info'), 'active')) {
            changeCondition(document.getElementById('bar_info'));
        }
        if (checkElementOnClass(document.getElementById('bar_redactor_form'), 'active')) {
            changeCondition(document.getElementById('bar_redactor_form'));
        }

        var redactor = false;
        var addBarElemClassName = document.getElementsByClassName('add_bar')[0].className;

        if (addBarElemClassName.indexOf('active') != -1) {
            redactor = true;
        }

        if (redactor) {
            if (lastMarker == null) {
                lastMarker = L.marker(e.latlng).addTo(beerMap);
            } else {
                beerMap.removeLayer(lastMarker);
                lastMarker = null;
            }
            changeCondition(document.getElementById('new_bar_form', false));

            document.getElementById('bar_cord').value = e.latlng.lat + ',' + e.latlng.lng;
        }
    }

    //------------------------------------------------------------------------------------------------------------------------//
    // Output bar on map
    outputBars(beerMap);
    function outputBars(map) {

        var bar;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'main/getBar');
        xhr.onload = function () {
            bar = JSON.parse(xhr.response);

            for (var i = 0; i < bar.length; i++) {
                var geojsonFeature = {
                    "type": "Feature",
                    "geometry": {
                        "type": "Point",
                        "coordinates": [bar[i].COORD.split(',')[0], bar[i].COORD.split(',')[1]]
                    },
                    "id_bar": bar[i].ID
                };
                var marker;
                L.geoJson(geojsonFeature, {
                    pointToLayer: function (feature, latlng) {
                        marker = L.marker(bar[i].COORD.split(','))
                            .bindPopup('<b>' + bar[i].NAME + '</b> <br> ' + bar[i].DESCRIPTION + '<br> <a id="bar_' + bar[i].ID + '"  style="cursor: pointer">show bar</a>').addTo(map);
                        marker.on("click", showBarInfo);
                        return marker;
                    }
                }).addTo(map);
            }
        }
        xhr.send();
    }

    function showBarInfo() {
        hideActiveBlock(document.getElementById('bar_info'));
        hideActiveBlock(document.getElementById('new_bar_form'));
        hideActiveBlock(document.getElementById('bar_redactor_form'));

        if (lastMarker != null) {
            beerMap.removeLayer(lastMarker);
            lastMarker = null;
        }

        var barId = this.feature.id_bar;
        document.getElementById('bar_' + this.feature.id_bar).onclick = function () {
            var barInfoElement;
            if (!checkElementOnClass(document.getElementsByClassName('add_bar')[0], 'active')) {
                barInfoElement = document.getElementById('bar_info');
                data = barInfoElement.dataset;
                data.barId = barId;
                barInfo.getBarInfo();
            } else {
                barInfoElement = document.getElementById('bar_redactor_form');
                data = barInfoElement.dataset;
                data.barId = barId;
                barRedactor.getBarInfo();
                document.getElementById('redactor_bar_id').value = barId;
            }
            changeCondition(barInfoElement, false);
        }
    }

    function changeCondition(e, changeChild) {
        if (e.className.indexOf('active') === -1) {
            e.className += ' active';
            if (changeChild) {
                e.children[0].innerHTML = '&#215;';
            }
        } else {
            e.className = e.className.replace(' active', '');
            if (changeChild) {
                e.children[0].innerHTML = '+';
            }
        }
    }

    function checkElementOnClass(element, className) {
        if (element.className.indexOf(className) == -1) {
            return false;
        }
        return true;
    }

    function hideActiveBlock(block) {
        block.className = block.className.replace(' active', '');
    }
}







