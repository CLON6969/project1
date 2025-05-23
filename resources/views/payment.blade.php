<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Make Payment</title>
 <style>body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f5f6fa;
  margin: 0;
  padding: 2rem;
}

.payment-container {
  background: white;
  max-width: 800px;
  margin: auto;
  border-radius: 8px;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.payment-details {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin-bottom: 2rem;
}

.payment-details div {
  margin-bottom: 1rem;
  min-width: 160px;
}

.payment-method h3 {
  margin-bottom: 0.2rem;
}

.tabs {
  display: flex;
  margin: 1rem 0;
}

.tab-button {
  flex: 1;
  padding: 0.75rem;
  border: 1px solid #ccc;
  background: #f2f2f2;
  cursor: pointer;
  font-weight: bold;
  color: #5e4bff;
}

.tab-button.active {
  background: #fff;
  border-bottom: 2px solid #5e4bff;
  color: black;
}

.tab-content {
  display: none;
  margin-bottom: 1.5rem;
}

.tab-content.active {
  display: block;
}

input[type="text"], input[type="file"] {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 0.5rem;
  margin-bottom: 1rem;
}

.required {
  color: red;
}

.buttons {
  display: flex;
  justify-content: space-between;
}

.cancel-btn, .submit-btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
}

.cancel-btn {
  background: #eee;
}

.submit-btn {
  background: #292b66;
  color: white;
}
</style>
</head>
<body>

  <div class="payment-container">
    <h2>MAKE PAYMENT</h2>

    {{-- Payment Details from Controller --}}
    <div class="payment-details">
      <div><strong>TRANSACTION</strong><p>{{ $payment->transaction_type }}</p></div>
      <div><strong>REFERENCE</strong><p>{{ $payment->reference }}</p></div>
      <div><strong>NARRATION</strong><p>{{ $payment->narration }}</p></div>
      <div><strong>TOTAL AMOUNT</strong><p>K{{ number_format($payment->amount, 2) }}</p></div>
    </div>

    <div class="payment-method">
      <h3>Payment Method</h3>
      <p>Please select a method and provide needed details.</p>

      <form action="{{ route('payments.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="payment_id" value="{{ $payment->id }}">

        <div class="tabs">
          <button type="button" class="tab-button active" data-method="mobile">📱 Mobile Money</button>
          <button type="button" class="tab-button" data-method="card">💳 Card</button>
          <button type="button" class="tab-button" data-method="bank">💵 Bank Proof of Payment</button>
        </div>

        <div id="mobile" class="tab-content active">
          <label for="mobile-number">Mobile Number <span class="required">*</span></label>
          <input type="text" id="mobile-number" name="mobile_number" placeholder="Enter mobile money phone number" />
        </div>

        <div id="card" class="tab-content">
          <label for="card-number">Card Number <span class="required">*</span></label>
          <input type="text" id="card-number" name="card_number" placeholder="Enter card number" />
        </div>

        <div id="bank" class="tab-content">
          <label for="bank-proof">Upload Bank Proof <span class="required">*</span></label>
          <input type="file" id="bank-proof" name="bank_proof" />
        </div>

        <div class="buttons">
          <a href="{{ route('dashboard') }}" class="cancel-btn">Cancel</a>
          <button type="submit" class="submit-btn">Submit Payment ▶</button>
        </div>
      </form>
    </div>
  </div>

<script>
const tabButtons = document.querySelectorAll(".tab-button");
const tabContents = document.querySelectorAll(".tab-content");

tabButtons.forEach(button => {
  button.addEventListener("click", () => {
    tabButtons.forEach(btn => btn.classList.remove("active"));
    tabContents.forEach(content => content.classList.remove("active"));
    button.classList.add("active");
    const method = button.getAttribute("data-method");
    document.getElementById(method).classList.add("active");
  });
});
</script>
  
</body>
</html>
