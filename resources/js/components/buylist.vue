<template>
    <div id="product">
        <h1 class="c-title u-mb_l">購入履歴一覧</h1>
        <div class="u-flex-between u-mb_l">
            <span>{{(activePage-1) * itemsPerPage +1}}-{{Math.min(activePage * itemsPerPage, totalItemCount)}}件</span>
            <span>全{{totalItemCount}}件</span>
    </div>
        <div v-for="(buylist, i) in buylists" :key="i" class="p-panel u-p_m u-mb_l">
            <div class="u-flex-between">
                <img :src="buylist.product.pic" class="c-img c-img__product">
                <div class="c-textarea c-textarea__product">
                    <h2>{{buylist.product.name}}</h2>
                    <p>価格：{{buylist.product.price}}円<br>
                        期限：{{buylist.product.limit | moment}}</p>
    </div>
    </div>
            <div class="u-flex-between u-w_50 u-m_auto">
                <button class="c-button c-button__link"><a :href="'/detail/' + buylist.product_id" >詳細を見る</a></button>
                <Attention @click="handleClick" :value="buylist.id">キャンセルする</Attention>
    </div>
            
        </div>
        <pagenate :active-page="activePage" :items-per-page="itemsPerPage" :total-item-count="totalItemCount" :page-range="pageRange" @change = "pageChange"/>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    import Pagenate from './pagenate.vue';
    import Attention from './attention.vue';
    export default {
        components: { Pagenate, Attention },
        data: function() {
            return {
                buylists: [],
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
            axios.get('/buylist/json?page='+ this.activePage, {params: param})
                .then(response => {
                    this.buylists = response.data.data;
                this.activePage = response.data.current_page;
                this.totalItemCount = response.data.total;
                console.log(response.data);
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
            pageChange(page){
                this.activePage = Number(page);
                const param = {
                    itemsPerPage: this.itemsPerPage,
                };
                axios.get('/buylist/json?page='+ this.activePage, {params: param})
                    .then(response => {
                    this.buylists = response.data.data;
                    this.activePage = response.data.current_page;
                    this.totalItemCount = response.data.total;
                    console.log(response.data);
                });
            },
            handleClick(value){
                const me = this;
                console.log(value);
                const param = {
                    id: value,
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
                });
            }
        }
    };

</script>
