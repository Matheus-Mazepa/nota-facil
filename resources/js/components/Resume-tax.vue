<template>
    <div class="parent-container">
        <div class="container">
            <h1>Preços</h1>

            <div class="row">
                <b-table striped hover :items="products" :fields="fields"></b-table>
            </div>

            <button class="pull-right btn-send" @click="subimitNote">Finalizar</button>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'resume-tax',

    props: {
      user: undefined
    },

    computed: {
      products() {
        return this.$store.getters['productsSelected/getProducts'];
      }
    },

    data: function () {
      return {
        fields:
          [
            {
              key: 'name',
              label: 'Nome',
            },
            {
              key: 'quantity',
              label: 'Qtd',
            },
            {
              key: 'formatted_price',
              label: 'Preço',
            }
          ]
      };
    },

    methods: {
      subimitNote() {
        axios.post('/products/tax-coupon', {
          'products': this.products
        }).then(response => {
          console.log(response);
        });
      }
    },
  }
</script>

<style scoped>
    .parent-container {
        position: fixed;
        background-color: white;
        bottom: 0;
        top: 84px;
        width: 32%;
        padding: 20px;
    }

    .parent-container h1 {
        padding-top: 10px;
    }

    .btn-send {
        width: 100%;
    }
</style>
