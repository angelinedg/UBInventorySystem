@extends('layouts.homenav')

@section('content')

@auth
                            
    @endauth
    @guest                 
      <meta http-equiv="refresh" content="0; URL='../login'" />
    @endguest

<div class="parallax">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header"> You are logged in as Admin!</div>
                

            </div>
            <br />
            <br />
            <div class="card mb-3">
             
              <div class="card-body">
                <h5 class="card-title">Chocolates</h5>
                <p class="card-text">Chocolate was once used as currency.
As early as 250 A.D., ancient civilizations of Mexico and South America, specifically The Mayans and the Aztecs, used the cocoa bean as a system of money.</p>
                
              </div>
            </div>
            <div class="card mb-3">
             
              <div class="card-body">
                <h5 class="card-title">Ketchups</h5>
                <p class="card-text">Now, this is our kinda cure!
Back in the 1800s, people believed tomatoes had a powerful healing property for curing the likes of diarrhea, jaundice and indigestion.
People took both ketchup and tomato pills in the hope of feeling better but the medicinal value of tomato based medicine collapse in 1840 after many tomato pills were found to be fraudulent. A shame really...</p>
                
              </div>
            </div>

             
        </div>
    </div>
</div>
</div>
@endsection


<style>
    body, html {
  height: 100%;
}

.parallax {
  /* The image used */
  background-image: url("/foodwall.jpg");

  /* Set a specific height */
  height: 100%;

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>