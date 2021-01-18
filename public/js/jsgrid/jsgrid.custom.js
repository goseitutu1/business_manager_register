'use strict';

(function (jsGrid, $) {
    var NumberField = jsGrid.NumberField;
    var NumberField3 = jsGrid.NumberField;
    var SelectField = jsGrid.SelectField;

    function DecimalField(config) {
        NumberField.call(this, config);
    }

    function DisabledField(config) {
        NumberField3.call(this, config);
    }

    DecimalField.prototype = new NumberField({
        step: 0.01,
        min: 0,
        filterValue: function () {
            return this.filterControl.val() ? parseFloat(this.filterControl.val()) : undefined;
        },
        insertValue: function () {
            return this.insertControl.val() ? parseFloat(this.insertControl.val()) : undefined;
        },
        editValue: function () {
            return this.editControl.val() ? parseFloat(this.editControl.val()) : undefined;
        },
        _createTextBox: function () {
            return NumberField.prototype._createTextBox.call(this)
                .attr("step", this.step)
                .attr("min", this.min);
        }
    });

    DisabledField.prototype = new NumberField3({
        min: 0,
        _createTextBox: function () {
            return $("<input>").attr({
                type: "text",
                min: this.min, disabled: true
            });
        }
    });


    function Select2Field(config) {
        SelectField.call(this, config);
    }

    Select2Field.prototype = new SelectField({
        _createSelect() {
            let el = SelectField.prototype._createSelect.call(this);
            setTimeout(() => el.select2({placeholder: "- - -", width: '100%'}), 100);
            return el;
        }
    });

    jsGrid.fields.select2 = jsGrid.Select2Field = Select2Field;
    jsGrid.fields.decimal = jsGrid.DecimalField = DecimalField;
    jsGrid.fields.disabled = jsGrid.DisabledField = DisabledField;
}(jsGrid, jQuery));
