// Create a Stripe client.
const stripe = Stripe(stripePublicKey);

// Create an instance of Elements.
const elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
const style = {
    base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4",
        },
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a",
    },
};

// Create an instance of the card Element.
const card = elements.create("card", {
    style: style
});
card.mount("#card-element");

card.on("change", ({
    error
}) => {
    const displayError = document.getElementById("card-errors");
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = "";
    }
});

// On gère le paiement
let cardButton = document.getElementById("submit");
//let clientSecret = cardButton.dataset.secret;
let donateName = document.getElementById("donate_name").value;
let form = document.getElementById("payment-form");
form.addEventListener("submit", function(ev) {
    ev.preventDefault();
    stripe
        .confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: donateName,
                },
            },
        })
        .then(function(result) {
            console.log(result);
            if (result.error) {
                document.getElementById("errors").innerText = result.error.message;
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === "succeeded") {
                    //  $("#payment-form").submit()
                    document.location.href = redirectAfterSuccessUrl;
                }
            }
        });
});