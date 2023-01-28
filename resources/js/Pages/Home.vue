<template>
    <div class="common-layout">
        <el-container>
            <el-header class="header">
                <div class="flex items-center">
                    <h1 class="title"> SpaShop </h1>
                    <div>
                        <cart @click="dialogTableVisible = true"/>
                        <el-dialog v-model="dialogTableVisible" title="Корзина" width="90%">
                            <el-table :data="cart">
                                <el-table-column property="name" label="Наименование" width="150" />
                                <el-table-column property="description" label="Описание" width="200" />
                                <el-table-column property="price" label="Цена" />
                                <el-table-column fixed="right" label="" width="120">
                                    <el-input-number size="small" />
                                    <template #default="scope">
                                        <el-button type="danger" @click="removeFromCart(scope.row.id)">Убрать</el-button>
                                    </template>
                                </el-table-column>
                            </el-table>
                            <hr>
                            <el-input class="customer" placeholder="Реквизиты для обратной связи" v-model="customer"/>
                            <el-button type="success" @click="saveCart()">Оформить</el-button>
                        </el-dialog>
                    </div>
                </div>
                <hr>
            </el-header>

            <el-main>
                <el-row>
                    <el-col
                        v-for="(item, index) in products.data"
                        :key="item.id"
                        :span="8"
                        :style="{ padding: '10px' }"

                    >
                        <el-card :body-style="{ padding: '0px' }" class="card-item">
                            <img
                                :src="item.image"
                                class="image"
                            />
                            <div style="padding: 14px">
                                <span>{{ item.name }}</span>
                                <div class="card-description">{{ item.description }}</div>
                                <div class="bottom">
                                    <div>{{ item.price }} Руб.</div>
                                    <el-button type="success" @click="addToCart(item)">Купить</el-button>
                                </div>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
            </el-main>

            <el-footer></el-footer>
        </el-container>
    </div>
</template>

<script>
import { ElHeader } from 'element-plus'
import Cart from '../../components/Icons/Cart.vue'
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
        Cart
    },
    data() {
        return {
            dialogTableVisible: false,
            cart: [],
            customer: ''
        }
    },
    mounted() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
    },
    props: [
        'products',
    ],
    methods: {
        addToCart(product) {
            let exist = false;
            if (! this.cart) {
                this.cart.push(product)
                localStorage.setItem('cart', JSON.stringify(this.cart));
                return 0;
            }

            this.cart.forEach((item) => {
                if (item.id === product.id) {
                    exist = true;
                }
            });

            if (! exist) {
                this.cart.push(product)
                localStorage.setItem('cart', JSON.stringify(this.cart));
            }
        },
        removeFromCart(id) {
            this.cart = this.cart.filter((item) => {return item.id !== id});
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        saveCart() {
            this.$inertia.post('/order/save', { data: this.cart, customer: this.customer });
        }
    }
};
</script>
<style scoped>
    .card-item {
        cursor: pointer;
        min-height: 100%;
    }
    .card-description {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .bottom {
        margin-top: 13px;
        line-height: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .image {
        width: 100%;
        display: block;
    }
    .header {
        height: max-content;
    }
    .items-center {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .title {
        font-weight: bold;
    }
    h1 {
        font-size: 32px;
        text-shadow: 0px 4px 10px rgb(201 201 201 / 80%);
    }
    .customer {
        padding: 10px;
    }
</style>
