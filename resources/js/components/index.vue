<template>
    <div id="index" class="u-flex-default u-mb_m">
        <div v-for="(val, key) in product"  class="p-panel p-panel__item3 u-p_m u-mr_l u-mb_l">
          <a :href="'/detail/' + val.id">
           <img :src=val.pic class="c-img c-img__index">
            <div class="c-textarea">
                <h2 class="u-word">{{val.name}}</h2>
                <p v-if="val.limit_flg == true" class="u-word">価格：{{val.price}}円<br>
                期限：{{val.limit|moment}}</p>
                <p v-else class="u-word">価格：{{val.price}}円<br>
                    期限：期限なし</p>
            </div>
    </a>
        </div>
    </div>
</template>


<script>
    /*最新3件の商品情報を取得*/
    const axios = require('axios');
    const moment = require('moment');
    export default{
        mounted(){
            axios.get('/index/json')
            .then(response => {
                this.product = response.data;
                console.log(this.product);
            });
        },
        data: function(){
            return {
                product: [],
            };
        },
        filters: {
            moment: function(data) {
                return moment(data).format('MM月DD日 HH時');
            }
        },
    }
</script>