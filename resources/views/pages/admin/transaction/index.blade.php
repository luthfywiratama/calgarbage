@extends('layouts.admin')


@section('content')
<div class="container my-5">
    @include('includes.admin.flash-message')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
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
                    @foreach($transactions as $item)
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
                            <td><a href="#" data-route="{{ route('admin.transaction.update',$item->id) }}"
                                    class="text-primary update" data-bs-toggle="modal"
                                    data-bs-target="#modalUpdate">Update Status</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<!-- Modal trigger button -->


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalUpdate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="form-update">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <p class="text-center">Update Menjadi diterima?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">YES</button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
@push('js')
<script>
    $(document).ready(function () {
        $('.update').click(function (e) {
            var route = $(this).data("route");
            $('#form-update').attr('action', route);
        });
    });

</script>


@endpush
