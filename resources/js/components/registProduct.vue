<template>
    <div id="registProduct">

        <form enctype="multipart/form-data" method="post" :action="'/store/saveJson/' + this.url" class="p-form">
            <h1 class="c-title u-center u-mb_m">商品登録・編集</h1>
            <input type="hidden" name="_token" :value="csrf">
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">商品名<span class="u-require u-inline u-ml_l">＊必須</span></label>
                <input type="text" name='name' v-model="name" class="c-form c-form__text">
                <p v-if="this.errMsg.name" class="u-error">{{this.errMsg.name}}</p>
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">商品画像<span class="u-require u-inline u-ml_l">＊必須</span></label>
                <span>＊ドラッグ＆ドロップまたはクリック後ファイルを選択して下さい</span>
                <Liveview :pic="pic" @change="picChange" class="c-img__pic" />
                <p v-if="this.errMsg.pic" class="u-error">{{this.errMsg.pic}}</p>
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">カテゴリー</label>
                <select name='category' v-model="category" class="c-form c-form__select u-pl_m">
                    <option value="" selected>選択してください▼</option>
                    <option v-for="val in categoryList" :value="val.id">
                        {{val.name}}
                    </option>
                </select>
                <p v-if="this.errMsg.category" class="u-error">{{this.errMsg.category}}</p>
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    JANコード
                </label>
                <input type="num" name="jan" v-model="jan" @change="searchJan" class="c-form c-form__text">
                <p v-if="this.errMsg.jan" class="u-error">{{this.errMsg.jan}}</p>
            </div>
            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    価格<span class="u-require u-inline u-ml_l">＊必須</span>
                </label>
                <input type="num" name="price" v-model="price" class="c-form c-form__num">円
                <p v-if="this.errMsg.price" class="u-error">{{this.errMsg.price}}</p>
            </div>

            <div class="u-flex-form u-mb_m">
                <label class="c-form__title">
                    賞味期限・品質保持期限<span class="u-require u-inline u-ml_l">＊必須</span>
                </label>
                <input type="radio" name="limit_flg" value=false v-model="limit_flg">期限なし
                <input type="radio" name="limit_flg" value=true v-model="limit_flg">期限あり
                <input type="datetime-local" name="limit" v-model="limit" v-if="limit_flg !== 'false'">
                <p v-if="this.errMsg.limit" class="u-error">{{this.errMsg.limit}}</p>
            </div>
            <div>
                <input type="submit" :disabled="isValid" class="c-form c-button c-form__text c-button__link">
            </div>
        </form>
    </div>
</template>


<script>
    /*商品出品・編集*/
    const axios = require('axios');
    const moment = require('moment');
    import Liveview from './liveview.vue';
    export default {
        components: {
            Liveview
        },
        data() {
            return {
                /*csrfトークン*/
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url: (window.location.pathname !== '/store/registProduct') ? window.location.pathname.replace('/store/registProduct/', '') : 'new',
                categoryList: [],
                name: "",
                jan: "",
                category: "",
                price: "",
                limit_flg: 'false',
                limit: "",
                pic: "",
            };
        },
        mounted() {
            /*新規、編集の分岐*/
            if (this.url !== 'new') {
                const param = {
                    id: this.url,
                };
                /*編集の場合、商品情報の取得*/
                axios.get('/store/registProductJson', {
                        params: param
                    })
                    .then(response => {
                        console.log(response.data);
                        this.name = response.data.name;
                        this.category = response.data.category_id;
                        this.jan = response.data.jan ? String(response.data.jan) : '';
                        this.price = response.data.price;
                        this.limit = moment(response.data.limit).format('YYYY-MM-DDThh:mm');
                        this.limit_flg = this.limit && 'true';
                        this.pic = response.data.pic;
                    });

            }
            /*カテゴリーの取得*/
            axios.get('/categorylist/json')
                .then(response => {
                    this.categoryList = response.data;
                    console.log(response.data);
                });
        },
        filters: {
            moment: function(data) {
                return moment(data).format('YY/MM/DD HH:mm');
            }
        },
        computed: {
            errMsg() {
                /*バリデーション*/
                let isValid = false;
                const errMsgRequire = '入力必須項目です',
                    errMsgInteger = '半角数字で入力してください',
                    errMsgMax = '190文字以内で入力してください',
                    errMsgMaxnum = '9文字以内で入力してください',
                    errMsgJan = '13文字で入力してください';
                return {
                    name: (() => {
                        /*必須、最大文字数*/
                        if (!this.name) {
                            return errMsgRequire;
                        } else {
                            if (this.name.length > 190) {
                                return errMsgMax;
                            }
                            return '';
                        }
                    })(),
                    jan: (() => {
                        /*数字、桁数チェック*/
                        console.log('jan' + this.jan);
                        if (this.jan && !(/^\d*$/.test(this.jan))) {
                            return errMsgInteger;
                        } else {
                            if (this.jan.length != 0 && this.jan.length != 13) {
                                console.log(this.jan.length);
                                return errMsgJan;
                            }
                            return '';
                        }
                    })(),
                    price: (() => {
                        /*必須、数字、最大文字数*/
                        if (!this.price) {
                            return errMsgRequire;
                        } else {
                            if (!(/^\d*$/.test(this.price))) {
                                return errMsgInteger;
                            } else if (this.price.length > 10) {
                                return errMsgMaxnum;
                            } else {
                                return '';
                            }
                        }
                    })(),
                    limit: (() => {
                        /*必須*/
                        if (!this.limit && this.limit_flg === 'true') {
                            return errMsgRequire;
                        } else {
                            return '';
                        }
                    })(),
                    pic: (() => {
                        /*必須*/
                        if (!this.pic) {
                            return errMsgRequire;
                        } else {
                            return '';
                        }
                    })(),
                }
            },
            isValid() {
                /*エラーがなければ送信ボタンをアクティブに*/
                if (Object.values(this.errMsg).filter(value => {
                        return value !== '';
                    }).length === 0) {
                    return false;
                } else {
                    return true;
                }
            },

        },
        methods: {
            picChange(data) {
                console.log(data);
                this.pic = data.pic;
            },
            /*JAN入力時の処理*/
            searchJan() {
                console.log(this.jan.length);
                if (this.jan.length == 13) {
                    const param = {
                        jan: this.jan,
                    };
                    /*JANによる商品検索*/
                    axios.get('/store/searchJan', {
                            params: param,
                        })
                        .then(response => {
                            console.log(response.data);
                            if (response.data.length !== 0) {
                                this.category = response.data.category_id;
                                this.name = response.data.name;
                                this.price = response.data.price;
                                this.pic = response.data.pic;
                            }
                        });
                }
            }
            /*handleSubmit(){
                const param = {
                    id: this.url,
                    name: this.name,
                    jan: this.jan,
                    price: this.price,
                    limit: this.limit,
                    pic: this.pic,
                };
                axios.post('/store/saveJson',param,
                )
                        .then(response => {
                        console.log(response.data);
                })
                
            }*/
        }
    }

</script>
