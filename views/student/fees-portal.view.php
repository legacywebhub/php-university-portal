<style>
.payment-container {
	background-color: inherit;
	margin: 5px 20px;
	padding: 10px;
}
.payment-container button {
	width: 100%;
	margin: 7px 0;
}
#paypal-button-container {
	margin-top: 7px;
}
.hidden {
    display: none;
}
</style>

<!-- Paystack Inline CDN -->
<script src="https://js.paystack.co/v2/inline.js"></script>
<!-- Paypal Inline CDN -->
<script src="https://www.paypal.com/sdk/js?client-id=AWdJ6mFjMGvF1XuR0C18sNv81xd2F56k-97WGuaZ2LBdSgOofV50QLX3FLQW-uMEbNBI49MCrmKQ5UY5&currency=USD&disable-funding=credit"></script>

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Payment Portal</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="fees">Fees</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Portal</a></li>
        </ol>
    </div>
</div>
				
<div class="row">
    <div class="col-xl-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Make Payment</h5>
            </div>
            <div class="card-body">
                <form class="fee-form" name="fee-form" method="post">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Student Name</label>
                                <input type="text" class="form-control" name="name" value="<?=$context['student']['firstname']." ".$context['student']['lastname']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <select class="form-control" name="department_id" required>
                                    <option value=<?=$context['student']['department_id']; ?>><?=fetch_department($context['student']['department_id']);?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="form-label">Fee Duration</label><br>
                                <label class="radio-inline col-lg-3"><input type="radio" name="duration" value="monthly" disabled> Monthly</label>
                                <label class="radio-inline col-lg-3"><input type="radio" name="duration" value="semester" disabled> Yearly</label>
                                <label class="radio-inline col-lg-3"><input type="radio" name="duration" value="session" disabled checked> Session</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="form-label">Fee Purpose</label>
                                <select class="form-control" name="purpose" required>
                                    <option value="">Fee Purpose</option>
                                    <option value="<?=$context['student']['level']; ?> Level School Fee"><?=$context['student']['level']; ?> Level School Fee</option>
                                    <option value="<?=$context['student']['level']; ?> Level Department Fee"><?=$context['student']['level']; ?> Level Department Fee</option>
                                    <option value="<?=$context['student']['level']; ?> Level Perculiar Fee"><?=$context['student']['level']; ?> Level Perculiar Fee</option>
                                    <option value="<?=$context['student']['level']; ?> Level GS Fee"><?=$context['student']['level']; ?> Level GS Fee</option>
                                    <option value="<?=$context['student']['level']; ?> Level Portal Fee"><?=$context['student']['level']; ?> Level Portal Fee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" name="amount" maxlength="15" onkeypress="return onlyNumberKey(event)" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="form-label">Payment Method</label>
                                <select class="form-control" name="payment_method" required>
                                    <option value="card">Card</option>
                                    <!-- <option class="hidden" value="Exam">Cheque</option>
                                    <option class="hidden" value="Other">Other</option> -->
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Payment Details</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div> -->
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3 fee-form-buttons">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                            <a href="fees" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>

                <div class="mt-5 payment-container">
                    <h4 style="font-size:18px; opacity:.6">PAYMENT METHODS</h4><hr>
                    <div class="col-lg-8 col-sm-12">
                        <button class="btn btn-large btn-primary paystack-btn">Paystack <img src="<?=STATIC_ROOT; ?>/dashboard/images/paystack.png"></button>
                        <button class="btn btn-large btn-danger flutterwave-btn">Flutterwave <img src="<?=STATIC_ROOT; ?>/dashboard/images/flutterwave.png"></button>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	//THIS ENTIRE SCRIPT CODE IS FOR FEE PAYMENT PROCESSING FOR PAYSTACK AND PAYPAL

	// GLOBAL VARIABLES
	let email = "<?=$context['student']['email']; ?>", // Paystack needs this for payment
        feeForm = document.querySelector('.fee-form'),
        feeFormBtns = document.querySelector('.fee-form-buttons'),
		paymentContainer = document.querySelector('.payment-container'),
		paystackBtn = document.querySelector('.paystack-btn'),
		flutterwaveBtn = document.querySelector('.flutterwave-btn'),
		url = window.location.href;


	//payment container is set hidden by default with this line
	paymentContainer.classList.add("hidden");


	// EVENT LISTENERS
	feeForm.addEventListener('submit', (e)=>{
		e.preventDefault()
		// hide fee form buttons
		feeFormBtns.classList.add("hidden");
		// show payment pop up buttons
		paymentContainer.classList.remove("hidden");
        // flutterwave button event listener
        flutterwaveBtn.addEventListener('click', function(e){
            e.preventDefault();
            console.log('Flutterwave button clicked');
        })
        // paystack button event listener
        paystackBtn.addEventListener('click', function(e){
            e.preventDefault();
            console.log('Paystack button clicked');
            payWithPaystack();
        })
	})
	

	//FUNCTIONS
	// Paystack function
	function payWithPaystack() {
        // Declaring required variables from input form
        let amount = parseInt(feeForm['amount'].value);

		const paystack = new PaystackPop();

		paystack.newTransaction({

			key: 'pk_test_832c31b00dacb05ee5a7bb8c43786e381eb45921', // Replace with your public key

			email: email,

			amount: amount * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit (kobo)

			currency: "NGN", // Use GHS for Ghana Cedis or USD for US Dollars

			ref: "" + Math.floor(Math.random() * 1000000000 + 1), // Replace with a reference you generated

			onSuccess: (transaction) => {
                console.log("Payment successful");
				// Payment complete! Reference: transaction.reference
				submitFormData(transaction.reference);
			},
		
			onCancel: () => {
				// user closed popup
                swal("", "Payment aborted", "error");
			}

		});
	}


	// Function to submit form data after successful transaction
	function submitFormData(ref){
        
        // Declaring submission data
        let data = {
            'invoice_id': ref,
            'student_id': <?=$context['student']['id']; ?>,
            'department_id': <?=$context['student']['department_id']; ?>,
            'level': <?=$context['student']['level']; ?>,
            'purpose': feeForm['purpose'].value,
            'payment_method': feeForm['payment_method'].value,
            'amount': feeForm['amount'].value,
            'csrf_token': feeForm['csrf_token'].value
        }

        // Consoling submission data
        console.log(data);

        // Forwarding data
        fetch(url, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            console.log(data);
            if (data['status'] == 'success') {
                setTimeout(()=>{
                    swal("", data['message'], "success");
                    // Redirecting to fees page
                    setTimeout(()=>{
                        window.location.href = "fees";
                    }, 3000)
                }, 3000);
            } else {
                setTimeout(()=>{
                    swal("", data['message'], "error");
                }, 3000);
            }
        })

	}


	// Paypal function
	// Render the PayPal button into #paypal-button-container
	paypal.Buttons({
	
        // Set up the transaction
        createOrder: function(data, actions) {
            // Declaring new variables from fee form
            let amount = parseInt(feeForm['amount'].value);

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                submitFormData(transaction.id);

                // Replace the above to show a success message within this page, e.g.
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }

        // Note that that no DOM element should bear an ID of paypal else this won't work

    }).render('#paypal-button-container');

</script>