<template>
<div id="mypage">
    <div>
        <h1 class="c-title u-mb_l">販売履歴一覧</h1>
        <div v-for="(salelist, i) in salelists" :key="i" class="u-mb_l">
        <div class="u-flex-between">
            <img :src="salelist.pic" class="c-img c-img__product">
            <div class="c-textarea c-textarea__product">
        <h2>{{salelist.name}}</h2>
        <p>販売日時：{{salelist.updated_at | moment}}</p>
    </div>
    </div>
        <div class="u-flex-between u-w_50 u-m_auto">
            <button class="c-button c-button__link"><a :href="'/detail/' + salelist.product_id">詳細を見る</a></button>
    </div>
    </div>
        <div class="u-right"><a href="/store/salelist" class="u-right">さらに見る</a></div>
    </div>
    
    <div>
        <h1 class="c-title u-mb_l">出品商品一覧</h1>
        <div v-for="(productlist, i) in productlists" :key="i" class=" u-mb_l">
        <div class="u-flex-between">
            <img :src="productlist.pic" class="c-img c-img__product">
            <div class="c-textarea c-textarea__product">
        <h2>{{productlist.name}}</h2>
        <p>最終更新日時：{{productlist.updated_at | moment}}</p>
    </div>
    </div>
        <div class="u-flex-between u-w_50 u-m_auto">
            <button class="c-button c-button__link">
            <a :href="'/detail/' + productlist.id">詳細を見る</a></button>
            <button v-if=!productlist.sale class="c-button c-button__link"><a :href="'/store/registProduct/' + productlist.id">編集する</a></button>
    </div>
    </div>
        <div class="u-right"><a href="/store/productlist" class="u-right">さらに見る</a></div>
    </div>
    
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    export default {
        data: function() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                salelists: [],
                productlists: [],
                activePage: 1,
                itemsPerPage: 5,
                totalItemCount: 1,
                pageRange: 5,
            };
        },
        mounted() {
            const param = {
                itemsPerPage: this.itemsPerPage,
            };
            axios.get('/salelist/json?page=' + this.activePage, {
                params: param
            })
                .then(response => {
                this.salelists = response.data.data;
                console.log(response);
            });
            axios.get('/productlist/json?page=' + this.activePage, {
                params: param
            })
                .then(response => {
                this.productlists = response.data.data;
            });
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {

        },
        methods: {
            handleClick(e){
                const me = this;
                console.log(e.target.value);
                const param = {
                    id: e.target.value,
                };
                axios.get('/cancel/json',{
                    params: param
                })
                    .then(response => {
                    console.log(response.data);
                    alert('キャンセルしました');
                })
                    .then(function(){
                    const param = {
                        itemsPerPage: me.itemsPerPage,
                    };
                    axios.get('/buylist/json?page=' + me.activePage, {
                        params: param
                    })
                        .then(response => {
                        me.buylists = response.data.data;
                        me.activePage = response.data.current_page;
                        me.totalItemCount = response.data.total;
                        console.log(response.data);
                    });
                })
                ;
            }
        }
    };

</script>
