// Create a Stripe client.
var stripe = Stripe('pk_test_51HN5AkI9xYefOdXp3ZXTbAolGE8ZLvuvjGfC2KfMS12BLJzRTtgFkVj0mGSZRNOhrReUG25nPukhBYZ3m03wGTfD00K1AoPx3G');

// Create an instance of Elements.
var elements = stripe.elements();


// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});
card.mount('#card-element');

card.on('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
    }
});

// On gère le paiement
var cardButton  = document.getElementById('submit');
var clientSecret  = cardButton.dataset.secret ;
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(ev) {
   // ev.preventDefault();
    stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: card,
            billing_details: {
                name: 'DIOUMASSI'
            }
        }
    }).then(function (result) {
        console.log(result);
        if (result.error) {
            document.getElementById("errors").innerText = result.error.message
        } else {
            // The payment has been processed!
            if (result.paymentIntent.status === 'succeeded') {
            //  $("#payment-form").submit()
                document.location.href = '/donate';
            }
        }
    });
});