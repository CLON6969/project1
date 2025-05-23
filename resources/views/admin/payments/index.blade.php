@extends('layouts.admin_dashboard')

@section('content')
<div class="container">
   

    <table class="payment-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Method</th>
                <th>Transaction ID</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Screenshot</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->user->name }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                <td class="notes">
                    <button class="show-notes-btn">View Notes</button>
                    <div class="notes-overlay">
                        <div class="overlay-content">
                            <p>{{ $payment->notes }}</p>
                            <button class="close-overlay">Close</button>
                        </div>
                    </div>
                </td>
                <td class="status">
                    <span class="status-{{ $payment->status }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </td>
                <td>
                    @if ($payment->screenshot_path)
                    <button class="show-screenshot-btn">View Screenshot</button>
                    <div class="screenshot-overlay">
                        <div class="overlay-content">
                            <img src="{{ asset('storage/' . $payment->screenshot_path) }}" class="screenshot-img">
                            <button class="close-overlay">Close</button>
                        </div>
                    </div>
                    @else
                    <span class="no-screenshot">None</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.approve_payment', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="status-dropdown">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>
                        <button type="submit" class="update-button">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Handle showing and closing the Notes Overlay
    const showNotesBtns = document.querySelectorAll('.show-notes-btn');
    const notesOverlays = document.querySelectorAll('.notes-overlay');
    const closeNotesBtns = document.querySelectorAll('.close-overlay');

    showNotesBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            notesOverlays[index].style.display = 'block';
        });
    });

    closeNotesBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.target.closest('.notes-overlay').style.display = 'none';
        });
    });

    // Handle showing and closing the Screenshot Overlay
    const showScreenshotBtns = document.querySelectorAll('.show-screenshot-btn');
    const screenshotOverlays = document.querySelectorAll('.screenshot-overlay');
    const closeScreenshotBtns = document.querySelectorAll('.close-overlay');

    showScreenshotBtns.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            screenshotOverlays[index].style.display = 'block';
        });
    });

    closeScreenshotBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.target.closest('.screenshot-overlay').style.display = 'none';
        });
    });
});

</script>


@endsection
