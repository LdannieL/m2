define(["jquery"], function($) {
    'use strict';
    return {
        wstLoadFavorites: function(favs) {
            $('.favorites-not-logged-in').hide();
            $('.favorites-logged-in').show();
            //var favs = JSON.parse("<?php echo $block->getFavoriteIdsJson() ?>");
            // var favs = "<?php echo $block->getFavoriteIdsJson() ?>";
            var favs = favs;
            //alert(favs);
            // console.log(favs);
            $.each(favs, function(i, value) {
                //alert(value);
                $('#favorite-product-id' + value).addClass("red");
                $('#favor' + value).html('Remove From');
            });
            // favs.each(function(value) {
            //     $('#favorite-product-id' + value).addClass("red");
            //     $('#favor' + value).html('Remove From');
            // });
        },
    //     wstLoadFavoritesQuickView(): function () {
    // //     '<?php if ($block->isCustomerLoggedIn()): ?>''
    // //         $('.favorites-not-logged-in').hide();
    // //         $('.favorites-logged-in').show();
    // //         favs.each(function(value){
    // //             $('#qw' + value).addClass("red");
    // //             $('#qwfavor' + value).html('Remove From');
    // //         });
    // //     '<?php endif; ?>''
    //     },
        productSubmitToFavorites: function(obj) {
            var product = $(obj).data('product');
            var favs = {};

            $.ajax({
                url : 'http://127.0.0.1/magento2novi/index.php/' + 'favorites/index/submit/',
                type: 'POST',
                datatype: 'json',
                data : {product: product},
                success: function(data, response)
                {
                    $('#favorite-product-id' + product).toggleClass("red");
                    $('#qw' + product).toggleClass("red");
                    ($('#favor' + product).text() === "Add To") ? $('#favor' + product).text('Remove From') : $('#favor' + product).text("Add To");
                    ($('#qwfavor' + product).text() === "Add To") ? $('#qwfavor' + product).text('Remove From') : jQuery('#qwfavor' + product).text("Add To");

                    //favs = JSON.parse(data);
                    favs = data;
                    console.log("Success");
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log("Error: " + errorThrown);
                }
            });
            return false;
        },
        showDivtest: function() {
          alert("I am here");
        },
        newsubmit: function(obj) {
            var product = $(obj).data('product');
            alert(product);
            // this.element.on('click', function(e){
                //alert("Yuhhooo!");
            // }
        },
        newestsubmit: function(e) {
        //     e.target.click(function () {
        //         alert(Yuhhooo);
        //      });
        },
        selectProduct: function(data, event) {
            // this.element.on('click', function(data, event){
            //     alert("You click on element: " + event.target);
            // });
            //alert('You selected: ' + data.product);
        }
    }

    
});


