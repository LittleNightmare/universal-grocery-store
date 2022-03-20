$(document).ready(function () {
    $('#add').click(function () {
        var id = new String;
        var img_path = new String;
        var amount = new Number;
        let price = new Number;
        var name = new String;

        var id_text = $('div.dis>p.number').text();
        id = id_text.split('#: ')[1];

        var img = $("div.picture>img").attr('src');
        img_path = img.substring(1);

        amount = $('.num').val();
        var save = $("div em img");

        var price_text = $('div.dis>h3').text();
        price = Number(price_text.substring(1).split('/')[0])

        name = $("div.dis>h1.name").text();
        
        if (amount > 0) {
            addChart(id, img_path, amount, price, name);
        }
    });

    $(".add").click(function () {
        var n = $(this).siblings(".num").val();
        n++;
        $(this).siblings(".num").val(n);
        var p = $(this).parent().siblings(".price").html();
        p = p.substr(1, 4);
        $(this).parent().siblings(".sub_total").val('$' + (p * n).toFixed(2));
    });

    $(".min").click(function () {
        var n = $(this).siblings(".num").val();
        if (n == 1) {
            return false;
        }
        n--;
        $(this).siblings(".num").val(n);
        var p = $(this).parent().siblings(".price").html();
        p = p.substr(1, 4);
        $(this).parent().siblings(".sub_total").val('$' + (p * n).toFixed(2));
    });

    $(".num").change(function () {
        var n = $(this).val();
        var p = $(this).parent().siblings(".price").html();
        p = p.substr(1, 4);
        $(this).parent().siblings(".sub_total").val('$' + (p * n).toFixed(2));
    });
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
        })
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