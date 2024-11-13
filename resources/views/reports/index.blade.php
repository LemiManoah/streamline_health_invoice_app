<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Reports ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Generate Reports</h2>

                <form id="reportForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Report Type</label>
                            <select name="report_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="revenue">Revenue Report</option>
                                <option value="client">Client Report</option>
                                <option value="status">Status Report</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Generate Report
                        </button>
                    </div>
                </form>

                <div id="reportChart" class="mt-8 hidden">
                    <canvas id="reportCanvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let reportChart = null;

        document.getElementById('reportForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const params = new URLSearchParams(formData);

            try {
                const response = await fetch(`/reports/generate?${params.toString()}`);
                const data = await response.json();

                const chartElement = document.getElementById('reportChart');
                chartElement.classList.remove('hidden');

                if (reportChart) {
                    reportChart.destroy();
                }

                const ctx = document.getElementById('reportCanvas').getContext('2d');
                const chartConfig = createChartConfig(formData.get('report_type'), data);
                reportChart = new Chart(ctx, chartConfig);
            } catch (error) {
                console.error('Error generating report:', error);
            }
        });

        function createChartConfig(reportType, data) {
            switch (reportType) {
                case 'revenue':
                    return {
                        type: 'line',
                        data: {
                            labels: data.map(item => item.date),
                            datasets: [{
                                label: 'Daily Revenue',
                                data: data.map(item => item.total),
                                borderColor: 'rgb(75, 192, 192)',
                            }]
                        }
                    };

                case 'client':
                    return {
                        type: 'bar',
                        data: {
                            labels: data.map(item => item.client.name),
                            datasets: [{
                                label: 'Revenue by Client',
                                data: data.map(item => item.total),
                                backgroundColor: 'rgb(54, 162, 235)',
                            }]
                        }
                    };

                case 'status':
                    return {
                        type: 'pie',
                        data: {
                            labels: data.map(item => item.status),
                            datasets: [{
                                data: data.map(item => item.count),
                                backgroundColor: [
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    'rgb(255, 99, 132)'
                                ],
                            }]
                        }
                    };
            }
        }
    </script>
    @endpush
</x-app-layout>