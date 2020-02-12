<template>
<ul class="p-pagenation u-flex-between u-center">
        <li class="pagenation__item active" key='top' v-if="currentPage > 1"><a :name='1' @click = "handleLinkClick">先頭へ</a></li>
        <li class="pagenation__item active" key='prev' v-if="currentPage > 1"><a :name="currentPage - 1" @click = "handleLinkClick">前へ</a></li>
        <li v-for="page in Pages"  class="pagenation__item active"><a :name="page" @click = "handleLinkClick">{{page}}</a></li>
        <li class="pagenation__item active" key='next' v-if="currentPage < totalPage"><a :name="currentPage + 1" @click = "handleLinkClick">次へ</a></li>
        <li class="pagenation__item active" key='end' v-if="currentPage < totalPage"><a :name="totalPage" @click = "handleLinkClick">最後へ</a></li>
        </ul>
    
</template>


<script>
    /*ページネーション*/
    export default{
        props: {
            activePage: {
                type: Number,
                required: true
            },
            itemsPerPage: {
                type: Number,
                required: true
            },
            totalItemCount: {
                type: Number,
                required: true
            },
            pageRange: {
                type: Number,
                required: true
            },
        },
        computed: {
            currentPage(){
                return this.activePage;
            },
            totalPage(){
                return Math.ceil(this.totalItemCount / this.pageRange);
            },
            Pages(){
                console.log(this.totalPage);
                let pages = [],
                      firstPage = "",
                      lastPage = "";
                if(this.pageRange >= this.totalPage){
                    /*総ページ数による分岐*/
                    firstPage = 1;
                    lastPage = this.totalPage;
                }else{
                    /*現在ページ数による分岐*/
                    if(this.currentPage < (this.pageRange / 2) ){
                        firstPage = 1;
                        lastPage = this.pageRange;
                    }else if(this.currentPage + (this.pageRange /2) > this.totalPage){
                        firstPage = this.totalPage - this.pageRange + 1;
                        lastPage = this.totalPage;
                    }else{
                        firstPage = this.currentPage - Math.floor(this.pageRange /2);
                        lastPage = this.currentPage + Math.floor(this.pageRange /2);
                    }
                }
                for(let i = firstPage; i <= lastPage; i++){
                    pages.push(i);
                    console.log(pages);
                }
                return pages;
            }
        },
        methods: {
            handleLinkClick(e){
                this.$emit("change", e.target.name);
            }
        }
        
    };
</script>