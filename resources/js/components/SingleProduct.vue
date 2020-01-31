<template>
	<div>
		<div class="latest-post-content">
    <h2>Price:- {{ product.price }} Tk.</h2>
	  </div> 
	  <div class="latest-post clearfix"style="background:gray;">
	    <figcaption>
	        <div class="bookmark" v-if="countProduct(product.id) < 1">
	            <a  @click="addtoCart"> Add to Cart</a>
	        </div>
	        <div class="read-more" v-if="countProduct(product.id) >= 1">
	           <div class="number">
								<span class="minus" @click="removeFromCart()">-</span>
								<span class="btn btn-sm btn-success">{{ countProduct(product.id) }}</span>
								<span class="plus" @click="addtoCart">+</span>
							</div>
	        </div>
	    </figcaption>
	  	<br>
	  </div>
	</div>
	
</template>

<script>
import axios from 'axios';
import {mapActions, mapGetters} from 'vuex';

export default {

  props: ['product'],

	 methods:{
	 			...mapActions({
			  			addProduct: 'cart/addProduct',
			  			removeProduct: 'cart/removeProduct'
			  	}),

	      addtoCart() {
	      	this.addProduct(this.product);
	      },

	      removeFromCart() {
	      	this.removeProduct(this.product);
	      },

	      countProduct(id) {
	      	let pro = this.products;
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
	  	})
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
