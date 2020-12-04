$(document).ready(function(){

    //AGREGANDO CLASE ACTIVE AL PRIMER ENLACE ---------------------------
    $('.category_list .category_item[category="botanas"]').addClass('ct_item-active');
    $('.product-item').hide();
    $('.product-item[category="botanas"]').show();

    //FILTRANDO PRODUCTOS-----------------------------------

    $('.category_item').click(function(){
        var catProduct = $(this).attr('category');
        console.log(catProduct);

        //AGREGANDO CLASE ACTIVE AL ENLACE SELECCIONADO
        $('.category_item').removeClass('ct_item-active');
        $(this).addClass('ct_item-active');

        //OCULTANDO PRODUCTOS-----------------------------
        $('.product-item').css('transform', 'scale(0)');
        function hideProduct(){
            $('.product-item').hide();    
        } setTimeout(hideProduct,200);

        //MOSTRANDO PRODUCTOS-----------------------------
        function showProduct(){
            $('.product-item[category="'+catProduct+'"]').show();
            $('.product-item[category="'+catProduct+'"]').css('transform', 'scale(1)');
        } setTimeout(showProduct,200);
    });
  
});