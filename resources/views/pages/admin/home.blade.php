@extends('layouts.admin')


@section('content')
<div class="container mt-5">

    <div class="card mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <h4>Transaksi </h4>
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Sampah</th>
                                    <th scope="col">Jumlah Berat</th>
                                    <th scope="col">Total Bayar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Lama Penyimpanan</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->garbageType->name ?? '-' }}</td>
                                    <td>{{ $item->weight }} KG</td>
                                    <td>Rp. {{ number_format($item->total_payment) }}</td>
                                    <td>
                                        @if($item->status == 'pending')
                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                        @else
                                        <span class="badge rounded-pill bg-success">Diterima</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td><a href="#"
                                         data-name="{{ $item->name }}"
                                         data-type="{{ $item->garbageType->name }}"
                                         data-weight="{{ $item->garbageType->name }}"
                                         data-payment="{{ $item->total_payment }}"
                                         data-status="{{ $item->status }}"
                                         class="text-primary detail"
                                         data-bs-toggle="modal" data-bs-target="#modalDetail">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-lg-4">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Nama:</td>
                        <td id="name_detail"></td>
                    </tr>
                    <tr>
                        <td>Jenis Sampah:</td>
                        <td id="type_detail"></td>
                    </tr>
                    <tr>
                        <td>Berat:</td>
                        <td id="weight_detail"></td>
                    </tr>
                    <tr>
                        <td>Total Bayar:</td>
                        <td id="payment_detail"></td>
                    </tr>
                    <tr>
                        <td>status:</td>
                        <td id="status_detail"></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>




@push('js')
    <script src="{{ asset('cms/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('cms/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('cms/assets/js/plugins/chart.js/chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($label),
                datasets: [{
                    data: @json($count),
                    backgroundColor: @json($color),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

    <script>
        $(document).ready(function () {


            function totalpay()
            {
                let price = $('#type').find('option:selected').data('price');
                let weight = $('#weight').val();

                console.log(weight);
                let total = price * weight;
                $('#totalpay').html(formatRupiah(total));
            }
            function formatRupiah(number) {
                var rupiah = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                return rupiah;
                }
            // Listen for a change event on the select element
            $("#type").on("change", function () {
                totalpay();
            });
            $("#weight").on("keyup", function () {
                totalpay();
            });

            $('.detail').click(function (e) {
                e.preventDefault();
                let name = $(this).data('name');
                let type = $(this).data('type');
                let weight = $(this).data('weight');
                let payment = $(this).data('payment');
                let status = $(this).data('status');

                $('#name_detail').html(name);
                $('#type_detail').html(type);
                $('#weight_detail').html(weight);
                $('#payment_detail').html(payment);
                $('#status_detail').html(status);

            });

        });

    </script>
@endpush
