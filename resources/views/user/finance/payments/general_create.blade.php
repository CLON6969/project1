@extends('layouts.user_payment')

@section('content')

<div class="payment-container">
  <h2>GENERAL PAYMENT</h2>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert-error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('payments.general.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="payment-details">
      <div>
        <label for="amount"><strong>Amount</strong></label>
        <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" required>
      </div>

      <div>
        <label for="service"><strong>Service</strong></label>
        <select name="service" id="service" required>
          <option value="">-- Select Service --</option>
          @foreach($services as $service)
            <option value="{{ $service }}" {{ old('service') === $service ? 'selected' : '' }}>{{ $service }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="notes"><strong>Notes (optional)</strong></label>
        <textarea name="notes" id="notes" rows="3" placeholder="Enter any notes">{{ old('notes') }}</textarea>
      </div>
    </div>

    {{-- DO NOT MODIFY BELOW THIS LINE --}}
    <div class="payment-method">
      <h3>Payment Method</h3>
      <p>Please select a method and provide needed details.</p>

      <input type="hidden" name="payment_method" id="payment_method_input" value="mobile">

      <div class="tabs">
        <button type="button" class="tab-button active" data-method="mobile"><i class="fas fa-mobile"></i> Mobile Money</button>
        <button type="button" class="tab-button" data-method="card"><i class="fas fa-credit-card"></i> Card</button>
        <button type="button" class="tab-button" data-method="bank"><i class="fas fa-university"></i> Bank Proof of Payment</button>
        <button type="button" class="tab-button disabled"><i class="fas fa-wallet"></i> PayPal</button>
      </div>

      <div id="mobile" class="tab-content active">
        <label for="mobile_number">Mobile Number <span class="required">*</span></label>
        <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter mobile money phone number" />
      </div>

      <div id="card" class="tab-content">
        <label for="card_number">Card Number <span class="required">*</span></label>
        <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="Enter card number" />
      </div>

      <div id="bank" class="tab-content">
        <label for="bank_proof">Upload Bank Proof <span class="required">*</span></label>
        <input type="file" name="bank_proof" />
      </div>

      <div class="buttons">
        <a href="{{ url()->current() }}" class="cancel-btn">Cancel</a>
        <button type="submit" class="submit-btn">Submit Payment ▶</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab-button:not(.disabled)");
  const tabContents = document.querySelectorAll(".tab-content");
  const methodInput = document.getElementById("payment_method_input");

  tabButtons.forEach(button => {
    button.addEventListener("click", () => {
      tabButtons.forEach(btn => btn.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      button.classList.add("active");
      const method = button.getAttribute("data-method");
      if (method) {
        document.getElementById(method).classList.add("active");
        methodInput.value = method;
      }
    });
  });
});
</script>

<style>
  .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 1rem; }
  .alert-error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 1rem; }
  .tab-content { display: none; margin-top: 1rem; }
  .tab-content.active { display: block; }
  .tab-button.active { background-color: #f0f0f0; }
  .buttons { margin-top: 20px; display: flex; justify-content: space-between; }
  .cancel-btn, .submit-btn { padding: 10px 20px; border-radius: 5px; text-decoration: none; }
  .cancel-btn { background: #ccc; color: #000; }
  .submit-btn { background: #4CAF50; color: white; border: none; }
</style>

@endsection
