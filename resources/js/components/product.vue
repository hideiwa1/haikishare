<template>
    <main class="main" id="product">
        <h1 class="c-title">商品検索</h1>
        <div class="u-flex">
            <search :keyword="keyword" :category="category" :min="min" :max="max" :area="area" :limit="limit" @change="searchProduct" />
            <article class="p-maincontent">

                <div class="u-flex-between">
                    <span>{{(activePage-1) * itemsPerPage +1}}-{{Math.min(activePage * itemsPerPage, totalItemCount)}}件</span>
                    <span>全{{totalItemCount}}件</span>
                </div>
                <div class="u-mb_m">
                <div v-for="(product, key) in products" class="p-panel u-p_m u-mr_l u-mb_l">
                    <a :href="'detail/' + product.id" class="u-flex-default">
                    <img :src=product.pic class="c-img c-img__product">
                        <div class="c-textarea c-textarea__product">
                            <h2 class="u-word">{{product.name}}</h2>
                            <p v-if="product.limit_flg == true" v-cloak>価格：{{product.price}}円<br>
                                期限：{{product.limit | moment}}</p>
                            <p v-else>価格：{{product.price}}円<br>
                                期限：期限なし</p>
                        </div>
                    </a>
                </div>
    </div>
                <pagenate :active-page="activePage" :items-per-page="itemsPerPage" :total-item-count="totalItemCount" :page-range="pageRange" @change="pageChange" />
            </article>
        </div>
    </main>
</template>


<script>
    /*商品一覧*/
    const axios = require('axios');
    const moment = require('moment');
    import Search from './search.vue';
    import Pagenate from './pagenate.vue';
    export default {
        components: {
            Search,
            Pagenate
        },
        data: function() {
            return {
                products: [],
                activePage: 1,
                itemsPerPage: 5,
                totalItemCount: 1,
                pageRange: 5,
                keyword: '',
                category: '',
                min: '',
                max: '',
                area: '',
                limit: '',
            };
        },
        mounted() {
            /*商品情報を取得*/
            const param = {
                itemsPerPage: this.itemsPerPage,
            };
            axios.get('/product/json?page=' + this.activePage, {
                    params: param
                })
                .then(response => {
                    this.products = response.data.data;
                    this.activePage = response.data.current_page;
                    this.totalItemCount = response.data.total;
                    console.log(response.data);
                });
        },
        filters: {
            moment: function(data) {
                return moment(data).format('MM月DD日 HH時');
            }
        },
        computed: {

        },
        methods: {
            pageChange(page) {
                /*ページ遷移時の処理*/
                this.activePage = Number(page);
                const param = {
                    itemsPerPage: this.itemsPerPage,
                    keyword: this.keyword,
                    category: this.category,
                    min: this.min,
                    max: this.max,
                    area: this.area,
                    limit: this.limit,
                };
                axios.get('/product/json?page=' + this.activePage, {
                        params: param
                    })
                    .then(response => {
                        this.products = response.data.data;
                        this.activePage = response.data.current_page;
                        this.totalItemCount = response.data.total;
                        console.log(response.data);
                    });
            },
            searchProduct(data) {
                /*検索時の処理*/
                console.log(data);
                this.keyword = data.keyword;
                this.category = data.category;
                this.min = data.min;
                this.max = data.max;
                this.area = data.area;
                this.limit = data.limit;
                this.pageChange(1);
            },
        }
    }

</script>
