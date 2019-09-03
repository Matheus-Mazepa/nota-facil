import store from "../index";

export default {
    clearProductsSelected({commit, state}) {
        state.products = [];
    },

    addOrUpdateProduct({commit, state}, product) {
        const index = _.findIndex(state.products, function (o) {
            return o._cod === product._cod;
        });
        if (index === -1) {
            product.price =  {
                sale: product.comercial_price,
                discount: 0
            };
            product.unit = {abbreviation: product.taxable_unit};
            product.quantity = 1;
            state.products.push(product);
        } else {
            const temporaryProduct = state.products[index];
            temporaryProduct.quantity = temporaryProduct.quantity + 1;
            state.products[index] = temporaryProduct;
            const temp = state.products;
            state.products = [];
            state.products = temp;
        }
    }
}
