import Vue from 'vue';
import Index from './components/index.vue';
import Product from './components/product.vue';
import Buylist from './components/buylist.vue';
import ProductList from './components/productList.vue';
import SaleList from './components/saleList.vue';
import Menu from './components/menu.vue';
import RegistProduct from './components/registProduct.vue';
import Profile from './components/profile.vue';
import StoreProfile from './components/storeProfile.vue';
import BuyModal from './components/buyModal.vue';
import Mypage from './components/mypage.vue';
import StoreMypage from './components/storeMypage.vue';
import attention from './attention.js';

Vue.config.productionTip = false

document.getElementById('index') &&
new Vue({
    render: h => h(Index),
}).$mount('#index')

document.getElementById('product') &&
new Vue({
    render: h => h(Product),
}).$mount('#product')

document.getElementById('buylist') &&
new Vue({
    render: h => h(Buylist),
}).$mount('#buylist')

document.getElementById('productList') &&
new Vue({
    render: h => h(ProductList),
}).$mount('#productList')

document.getElementById('saleList') &&
new Vue({
    render: h => h(SaleList),
}).$mount('#saleList')

document.getElementById('menu') &&
new Vue({
    render: h => h(Menu),
}).$mount('#menu')

document.getElementById('registProduct') &&
    new Vue({
    render: h => h(RegistProduct),
}).$mount('#registProduct')

document.getElementById('profile') &&
    new Vue({
    render: h => h(Profile),
}).$mount('#profile')

document.getElementById('storeProfile') &&
    new Vue({
    render: h => h(StoreProfile),
}).$mount('#storeProfile')


document.getElementById('buyButton') &&
    new Vue({
    render: h => h(BuyModal),
}).$mount('#buyButton')

document.getElementById('mypage') &&
    new Vue({
    render: h => h(Mypage),
}).$mount('#mypage')

document.getElementById('storeMypage') &&
    new Vue({
    render: h => h(StoreMypage),
}).$mount('#storeMypage')