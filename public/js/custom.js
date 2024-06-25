$(Document).ready(function () {
    $('.plusAdult').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price-adult').val();
        var counter = card.find('#counter').val();
        var adult = card.find('#adult').val();

        var minAdult  = parseInt(counter) + 1;
        var plusAdult = parseInt(adult) + 1;
        card.find('#counter').val(minAdult);
        card.find('#adult').val(plusAdult);
        var minPeople = parseInt(plusAdult) - parseInt(minAdult);

        var subtotal = parseInt(price) * parseInt(plusAdult);
        card.find('#total-priceAdult').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(plusAdult > minPeople){
            card.find('.minusAdult').prop("disabled", false);
        }
    })
    $('.minusAdult').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price-adult').val();
        var counter = card.find('#counter').val();
        var adult = card.find('#adult').val();

        var minAdult  = parseInt(counter) - 1;
        var minusAdult = parseInt(adult) - 1;
        card.find('#counter').val(minAdult);
        card.find('#adult').val(minusAdult);
        var minPeople = parseInt(minusAdult) - parseInt(minAdult);

        var subtotal = parseInt(price) * parseInt(minusAdult);
        card.find('#total-priceAdult').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(minusAdult <= minPeople){
            card.find('.minusAdult').prop("disabled", true);
        }
    })

    $('.card-body').each(function(){
        var card = $(this);
        var price = card.find('#price-adult').val();
        var adult = card.find('#adult').val();
        var total = parseInt(price) * parseInt(adult);
        card.find('#total-priceAdult').val(total);
        card.find('#total-price').val(total);
    });
    // =========Number of Child========= //
    $('.plusChild').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();

        var plusChild = parseInt(quantity) + 1;
        card.find('#child').val(plusChild);

        var subtotal = parseInt(price) * parseInt(plusChild);
        card.find('.totalPriceChild').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(plusChild > 0){
            card.find('.minusChild').prop("disabled", false);
        }
    })
    $('.minusChild').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();

        var minusChild = parseInt(quantity) - 1;
        card.find('#child').val(minusChild);

        var subtotal = parseInt(price) * parseInt(minusChild);
        card.find('.totalPriceChild').val(subtotal);
        var totalPriceAdult = card.find('#total-priceAdult').val();
        var totalPriceChild = card.find('#total-priceChild').val();
        var totalPrice = parseInt(totalPriceAdult) + parseInt(totalPriceChild);
        card.find('#total-price').val(totalPrice);

        if(minusChild <= 0){
            card.find('.minusChild').prop("disabled", true);
        }
    })

    $('.card-body').each(function(){
        var card = $(this);
        var price = card.find('#price-child').val();
        var quantity = card.find('#child').val();
        var total = parseInt(price) * parseInt(quantity);
        card.find('.totalPriceChild').val(total);
    });
    // =========Number of Infant========= //
    $('.plusInfant').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();

        var plusInfant = parseInt(quantity) + 1;
        card.find('#infant').val(plusInfant);

        var subtotal = parseInt(price) * parseInt(plusInfant);
        card.find('.totalprice').val(subtotal);

        if(plusInfant > 0){
            card.find('.minusInfant').prop("disabled", false);
        }
    })
    $('.minusInfant').click(function(e){
        e.preventDefault();
        var card = $(this).closest('.card-body');
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();

        var minusInfant = parseInt(quantity) - 1;
        card.find('#infant').val(minusInfant);

        var subtotal = parseInt(price) * parseInt(minusInfant);
        card.find('.totalprice').val(subtotal);

        if(minusInfant <= 0){
            card.find('.minusInfant').prop("disabled", true);
        }
    })

    $('.card-body').each(function(){
        var card = $(this);
        var price = card.find('#price').val();
        var quantity = card.find('#infant').val();
        var total = parseInt(price) * parseInt(quantity);
        card.find('#totalprice').val(total);
    });
})

