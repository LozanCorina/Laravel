@extends('layouts.main')
@section('content')
<body>
    @php
        $stripe_key = 'pk_test_51IMs8sGodsiojyonCpTZ1Zcxd8jb5R5WHgvTnORVUGCRsqz3U8XXlnZDT2CBRyRJyQq3MA01AzwmtlkMAbv0WKxX00oRkBJ02l';
    @endphp
    <section class="section-content bg padding-y border-top">
    <div class="container" style="margin-top:5%;margin-bottom:5%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif   
                    <header class="card-header">     
                        <h4 class="card-title mt-2">Finalizare comandă</h4>
                    </header>
                    <div class="content" style="padding-left: 20px;">
                        <p>Suma spre achitare: {{returnPriceFormat($amountFormat)}}</p>                       
                    </div>
                </div>
                <div class="card">
                    <form method="POST"  action="{{route('procesat.stripe')}}"  id="payment-form">
                        @csrf       
                        <input type="hidden" name="name" value="{{$data['name']}}">  
                        <input type="hidden" name="email" value="{{$data['email']}}">
                        <input type="hidden" name="phone" value="{{$data['phone']}}">
                        <input type="hidden" name="date" value="{{$data['date']}}">
                        <input type="hidden" name="city" value="{{$data['city']}}">
                        <input type="hidden" name="home" value="{{$data['home']}}">
                        <input type="hidden" name="amount" value="{{$data['amount']}}">
                        <input type="hidden" name="note" value="{{$data['note']}}">
                        <input type="hidden" name="discount" value="{{$data['discount']}}">
                        <input type="hidden" name="delivery" value="{{$data['delivery']}}">
                        <input type="hidden" name="subtotal" value="{{$data['subtotal']}}">
                        <input type="hidden" name="radio" value="{{$data['radio']}}">                       

                        <div class="form-group">
                            <div class="card-header">
                                <label for="card-element">
                                    Introdu datele de pe card
                                </label>
                            </div>
                            <div class="card-body">
                                <div id="card-element" name="card">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input type="hidden" name="plan" value="" />
                            </div>
                        </div>
                        <div class="card-footer">
                          <button
                          id="card-button"
                          class="btn btn-primary btn-block"
                          style="width: 330px;"
                          type="submit"
                          data-secret="{{ $intent }}"
                        > Achită </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#ed6555',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#ed6555',
                iconColor: '#ed6555'
            }
        };
    
        const stripe = Stripe('{{ $stripe_key }}', { locale: 'ro' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style , hidePostalCode: true}); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
    
        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
    
        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    
        // Handle form submission.
        var form = document.getElementById('payment-form');
    
        form.addEventListener('submit', function(event) {
            event.preventDefault();
           // document.getElementById('card-button').disabled=true;
    
        stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                   // billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    form.submit();
                }
            });
        });
    </script>   
</body>
</htlm>
@endsection