<template>
    <div id="productList">
        <h1 class="c-title  u-mb_l">出品商品一覧</h1>
        <div class="u-flex-between u-mb_l">
            <span>{{(activePage-1) * itemsPerPage +1}}-{{Math.min(activePage * itemsPerPage, totalItemCount)}}件</span>
            <span>全{{totalItemCount}}件</span>
    </div>
        <div v-for="(productlist, i) in productlists" :key="i" class=" u-mb_l">
            <div class="u-flex-between">
                <img :src="productlist.pic" class="c-img c-img__product">
                <div class="c-textarea c-textarea__product">
            <h2>{{productlist.name}}</h2>
            <p v-if="!storeId">最終更新日時：{{productlist.updated_at | moment}}</p>
                <p v-if="storeId">期限：{{productlist.limit | moment}}<br>
                価格：{{productlist.price}}円</p>
    </div>
    </div>
            <div class="u-flex-between u-w_50 u-m_auto">
                <button class="c-button c-button__link"><a :href="'/detail/' + productlist.id">詳細を見る</a></button>
                <button v-if="!productlist.sale && !storeId" class="c-button c-button__link"><a :href="'/store/registProduct/' + productlist.product_id">編集する</a></button>
        </div>
    </div>
        <pagenate :active-page="activePage" :items-per-page="itemsPerPage" :total-item-count="totalItemCount" :page-range="pageRange" @change="pageChange" />
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    import Pagenate from './pagenate.vue';
    export default {
        components: {
            Pagenate
        },
        data: function() {
            return {
                productlists: [],
                activePage: 1,
                itemsPerPage: 5,
                totalItemCount: 1,
                pageRange: 5,
                storeId: '',
            };
        },
        mounted() {
            console.log(location.pathname);
            if(location.pathname.indexOf('/store/profile') !== -1){
                this.storeId = location.pathname.replace('/store/profile/', "");
            }
            console.log(this.storeId);
            const param = {
                itemsPerPage: this.itemsPerPage,
                storeId: this.storeId,
            };
            axios.get('/productlist/json?page=' + this.activePage, {
                    params: param
                })
                .then(response => {
                    this.productlists = response.data.data;
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
            pageChange(page) {
                this.activePage = Number(page);
                const param = {
                    itemsPerPage: this.itemsPerPage,
                    storeId: this.storeId,
                };
                axios.get('/productlist/json?page=' + this.activePage, {
                        params: param
                    })
                    .then(response => {
                        this.productlists = response.data.data;
                        this.activePage = response.data.current_page;
                        this.totalItemCount = response.data.total;
                        console.log(response.data);
                    });
            }
        }
    };

</script>
