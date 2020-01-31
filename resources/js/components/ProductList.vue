<template>
<div id="menulist" data-id="">
	<div v-if="product.length <= 0">
		No Item Found
	</div>
	<div class="col-sm-4 col-xs-6" v-for="item in product">
    <div class="single-product">
        <figure>
            <img :src="'/' + item.thumbnail" alt="">

            <figcaption>
                <div class="bookmark" v-if="countProduct(item.id) < 1">
                    <a  @click="addtoCart(item)"> Add to Cart</a>
                    <br><br>
                      <a :href="'/grocery_product/' + item.id" >More Details</a>
                </div>
                <div class="read-more" v-if="countProduct(item.id) >= 1">
                   <div class="number">
											<span class="minus" @click="removeFromCart(item)">-</span>
											<span class="btn btn-sm btn-success">{{ countProduct(item.id) }}</span>
											<span class="plus" @click="addtoCart(item)">+</span>
										</div>
                </div>
            </figcaption>
          
        </figure>

        <h4><a :href="'/grocery_product/' + item.id">{{ item.product_name }}</a></h4>

        <h5>Price:-Tk. {{ item.price }}</h5>
    </div>
	</div>
</div>	
	
</template>

<script>
import axios from 'axios';
import {mapActions, mapGetters} from 'vuex';

export default {

  data: function () {
    return {
      product: {}
    }
  },
  mounted () { 
  	this.loadProduct();
    
  },

  props: ['profileId', 'id'],

	 methods:{
	 			...mapActions({
			  			addProduct: 'cart/addProduct',
			  			removeProduct: 'cart/removeProduct'
			  	}),

	      loadProduct(id = '') {
	      	axios.get('http://127.0.0.1:8000/ajaxRequest/', { params: {profileId: this.profileId, id: id}})
		      .then(response => {
		         console.log(response)
		        this.product = response.data
		      })
		      .catch(err => {
		        console.log(err)
		      })
	      },

	      addtoCart(item) {
	      	this.addProduct(item);
	      },

	      removeFromCart(item) {
	      	this.removeProduct(item);
	      },

	      countProduct(id) {
	      	let pro = this.products;
          if (!pro) {
            return 0;
          }
					for (var i = 0; i < pro.length; i++) {
						if(pro[i].id == id) {
							return pro[i].count;
						}			
					}
					return 0;
	      }
	  },

	  computed: {
	  	...mapGetters({
	  		selectedMenu: 'menu/selectedMenu',
	  		products: 'cart/products'
	  	}),
	  },

	  watch: {
	    selectedMenu(id) {
	    	this.loadProduct(id);
	    	console.log(id);
	    }
	  }
}
</script>

<style>
  span {
  	cursor:pointer;
  }
   .div_style{
      width: 97%;
    }
    .number{
       margin: 0px 0px 25px 0px;
    }

    input.quantity {
        width: 61%;
    }
    .plus{
      width:34px;
      height:34px;
      background:#3e91f0;
      font-size: 25px;
      color: #533ef0;
      border-radius:4px;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
    }

    .minus{
      width:34px;
      height:34px;
      background:#f04d3e;
      font-size: 25px;
      color: #533ef0;
      border-radius:4px;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
    }

    input{
      height:34px;
      width: 100px;
      text-align: center;
      font-size: 26px;
      border:1px solid #ddd;
      border-radius:4px;
      display: inline-block;
      vertical-align: middle;
    }
</style>