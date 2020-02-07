<template>
    <div id="mypage">
       <h1 class="c-title">購入履歴</h1>
        <div v-for="(buylist, i) in buylists" :key="i" class="p-panel u-p_m u-mb_m">
            <h2>{{buylist.product.name}}</h2>
            <p>購入日：{{buylist.updated_at | moment}}</p>
            <div class="u-flex-between u-w_50 u-m_auto">
                <button class="c-button c-button__link"><a :href="'/detail/' + buylist.product_id" >詳細を見る</a></button>
                <Attention @click="handleClick" :value="buylist.id">キャンセルする</Attention>
    </div>
    </div>
        <div class="u-right"><a href="/buylist" class="u-right">>>さらに見る</a></div>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    import Attention from './attention.vue';
    export default {
        components: {Attention},
        data: function() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            axios.get('/buylist/json?page=' + this.activePage, {
                    params: param
                })
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
