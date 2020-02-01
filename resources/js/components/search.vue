<template>
<div id="search">
   <form>
       <div>
           <label>
               キーワード
            </label>
           <input type="text" v-model="s_keyword">
    </div>
      
       <div>
           <label>
               カテゴリー
           </label>
           <select v-model="s_category">
              <option value="">選択してください</option>
               <option v-for="val in categoryList" :value="val.id">
                   {{val.name}}
               </option>
           </select>
       </div>
       
       <div>
           <label>
               価格帯
           </label>
           <input type="number" placeholder="0円" v-model="s_min">
           ~
           <input type="number" placeholder="上限なし" v-model="s_max">
       </div>
       
       <div>
           <label>
               都道府県
           </label>
           <select v-model="s_area">
              <option value="" selected>選択してください</option>
               <option v-for="val in areaList" :value="val.id">
                   {{val.name}}
               </option>
           </select>
       </div>
       
       <div>
          <label>
               <input type="checkbox" v-model="s_limit">期限切れの商品も含める
           </label>
       </div>
       
       <div>
           <input type="submit" value="検索する" @click.prevent = "handleClick">
       </div>
   </form>
</div>
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