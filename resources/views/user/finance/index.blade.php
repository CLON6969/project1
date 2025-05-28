@extends('layouts.financial')

@section('content')
<div class="p-6 space-y-8">

    <h2 class="text-2xl font-bold text-gray-800">Finance Overview</h2>

    {{-- 1. Bar Chart: Summary Comparison --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Summary: Payments, Invoices, Expenses, Budgets</h3>
        <canvas id="summaryChart" class="w-full h-64"></canvas>
    </div>

    {{-- 2. Doughnut Chart: Distribution --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribution</h3>
        <canvas id="distributionChart" class="w-full h-64"></canvas>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const summaryChart = new Chart(document.getElementById('summaryChart'), {
        type: 'bar',
        data: {
            labels: ['Payments', 'Invoices', 'Expenses', 'Budgets'],
            datasets: [{
                label: 'ZMW',
                data: [
                    {{ $totalPayments }},
                    {{ $unpaidInvoices->sum('amount') }},
                    {{ $totalExpenses }},
                    {{ $totalBudgets }}
                ],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#3b82f6'],
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (context) => `ZMW ${context.parsed.y.toLocaleString()}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6b7280' }
                },
                x: {
                    ticks: { color: '#6b7280' }
                }
            }
        }
    });

    const distributionChart = new Chart(document.getElementById('distributionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Payments', 'Invoices', 'Expenses', 'Budgets'],
            datasets: [{
                data: [
                    {{ $totalPayments }},
                    {{ $unpaidInvoices->sum('amount') }},
                    {{ $totalExpenses }},
                    {{ $totalBudgets }}
                ],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#3b82f6'],
                hoverOffset: 12
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#374151'
                    }
                }
            }
        }
    });
</script>
@endsection
