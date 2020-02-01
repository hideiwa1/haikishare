<template>
    <div id="mypage">
       <h1>購入履歴</h1>
        <div v-for="(buylist, i) in buylists" :key="i">
            <h2>{{buylist.product.name}}</h2>
            <p>{{buylist.updated_at | moment}}</p>
            <button><a :href="'/detail/' + buylist.product_id">詳細を見る</a></button>
            <Attention @click="handleClick" :value="buylist.id">キャンセルする</Attention>
    </div>
    <div><a href="/buylist">さらに見る</a></div>
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
