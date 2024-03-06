<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>My Fees History</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="fees-portal" class="btn btn-primary">+ New payment</a>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Invoice ID</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($context['fees'])): ?>
                            <tr role="row" class="even">
                                <td>
                                    No paid fees yet
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach($context['fees'] as $fee): ?>
                                <tr>
                                    <td><?=$fee['date']; ?></td>
                                    <td>N<?=$fee['amount']; ?></td>
                                    <td><?=$fee['purpose']; ?></td>
                                    <td><?=$fee['payment_method']; ?></td>
                                    <td><?=$fee['invoice_id']; ?></td>
                                    <td>
                                        <a href="fee-receipt?invoice_id=<?=$fee['invoice_id']; ?>" class="btn btn-sm btn-primary">view</a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>