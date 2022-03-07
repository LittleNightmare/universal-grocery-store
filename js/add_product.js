$(document).ready(function () {
    $('#add').click(function () {
        var id_text = $('div.dis>p.number').text();
        var id = id_text.split('#: ')[1];

        var img = $("div.picture>img").attr('src');
        var img_path = img.substring(1);

        var amount = $('#quan').val();
        var save = $("div em img");
        let price = 0;
        if(save){
            var price_text = $('div.dis>h3.sp').text();
            price = Number(price_text.substring(1).split('/')[0]);
        } else {
            var price_text = $('idv.dis>hs.price').text();
            price = Number(price_text.substring(1).split('/')[0])
        }
        var name = $("div.dis>h1.name").text();
        if(amount>0){
            addChart(id, img_path, amount, price, name);
        }
        
    })
});

function addChart(id, img, amount, price, name) {
    let cart = localStorage.getItem('Cart');
    if (cart) {
        cart = JSON.parse(msgCart);
        let exist = false;
        cart.forEach(v => {
            if (v.id == id) {
                v.amount = v.amount + amount;
                exist = true;
            }
        })
        if (!exist) {
            cart.push({ id, img, amount, price, name });
        }
    } else {
        var good = { id, img, amount, price, name };
        var goodList = [good];
        localStorage.setItem('Cart', JSON.stringify(goodList));
    }
}