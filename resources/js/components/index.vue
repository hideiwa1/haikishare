<template>
    <div id="index" class="u-flex-default u-mb_m">
        <div v-for="(val, key) in product"  class="p-panel p-panel__item3 u-p_m">
          <a :href="'/detail/' + val.id">
           <img :src=val.pic class="c-img c-img__index">
            <div class="c-textarea">
                <h2>{{val.name}}</h2>
                <p>価格：{{val.price}}円<br>
                期限：{{val.limit|moment}}</p>
                <p>住所：</p>
            </div>
    </a>
        </div>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    export default{
        mounted(){
            axios.get('/index/json')
            .then(response => {
                this.product = response.data;
            });
        },
        data: function(){
            return {
                product: [],
            };
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY年MM月DD日 HH:mm');
            }
        },
    }
</script>