$(document).ready(function () {
    // first update summary
    updateSummary()

    // create ProductList
    fillProductList();

    // check box style
    $('.cart-table').on("change",".checkall",function () {
        // $(this).prop("checked");
        $(".check").prop("checked", $(this).prop("checked"));
        if ($(this).prop("checked")) {
            // add class name check-cart-item
            $(".p_item").addClass("check-cart-item");
        } else {
            $(".p_item").removeClass("check-cart-item");
        }
    });

    $('.cart-table').on("change",".check",function () {
        if ($(".check:checked").length === $(".check").length) {
            $(".checkall").prop("checked", true);
        } else {
            $(".checkall").prop("checked", false);
        }
        if ($(this).prop("checked")) {
            // add class name check-cart-item
            $(this).parents(".p_item").addClass("check-cart-item");
        } else {
            $(this).parents(".p_item").removeClass("check-cart-item");
        }
    });

    // update quality when .num change
    $('.cart-table').on("change", ".num", function () {
        // update product list after change value
        // $(this).parent().parent().parent() is current <tr>
        var n = $(this).val();
        var p = $(this).parent().parent().siblings().children().children().children(".price").html();
        p = String(p).substring(1, 4);
        $(this).parent().parent().siblings(".pri").html('$' + (p * n).toFixed(2));
        updateQuality($(this).parent().parent().parent(), $(this).val());
    });
    // handle click event after update elements
    $('.cart-table').on("click", ".add", function () {
        var n = $(this).siblings(".num").val();
        n++;
        $(this).siblings(".num").val(n);
        $(this).siblings(".num").change();
    });

    $('.cart-table').on("click", ".min", function () {
        var n = $(this).siblings(".num").val();
        if (n == 1) {
            return false;
        }
        n--;
        $(this).siblings(".num").val(n);
        $(this).siblings(".num").change();
    });

    

    //Empty All
    $('.total-price>button.ea').on("click", function () {
        // TODO animation
        alert("Cart has been CLEAR!");
        localStorage.removeItem("Cart");
        updateSummary();
        clearProductList();

    });

    //Remove button
    $('.cart-table').on("click", 'button', function () {
        removeItem($(this).parent().find('p').text());
        updateSummary();
        clearProductList();
        if (localStorage.getItem("Cart")) {
            fillProductList();
        }
        $(this).parent().parent().parent().parent().remove();
    });


});

function fillProductList() {
    let cart = localStorage.getItem('Cart');
    if (! (cart)){
        return true;
    }
    let table = $('.cart-table>tbody');
    JSON.parse(cart).forEach(i => {
        // add a new row(<tr>)
        var row = newRow(i.img, i.name, i.price, i.amount);
        table.append(row);
    })
};


function newRow(img, name, price, amount) {
    var row = document.createElement('tr');
    // create 4 <td>s separately
    var column0 = document.createElement('td');
    column0.innerHTML = `
    <input class="check" type="checkbox">
    `;
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
        <input class="min" name="" type="button" value="-">
        <input class="num" name="num" type="text" value="${amount}">
        <input class="add" name="" type="button" value="+">
    </div>
    `;
    var column3 = document.createElement('td');
    column3.id = 'pri';
    column3.innerHTML = "$" + price * 100 * amount / 100;
    row.appendChild(column0);
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
    if (! (cart)){
        return true;
    }
    // may not exist
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

    if (cart) {
        cart = JSON.parse(cart);
        cart.forEach(function (good) {
            totalItem = Number(totalItem) + Number(good.amount);
            subTotal = Number(subTotal) + Number(good.price) * 100 * Number(good.amount);
        });

        subTotal = subTotal / 100;
        QST = parseFloat(((subTotal * 100) * 9975 / 100000 / 100).toPrecision(12)).toFixed(2);
        GST = parseFloat((subTotal * 100 * 5 / 10000).toPrecision(12)).toFixed(2);
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

function removeItem(name) {
    // only called when exist good in the cart
    let cart = localStorage.getItem('Cart');
    if (cart) {
        cart = JSON.parse(cart);
        cart = cart.filter(function (item) {
            return item.name !== name;
        });

        if (cart.length == 0) {
            localStorage.removeItem('Cart');
        } else {
            localStorage.setItem("Cart", JSON.stringify(cart));
        }
    }
};