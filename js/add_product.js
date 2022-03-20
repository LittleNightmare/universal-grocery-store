$(document).ready(function () {
    $("input.sub_total").attr("readonly","readonly");


    $('#add').click(function () {
        let id = new String;
        let img_path = new String;
        let amount = new Number;
        let price = new Number;
        let name = new String;

        var id_text = $('div.dis>p.number').text();
        id = id_text.split('#: ')[1];

        var img = $("div.picture>img").attr('src');
        img_path = img.substring(1);

        amount = $('.num').val();
        var save = $("div em img");

        var price_text = $('div.dis>h3').text();
        price = Number(price_text.substring(1).split('/')[0]);

        name = $("div.dis>h1.name").text();
        
        if (amount > 0) {
            addChart(id, img_path, amount, price, name);
        }
    });

    $(".num").change(function () {
        var n = $(this).val();
        var price_text = $('div.dis>h3').text();
        price = Number(price_text.substring(1).split('/')[0]);
        $(this).parent().siblings(".sub_total").val('$' + (price * n).toFixed(2));
        
        var id_text = $('div.dis>p.number').text();
        var id = id_text.split('#: ')[1];
        updateProductTemp(id, n);
    });

    
    $(".add").click(function () {
        var n = $(this).siblings(".num").val();
        n++;
        $(this).siblings(".num").val(n);
        $(".num").change();
    });

    $(".min").click(function () {
        var n = $(this).siblings(".num").val();
        if (n == 1) {
            return false;
        }
        n--;
        $(this).siblings(".num").val(n);
        $(".num").change();
    });

    var id_text = $('div.dis>p.number').text();
    var id = id_text.split('#: ')[1];
    $(".num").val(Number(loadProductTemp(id)));

})

function addChart(id, img, amount, price, name) {
    amount = Number(amount);
    price = Number(price);

    let cart = localStorage.getItem('Cart');
    if (cart) {
        cart = JSON.parse(cart);
        let exist = false;
        cart.forEach(v => {
            if (v.id == id) {
                v.amount = Number(v.amount) + Number(amount);
                exist = true;
            }
        });
        if (!exist) {
            cart.push({ id, img, amount, price, name });
        }
        localStorage.setItem('Cart', JSON.stringify(cart));
    } else {
        var good = { id, img, amount, price, name };
        var goodList = [good];
        localStorage.setItem('Cart', JSON.stringify(goodList));
    }
}

function updateProductTemp(id, amount){
    amount = Number(amount);
    let productTemp = localStorage.getItem('ProductTemp');
    if(productTemp){
        productTemp = JSON.parse(productTemp);
        
    } else {
        productTemp = {};
        
    }
    productTemp[id] = amount;
    localStorage.setItem('ProductTemp', JSON.stringify(productTemp));
}

function loadProductTemp(id){
    let productTemp = localStorage.getItem('ProductTemp');
    if(productTemp){
        productTemp = JSON.parse(productTemp);
        if (productTemp[id]){
            return productTemp[id];
        } else {
            return 1;
        }
        
    } else {
        return 1;
    }
}