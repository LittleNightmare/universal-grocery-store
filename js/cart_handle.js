$(document).ready(function () {
    updateSummary()
    
    let cart = localStorage.getItem('Cart');
    if (cart) {
        // create ProductList
        fillProductList();
        $('tbody').on("blur", 'input', function () {
            // update product list after change value
            updateQuality($(this).parent().parent().parent(), $(this).val());
        });
    }

    //Empty All
    $('.total-price>button.ea').on("click", function () {
        alert("Cart has been CLEAR!");
        localStorage.removeItem("Cart");
        updateSummary();
        clearProductList();

    });

    //Remove button
    $('tbody').on("click", 'button', function(){
        console.log($(this).parent().find('p').text());
        removeItem($(this).parent().find('p').text());
        updateSummary();
        clearProductList();
        if(localStorage.getItem("Cart")){
            fillProductList();
        }
    })


});



function fillProductList() {
    let cart = localStorage.getItem('Cart');
    let table = $('.cart-table>tbody');
    JSON.parse(cart).forEach(i => {
        // console.log(i.img, i.name, i.price, i.amount);
        var row = newRow(i.img, i.name, i.price, i.amount);
        table.append(row);
    })
};


function newRow(img, name, price, amount) {
    var row = document.createElement('tr');
    var column1 = document.createElement('td');
    column1.innerHTML = `
    <div id="item">
    <img src="${img}" alt="">
        <div id="dis">
            <p>${name}</p>
            <h4>Price: $${price}/each</h4>
            <br>
            <button>Remove</button>
        </div>
    </div>
    `;
    var column2 = document.createElement('td');
    column2.innerHTML = `
    <div id="quantity">
        <input type="number" value="${amount}"  min="0" >
    </div>
    `;
    var column3 = document.createElement('td');
    column3.id = 'pri';
    column3.innerHTML = "$" + price * 100 * amount / 100;
    row.appendChild(column1);
    row.appendChild(column2);
    row.appendChild(column3);
    return row;
};

function clearProductList() {
    $('.cart-table>tbody').empty();
}

function updateQuality(currentRow, newQuality) {
    let name = currentRow.find("#item>#dis>p").text();
    let cart = JSON.parse(localStorage.getItem('Cart'));
    var change = false;
    cart.forEach(i => {
        if (i.name == name) {
            if (i.amount != Number(newQuality)) {
                i.amount = Number(newQuality);
                change = true;
            }


        }
    })

    if (change) {
        localStorage.setItem('Cart', JSON.stringify(cart));
        clearProductList();
        fillProductList();
        updateSummary();
    }

};

function updateSummary() {

    let cart = localStorage.getItem('Cart');
    let totalItem = 0;
    let subTotal = 0;
    if(cart){
        cart = JSON.parse(cart);
        cart.forEach(function (good) {
            totalItem = Number(totalItem) + Number(good.amount);
            subTotal = Number(subTotal) + Number(good.price)*100*Number(good.amount);
        });
    }
    
    subTotal = subTotal/100;
    let QST = parseFloat(((subTotal*100) * 9975 /100000 / 100).toPrecision(12)).toFixed(2);
    let GST = parseFloat((subTotal*100 * (0.05*100)/10000).toPrecision(12)).toFixed(2);
    let total = parseFloat((subTotal + Number(QST) + Number(GST)).toPrecision(12));
    // write in page
    let summary = $('.total-price>table');
    summary.find('.totalitems').text(totalItem);
    summary.find('.subtotal').text(subTotal);
    summary.find('.qst').text(QST);
    summary.find('.gst').text(GST);
    summary.find('.total').text(total);
};

function removeItem(name){
    let cart = localStorage.getItem('Cart');
    if(cart){
        cart = JSON.parse(cart);
        cart = cart.filter(function(item){
            return item.name !== name;
        });
    }
    if(cart.length == 0){
        localStorage.removeItem('Cart');
    } else{
        localStorage.setItem("Cart",JSON.stringify(cart));
    }
    
};