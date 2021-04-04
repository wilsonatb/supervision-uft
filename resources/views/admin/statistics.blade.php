@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Reporte </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<figure class="highcharts-figure">
    <div id="container"></div>
</figure>

{{-- <ul class="list-group mb-3">
    @php($i = 1)
    <li class="list-group-item active">Leyenda de campos</li>
    @foreach($percentages_1 as $key => $value)

    @if ($i%2 != 0)

        <li class="list-group-item">{{ $i++ }}-{{$key}}</li>
        
    @endif
    @php($i++)
    @endforeach
</ul> --}}

<script src="{{ asset('adminlte/chart/highcharts.js') }}"></script>
<script src="{{ asset('adminlte/chart/data.js') }}"></script>
<script src="{{ asset('adminlte/chart/drilldown.js') }}"></script>
<script src="{{ asset('adminlte/chart/exporting.js') }}"></script>
<script src="{{ asset('adminlte/chart/export-data.js') }}"></script>
<script src="{{ asset('adminlte/chart/accessibility.js') }}"></script>

<script>
    // Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Estadisticas por corte'
    },
    subtitle: {
        text: 'Click para ver mas detalles'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
    },

    series: [
        {
            name: "Cortes",
            
            data: [
                {
                    name: "Bloque Cero",
                    y: 100,
                    drilldown: "Bloque Cero"
                },
                {
                    name: "Corte I",
                    y: 100,
                    drilldown: "Corte I"
                },
                {
                    name: "Corte II",
                    y: 100,
                    drilldown: "Corte II"
                },
                {
                    name: "Corte III",
                    y: 100,
                    drilldown: "Corte III"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: 'Bloque Cero',
                    id: 'Bloque Cero',
                    data: [
                        @foreach($percentages_0 as $name => $value)
                        [
                            '{{ $name }}',
                            {{ $value }}
                            ],
                        @endforeach
                ]
            },
            {
                name: 'Corte I',
                    id: 'Corte I',
                    data: [
                        @foreach($percentages_1 as $name => $value)
                        [
                            '{{ $name }}',
                            {{ $value }}
                            ],
                        @endforeach
                ]
            },
            {
                name: 'Corte II',
                    id: 'Corte II',
                    data: [
                        @foreach($percentages_2 as $name => $value)
                        [
                            '{{ $name }}',
                            {{ $value }}
                            ],
                        @endforeach
                ]
            },
            {
                name: 'Corte III',
                    id: 'Corte III',
                    data: [
                        @foreach($percentages_3 as $name => $value)
                        [
                            '{{ $name }}',
                            {{ $value }}
                            ],
                        @endforeach
                ]
            }
        ]
    }
});
</script>
@endsection
