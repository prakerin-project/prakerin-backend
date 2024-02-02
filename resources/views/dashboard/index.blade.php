@extends('layouts.index')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col">
            <div style="columns: 20rem; column-gap:.825rem;">
                <div id="chart-1" class="bg-danger" style="height: 10rem; break-inside: avoid-column"></div>
                <div id="chart-2" class="bg-danger" style="height: 10rem; break-inside: avoid-column"></div>
                <div id="chart-3" class="bg-danger" style="height: 10rem; break-inside: avoid-column"></div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        const options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            }
        }
        console.log($("#chart-1").first());
        const chart = new ApexChart($("#chart-1").first()[0], options);

        chart.render();
    </script>
@endsection
