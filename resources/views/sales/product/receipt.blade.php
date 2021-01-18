<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
        {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}

        <!-- CSS only -->
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" media="print"> --}}

        <title>Document</title>
        <style>
            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .text-left {
                text-align: left;
            }

            /* hr {
                border: 0.5px dashed #B1B1B3;
            } */
            hr {
                border: dashed 1px #B1B1B3;
                /* width: 96%; */
                color: #B1B1B3;
                /* height: 0.5px; */
            }

            tr>th {
                border-top: 1px dashed rgb(153, 153, 156);
                border-bottom: 1px dashed rgb(153, 153, 156);
            }

            .no-border {
                border: none;
            }

            .total {
                font-weight: bold;
                font-size: 30;
            }

            .payment {
                font-weight: bold;
                font-size: 20;
            }

            /* tfoot>tr>td {
                border-bottom: 1px dashed #B1B1B3;
            } */
        </style>
    </head>

    <body>
        @php
            $items_count = $data->items->count();
            $currency = @$data->businesss->currency->code;
            $barcode = DNS1D::getBarcodeHTML("{$data->id}", 'UPCA', 3,65);
        @endphp

        <div class="text-center">
            <img src="{{ asset($data->business->logo) }}" alt="{{ $data->business->name }} logo" class="mt-5" width="100%" height="200px" style="margin-bottom: 10px;">
        </div>
        <hr>
        <p class="text-center" style="margin: 5px 0 5px 0;"> <strong>SALES RECEIPT</strong> </p>

        <table width="100%">
            <tr>
                <th>Qty</th>
                <th>Item Description</th>
                <th>Price</th>
            </tr>
            @foreach($data->items as $item)
            <tr>
                <td>{{ $item->quantity }}x</td>
                <td>{{ $item->name }}</td>
                <td class="text-right">{{ $currency . $item->total }}</td>
            </tr>
            @endforeach
        </table>

        <p class="text-center" style="margin: 10px 0 5px 0;"><strong>{{ $items_count }}x Items Sold</strong></p>

        <table width="100%">
            <tr>
                <th class="text-left">Sub Total: </th>
                <th class="text-right">{{ $data->total }}</th>
            </tr>
            <tr>
                <td>Line Discount:</td>
                <td class="text-right">{{ $data->total_discount / $items_count }}</td>
            </tr>
            <tfoot>
                <tr>
                    <td><strong>Discount Total:</strong> </td>
                    <td class="text-right"><strong>{{ $data->total_discount }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <hr>
        <table width="100%">
            <tr class="no-border">
                <th class="text-left no-border"><span class="total">Total: </span></th>
                <th class="text-right no-border total"><span class="total">{{ $data->total_payable }}</span></th>
            </tr>
            <tr>
                <td>Cash</td>
                <td class="text-right"><span class="payment">{{ $data->payment->amount_paid }}</span></td>
            </tr>
        </table>
        <hr>

        <h4 class="text-center">THANK YOU</h4>

        <pre class="text-center">{!! $barcode !!}</pre>
    </body>

</html>
