<!-- Updated Blade Partial: resources/views/admin/subscriptions/partials/table.blade.php -->
<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center p-4">
        <h3 class="text-lg font-semibold">Subscription List</h3>
        <a href="{{ route('admin.subscriptions.export') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm">Export CSV</a>
    </div>

    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">
            <tr>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Package</th>
                <th class="px-4 py-2">Plan</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Date</th>
                @if(isset($showApprove) && $showApprove)
                <th class="px-4 py-2">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $sub)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $sub->user->name }}</td>
                <td class="px-4 py-2">{{ $sub->user->email }}</td>
                <td class="px-4 py-2">{{ $sub->package->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $sub->plan->name }}</td>
                <td class="px-4 py-2 capitalize">
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium
                        {{
                            $sub->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($sub->status === 'approved' ? 'bg-green-100 text-green-800' :
                            'bg-red-100 text-red-800')
                        }}">
                        {{ $sub->status }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $sub->created_at->format('d M Y') }}</td>
                @if(isset($showApprove) && $showApprove)
                <td class="px-4 py-2">
                    <form method="POST" action="{{ route('admin.subscriptions.approve', $sub->id) }}" class="inline-block approve-form">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 px-4">
        {{ $subscriptions->links() }}
    </div>
</div>

<script>
// Optional AJAX approve handling (graceful fallback still posts normally)
document.querySelectorAll('.approve-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!confirm('Are you sure you want to approve this subscription?')) return;

        const res = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                'Accept': 'application/json'
            },
        });

        if (res.ok) {
            alert('Subscription approved!');
            location.reload();
        } else {
            alert('Failed to approve.');
        }
    });
});
</script>
