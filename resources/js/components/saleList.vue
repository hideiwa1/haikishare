<template>
<div id="product">
    <div v-for="(salelist, i) in salelists" :key="i">
        <h2>{{salelist.name}}</h2>
        <p>{{salelist.updated_at | moment}}</p>
        <button><a :href="'/detail/' + salelist.id">詳細を見る</a></button>
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
            axios.get('/store/salelist/json?page='+ this.activePage, {params: param})
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
                axios.get('/store/salelist/json?page='+ this.activePage, {params: param})
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
