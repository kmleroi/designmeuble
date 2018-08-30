$( document ).ready(function() {
    'use strict';

        var app = new Vue({
            el: '#root',
            data: {
                featured: [],
                loading: false
            },
            methods:{
                getFeaturedProducts : function(){
                    this.loading = true;
                    axios.get('/featured').then(function(response){
                        console.log(response.data)
                        app.featured = response.data.featured;
                        app.loading = false;
                    })
                }
            },
            created: function(){
                this.getFeaturedProducts();
            }
        });

});

