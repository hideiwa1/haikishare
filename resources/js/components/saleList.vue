<template>
<div id="saleList">
    <h1 class="c-title u-mb_l">販売履歴一覧</h1>
    <div class="u-flex-between u-mb_l">
            <span>{{(activePage-1) * itemsPerPage +1}}-{{Math.min(activePage * itemsPerPage, totalItemCount)}}件</span>
            <span>全{{totalItemCount}}件</span>
    </div>
    <div v-for="(salelist, i) in salelists" :key="i" class=" u-mb_l">
        <div class="u-flex-between">
            <img :src="salelist.pic" class="c-img c-img__product">
            <div class="c-textarea c-textarea__product">
        <h2>{{salelist.name}}</h2>
        <p>販売日時：{{salelist.updated_at | moment}}</p>
    </div>
    </div>
        <div class="u-flex-between u-w_50 u-m_auto">
            <button class="c-button c-button__link">
            <a :href="'/detail/' + salelist.product_id">詳細を見る</a></button>
    </div>
    </div>
    <pagenate :active-page="activePage" :items-per-page="itemsPerPage" :total-item-count="totalItemCount" :page-range="pageRange" @change = "pageChange"/>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    import Pagenate from './pagenate.vue';
    export default {
        components: { Pagenate },
        data: function() {
            return {
                salelists: [],
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
            axios.get('/salelist/json?page='+ this.activePage, {params: param})
                .then(response => {
                this.salelists = response.data.data;
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
                axios.get('/salelist/json?page='+ this.activePage, {params: param})
                    .then(response => {
                    this.salelists = response.data.data;
                    this.activePage = response.data.current_page;
                    this.totalItemCount = response.data.total;
                    console.log(response.data);
                });
            }
        }
    };

</script>
