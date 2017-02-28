var selectBeer = new Vue({
    el: '#select_beer',
    data: {
        newBeer: '',
        beers: null,
    },

    created: function () {
        this.fetchData();
    },

    methods: {
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



