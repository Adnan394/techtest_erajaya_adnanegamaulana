<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erajaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color:#f0f0f0
        }

        #main {
            width: 100%;
            height: 500px;
            margin-top: 80px;
        }
        
        #piechart, #piechart2, #barchart, #linechart {
            margin-top: 150px;
            width: 100%;
            height: 400px;
        }
    </style>
  </head>
  <body>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('index') }}" method="GET">
                @csrf
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <select name="company" id="company" class="form-select">

                        <option value="" selected>All</option>
                        @foreach ($company as $value)
                            <option value="{{ $value->id }}" {{ $request->company == $value->id ? 'selected' : '' }}>{{ $value->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="division" class="form-label">Division</label>
                    <select name="division" id="division" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($division as $value)
                            <option value="{{ $value->id }}" {{ $request->division == $value->id ? 'selected' : '' }}>{{ $value->division_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($level as $value)
                            <option value="{{ $value->id }}" {{ $request->level == $value->id ? 'selected' : '' }}>{{ $value->level_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($gender as $value)
                            <option value="{{ $value->id }}" {{ $request->gender == $value->id ? 'selected' : '' }}>{{ $value->gender_name }}</option>
                        @endforeach
                    </select>
                </div>


                <button class="btn btn-primary" type="submit">Apply Filter</button>
            </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" alt="" width="150px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active px-3" aria-current="page" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-funnel-fill fs-3"></i></a>
                </li>
            </ul>
            </div>
        </div>
    </nav>


    <main class="container pt-5">
        <div class="row">
            <div class="col" id="barchart"></div>
        </div>
        <div class="row">
            <div class="col" id="piechart"></div>
            <div class="col" id="piechart2"></div>
        </div>
        <div class="row">
            <div class="col" id="linechart"></div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    {{-- echart --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.6.0/echarts.min.js"></script>

    <script>
        var piechart = document.getElementById('piechart');
        var piechart2 = document.getElementById('piechart2');
        var barchart = document.getElementById('barchart');
        var linechart = document.getElementById('linechart');

        var myChart = echarts.init(piechart);
        var myChart2 = echarts.init(piechart2);
        var myChart3 = echarts.init(barchart);
        var myChart4 = echarts.init(linechart);
        var data = {!! json_encode($data) !!};

        // Mapping bulan dari angka ke nama
        const monthMap = {
            '01': 'Jan',
            '02': 'Feb',
            '03': 'Mar',
            '04': 'Apr',
            '05': 'May',
            '06': 'Jun',
            '07': 'Jul',
            '08': 'Aug',
            '09': 'Sep',
            '10': 'Oct',
            '11': 'Nov',
            '12': 'Dec'
        };

        const formattedData = data.map(item => {
            const year = item.period.toString().slice(0, 4);
            const month = item.period.toString().slice(4, 6);
            const monthName = monthMap[month] || month;
            return {
                value: item.total,
                name: `${monthName} ${year}`
            };
        });

        var option = {
            title: {
                text: 'Pie Chart',
                subtext: 'Employee count',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            series: [
                {
                    name: 'Employee Count',
                    type: 'pie',
                    radius: '70%',
                    data: formattedData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                    label: {
                        show: true,
                        formatter: '{b}: {c}',
                        position: 'outline'
                    },
                }
            ]
        };

        var option2 = {
            title: {
                text: 'Nightingale Chart',
                subtext: 'Employee Period',
                left: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
            },
            series: [
                {
                    name: 'Employee Count',
                    type: 'pie',
                    radius: [20, 140],
                    center: ['50%', '50%'],
                    roseType: 'area',
                    itemStyle: {
                        borderRadius: 8
                    },
                    label: {
                        show: true,
                        formatter: '{b}: {c}',
                        position: 'outside'
                    },
                    labelLine: {
                        show: true,
                        length: 20,
                        length2: 10
                    },
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                    data: formattedData,
                }
            ]
        };

        option3 = {
            title: {
                text: 'Bar Chart',
                subtext: 'Employee count',
                left: 'center'
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: {
                type: 'category',
                data: formattedData.map(item => item.name),
                axisLabel: {
                    interval: 0, 
                    rotate: 30 
                }
            },
            yAxis: {
                type: 'value'
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const item = params[0];
                    return `${item.name}<br/><strong>${item.value}</strong>`;
                }
            },
            series: [
                {
                    data: formattedData.map(item => item.value),
                    type: 'bar',
                    barCategoryGap: '20%',
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}' 
                    },
                    itemStyle: {
                        color: '#5470C6'
                    }
                }
            ]
        };

        option4 = {
            title: {
                text: 'Line Chart',
                subtext: 'Employee count',
                left: 'center'
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: formattedData.map(item => item.name),
            },
            yAxis: {
                type: 'value'
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const item = params[0];
                    return `${item.name}<br/><strong>${item.value}</strong>`;
                }
            },
            series: [
                {
                    data: formattedData.map(item => item.value),
                    type: 'line',
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}' 
                    }
                }
            ]
        };


        // Set options
        myChart.setOption(option);
        myChart2.setOption(option2);
        myChart3.setOption(option3);
        myChart4.setOption(option4);
    </script>

  </body>
</html>