@extends('layouts.user_payment')

@section('content')

<div class="payment-container max-w-3xl mx-auto py-8 px-6 bg-white shadow-lg rounded-lg">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">General Payment</h2>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  {{-- Error Handling --}}
  @if($errors->any())
    <div class="alert-error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Payment Form --}}
  <form method="POST" action="{{ route('payments.general.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- Basic Payment Info --}}
    <div class="space-y-4 mb-6">
      <div>
        <label for="amount" class="font-semibold">Amount <span class="text-red-500">*</span></label>
        <input type="number" step="0.01" name="amount" id="amount"
               value="{{ old('amount', $payment->amount ?? '') }}" required
               class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
      </div>

      <div>
        <label for="narration" class="font-semibold">Narration <span class="text-red-500">*</span></label>
        <input type="text" name="narration" id="narration"
               value="{{ old('narration', $payment->narration ?? '') }}" required
               placeholder="Enter narration or purpose of payment"
               class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
      </div>

      <div>
        <label for="notes" class="font-semibold">Notes (Optional)</label>
        <textarea name="notes" id="notes" rows="3"
                  class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400"
                  placeholder="Add any relevant notes">{{ old('notes', $payment->notes ?? '') }}</textarea>
      </div>
    </div>

    {{-- Payment Method --}}
    <div class="payment-method border-t pt-6 mt-6">
      <h3 class="text-lg font-bold text-gray-700 mb-2">Payment Method</h3>

      <input type="hidden" name="payment_method" id="payment_method_input"
             value="{{ old('payment_method', $payment->payment_method ?? 'mobile') }}">

      {{-- Method Tabs --}}
      <div class="tabs flex space-x-3 mb-4">
        <button type="button" class="tab-button {{ old('payment_method', $payment->payment_method ?? 'mobile') == 'mobile' ? 'active' : '' }}" data-method="mobile">
          Mobile Money
        </button>
        <button type="button" class="tab-button {{ old('payment_method') == 'card' ? 'active' : '' }}" data-method="card">
          Card
        </button>
        <button type="button" class="tab-button {{ old('payment_method') == 'bank' ? 'active' : '' }}" data-method="bank">
          Bank Transfer
        </button>
      </div>

      {{-- Mobile Money Fields --}}
      <div id="mobile" class="tab-content {{ old('payment_method', $payment->payment_method ?? 'mobile') == 'mobile' ? 'active' : '' }}">
        <label for="mobile_number">Mobile Number <span class="text-red-500">*</span></label>
        <input type="text" name="mobile_number" value="{{ old('mobile_number', $payment->mobile_number ?? '') }}"
               placeholder="Enter mobile money number"
               class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
      </div>

      {{-- Card Fields --}}
      <div id="card" class="tab-content {{ old('payment_method') == 'card' ? 'active' : '' }}">
        <label for="card_number">Card Number <span class="text-red-500">*</span></label>
        <input type="text" name="card_number" value="{{ old('card_number', $payment->card_number ?? '') }}"
               placeholder="Enter card number"
               class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
      </div>

      {{-- Bank Fields --}}
      <div id="bank" class="tab-content {{ old('payment_method') == 'bank' ? 'active' : '' }}">
        <label for="bank_proof">Upload Proof of Payment <span class="text-red-500">*</span></label>
        <input type="file" name="bank_proof"
               class="w-full mt-1 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400" />
      </div>

      {{-- Submit --}}
      <div class="mt-6 flex justify-between">
        <a href="{{ route('payments.index') }}" class="cancel-btn">Cancel</a>
        <button type="submit" class="submit-btn">Submit Payment</button>
      </div>
    </div>
  </form>
</div>

{{-- Tab Switching Script --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab-button");
  const tabContents = document.querySelectorAll(".tab-content");
  const methodInput = document.getElementById("payment_method_input");

  tabButtons.forEach(button => {
    button.addEventListener("click", () => {
      const method = button.getAttribute("data-method");

      tabButtons.forEach(btn => btn.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      button.classList.add("active");
      document.getElementById(method).classList.add("active");
      methodInput.value = method;
    });
  });
});
</script>

{{-- Minimal Styling --}}
<style>
  .alert-success { background-color: #e6ffed; color: #1a7f37; padding: 10px; border-radius: 4px; margin-bottom: 1rem; }
  .alert-error { background-color: #fdecea; color: #b91c1c; padding: 10px; border-radius: 4px; margin-bottom: 1rem; }
  .tab-button {
    padding: 8px 16px;
    background: #f1f5f9;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
  }
  .tab-button.active {
    background: #3b82f6;
    color: white;
  }
  .tab-content { display: none; margin-top: 1rem; }
  .tab-content.active { display: block; }
  .cancel-btn {
    padding: 10px 20px;
    background: #e5e7eb;
    color: #111827;
    border-radius: 4px;
    text-decoration: none;
  }
  .submit-btn {
    padding: 10px 20px;
    background: #10b981;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
  }
</style>

@endsection
