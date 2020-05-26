let SfMailShop = {
    selector: '.addSubToCart'
};

SfMailShop.init = function() {
    SfMailShop.addClickEventToAddToCart();
}

SfMailShop.addClickEventToAddToCart = function() {
    jQuery(SfMailShop.selector).on("click", function(event) {
        event.preventDefault();
        $element = $(this);
        jQuery.ajax({
            method: "POST",
            url: $(this).data('host') + "/index.php",
            data: {
                id: $(this).data('pageId'),
                tx_sfmailshop: {
                    productUid: $(this).data('productUid'),
                    variantUid: $(this).data('variantUid'),
                    method: $(this).data('method')
                }
            }
        }).done(function(response) {
            if ($element.data('reload')) {
                location.reload();
            } else {
                alert(response.message);
            }
        });
    })
}

SfMailShop.init();
