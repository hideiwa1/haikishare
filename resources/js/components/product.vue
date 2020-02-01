<template>
    <div id="product">
      <search :keyword="keyword" :category="category" :min="min" :max="max" :area="area" :limit="limit" @change = "searchProduct" />
       <div v-for="(product, key) in products">
           <a :href="'detail/' + product.id">
           <h2>{{product.name}}</h2>
           <p>{{product.limit | moment}}</p>
    </a>
       </div>
        <pagenate :active-page="activePage" :items-per-page="itemsPerPage" :total-item-count="totalItemCount" :page-range="pageRange" @change = "pageChange"/>
    </div>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    import Search from './search.vue';
    import Pagenate from './pagenate.vue';
    export default {
        components: { Search, Pagenate },
        data: function(){
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
            const param = {
                itemsPerPage: this.itemsPerPage,
            };
            axios.get('/product/json?page='+ this.activePage, {params: param})
                .then(response => {
                this.products = response.data.data;
                this.activePage = response.data.current_page;
                this.totalItemCount = response.data.total;
                console.log(response.data);
            });
        },
        filters: {
            moment: function(data){
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
                    keyword : this.keyword,
                    category : this.category,
                    min : this.min,
                    max : this.max,
                    area : this.area,
                    limit : this.limit,
                };
                axios.get('/product/json?page='+ this.activePage, {params: param})
                    .then(response => {
                    this.products = response.data.data;
                    this.activePage = response.data.current_page;
                    this.totalItemCount = response.data.total;
                    console.log(response.data);
                });
            },
            searchProduct(data){
                console.log(data);
                this.keyword = data.keyword;
                this.category = data.category;
                this.min = data.min;
                this.max = data.max;
                this.area = data.area;
                this.limit = data.limit;
                this.pageChange(this.activePage);
            },
        }
    }
</script>