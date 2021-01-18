@push('scripts')
<script type="text/javascript">
    let data = {!! !empty(session('js_grid')) ? json_encode(session('js_grid')) : ($items ?? '[]') !!},
        services = {!! json_encode($services) !!};

    // Returns service object given its id
    function get_service(id) {
        let data;
        $.each(services, function (index, item) {
            if (item.id == id) return data = item;
        });
        return data;
    }

    // jsGrid item inserting or updating template
    function on_item_inserting_or_updating(args) {
        if (args.item.service_id === "") {
            alert("ERROR: Invalid a service selected!");
            args.cancel = true;
        }
        // this.tax_error_alert(args);
        let item = this.get_service(args.item.service_id);

        // set columns
        args.item.amount = item.amount.toFixed(2);
        args.item.total = (item.amount * args.item.quantity).toFixed(2);
    }

    // jsGrid item insert template
    function insert_template(fields) {
        let service = get_service(fields.service_id.insertControl.val());
        let total = service.amount * fields.quantity.insertControl.val();

        fields.amount.insertControl.val(service.amount.toFixed(2));
        fields.total.insertControl.val((total).toFixed(2));
    }

    // Calculate the total amount of the sales
    function calculate_total() {
        $("#discount_value").attr('disabled', false);

        //TODO: add taxes to jsgrid and calculation
        let data = {
            "total": $('#total'),
            "net_total": $('#net_total'),
            "total_discount": $('#total_discount'),
            "grid_items": $("#jsGrid").jsGrid("option", "data"),
        };

        // calculate order
        let math = {
            sub_total: 0,
            net_total: 0,
            discount: 0
        };

        // calculate sub total + tax
        data.grid_items.forEach((item) => {
            let _sub_total = parseFloat(item.amount * item.quantity);
            math.sub_total += _sub_total;
        });

        let  disc_value = parseFloat($("#discount_value").val());
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
        if($("#type").val() == "credit_sales"){
            $('#credit-sales').show();
            $('#cash-sales').hide();
        }
        if($("#type").val() == "cash_sales"){
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

    $(document).ready(function () {
        $('#customer_id').select2({
            width: '260',
            dropdownAutoWidth: true,
            theme: "bootstrap"
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

        $('#discount_type').on('change', function(e){
            calculate_total();
        });

        $('#discount_value').keyup(function(){
            calculate_total();
        });

        if(data.length > 0){
            $("#discount_value").attr('disabled', false);
        }

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
                    return {!!json_encode(session('js_grid', [])) !!};
                }
            },
            onItemInserting: function (args) {
                on_item_inserting_or_updating(args);
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
                    name: "service_id",
                    title: "Service",
                    type: "select2",
                    align: "left",
                    width: 130,
                    items: services,
                    valueField: "id",
                    textField: "name",
                    insertTemplate: function () {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.select2.prototype.insertTemplate
                            .call(this).trigger("change");
                        result.on("change", function () {
                            let service = get_service(data.service_id
                                .insertControl.val());
                            data.amount.insertControl.val(service
                                .amount);
                            insert_template(data);
                        });
                        return result;
                    },
                    editTemplate: function (value, item) {
                        let data = grid_fields(this._grid.fields);
                        let result = jsGrid.fields.select2.prototype.editTemplate.call(
                            this, value, item);
                        result.on("change", function () {
                            let service = get_service(data.service_id.editControl
                                .val());
                            data.amount.editControl.val(service
                                .amount);
                            edit_template(data);
                        });
                        return result;
                    }
                },
                {
                    name: "quantity",
                    title: "Quantity",
                    type: "number",
                    width: 50,
                    align: "center",
                    default: 1,
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
                    name: "amount",
                    title: "Amount",
                    type: "decimal",
                    width: 80,
                    align: "right",
                    readOnly: true
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
        let service = get_service(fields.service_id.editControl.val());
        let quantity = fields.quantity.editControl.val();

        if (service !== null && quantity >= 0) {
            sub_total = service.amount * quantity;
        }
        fields.amount.editControl.val(service.amount.toFixed(2));
        fields.total.editControl.val((sub_total).toFixed(2));
    }

    function grid_fields(fields) {
        return {
            "service_id": fields[0],
            "quantity": fields[1],
            "amount": fields[2],
            "total": fields[3],
        };
    }

</script>
@endpush
