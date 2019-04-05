<form id="form1">
    <input type="text" name="title" id="title" value ="{{$data['title']}}">
    <input type="text" name="body" id="body" value="{{$data['body']}}">
    <input type="submit">
</form>

<div id="paypal-button"></div>
							<script src="https://www.paypalobjects.com/api/checkout.js"></script>
							<script>
							  paypal.Button.render({
								// Configure environment
								env: 'sandbox',
								client: {
								  sandbox: 'AbQ-W8EhlRDQw4a2yngGL8b-kzS4xkOeWjXlNWxK0GvX7W7C5Ehn8sRqI4cLfsF98PHGhbQNgN1fNmlG',
								  production: 'demo_production_client_id'
								},
								// Customize button (optional)
								locale: 'en_US',
								style: {
								  size: 'small',
								  color: 'gold',
								  shape: 'pill',
								},
							
								// Enable Pay Now checkout flow (optional)
								commit: true,
							
								// Set up a payment
								payment: function(data, actions) {
								  return actions.payment.create({
									transactions: [{
									  amount: {
										total: '0.01',
										currency: 'USD'
									  }
									}]
								  });
								},
								// Execute the payment
								onAuthorize: function(data, actions) {
								  return actions.payment.execute().then(function() {
									// Show a confirmation message to the buyer
									window.alert('Thank you for your purchase!');
								  });
								}
							  }, '#paypal-button');
							
							</script>