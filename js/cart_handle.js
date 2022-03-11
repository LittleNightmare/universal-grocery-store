$(document).ready(function () {
    // first update summary
    updateSummary()
    
    let cart = localStorage.getItem('Cart');
    // if there is item in the cart
    if (cart) {
        // create ProductList
        fillProductList();
        $('tbody').on("blur", 'input', function () {
            // update product list after change value
            // $(this).parent().parent().parent() is current <tr>
            updateQuality($(this).parent().parent().parent(), $(this).val());
        });
    }

    //Empty All
    $('.total-price>button.ea').on("click", function () {
        // TODO animation
        alert("Cart has been CLEAR!");
        localStorage.removeItem("Cart");
        updateSummary();
        clearProductList();

    });

    //Remove button
    $('tbody').on("click", 'button', function(){
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
        // add a new row(<tr>)
        var row = newRow(i.img, i.name, i.price, i.amount);
        table.append(row);
    })
};


function newRow(img, name, price, amount) {
    var row = document.createElement('tr');
    // create 3 <td>s separately
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
    // change only value change
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
    let QST = 0;
    let GST = 0;
    let total = 0;

    if(cart){
        cart = JSON.parse(cart);
        cart.forEach(function (good) {
            totalItem = Number(totalItem) + Number(good.amount);
            subTotal = Number(subTotal) + Number(good.price)*100*Number(good.amount);
        });

        subTotal = subTotal/100;
        QST = parseFloat(((subTotal*100) * 9975 /100000 / 100).toPrecision(12)).toFixed(2);
        GST = parseFloat((subTotal*100 * 5/10000).toPrecision(12)).toFixed(2);
        total = parseFloat((subTotal + Number(QST) + Number(GST)).toPrecision(12));
    }
    // write in page
    let summary = $('.total-price>table');
    summary.find('.totalitems').text(totalItem);
    summary.find('.subtotal').text(subTotal);
    summary.find('.qst').text(QST);
    summary.find('.gst').text(GST);
    summary.find('.total').text(total);
};

function removeItem(name){
    // only called when exist good in the cart
    let cart = localStorage.getItem('Cart');
    if(cart){
        cart = JSON.parse(cart);
        cart = cart.filter(function(item){
            return item.name !== name;
        });

        if(cart.length == 0){
            localStorage.removeItem('Cart');
        } else{
            localStorage.setItem("Cart",JSON.stringify(cart));
        }
    }
    
    
};