$(function () {
    
    $(".checkall").change(function () {
        // $(this).prop("checked");
        $(".check").prop("checked", $(this).prop("checked"));
        if ($(this).prop("checked")) {
            // add class name check-cart-item
            $(".p_item").addClass("check-cart-item");
        } else {
            $(".p_item").removeClass("check-cart-item");
        }
    });

    $(".check").change(function () {
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

    $(".add").click(function () {
        var n = $(this).siblings(".num").val();
        n++;
        $(this).siblings(".num").val(n);
        var p = $(this).parent().parent().siblings().children().children().children(".price").html();
        p = p.substr(1, 4);
        $(this).parent().parent().siblings(".pri").html('$' + (p * n).toFixed(2));
        getSum();
    });

    $(".min").click(function () {
        var n = $(this).siblings(".num").val();
        if (n == 1) {
            return false;
        }
        n--;
        $(this).siblings(".num").val(n);
        var p = $(this).parent().parent().siblings().children().children().children(".price").html();
        p = p.substr(1, 4);
        $(this).parent().parent().siblings(".pri").html('$' + (p * n).toFixed(2));
        getSum();
    });

    $(".num").change(function () {
        var n = $(this).val();
        var p = $(this).parent().parent().siblings().children().children().children(".price").html();
        p = p.substr(1, 4);
        $(this).parent().parent().siblings(".pri").html('$' + (p * n).toFixed(2));
        getSum();
    });
    getSum();

    // total items and subtotal
    function getSum() {
        var count = 0;
        var price = 0;
        $(".num").each(function (i, ele) {
            count += parseInt($(ele).val());
        });
        $(".totalitems").text(count);
        $(".pri").each(function (i, ele) {
            price += parseFloat($(ele).text().substr(1));
        });
        $(".subtotal").text("$" + price.toFixed(2));
    }
    // remove items
    $(".remove").click(function () {
        $(this).parents(".p_item").remove();
        getSum();
    });

    // remove all
    $(".ea").click(function () {
        $(".p_item").remove();
        getSum();
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
        // create 4 <td>s separately
        var column0 = document.createElement('td');
        column1.innerHTML = `
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
            <input type="number" value="${amount}"  min="0" >
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

})