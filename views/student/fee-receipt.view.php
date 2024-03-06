<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Fees Receipt</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="fees">Fees</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Receipt</a></li>
        </ol>
    </div>
</div>
				
<div class="row">
    <div class="col-lg-12">

        <div class="card mt-3">
            <div class="card-header"> Invoice <strong><?=$context['fee']['date']; ?></strong> <span class="float-right">
                    <strong>Status:</strong> Successful</span> </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <h6>From:</h6>
                        <div> <strong>Webz Poland</strong> </div>
                        <div>Madalinskiego 8</div>
                        <div>#8901 Marmora Road Chi Minh City</div>
                        <div>Email: info@example.com</div>
                        <div>Phone: +01 123 456 7890</div>
                    </div>
                    <div class="mt-4 col-xl-6 text-right col-lg-6 col-md-6 col-sm-12">
                        <h6>To:</h6>
                        <div> <strong>Bob Mart</strong> </div>
                        <div>Attn: Daniel Marek</div>
                        <div>#8901 Marmora Road Chi Minh City</div>
                        <div>Email: info@example.com</div>
                        <div>Phone: +02 987 654 3210</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">Date</th>
                                <th class="center">Invoice number</th>
                                <th class="center">Amount</th>
                                <th class="center">Payment Purpose</th>
                                <th class="center">Payment Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center"><?=$context['fee']['date']; ?></td>
                                <td class="center"><?=$context['fee']['invoice_id']; ?></td>
                                <td class="center">N<?=$context['fee']['amount']; ?></td>
                                <td class="center"><?=$context['fee']['purpose']; ?></td>
                                <td class="center"><?=$context['fee']['payment_method']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5"> </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong>N<?=$context['fee']['amount']; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary" type="submit">Download</button>
                        <button onclick="javascript:window.print();" class="btn btn-light" type="button"> <i class="fa fa-print"></i> Print </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
