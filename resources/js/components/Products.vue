<template>
    <div class="container">
        <h1>{{$lang.label.products}}</h1>
        <b-input-group class="mt-3 col-sm-10 d-inline-flex">
            <b-form-input></b-form-input>
            <b-input-group-append>
                <b-button variant="info">Buscar</b-button>
            </b-input-group-append>
        </b-input-group>
        <b-input-group class="col-sm-1 d-inline-flex">
            <b-button variant="danger" @click="clearList">Limpar</b-button>
        </b-input-group>
        <div class="row">
            <div v-for="product in productsList" class="d-flex flex-row bd-highlight col-sm-3">
                <button @click="addProduct(product)" class="button-product">
                    <span class="align-self-center">
                       <strong>{{product.name}}</strong>
                    </span>
                </button>
            </div>
        </div>

    </div>
</template>

<script>
  export default {
    name: 'products',

    props: {
      user: undefined
    },

    data() {
      return {
        productsList: [],
      }
    },

    computed: {
      productsSelected: {
        get() {
          return this.$store.getters['productsSelected/getProducts'];
        },
        set(products) {
          this.$store.commit('productsSelected/SET_PRODUCTS', products);
        }
      },
    },

    beforeMount() {
      axios.get('/products/getAll').then(response => {
        this.productsList = response.data;
      });
    },

    methods: {
      clearList() {
        this.$store.dispatch('productsSelected/clearProductsSelected');
      },

      formatMoney(money) {
        const money_number = Number.parseFloat(money);
        return money_number.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      },

      addProduct(product) {
        product.formatted_price = 'R$ ' + this.formatMoney(product.comercial_price);
        this.$store.dispatch('productsSelected/addOrUpdateProduct', product);
      }
    },
  }
</script>

<style scoped>
    .button-product {
        width: 100%;
        padding: 30px 20px;
        margin: 10px 10px 10px 0;
        background-color: white;
        border-radius: 1px;
        box-shadow: 0px 0px 11px #c7c1c1;
        border: none;
    }

    .col-sm-3 {
        min-height: 150px;
    }
</style>
