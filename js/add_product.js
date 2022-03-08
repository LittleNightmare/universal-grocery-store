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

        amount = $('#quan').val();
        var save = $("div em img");

        var price_text = $('div.dis>h3').text();
        price = Number(price_text.substring(1).split('/')[0])

        name = $("div.dis>h1.name").text();
        
        if (amount > 0) {
            addChart(id, img_path, amount, price, name);
        }
    })
});

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