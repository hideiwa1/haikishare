<template>
<aside id="search" class="p-sidecontent u-pr_l">
   <form>
       <div class="u-flex-form u-mb_m">
           <label class="c-form__title">
               キーワード
            </label>
           <input type="text" v-model="s_keyword" class="c-form c-form__text">
    </div>
      
       <div class="u-flex-form u-mb_m">
           <label class="c-form__title">
               カテゴリー
           </label>
           <select v-model="s_category" class="c-form c-form__select u-pl_m">
              <option value="" selected>選択してください▼</option>
               <option v-for="val in categoryList" :value="val.id">
                   {{val.name}}
               </option>
           </select>
       </div>
       
       <div class="u-flex-form u-mb_m">
           <label class="c-form__title">
               価格帯
           </label>
           <div class="u-flex-between">
               <input type="number" placeholder="0円" v-model="s_min" class="c-form c-form__num">
               ~
               <input type="number" placeholder="上限なし" v-model="s_max" class="c-form c-form__num">
            </div>
       </div>
       
       <div class="u-flex-form u-mb_m">
           <label class="c-form__title">
               都道府県
           </label>
           <select v-model="s_area" class="c-form c-form__select u-pl_m">
              <option value="" selected>選択してください▼</option>
               <option v-for="val in areaList" :value="val.id">
                   {{val.name}}
               </option>
           </select>
       </div>
       
       <div class="u-flex-form u-mb_m">
           <label class="c-form__title">
               期限切れの商品も含める
               <input type="checkbox" v-model="s_limit">
           </label>
       </div>
       
       <div class="u-flex-form u-mb_m">
           <input type="submit" value="検索する" @click.prevent = "handleClick" class="c-form c-button c-form__text">
       </div>
   </form>
</aside>
</template>


<script>
    const axios = require('axios');
    const moment = require('moment');
    export default {
        props: [ 'keyword', 'category', 'min', 'max', 'area', 'limit'],
        data(){
            return{
                categoryList: [],
                areaList: [],
                s_keyword: this.keyword,
                s_category: this.category,
                s_min: this.min,
                s_max: this.max,
                s_area: this.area,
                s_limit: this.limit,
            };
        },
        mounted() {
            axios.get('/categorylist/json')
                .then(response => {
                this.categoryList = response.data;
                console.log(response.data);
            });
            axios.get('/arealist/json')
                .then(response => {
                this.areaList = response.data;
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
            handleClick(e){
                this.$emit("change", {keyword: this.s_keyword, category: this.s_category, min: this.s_min, max: this.s_max, area: this.s_area, limit: this.s_limit});
            }
        }
    };

</script>