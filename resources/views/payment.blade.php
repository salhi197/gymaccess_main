@extends('layouts.master')
@section('content')

<form id="payment-form">
            <button type="submit" class="stripe-button">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png" alt="Stripe Logo">
                Pay with Stripe
            </button>
            <div id="card-element" class="mt-4"><!-- A Stripe Element will be inserted here. --></div>
            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
        </form>





@endsection

@section('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .stripe-button {
            background-color: #6772e5;
            color: white;
            border: none;
            display: inline-flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .stripe-button img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .stripe-button:hover {
            background-color: #5469d4;
        }
    </style>


@endsection

@section('scripts')

<script>
        const stripe = Stripe('{{ config('stripe.key') }}'); // Your publishable key
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const {error, paymentIntent} = await stripe.confirmCardPayment('{{ $clientSecret }}', {
                payment_method: {
                    card: cardElement,
                }
            });

            if (error) {
                // Display error.message in your UI.
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // The payment has been processed!
                // Here you can call your backend to store the payment and generate a code.
                console.log('Payment successful: ', paymentIntent);
            }
        });
    </script>


@endsection