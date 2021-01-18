@push('scripts')
<script type="text/javascript">
    let data = {!! !empty(session('js_grid')) ? json_encode(session('js_grid')) : ($items ?? '[]') !!},
        products = {!!json_encode($products) !!};

    // Returns product object given its id
    function get_product(id) {
        let data;
        $.each(products, function (index, item) {
            if (item.id == id) return data = item;
        });
        return data;
    }

    // jsGrid item inserting or updating template
    function on_item_inserting_or_updating(args) {
        if (args.item.product_id === "") {
            alert("Invalid a product selected!");
            args.cancel = true;
        }
        let item = this.get_product(args.item.product_id);
        if (args.item.quantity > item.quantity) {
            alert("Item quantity must be less than "+item.quantity);
            args.cancel = true;
        }
        // set columns
        args.item.unit_price = item.selling_price.toFixed(2);
        args.item.total = (item.selling_price * args.item.quantity).toFixed(2);
    }

    // jsGrid item insert template
    function insert_template(fields) {
        let product = get_product(fields.product_id.insertControl.val()),
            quantity = parseFloat(fields.quantity.insertControl.val());

        let price = 0,
            sub_total = 0,
            vat_flat_total = 0,
            tax_total = 0;

        if (product !== null && quantity >= 0) {
            price = product.selling_price;
            sub_total = price * quantity;
        }

        fields.unit_price.insertControl.val(price.toFixed(2));
        fields.total.insertControl.val((sub_total).toFixed(2));
    }

    // Calculate the total amount of the sales
    function calculate_total() {
        $("#discount_value").attr('disabled', false);

        let data = {
            "total": $('#total'),
            "net_total": $('#net_total'),
            "total_discount": $('#total_discount'),
            "grid_items": $("#jsGrid").jsGrid("option", "data"),
        };

        // calculate order
        let math = { sub_total: 0, net_total: 0, discount: 0, net_total: 0};

        // calculate sub total + tax
        data.grid_items.forEach((item) => {
            let _sub_total = item.unit_price * item.quantity;

            math.sub_total += _sub_total;
        });
        let disc_value = parseFloat($("#discount_value").val());
        if($("#discount_type").val().includes('fixed') && disc_value > 0)
            math.discount = disc_value;

        if($("#discount_type").val().includes('percent') && disc_value > 0)
            math.discount = disc_value * 0.01 * math.sub_total;

        math.net_total = math.sub_total - math.discount;
        if(math.net_total < 0)
            alert("Discount entered exceed sales total amount!");

        data.total.val(math.sub_total.toFixed(2));
        data.total_discount.val(math.discount.toFixed(2));
        data.net_total.val(math.net_total.toFixed(2));
    }

    // hide or show credit & cash sales forms based on the sales type
    function salesFormVisibility(){
        if($("#type").val() === "credit_sales"){
            $('#credit-sales').show();
            $('#cash-sales').hide();
        }
        if($("#type").val() === "cash_sales"){
            $('#credit-sales').hide();
            $('#cash-sales').show();
        }
    }

    // function togglePhoneNumberField(){
    //     if($("#payment_method").val().includes("momo")){
    //         $('#phone_number').show();
    //     } else {
    //         $('#phone_number').hide();
    //     }
    // }

    // $('#payment_method').on('change',function () {
    //     if($('#payment_method').val() === 'cheque'){

    //         $('#cheque_block').css('display','block');
    //     }
    //     else{
    //         $('#cheque_block').css('display','none');
    //     }
    // });



    $(document).ready(function () {
        $('#customer_id').select2({
            width: '260',
            dropdownAutoWidth: true,
            theme: "bootstrap"
        });

        $('#discount_type').on('change', function(e){
            calculate_total();
        });

        $('#discount_value').keyup(function(){
            calculate_total();
        });

        // hide credit & cash sales forms on page load
        salesFormVisibility();
        // togglePhoneNumberField();

        $('#type').on('change', function(e){
            salesFormVisibility();
        });

        // $('#payment_method').on('change', function(e){
        //     togglePhoneNumberField();
        // });

        $("#jsGrid").jsGrid({
            width: "100%",
            height: "300px",
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            noDataContent: "Please Add Sales Items",
            data: data,
            controller: {
                loadData: function (filter) {
                    return {!!json_encode(session('js_grid')) !!};
                }
            },
            onItemInserting: function (args) {
                on_item_inserting_or_updating(args);
                // handler.onItemInsertingAndUpdating(args);
            },
            onItemUpdating: function (args) {
                on_item_inserting_or_updating(args);
            },
            onItemInserted: function (args) {
                calculate_total();
            },
            onItemUpdated: function (args) {
                calculate_total();
            },
            onItemDeleted: function (args) {
                calculate_total();
            },
            rowClick: function (args) {
                selectedItem = args.item;
                $selectedRow = $(args.event.target).closest("tr");
                $selectedRow.addClass("selected-row");
            },
            fields: [{
                    name: "product_id",
                    title: "Product",
                    type: "select2",
                    align: "left",
                    width: 130,
                    items: products,
                    valueField: "id",
                    textField: "name",
                    insertTemplate: function () {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.select2.prototype.insertTemplate
                            .call(this).trigger("change");
                        result.on("change", function () {
                            let product = get_product(data.product_id
                                .insertControl.val());
                            data.unit_price.insertControl.val(product
                                .selling_price);
                            insert_template(data);
                        });
                        return result;
                    },
                    editTemplate: function (value, item) {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.select2.prototype.editTemplate.call(
                            this, value, item);
                        result.on("change", function () {
                            let product = get_product(data.product_id.editControl
                                .val());
                            data.unit_price.editControl.val(product
                                .selling_price);
                            edit_template(data);
                        });
                        return result;
                    }
                },
                {
                    name: "unit_price",
                    title: "Unit Price",
                    type: "decimal",
                    width: 80,
                    align: "right",
                    readOnly: true
                },
                {
                    name: "quantity",
                    title: "QTY",
                    type: "number",
                    width: 50,
                    align: "center",
                    validate: {
                        validator: function (value, item) {
                            return value > 0;
                        },
                        message: "Quantity SHOULD be GREATER than Zero (0)!"
                    },
                    insertTemplate: function () {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.number.prototype.insertTemplate.call(
                            this);
                        result.val(1);
                        result.on("change", function () {
                            insert_template(data);
                        });
                        return result;
                    },
                    editTemplate: function (value, item) {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.number.prototype.editTemplate.call(
                            this, value, item);
                        result.on("change", function () {
                            edit_template(data);
                        });
                        return result;
                    }
                },
                {
                    name: "total",
                    title: "TOTAL",
                    type: "decimal",
                    width: 80,
                    align: "right",
                    readOnly: true
                },
                {
                    type: "control"
                }
            ]
        });

        // on save: retrieve grid and submit
        $('#btn_submit').on('click', function (e) {
            e.preventDefault();
            var action = $('#sales'),
                grid = $("#jsGrid").jsGrid("option", "data");

            $('#items').val(JSON.stringify(grid));
            $('#save_and_apply').val(false);

            action.submit();
        });
        // on save & apply: retrieve grid and submit
        $('#btn_apply').on('click', function (e) {
            e.preventDefault();
            var action = $('#sales'),
                grid = $("#jsGrid").jsGrid("option", "data");

            $('#items').val(JSON.stringify(grid));
            $('#save_and_apply').val(true);
            action.submit();
        });
    });

    function edit_template(fields) {
        let product = get_product(fields.product_id.editControl.val()),
            quantity = parseInt(fields.quantity.editControl.val());

        let price = 0,
            sub_total = 0,
            vat_flat_total = 0,
            tax_total = 0;

        if (product !== null && quantity >= 0) {
            price = product.selling_price;
            sub_total = price * quantity;
        }

        fields.unit_price.editControl.val(price.toFixed(2));
        fields.total.editControl.val((sub_total + tax_total).toFixed(2));
    }

    function grid_fields(fields) {
        return {
            "product_id": fields[0],
            "unit_price": fields[1],
            "quantity": fields[2],
            "total": fields[3],
        };
    }

</script>
@endpush
