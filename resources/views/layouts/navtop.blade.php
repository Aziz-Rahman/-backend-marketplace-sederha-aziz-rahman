<nav>
    <div class="container">
        <ul class="navbar-left" style="padding: 0;">
            <li>
                <a href="{{ route('products.index') }}">Toko Sederhana</a>
            </li>
            {{-- <li>
				<a href="#about">About</a>
			</li> --}}
        </ul>
        <!--end navbar-left -->
        <ul class="navbar-right">
            <li>
                <a href="#" id="cart">
                    <i class="fa fa-shopping-cart"></i> Cart <span id="cartCount" class="badge">0</span>
                </a>
            </li>
        </ul>
        <!--end navbar-right -->
    </div>
    <!--end container -->
</nav>

<div class="container">
    <div class="shopping-cart">
        <div class="shopping-cart-header">
            <i class="fa fa-shopping-cart cart-icon"></i>
            {{-- <span class="badge">0</span> --}}
            {{-- <div class="shopping-cart-total">
                <span class="lighter-text">Total:</span>
                <span class="main-color-text">$2,229.97</span>
            </div> --}}
        </div>
        <!--end shopping-cart-header -->

        <div id="cartItems"></div>

        {{-- <ul class="shopping-cart-items">
            <li class="clearfix">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
                <span class="item-name">Sony DSC-RX100M III</span>
                <span class="item-price">$849.99</span>
                <span class="item-quantity">Qty: 01</span>
            </li>
        </ul> --}}
        <a href="{{ route('cart.index') }}" class="button btn btn-danger">
            Shopping Cart <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </a>
    </div>
    <!--end shopping-cart -->
</div>
<!--end container -->


<style>
$main-color: #6394F8;
$light-text: #ABB0BE;

@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);

@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);

*, *:before, *:after {
  box-sizing: border-box;
}

body {
  font: 14px/22px "Lato", Arial, sans-serif;
  background: #6394F8;
}

.lighter-text {
  color: #ABB0BE;
}

.main-color-text {
  color: $main-color;
}

nav {
  padding: 20px 0 40px 0;
  background: #F8F8F8;
  font-size: 16px;
  
  .navbar-left {
    float: left;
  }
  
  .navbar-right {
    float: right;
  }
  ul {
    
    li {
      display: inline;
      padding-left: 20px;
      a {
        color: #777777;
        text-decoration: none;
        
        &:hover {
          color: black;
        }
      }
    }
  }
}

.badge {
    background-color: #6394F8;
    border-radius: 10px;
    color: white;
    display: inline-block;
    font-size: 12px;
    line-height: 1;
    padding: 3px 7px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

.shopping-cart {
    position: absolute;
    right: 6%;
    top: 50px;
    z-index: 9;
    margin: 20px 0;
    float: right;
    background: white;
    width: 320px;
    border-radius: 3px;
    padding: 20px;
    box-shadow: 2px 6px 10px #b8b8b89e;
  
  
    .shopping-cart-header {
        border-bottom: 1px solid #E8E8E8;
        padding-bottom: 15px;
        
        .shopping-cart-total {
            float: right;
        }
    }
  
    .shopping-cart-items {
    
        padding-top: 20px;
        list-style-type: none;
        border-bottom: 1px solid #ccc;
        font-size: 12px;

        li {
            margin-bottom: 5px;
        }

        img {
            float: left;
            margin-right: 12px;
            margin-bottom: 20px;
        }
    
        .item-name {
            display: block;
            padding-top: 0px;
            font-size: 12px;
        }
        
        .item-price {
            color: $main-color;
            margin-right: 8px;
        }
    
        .item-quantity {
            color: $light-text;
        }
    }
   
}

.shopping-cart:after {
	bottom: 100%;
	left: 89%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	border-bottom-color: white;
	border-width: 8px;
	margin-left: -8px;
}

.cart-icon {
  color: #515783;
  font-size: 24px;
  margin-right: 7px;
  float: left;
}

.button {
  background: $main-color;
  color:white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  display: block;
  border-radius: 3px;
  font-size: 16px;
  margin: 25px 0 15px 0;
  
  &:hover {
    background: lighten($main-color, 3%);
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

</style>
