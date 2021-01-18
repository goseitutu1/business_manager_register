<!--    Sub Menu Modals-->

{{-- <div class="modal fade" id="accountsmanagerModal" tabindex="-1" role="dialog" aria-labelledby="accountsmanagerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountsmanagerLabel">Accounts Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('account.gl.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            General Ledger
                        </li>
                    </a>

                    <a href="{{ route('account.journal.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            General Journal
                        </li>
                    </a>

                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div> --}}



<div class="modal fade" id="inventorymanagerModal" tabindex="-1" role="dialog" aria-labelledby="inventorymanagerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventorymanagerLabel">Inventory Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('inventory.product.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Products
                        </li>
                    </a>

                    <a href="{{ route('inventory.service.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Services
                        </li>
                    </a>

                    <a href="{{ route('inventory.category.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Categories
                        </li>
                    </a>

                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentLabel">Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('sales.payment.paid') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Paid
                        </li>
                    </a>

                    <a href="{{ route('sales.payment.owing.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Owing
                        </li>
                    </a>

                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="salesmanagerModal" tabindex="-1" role="dialog" aria-labelledby="salesmanagerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salesmanagerLabel">Sales Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('sales.product.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Products
                        </li>
                    </a>

                    <a href="{{ route('sales.service.index') }}" style="color:#1a237e">
                        <li class="list-group-item">
                            Services
                        </li>
                    </a>
                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--    End of modals-->
